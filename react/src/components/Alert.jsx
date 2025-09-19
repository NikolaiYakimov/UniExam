// export default function Alert({ type, message, onClose }) {
//     const bgColor = type === 'error' ? 'bg-red-50 border-red-200 text-red-800' : 'bg-green-50 border-green-200 text-green-800';
//     const icon = type === 'error' ? 'fa-exclamation-circle' : 'fa-check-circle';
//     const iconColor = type === 'error' ? 'text-red-500' : 'text-green-500';
//
//     return (
//         <div className={`mb-6 p-4 border rounded-lg flex items-start gap-3 relative ${bgColor}`}>
//             <div className="mt-0.5 flex-shrink-0">
//                 <i className={`fas ${icon} ${iconColor}`}></i>
//             </div>
//             <div>
//                 <p className="font-medium">{type === 'error' ? 'Грешка!' : 'Успешно!'}</p>
//                 <p>{message}</p>
//             </div>
//             <button
//                 type="button"
//                 className={`absolute top-3 right-3 ${type === 'error' ? 'text-red-500 hover:text-red-700' : 'text-green-500 hover:text-green-700'}`}
//                 onClick={onClose}
//             >
//                 <i className="fas fa-times"></i>
//             </button>
//         </div>
//     );
// }
// Alert.jsx - For displaying success/error messages
// export default function Alert({ type, message, onClose }) {
//     const bgColor = type === 'success' ? 'bg-green-50' : 'bg-red-50';
//     const borderColor = type === 'success' ? 'border-green-200' : 'border-red-200';
//     const textColor = type === 'success' ? 'text-green-800' : 'text-red-800';
//     const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
//     const iconColor = type === 'success' ? 'text-green-500' : 'text-red-500';
//
//     return (
//         <div className={`mb-6 p-4 ${bgColor} border ${borderColor} rounded-lg ${textColor} flex items-start gap-3 relative`}>
//             <div className="mt-0.5 flex-shrink-0">
//                 <i className={`fas ${icon} ${iconColor}`}></i>
//             </div>
//             <div>
//                 <p className="font-medium">{type === 'success' ? 'Успешно!' : 'Грешка!'}</p>
//                 <p>{message}</p>
//             </div>
//             <button
//                 type="button"
//                 className={`absolute top-3 right-3 ${type === 'success' ? 'text-green-500 hover:text-green-700' : 'text-red-500 hover:text-red-700'}`}
//                 onClick={onClose}
//             >
//                 <i className="fas fa-times"></i>
//             </button>
//         </div>
//     );
// }
// Alert.jsx
// import { useEffect, useState } from 'react';
//
// const Alert = ({ type, message, onClose }) => {
//     const [visible, setVisible] = useState(true);
//
//     useEffect(() => {
//         if (message) {
//             setVisible(true);
//             const timer = setTimeout(() => {
//                 setVisible(false);
//                 if (onClose) onClose();
//             }, 5000);
//             return () => clearTimeout(timer);
//         }
//     }, [message, onClose]);
//
//     if (!visible || !message) return null;
//
//     const alertConfig = {
//         success: {
//             bg: 'bg-green-50',
//             border: 'border-green-200',
//             text: 'text-green-800',
//             icon: 'fa-check-circle text-green-500',
//             title: 'Успешно!'
//         },
//         error: {
//             bg: 'bg-red-50',
//             border: 'border-red-200',
//             text: 'text-red-800',
//             icon: 'fa-exclamation-circle text-red-500',
//             title: 'Грешка!'
//         }
//     };
//
//     const config = alertConfig[type] || alertConfig.success;
//
//     return (
//         <div className={`mb-6 p-4 border rounded-lg flex items-start gap-3 relative ${config.bg} ${config.border} ${config.text}`}>
//             <div className="mt-0.5 flex-shrink-0">
//                 <i className={`fas ${config.icon}`}></i>
//             </div>
//             <div>
//                 <p className="font-medium">{config.title}</p>
//                 <p>{message}</p>
//             </div>
//             <button
//                 type="button"
//                 className={`absolute top-3 right-3 hover:opacity-70 ${type === 'success' ? 'text-green-500' : 'text-red-500'}`}
//                 onClick={() => {
//                     setVisible(false);
//                     if (onClose) onClose();
//                 }}
//             >
//                 <i className="fas fa-times"></i>
//             </button>
//         </div>
//     );
// };
//
// export default Alert;
// components/Alert.jsx
import { useEffect, useState } from 'react';

export default function Alert({ type = 'success', message, onClose }) {
    const [visible, setVisible] = useState(Boolean(message));

    useEffect(() => {
        if (!message) return;
        setVisible(true);
        const t = setTimeout(() => {
            setVisible(false);
            onClose?.();
        }, 5000);
        return () => clearTimeout(t);
    }, [message, onClose]);

    if (!visible || !message) return null;

    const isSuccess = type === 'success';
    const bg = isSuccess ? 'bg-green-50' : 'bg-red-50';
    const border = isSuccess ? 'border-green-200' : 'border-red-200';
    const text = isSuccess ? 'text-green-800' : 'text-red-800';
    const icon = isSuccess ? 'fa-check-circle text-green-500' : 'fa-exclamation-circle text-red-500';
    const close = isSuccess ? 'text-green-500 hover:text-green-700' : 'text-red-500 hover:text-red-700';

    return (
        <div className={`mb-6 p-4 border rounded-lg flex items-start gap-3 relative ${bg} ${border} ${text}`}>
            <div className="mt-0.5 flex-shrink-0">
                <i className={`fas ${icon}`}></i>
            </div>
            <div>
                <p className="font-medium">{isSuccess ? 'Успешно!' : 'Грешка!'}</p>
                <p>{message}</p>
            </div>
            <button type="button" className={`absolute top-3 right-3 ${close}`} onClick={() => { setVisible(false); onClose?.(); }}>
                <i className="fas fa-times"></i>
            </button>
        </div>
    );
}
