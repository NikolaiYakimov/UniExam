//
// import React, { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth.jsx';
// import Header from './Header.jsx';
// import Sidebar from './Sidebar';
//
// const StudentPayments = () => {
//     const [payments, setPayments] = useState([]);
//     const [loading, setLoading] = useState(true);
//     const [error, setError] = useState('');
//     const [success, setSuccess] = useState('');
//     const { user } = useAuth();
//
//     useEffect(() => {
//         fetchPayments();
//     }, []);
//
//     const fetchPayments = async () => {
//         try {
//             const token = localStorage.getItem('token');
//             const response = await fetch('/api/payments', {
//                 headers: {
//                     'Authorization': `Bearer ${token}`,
//                     'Content-Type': 'application/json',
//                 },
//             });
//
//             if (!response.ok) {
//                 throw new Error('Failed to fetch payments');
//             }
//
//             const data = await response.json();
//             setPayments(data.payments || []);
//         } catch (err) {
//             setError('Грешка при зареждане на плащанията.');
//             console.error('Error fetching payments:', err);
//         } finally {
//             setLoading(false);
//         }
//     };
//
//     const formatDate = (dateString) => {
//         return new Date(dateString).toLocaleDateString('bg-BG', {
//             year: 'numeric',
//             month: 'long',
//             day: 'numeric',
//             hour: '2-digit',
//             minute: '2-digit'
//         });
//     };
//
//     const getStatusBadge = (status) => {
//         if (status === 'paid') {
//             return <span className="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Платено</span>;
//         } else if (status === 'refunded') {
//             return <span className="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Върнато</span>;
//         } else {
//             return <span className="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">{status}</span>;
//         }
//     };
//
//     if (loading) {
//         return (
//             <div className="flex justify-center items-center h-64">
//                 <div className="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-indigo-500"></div>
//             </div>
//         );
//     }
//
//     return (
//         <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">
//             <Header />
//
//             <div className="page-layout">
//                 <Sidebar user={user} />
//
//                 <div id="mainContent" className="ml-0 lg:ml-0 p-4 lg:p-8 transition-all duration-300">
//                     {/* Page Header */}
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Моите плащания</h1>
//                                 <p className="text-sm text-gray-500 mt-1">История на всички ваши плащания</p>
//                             </div>
//                         </div>
//                     </div>
//
//                     {/* Alerts */}
//                     {error && (
//                         <div className="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-md">
//                             <div className="flex">
//                                 <div className="flex-shrink-0">
//                                     <svg className="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
//                                         <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clipRule="evenodd" />
//                                     </svg>
//                                 </div>
//                                 <div className="ml-3">
//                                     <p className="text-sm text-red-700">{error}</p>
//                                 </div>
//                             </div>
//                         </div>
//                     )}
//
//                     {success && (
//                         <div className="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-md">
//                             <div className="flex">
//                                 <div className="flex-shrink-0">
//                                     <svg className="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
//                                         <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clipRule="evenodd" />
//                                     </svg>
//                                 </div>
//                                 <div className="ml-3">
//                                     <p className="text-sm text-green-700">{success}</p>
//                                 </div>
//                             </div>
//                         </div>
//                     )}
//
//                     {payments.length === 0 ? (
//                         <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
//                             <i className="fas fa-credit-card text-4xl text-gray-300 mb-4"></i>
//                             <h3 className="text-lg font-medium text-gray-700 mb-2">Нямате направени плащания</h3>
//                             <p className="text-gray-500">Все още нямате записани плащания в системата.</p>
//                         </div>
//                     ) : (
//                         <div className="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
//                             <div className="overflow-x-auto">
//                                 <table className="w-full">
//                                     <thead className="bg-gray-50">
//                                     <tr>
//                                         <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Изпит</th>
//                                         <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID на плащане</th>
//                                         <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Сума</th>
//                                         <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Статус</th>
//                                         <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Дата</th>
//                                     </tr>
//                                     </thead>
//                                     <tbody className="bg-white divide-y divide-gray-100">
//                                     {payments.map((payment) => (
//                                         <tr key={payment.id} className="hover:bg-gray-50">
//                                             <td className="px-6 py-4 whitespace-nowrap">
//                                                 <div className="text-sm font-medium text-gray-900">
//                                                     {payment.registration?.exam?.subject?.subject_name || 'Няма информация'}
//                                                 </div>
//                                                 <div className="text-sm text-gray-500">
//                                                     {payment.registration?.exam?.exam_type || ''}
//                                                 </div>
//                                             </td>
//                                             <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
//                                                 {payment.stripe_payment_id}
//                                             </td>
//                                             <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
//                                                 {payment.amount} {payment.currency && payment.currency.toUpperCase()}
//                                             </td>
//                                             <td className="px-6 py-4 whitespace-nowrap">
//                                                 {getStatusBadge(payment.status)}
//                                             </td>
//                                             <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
//                                                 {formatDate(payment.payment_date)}
//                                             </td>
//                                         </tr>
//                                     ))}
//                                     </tbody>
//                                 </table>
//                             </div>
//                         </div>
//                     )}
//                 </div>
//             </div>
//         </div>
//     );
// };
//
// export default StudentPayments;
import React, { useState, useEffect } from 'react';
import { useAuth, api } from '../hooks/useAuth.jsx';
import { useLocation, Link } from 'react-router-dom';
import Header from './Header.jsx';
import Sidebar from './Sidebar';
import Alert from './Alert';

const StudentPayments = () => {
    const { user } = useAuth();
    const location = useLocation();
    const [payments, setPayments] = useState([]);
    const [loading, setLoading] = useState(true);
    const [alert, setAlert] = useState({ type: '', message: '' });

    useEffect(() => {
        fetchPayments();

        if (location.state?.message) {
            setAlert({ type: 'success', message: location.state.message });
            window.history.replaceState({}, document.title);
        }
    }, [location.state]);

    const fetchPayments = async () => {
        try {
            setLoading(true);
            const response = await api.get('/payments');
            console.log(response)

            if (response.status==200) {
                setPayments(response.data.payments || []);
            } else {
                setAlert({ type: 'error', message: 'Грешка при зареждане на плащанията.' });
            }
        } catch (error) {
            console.error('Error fetching payments:', error);
            setAlert({ type: 'error', message: 'Грешка при зареждане на плащанията.' });
        } finally {
            setLoading(false);
        }
    };

    const formatDate = (dateString) => {
        return new Date(dateString).toLocaleDateString('bg-BG', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    };

    const getStatusBadge = (status) => {
        const statusConfig = {
            paid: { class: 'bg-green-100 text-green-800', text: 'Платено' },
            refunded: { class: 'bg-red-100 text-red-800', text: 'Върнато' },
            pending: { class: 'bg-yellow-100 text-yellow-800', text: 'Изчакване' },
            failed: { class: 'bg-red-100 text-red-800', text: 'Неуспешно' }
        };

        const config = statusConfig[status] || { class: 'bg-gray-100 text-gray-800', text: status };

        return (
            <span className={`px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${config.class}`}>
                {config.text}
            </span>
        );
    };

    if (loading) {
        return (
            <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50">
                <Header />
                <div className="flex pt-0">
                    <Sidebar user={user} />
                    <div className="flex-1 p-4 lg:p-8 ml-0 lg:ml-0 flex justify-center items-center">
                        <div className="flex justify-center items-center py-8">
                            <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600"></div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50">
            <Header />
            <div className="flex pt-0">
                <Sidebar user={user} />

                <div className="flex-1 p-4 lg:p-8 ml-0 lg:ml-0">
                    <div className="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">
                        <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                            <div>
                                <h1 className="text-2xl font-bold text-gray-800">Моите плащания</h1>
                                <p className="text-sm text-gray-500 mt-1">История на всички ваши плащания</p>
                            </div>

                        </div>
                    </div>

                    {alert.message && (
                        <Alert
                            type={alert.type}
                            message={alert.message}
                            onClose={() => setAlert({ type: '', message: '' })}
                        />
                    )}

                    {payments.length === 0 ? (
                        <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
                            <i className="fas fa-credit-card text-4xl text-gray-300 mb-4"></i>
                            <h3 className="text-lg font-medium text-gray-700 mb-2">Нямате направени плащания</h3>
                            <p className="text-gray-500">Все още нямате записани плащания в системата.</p>
                        </div>
                    ) : (
                        <div className="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                            <div className="overflow-x-auto">
                                <table className="w-full">
                                    <thead className="bg-gray-50">
                                    <tr>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Изпит
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID на плащане
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Сума
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Статус
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Дата
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody className="bg-white divide-y divide-gray-100">
                                    {payments.map((payment) => (
                                        <tr key={payment.id} className="hover:bg-gray-50 transition-colors">
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <div className="text-sm font-medium text-gray-900">
                                                    {payment.registration?.exam?.subject?.subject_name || 'Няма информация'}
                                                </div>
                                                <div className="text-sm text-gray-500">
                                                    {payment.registration?.exam?.exam_type || ''}
                                                </div>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono">
                                                {payment.stripe_payment_id}
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {payment.amount} {payment.currency && payment.currency.toUpperCase()}
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                {getStatusBadge(payment.status)}
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {formatDate(payment.payment_date)}
                                            </td>
                                        </tr>
                                    ))}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
};

export default StudentPayments;
