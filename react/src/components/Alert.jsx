
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
