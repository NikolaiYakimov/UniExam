export default function Alert({ type, message, onClose }) {
    const bgColor = type === 'error' ? 'bg-red-50 border-red-200 text-red-800' : 'bg-green-50 border-green-200 text-green-800';
    const icon = type === 'error' ? 'fa-exclamation-circle' : 'fa-check-circle';
    const iconColor = type === 'error' ? 'text-red-500' : 'text-green-500';

    return (
        <div className={`mb-6 p-4 border rounded-lg flex items-start gap-3 relative ${bgColor}`}>
            <div className="mt-0.5 flex-shrink-0">
                <i className={`fas ${icon} ${iconColor}`}></i>
            </div>
            <div>
                <p className="font-medium">{type === 'error' ? 'Грешка!' : 'Успешно!'}</p>
                <p>{message}</p>
            </div>
            <button
                type="button"
                className={`absolute top-3 right-3 ${type === 'error' ? 'text-red-500 hover:text-red-700' : 'text-green-500 hover:text-green-700'}`}
                onClick={onClose}
            >
                <i className="fas fa-times"></i>
            </button>
        </div>
    );
}
