
import { useState } from 'react';
import { useAuth } from '../hooks/useAuth';
import './Login.css';
import {Link} from "react-router-dom";

export default function Login() {
    const [credentials, setCredentials] = useState({
        username: '',
        password: ''
    });
    const [showPassword, setShowPassword] = useState(false);
    const [isSubmitting,setIsSubmitting]=useState(false);
    const [errors, setErrors] = useState({});
    const { login } = useAuth();

    const handleSubmit = async (e) => {
        e.preventDefault();
        setErrors({});
        setIsSubmitting(true);


        try {
            await login(credentials);
        } catch (error) {
            console.error('Login error:', error.response);

            // Handle different error response formats
            if (error.response?.status === 401) {
                // Default message for 401 (Unauthorized)
                setErrors({ general: ['Невалидно потребителско име или парола'] });
            }
            else if (error.response?.data?.errors) {
                // Laravel validation errors format
                setErrors(error.response.data.errors);
            }
            else if (error.response?.data?.message) {
                // Single error message format
                setErrors({ general: [error.response.data.message] });
            }
            else if (error.response?.data) {
                // Other error formats
                setErrors({ general: [error.response.data] });
            }
            else {
                setErrors({ general: ['Грешка при връзка със сървъра'] });
            }
        }finally {
            setIsSubmitting(false);
        }
    };

    const togglePasswordVisibility = () => {
        setShowPassword(!showPassword);
    };

    return (
        <div className="login-page-wrapper">
            <div className="login-container">
                <img src="/images/university-logo.png" alt="Университетско лого" className="logo" />
                <h2 className="login-title">Вход в студентския портал</h2>

                {/* Display general errors */}
                {errors.general && (
                    <div className="alert alert-danger alert-dismissible ">
                        {errors.general.map((error, index) => (
                            <div key={index}>{error}</div>
                        ))}
                        <button
                            type="button"
                            className="btn-close"
                            onClick={() => setErrors({...errors, general: null})}
                        ></button>
                    </div>
                )}

                {/* Display field-specific errors */}
                {errors.message && (
                    <div className="alert alert-danger alert-dismissible ">
                        <div>{errors.message}</div>
                        <button
                            type="button"
                            className="btn-close"
                            onClick={() => setErrors({...errors, message: null})}
                        ></button>
                    </div>
                )}

                <form onSubmit={handleSubmit}>
                    <div className="mb-3">
                        <div className="input-group">
                            <span className="input-group-text">
                                <i className="fas fa-user"></i>
                            </span>
                            <input
                                type="text"
                                name="username"
                                value={credentials.username}
                                onChange={(e) => setCredentials({...credentials, username: e.target.value})}
                                className={`form-control form-control-lg ${errors.username ? 'is-invalid' : ''}`}
                                placeholder="Потребителско име"
                                required
                                autoFocus
                            />
                        </div>
                        {errors.username && (
                            <div className="invalid-feedback d-block">{errors.username[0]}</div>
                        )}
                    </div>

                    <div className="mb-3 position-relative">
                        <div className="input-group">
                            <span className="input-group-text">
                                <i className="fas fa-lock"></i>
                            </span>
                            <input
                                type={showPassword ? "text" : "password"}
                                name="password"
                                value={credentials.password}
                                onChange={(e) => setCredentials({...credentials, password: e.target.value})}
                                className={`form-control form-control-lg ${errors.password ? 'is-invalid' : ''}`}
                                placeholder="Парола"
                                required
                            />
                            <span className="password-toggle" onClick={togglePasswordVisibility}>
                                <i className={`fas ${showPassword ? 'fa-eye-slash' : 'fa-eye'}`}></i>
                            </span>
                        </div>
                        <div className="mb-3 text-end">
                            <Link to="/forgot-password">Забравена парола?</Link>
                        </div>
                        {errors.password && (
                            <div className="invalid-feedback d-block">{errors.password[0]}</div>
                        )}
                    </div>

                    <button
                        type="submit"
                        className="btn btn-primary btn-login btn-lg w-100 mb-3"
                        disabled={isSubmitting}
                    >
                        {isSubmitting ? (
                            <>
                                <span className="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                Вход...
                            </>
                        ) : (
                            <>
                                <i className="fas fa-sign-in-alt me-2"></i>
                                Вход
                            </>
                        )}
                    </button>
                </form>
            </div>
        </div>
    );
}
