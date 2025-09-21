// // ResetPassword.jsx
// import { useState } from 'react';
// import { useSearchParams, Link } from 'react-router-dom';
// import './Login.css'; // Reusing the same styles
//
// export default function ResetPassword() {
//     const [searchParams] = useSearchParams();
//     const [formData, setFormData] = useState({
//         token: searchParams.get('token') || '',
//         email: searchParams.get('email') || '',
//         password: '',
//         password_confirmation: ''
//     });
//     const [errors, setErrors] = useState({});
//     const [status, setStatus] = useState(null);
//     const [isLoading, setIsLoading] = useState(false);
//
//     const handleSubmit = async (e) => {
//         e.preventDefault();
//         setIsLoading(true);
//         setErrors({});
//
//         try {
//             const response = await fetch('http://localhost:8000/api/password/reset', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'Accept': 'application/json',
//                 },
//                 body: JSON.stringify(formData)
//             });
//
//             const data = await response.json();
//
//             if (response.ok) {
//                 setStatus('Паролата ви е променена успешно!');
//             } else {
//                 if (data.errors) {
//                     setErrors(data.errors);
//                 } else if (data.message) {
//                     setErrors({ general: [data.message] });
//                 }
//             }
//         } catch (error) {
//             setErrors({ general: ['Грешка при връзка със сървъра'] });
//         } finally {
//             setIsLoading(false);
//         }
//     };
//
//     const handleChange = (e) => {
//         setFormData({
//             ...formData,
//             [e.target.name]: e.target.value
//         });
//     };
//
//     return (
//         <div className="login-page-wrapper">
//             <div className="login-container">
//                 <img src="/images/university-logo.png" alt="Университетско лого" className="logo" />
//                 <h2 className="login-title">Възстановяване на парола</h2>
//
//                 {status && (
//                     <div className="alert alert-success alert-dismissible fade show">
//                         {status}
//                         <button type="button" className="btn-close" onClick={() => setStatus(null)}></button>
//                     </div>
//                 )}
//
//                 {errors.general && (
//                     <div className="alert alert-danger alert-dismissible fade show">
//                         {errors.general.map((error, index) => (
//                             <div key={index}>{error}</div>
//                         ))}
//                         <button type="button" className="btn-close" onClick={() => setErrors({...errors, general: null})}></button>
//                     </div>
//                 )}
//
//                 <form onSubmit={handleSubmit}>
//                     <input type="hidden" name="token" value={formData.token} />
//
//                     <div className="mb-3">
//                         <div className="input-group">
//                             <span className="input-group-text">
//                                 <i className="fas fa-envelope"></i>
//                             </span>
//                             <input
//                                 type="email"
//                                 name="email"
//                                 value={formData.email}
//                                 onChange={handleChange}
//                                 className={`form-control form-control-lg ${errors.email ? 'is-invalid' : ''}`}
//                                 placeholder="Имейл адрес"
//                                 required
//                             />
//                         </div>
//                         {errors.email && (
//                             <div className="invalid-feedback d-block">{errors.email[0]}</div>
//                         )}
//                     </div>
//
//                     <div className="mb-3">
//                         <div className="input-group">
//                             <span className="input-group-text">
//                                 <i className="fas fa-lock"></i>
//                             </span>
//                             <input
//                                 type="password"
//                                 name="password"
//                                 value={formData.password}
//                                 onChange={handleChange}
//                                 className={`form-control form-control-lg ${errors.password ? 'is-invalid' : ''}`}
//                                 placeholder="Нова парола"
//                                 required
//                             />
//                         </div>
//                         {errors.password && (
//                             <div className="invalid-feedback d-block">{errors.password[0]}</div>
//                         )}
//                     </div>
//
//                     <div className="mb-3">
//                         <div className="input-group">
//                             <span className="input-group-text">
//                                 <i className="fas fa-lock"></i>
//                             </span>
//                             <input
//                                 type="password"
//                                 name="password_confirmation"
//                                 value={formData.password_confirmation}
//                                 onChange={handleChange}
//                                 className="form-control form-control-lg"
//                                 placeholder="Потвърдете новата парола"
//                                 required
//                             />
//                         </div>
//                     </div>
//
//                     <button
//                         type="submit"
//                         className="btn btn-primary btn-login btn-lg w-100 mb-3"
//                         disabled={isLoading}
//                     >
//                         {isLoading ? (
//                             <>
//                                 <span className="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
//                                 Зареждане...
//                             </>
//                         ) : (
//                             <>
//                                 <i className="fas fa-save me-2"></i>
//                                 Запази новата парола
//                             </>
//                         )}
//                     </button>
//                 </form>
//
//                 <div className="form-footer">
//                     <Link to="/login">Обратно към входа</Link>
//                 </div>
//             </div>
//         </div>
//     );
// }
// components/ResetPassword.jsx
import { useState, useEffect } from 'react';
import {useSearchParams, useNavigate, Link} from 'react-router-dom';
import { api } from '../hooks/useAuth';
import './Login.css';

export default function ResetPassword() {
    const [searchParams] = useSearchParams();
    const navigate = useNavigate();
    const [email, setEmail] = useState(searchParams.get('email') || '');
    const [token, setToken] = useState(searchParams.get('token') || '');
    const [password, setPassword] = useState('');
    const [passwordConfirmation, setPasswordConfirmation] = useState('');
    const [errors, setErrors] = useState({});
    const [status, setStatus] = useState(null);
    const [isLoading, setIsLoading] = useState(false);

    useEffect(() => {
        if (!token || !email) {
            setErrors({ general: ['Невалиден линк за възстановяване на парола'] });
        }
    }, [token, email]);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setIsLoading(true);
        setErrors({});

        try {
            const response = await api.post('/password/reset', {
                token,
                email,
                password,
                password_confirmation: passwordConfirmation
            });

            setStatus('Паролата ви е променена успешно!');

            // Пренасочване към логин страницата след 2 секунди
            setTimeout(() => {
                navigate('/login');
            }, 2000);
        } catch (error) {
            if (error.response?.status === 422) {
                setErrors(error.response.data.errors);
            } else if (error.response?.data?.message) {
                setErrors({ general: [error.response.data.message] });
            } else {
                setErrors({ general: ['Грешка при връзка със сървъра'] });
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
                    </div>
                )}

                {errors.general && (
                    <div className="alert alert-danger alert-dismissible fade show">
                        {errors.general.map((error, index) => (
                            <div key={index}>{error}</div>
                        ))}
                    </div>
                )}

                <form onSubmit={handleSubmit}>
                    <input type="hidden" name="token" value={token} />

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
                            />
                        </div>
                        {errors.email && (
                            <div className="invalid-feedback d-block">{errors.email[0]}</div>
                        )}
                    </div>

                    <div className="mb-3">
                        <div className="input-group">
                            <span className="input-group-text">
                                <i className="fas fa-lock"></i>
                            </span>
                            <input
                                type="password"
                                name="password"
                                value={password}
                                onChange={(e) => setPassword(e.target.value)}
                                className={`form-control form-control-lg ${errors.password ? 'is-invalid' : ''}`}
                                placeholder="Нова парола"
                                required
                            />
                        </div>
                        {errors.password && (
                            <div className="invalid-feedback d-block">{errors.password[0]}</div>
                        )}
                    </div>

                    <div className="mb-3">
                        <div className="input-group">
                            <span className="input-group-text">
                                <i className="fas fa-lock"></i>
                            </span>
                            <input
                                type="password"
                                name="password_confirmation"
                                value={passwordConfirmation}
                                onChange={(e) => setPasswordConfirmation(e.target.value)}
                                className="form-control form-control-lg"
                                placeholder="Потвърдете новата парола"
                                required
                            />
                        </div>
                    </div>

                    <button
                        type="submit"
                        className="btn btn-primary btn-login btn-lg w-100 mb-3"
                        disabled={isLoading || !token || !email}
                    >
                        {isLoading ? (
                            <>
                                <span className="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                Запазване...
                            </>
                        ) : (
                            <>
                                <i className="fas fa-save me-2"></i>
                                Запази новата парола
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
