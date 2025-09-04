import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faUser, faLock, faEye, faEyeSlash, faSignInAlt } from '@fortawesome/free-solid-svg-icons';
import './Login.css';
import logo from './assets/university-logo.png';


const Login = () => {
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');
    const [showPassword, setShowPassword] = useState(false);
    const [errors, setErrors] = useState([]);

    const navigate = useNavigate();

    const handleSubmit = async (e) => {
        e.preventDefault();
        setErrors([]);
        try {
            const response = await fetch('/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ username, password }),
            });
            const data = await response.json();
            if (response.ok) {
                const url = new URL(data.redirect, window.location.origin);
                navigate(url.pathname);
            } else {
                setErrors([data.message]);
            }
        } catch (error) {
            setErrors([error.message]);
        }
        // Валидация
        const newErrors = [];

        if (!username) {
            newErrors.push('Потребителското име е задължително');
        }

        if (!password) {
            newErrors.push('Паролата е задължителна');
        }

        setErrors(newErrors);

        if (newErrors.length === 0) {
            // Тук ще изпратим формата
            console.log('Изпращане на форма:', { username, password });
            // Можете да добавите API заявка тук
        }
    };

    const togglePasswordVisibility = () => {
        setShowPassword(!showPassword);
    };

    return (
        <div className="login-wrapper">
            <div className="login-container">
                {/* Университетско лого */}
                <img

                    // src='./university-logo.png'
                    src={logo}
                    alt="Университетско лого"
                    className="logo"
                />

                <h2 className="login-title">Вход в студентския портал</h2>

                {/* Показване на грешки */}
                {errors.length > 0 && (
                    <div className="alert alert-danger alert-dismissible fade show">
                        {errors.map((error, index) => (
                            <div key={index}>{error}</div>
                        ))}
                        <button
                            type="button"
                            className="btn-close"
                            onClick={() => setErrors([])}
                            aria-label="Close"
                        ></button>
                    </div>
                )}

                <form onSubmit={handleSubmit}>
                    <div className="mb-3">
                        <div className="input-group">
              <span className="input-group-text">
                <FontAwesomeIcon icon={faUser} />
              </span>
                            <input
                                type="text"
                                name="username"
                                value={username}
                                className="form-control form-control-lg"
                                placeholder="Потребителско име"
                                required
                                autoFocus
                                onChange={(e) => setUsername(e.target.value)}
                            />
                        </div>
                    </div>

                    <div className="mb-3 position-relative">
                        <div className="input-group">
              <span className="input-group-text">
                <FontAwesomeIcon icon={faLock} />
              </span>
                            <input
                                type={showPassword ? "text" : "password"}
                                name="password"
                                value={password}
                                className="form-control form-control-lg"
                                placeholder="Парола"
                                required
                                onChange={(e) => setPassword(e.target.value)}
                            />
                            <span
                                className="password-toggle"
                                onClick={togglePasswordVisibility}
                            >
                <FontAwesomeIcon icon={showPassword ? faEyeSlash : faEye} />
              </span>
                        </div>
                    </div>

                    <button
                        type="submit"
                        className="btn btn-primary btn-login btn-lg w-100 mb-3"
                    >
                        <FontAwesomeIcon icon={faSignInAlt} className="me-2" />
                        Вход
                    </button>
                </form>
            </div>
        </div>
    );
};

export default Login;
