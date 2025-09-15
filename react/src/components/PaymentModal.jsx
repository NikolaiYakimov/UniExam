// import { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
//
// export default function PaymentModal({ exam, onSuccess, onError, onClose }) {
//     const { token } = useAuth();
//     const [loading, setLoading] = useState(false);
//
//     useEffect(() => {
//         // Инициализиране на Stripe плащането
//         const initializePayment = async () => {
//             setLoading(true);
//             try {
//                 const response = await fetch(`http://localhost:8000/api/payment/${exam.id}/handle`, {
//                     method: 'POST',
//                     headers: {
//                         'Authorization': `Bearer ${token}`,
//                         'Content-Type': 'application/json',
//                     },
//                     body: JSON.stringify({ exam_id: exam.id })
//                 });
//
//                 if (!response.ok) {
//                     throw new Error('Грешка при инициализиране на плащането');
//                 }
//
//                 const { clientSecret } = await response.json();
//
//                 // Инициализиране на Stripe Embedded Checkout
//                 if (window.Stripe) {
//                     const stripe = window.Stripe("{{ config('services.stripe.key') }}");
//                     stripe.initEmbeddedCheckout({
//                         clientSecret
//                     }).then((checkout) => {
//                         checkout.mount('#checkout');
//
//                         // Обработка на събития
//                         checkout.on('complete', () => {
//                             onSuccess();
//                         });
//
//                         checkout.on('close', () => {
//                             onClose();
//                         });
//                     });
//                 }
//             } catch (error) {
//                 onError(error);
//             } finally {
//                 setLoading(false);
//             }
//         };
//
//         initializePayment();
//     }, [exam, token, onSuccess, onError, onClose]);
//
//     return (
//         <div className="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
//             <div className="bg-white rounded-lg shadow-lg w-full max-w-md mx-auto p-6 relative">
//                 <button
//                     onClick={onClose}
//                     className="absolute top-2 right-2 text-gray-500 hover:text-gray-700"
//                 >
//                     <i className="fas fa-times"></i>
//                 </button>
//
//                 <h2 className="text-xl font-semibold text-gray-800 mb-4">
//                     Плащане за {exam.subject?.subject_name}
//                 </h2>
//
//                 <div className="mb-4">
//                     <p className="text-gray-600">Цена: <span className="font-medium">{exam.price} лв.</span></p>
//                 </div>
//
//                 {loading ? (
//                     <div className="flex justify-center items-center h-40">
//                         <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
//                     </div>
//                 ) : (
//                     <div className="w-full overflow-x-auto">
//                         <div id="checkout" className="min-w-[400px] h-[400px]"></div>
//                     </div>
//                 )}
//             </div>
//         </div>
//     );
// }
// PaymentModal.jsx - For handling payment process
// export default function PaymentModal({ exam, onSuccess, onError, onClose }) {
//     const [loading, setLoading] = useState(false);
//
//     const handlePayment = async () => {
//         setLoading(true);
//         try {
//             // Simulate payment process
//             await new Promise(resolve => setTimeout(resolve, 2000));
//
//             // In a real implementation, this would integrate with Stripe
//             onSuccess();
//         } catch (error) {
//             onError(error);
//         } finally {
//             setLoading(false);
//         }
//     };
//
//     return (
//         <div className="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
//             <div className="bg-white rounded-lg shadow-lg w-full max-w-md mx-auto p-6 relative">
//                 <button
//                     onClick={onClose}
//                     className="absolute top-2 right-2 text-gray-500 hover:text-gray-700"
//                 >
//                     <i className="fas fa-times"></i>
//                 </button>
//
//                 <h2 className="text-xl font-bold text-gray-800 mb-4">Плащане за изпит</h2>
//
//                 <div className="mb-4">
//                     <p className="text-gray-600">Предмет: <span className="font-medium">{exam.subject?.subject_name}</span></p>
//                     <p className="text-gray-600">Тип: <span className="font-medium">{exam.exam_type}</span></p>
//                     <p className="text-gray-600">Цена: <span className="font-medium">{exam.price} лв.</span></p>
//                 </div>
//
//                 <div className="flex justify-end gap-3">
//                     <button
//                         onClick={onClose}
//                         className="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100"
//                         disabled={loading}
//                     >
//                         Отказ
//                     </button>
//                     <button
//                         onClick={handlePayment}
//                         className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50"
//                         disabled={loading}
//                     >
//                         {loading ? 'Обработка...' : 'Плати'}
//                     </button>
//                 </div>
//             </div>
//         </div>
//     );
// }


// import { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
//
// export default function PaymentModal({ exam, onSuccess, onError, onClose }) {
//     const { token } = useAuth();
//     const [loading, setLoading] = useState(false);
//
//     const handlePayment = async () => {
//         try {
//             setLoading(true);
//             const response = await fetch(`http://localhost:8000/api/payment/${exam.id}`, {
//                 method: 'POST',
//                 headers: {
//                     'Authorization': `Bearer ${token}`,
//                     'Content-Type': 'application/json',
//                 }
//             });
//
//             if (!response.ok) {
//                 throw new Error('Грешка при иницииране на плащането');
//             }
//
//             const { clientSecret } = await response.json();
//
//             // Инициализиране на Stripe плащане
//             // Тук трябва да добавите кода за инициализиране на Stripe
//             // Това е само примерна структура
//
//             // Ако успешно се инициира плащането
//             onSuccess();
//         } catch (err) {
//             onError(err);
//         } finally {
//             setLoading(false);
//         }
//     };
//
//     return (
//         <div className="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
//             <div className="bg-white rounded-lg shadow-lg w-full max-w-md mx-auto p-6 relative">
//                 <button onClick={onClose} className="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
//                     <i className="fas fa-times"></i>
//                 </button>
//
//                 <h2 className="text-xl font-bold text-gray-800 mb-4">Плащане за изпит</h2>
//                 <p className="text-gray-600 mb-2">Предмет: {exam.subject?.subject_name}</p>
//                 <p className="text-gray-600 mb-4">Цена: {exam.price} лв.</p>
//
//                 <div className="flex justify-end space-x-3">
//                     <button
//                         onClick={onClose}
//                         className="px-4 py-2 text-gray-600 hover:text-gray-800"
//                     >
//                         Отказ
//                     </button>
//                     <button
//                         onClick={handlePayment}
//                         disabled={loading}
//                         className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50"
//                     >
//                         {loading ? 'Зареждане...' : 'Плати'}
//                     </button>
//                 </div>
//             </div>
//         </div>
//     );
// }
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
