import { useState, useEffect } from 'react';
import { useAuth } from '../hooks/useAuth';

export default function PaymentModal({ exam, onSuccess, onError, onClose }) {
    const { token } = useAuth();
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        // Инициализиране на Stripe плащането
        const initializePayment = async () => {
            setLoading(true);
            try {
                const response = await fetch(`http://localhost:8000/api/payment/${exam.id}/handle`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ exam_id: exam.id })
                });

                if (!response.ok) {
                    throw new Error('Грешка при инициализиране на плащането');
                }

                const { clientSecret } = await response.json();

                // Инициализиране на Stripe Embedded Checkout
                if (window.Stripe) {
                    const stripe = window.Stripe("{{ config('services.stripe.key') }}");
                    stripe.initEmbeddedCheckout({
                        clientSecret
                    }).then((checkout) => {
                        checkout.mount('#checkout');

                        // Обработка на събития
                        checkout.on('complete', () => {
                            onSuccess();
                        });

                        checkout.on('close', () => {
                            onClose();
                        });
                    });
                }
            } catch (error) {
                onError(error);
            } finally {
                setLoading(false);
            }
        };

        initializePayment();
    }, [exam, token, onSuccess, onError, onClose]);

    return (
        <div className="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div className="bg-white rounded-lg shadow-lg w-full max-w-md mx-auto p-6 relative">
                <button
                    onClick={onClose}
                    className="absolute top-2 right-2 text-gray-500 hover:text-gray-700"
                >
                    <i className="fas fa-times"></i>
                </button>

                <h2 className="text-xl font-semibold text-gray-800 mb-4">
                    Плащане за {exam.subject?.subject_name}
                </h2>

                <div className="mb-4">
                    <p className="text-gray-600">Цена: <span className="font-medium">{exam.price} лв.</span></p>
                </div>

                {loading ? (
                    <div className="flex justify-center items-center h-40">
                        <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                    </div>
                ) : (
                    <div className="w-full overflow-x-auto">
                        <div id="checkout" className="min-w-[400px] h-[400px]"></div>
                    </div>
                )}
            </div>
        </div>
    );
}
