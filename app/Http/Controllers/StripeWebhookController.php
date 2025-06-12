<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Webhook;
use App\Http\Controllers\PaymentController;

class StripeWebhookController extends Controller
{
    protected $paymentController;

    public function __construct(PaymentController $paymentController)
    {
        $this->paymentController = $paymentController;
    }

    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $webhookSecret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent(
                $payload, $sigHeader, $webhookSecret
            );

            // Handle the event
            switch ($event->type) {
                case 'checkout.session.completed':
                    $session = $event->data->object;
                    if ($session->payment_status === 'paid') {
                        try {
                            $this->paymentController->createRegistrationAndPayment($session);
                            Log::info('Checkout session completed and registration created:', ['session_id' => $session->id]);
                        } catch (\Exception $e) {
                            Log::error('Failed to process checkout session:', [
                                'session_id' => $session->id,
                                'error' => $e->getMessage()
                            ]);
                            // If registration fails, initiate refund
                            $this->paymentController->processRefund($session->payment_intent, $e->getMessage());
                        }
                    }
                    break;

                case 'checkout.session.expired':
                    $session = $event->data->object;
                    Log::info('Checkout session expired:', ['session_id' => $session->id]);
                    break;

                case 'payment_intent.payment_failed':
                    $paymentIntent = $event->data->object;
                    Log::error('Payment failed:', [
                        'payment_intent_id' => $paymentIntent->id,
                        'error' => $paymentIntent->last_payment_error?->message ?? 'Unknown error'
                    ]);
                    break;

                case 'charge.refunded':
                    $charge = $event->data->object;
                    Log::info('Payment refunded:', [
                        'charge_id' => $charge->id,
                        'amount_refunded' => $charge->amount_refunded / 100,
                        'currency' => $charge->currency
                    ]);
                    // You might want to update your local payment record here
                    Payment::where('stripe_payment_id', $charge->payment_intent)
                        ->update(['status' => 'refunded']);
                    break;

                default:
                    Log::info('Unhandled event type: ' . $event->type);
            }

            return response()->json(['status' => 'success']);
        } catch (\UnexpectedValueException $e) {
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        } catch (\Exception $e) {
            Log::error('Webhook error: ' . $e->getMessage());
            return response()->json(['error' => 'Webhook handling failed'], 500);
        }
    }
}
