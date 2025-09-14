import { useAuth } from '../hooks/useAuth.jsx';

export default function Dashboard() {
    const { user, logout } = useAuth();

    const handleLogout = () => {
        logout();
    };

    return (
        <div style={{ padding: '20px', fontFamily: 'Arial, sans-serif' }}>
            <header style={{
                display: 'flex',
                justifyContent: 'space-between',
                alignItems: 'center',
                marginBottom: '30px',
                paddingBottom: '15px',
                borderBottom: '1px solid #ddd'
            }}>
                <h1>Добре дошли, {user?.first_name} {user?.last_name}</h1>
                <h2>Твоят телефон е {user?.phone}</h2>
                <button
                    onClick={handleLogout}
                    style={{
                        padding: '8px 16px',
                        backgroundColor: '#dc3545',
                        color: 'white',
                        border: 'none',
                        borderRadius: '4px',
                        cursor: 'pointer'
                    }}
                >
                    Изход
                </button>
            </header>

            <div style={{
                backgroundColor: '#f8f9fa',
                padding: '20px',
                borderRadius: '8px',
                maxWidth: '600px',
                margin: '0 auto'
            }}>
                <h2>Потребителска информация</h2>
                <div style={{ marginBottom: '15px' }}>
                    <strong>Име:</strong> {user?.first_name} {user?.second_name} {user?.last_name}
                </div>
                <div style={{ marginBottom: '15px' }}>
                    <strong>Потребителско име:</strong> {user?.username}
                </div>
                <div style={{ marginBottom: '15px' }}>
                    <strong>Имейл:</strong> {user?.email}
                </div>
                <div style={{ marginBottom: '15px' }}>
                    <strong>Телефон:</strong> {user?.phone}
                </div>
                <div style={{ marginBottom: '15px' }}>
                    <strong>Роля:</strong> {user?.role}
                </div>
            </div>

            <div style={{ marginTop: '30px', textAlign: 'center' }}>
                <p>Това е началната страница след успешен вход в системата.</p>
                <p>От тук потребителите ще имат достъп до различни функции в зависимост от тяхната роля.</p>
            </div>
        </div>
    );
}
