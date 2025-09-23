
import { useEffect, useState } from 'react';
import { useAuth } from '../hooks/useAuth';
import { loadStripe } from '@stripe/stripe-js';
import { EmbeddedCheckoutProvider, EmbeddedCheckout } from '@stripe/react-stripe-js';

const stripePromise = loadStripe('pk_test_51RNuBn03XfZ86NSQtnbBWiqAtD9vawHSxECfQEHM2qY3B9xjhjBkpWF6JI6kH0qASsxR2A0JQv3m3jwiiOZ5UQz700JYH2zz8U'); // Replace with your actual publishable key

export default function PaymentModal({ exam, onSuccess, onError, onClose }) {
    const { token } = useAuth();
    const [clientSecret, setClientSecret] = useState('');
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const createCheckoutSession = async () => {
            try {
                setLoading(true);
                // const response = await fetch(`http://localhost:8000/api/payment/${exam.id}`, {
                //     method: 'POST',
                //     headers: {
                //         'Authorization': `Bearer ${token}`,
                //         'Content-Type': 'application/json',
                //     }
                // });
                const response = await fetch(`http://localhost:8000/api/exams/payment/${exam.id}`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                    }
                });

                if (!response.ok) {
                    throw new Error('Грешка при създаване на сесия за плащане');
                }

                const { clientSecret } = await response.json();
                setClientSecret(clientSecret);
            } catch (err) {
                onError(err);
                onClose();
            } finally {
                setLoading(false);
            }
        };

        if (exam) {
            createCheckoutSession();
        }
    }, [exam, token, onError, onClose]);

    return (
        <div className="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div className="bg-white rounded-lg shadow-lg w-full max-w-2xl mx-auto p-6 relative">
                <button onClick={onClose} className="absolute top-4 right-4 text-gray-500 hover:text-gray-700 z-10">
                    <i className="fas fa-times text-xl"></i>
                </button>

                <h2 className="text-xl font-bold text-gray-800 mb-4">Плащане за изпит</h2>

                {loading ? (
                    <div className="flex justify-center items-center h-64">
                        <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
                    </div>
                ) : clientSecret ? (
                    <div className="w-full overflow-x-auto">
                        <EmbeddedCheckoutProvider
                            stripe={stripePromise}
                            options={{ clientSecret }}
                        >
                            <EmbeddedCheckout className="min-w-[400px] h-[600px]" />
                        </EmbeddedCheckoutProvider>
                    </div>
                ) : (
                    <div className="text-center p-8">
                        <p className="text-red-500">Грешка при зареждане на формата за плащане</p>
                    </div>
                )}
            </div>
        </div>
    );
}
