
import { useState } from 'react';
import { Link } from 'react-router-dom';
import { api } from '../hooks/useAuth';
import './Login.css';

export default function ForgotPassword() {
    const [email, setEmail] = useState('');
    const [errors, setErrors] = useState({});
    const [status, setStatus] = useState(null);
    const [isLoading, setIsLoading] = useState(false);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setIsLoading(true);
        setErrors({});
        setStatus(null);

        try {
            const response = await api.post('/password/email', { email });
            console.log(response)
            setStatus(response.data?.status || 'Изпратихме ви имейл с линк за възстановяване на паролата!');
        } catch (error) {
            if (error.response?.status === 422) {
                setErrors(error.response.data.errors);
            } else if (error.response?.data?.message) {
                setErrors({ email: [error.response.data.message] });
            } else {
                setErrors({ email: ['Грешка при връзка със сървъра'] });
            }
        } finally {
            setIsLoading(false);
        }
    };

    return (
        <div className="login-page-wrapper">
            <div className="login-container">
                <img src="/images/university-logo.png" alt="Университетско лого" className="logo" />
                <h2 className="login-title">Възстановяване на парола</h2>

                {status && (
                    <div className="alert alert-success alert-dismissible fade show">
                        {status}
                        <button type="button" className="btn-close" onClick={() => setStatus(null)}></button>
                    </div>
                )}

                {errors.email && (
                    <div className="alert alert-danger alert-dismissible fade show">
                        {errors.email.map((error, index) => (
                            <div key={index}>{error}</div>
                        ))}
                        <button type="button" className="btn-close" onClick={() => setErrors({})}></button>
                    </div>
                )}

                <form onSubmit={handleSubmit}>
                    <div className="mb-3">
                        <div className="input-group">
                            <span className="input-group-text">
                                <i className="fas fa-envelope"></i>
                            </span>
                            <input
                                type="email"
                                name="email"
                                value={email}
                                onChange={(e) => setEmail(e.target.value)}
                                className={`form-control form-control-lg ${errors.email ? 'is-invalid' : ''}`}
                                placeholder="Имейл адрес"
                                required
                                autoFocus
                            />
                        </div>
                    </div>

                    <button
                        type="submit"
                        className="btn btn-primary btn-login btn-lg w-100 mb-3"
                        disabled={isLoading}
                    >
                        {isLoading ? (
                            <>
                                <span className="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                Изпращане...
                            </>
                        ) : (
                            <>
                                <i className="fas fa-paper-plane me-2"></i>
                                Изпрати линк за възстановяване
                            </>
                        )}
                    </button>
                </form>

                <div className="form-footer">
                    <Link to="/login">Обратно към входа</Link>
                </div>
            </div>
        </div>
    );
}
