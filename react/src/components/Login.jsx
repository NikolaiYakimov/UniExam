// // import { useState } from 'react';
// // import { useAuth } from '../hooks/useAuth.jsx';
// //
// // export default function Login() {
// //     const [credentials, setCredentials] = useState({
// //         username: '',
// //         password: ''
// //     });
// //     const [errors, setErrors] = useState({});
// //     const { login, isLoading } = useAuth();
// //
// //     const handleSubmit = async (e) => {
// //         e.preventDefault();
// //         try {
// //             await login(credentials);
// //         } catch (error) {
// //             if (error.response?.data?.errors) {
// //                 setErrors(error.response.data.errors);
// //             }
// //         }
// //     };
// //
// //     return (
// //         <div className="login-container">
// //             <form onSubmit={handleSubmit}>
// //                 <div>
// //                     <label>Потребителско име</label>
// //                     <input
// //                         type="text"
// //                         value={credentials.username}
// //                         onChange={(e) => setCredentials({...credentials, username: e.target.value})}
// //                     />
// //                     {errors.username && <span className="error">{errors.username[0]}</span>}
// //                 </div>
// //                 <div>
// //                     <label>Парола</label>
// //                     <input
// //                         type="password"
// //                         value={credentials.password}
// //                         onChange={(e) => setCredentials({...credentials, password: e.target.value})}
// //                     />
// //                 </div>
// //                 <button type="submit" disabled={isLoading}>
// //                     {isLoading ? 'Вход...' : 'Вход'}
// //                 </button>
// //             </form>
// //         </div>
// //     );
// // }
// import { useState } from 'react';
// import { useAuth } from '../hooks/useAuth';
//
// export default function Login() {
//     const [credentials, setCredentials] = useState({
//         username: '',
//         password: ''
//     });
//     const [errors, setErrors] = useState({});
//     const { login, isLoading } = useAuth();
//
//     const handleSubmit = async (e) => {
//         e.preventDefault();
//         setErrors({});
//
//         try {
//             const response = await login(credentials);
//             // Успешен логин - пренасочване се случва автоматично
//             console.log('Login successful', response);
//         } catch (error) {
//             if (error.response?.data?.errors) {
//                 setErrors(error.response.data.errors);
//             } else if (error.response?.data?.message) {
//                 setErrors({ general: [error.response.data.message] });
//             } else {
//                 setErrors({ general: ['Грешка при връзка със сървъра'] });
//             }
//         }
//     };
//
//     return (
//         <div style={{ maxWidth: '400px', margin: '50px auto', padding: '20px' }}>
//             <h2>Вход в системата</h2>
//             <form onSubmit={handleSubmit}>
//                 <div style={{ marginBottom: '15px' }}>
//                     <label>Потребителско име</label>
//                     <input
//                         type="text"
//                         value={credentials.username}
//                         onChange={(e) => setCredentials({...credentials, username: e.target.value})}
//                         style={{ width: '100%', padding: '8px', marginTop: '5px' }}
//                     />
//                     {errors.username && (
//                         <div style={{ color: 'red', fontSize: '14px' }}>{errors.username[0]}</div>
//                     )}
//                 </div>
//                 <div style={{ marginBottom: '15px' }}>
//                     <label>Парола</label>
//                     <input
//                         type="password"
//                         value={credentials.password}
//                         onChange={(e) => setCredentials({...credentials, password: e.target.value})}
//                         style={{ width: '100%', padding: '8px', marginTop: '5px' }}
//                     />
//                 </div>
//                 {errors.general && (
//                     <div style={{ color: 'red', marginBottom: '15px' }}>
//                         {errors.general[0]}
//                     </div>
//                 )}
//                 <button
//                     type="submit"
//                     disabled={isLoading}
//                     style={{
//                         width: '100%',
//                         padding: '10px',
//                         backgroundColor: isLoading ? '#ccc' : '#007bff',
//                         color: 'white',
//                         border: 'none',
//                         borderRadius: '4px',
//                         cursor: isLoading ? 'not-allowed' : 'pointer'
//                     }}
//                 >
//                     {isLoading ? 'Вход...' : 'Вход'}
//                 </button>
//             </form>
//         </div>
//     );
// }
// import { useState } from 'react';
// import { useAuth } from '../hooks/useAuth';
// import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
// import { faUser, faLock, faEye, faEyeSlash, faSignInAlt } from '@fortawesome/free-solid-svg-icons';
// import 'bootstrap/dist/css/bootstrap.min.css';
// import './Login.css';
//
// export default function Login() {
//     const [credentials, setCredentials] = useState({
//         username: '',
//         password: ''
//     });
//     const [showPassword, setShowPassword] = useState(false);
//     const [errors, setErrors] = useState({});
//     const { login, isLoading } = useAuth();
//
//     const handleSubmit = async (e) => {
//         e.preventDefault();
//         setErrors({});
//
//         try {
//             await login(credentials);
//         } catch (error) {
//             if (error.response?.data?.errors) {
//                 setErrors(error.response.data.errors);
//             } else if (error.response?.data?.message) {
//                 setErrors({ general: [error.response.data.message] });
//             } else {
//                 setErrors({ general: ['Грешка при връзка със сървъра'] });
//             }
//         }
//     };
//
//     const togglePasswordVisibility = () => {
//         setShowPassword(!showPassword);
//     };
//
//     return (
//         <div className="login-page-wrapper">
//             <div className="login-container">
//                 {/* Университетско лого */}
//                 <img src="/images/university-logo.png" alt="Университетско лого" className="logo" />
//
//                 <h2 className="login-title">Вход в студентския портал</h2>
//
//                 {errors.general && (
//                     <div className="alert alert-danger alert-dismissible fade show">
//                         {errors.general.map((error, index) => (
//                             <div key={index}>{error}</div>
//                         ))}
//                         <button type="button" className="btn-close" onClick={() => setErrors({})}></button>
//                     </div>
//                 )}
//
//                 <form onSubmit={handleSubmit}>
//                     <div className="mb-3">
//                         <div className="input-group">
//               <span className="input-group-text">
//                 <FontAwesomeIcon icon={faUser} />
//               </span>
//                             <input
//                                 type="text"
//                                 name="username"
//                                 value={credentials.username}
//                                 onChange={(e) => setCredentials({...credentials, username: e.target.value})}
//                                 className={`form-control form-control-lg ${errors.username ? 'is-invalid' : ''}`}
//                                 placeholder="Потребителско име"
//                                 required
//                                 autoFocus
//                             />
//                         </div>
//                         {errors.username && (
//                             <div className="invalid-feedback d-block">{errors.username[0]}</div>
//                         )}
//                     </div>
//
//                     <div className="mb-3 position-relative">
//                         <div className="input-group">
//               <span className="input-group-text">
//                 <FontAwesomeIcon icon={faLock} />
//               </span>
//                             <input
//                                 type={showPassword ? "text" : "password"}
//                                 name="password"
//                                 value={credentials.password}
//                                 onChange={(e) => setCredentials({...credentials, password: e.target.value})}
//                                 className={`form-control form-control-lg ${errors.password ? 'is-invalid' : ''}`}
//                                 placeholder="Парола"
//                                 required
//                             />
//                             <span className="password-toggle" onClick={togglePasswordVisibility}>
//                 <FontAwesomeIcon icon={showPassword ? faEyeSlash : faEye} />
//               </span>
//                         </div>
//                         <div className="mb-3 text-end">
//                             <a href="/forgot-password">Забравена парола?</a>
//                         </div>
//                         {errors.password && (
//                             <div className="invalid-feedback d-block">{errors.password[0]}</div>
//                         )}
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
//                                 Вход...
//                             </>
//                         ) : (
//                             <>
//                                 <FontAwesomeIcon icon={faSignInAlt} className="me-2" />
//                                 Вход
//                             </>
//                         )}
//                     </button>
//                 </form>
//             </div>
//         </div>
//     );
// }
import { useState } from 'react';
import { useAuth } from '../hooks/useAuth';
import './Login.css';

export default function Login() {
    const [credentials, setCredentials] = useState({
        username: '',
        password: ''
    });
    const [showPassword, setShowPassword] = useState(false);
    const [errors, setErrors] = useState({});
    const { login, isLoading } = useAuth();

    const handleSubmit = async (e) => {
        e.preventDefault();
        setErrors({});

        try {
            await login(credentials);
        } catch (error) {
            if (error.response?.data?.errors) {
                setErrors(error.response.data.errors);
            } else if (error.response?.data?.message) {
                setErrors({ general: [error.response.data.message] });
            } else {
                setErrors({ general: ['Грешка при връзка със сървъра'] });
            }
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

                {errors.general && (
                    <div className="alert alert-danger alert-dismissible fade show">
                        {errors.general.map((error, index) => (
                            <div key={index}>{error}</div>
                        ))}
                        <button type="button" className="btn-close" onClick={() => setErrors({})}></button>
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
                            <a href="/forgot-password">Забравена парола?</a>
                        </div>
                        {errors.password && (
                            <div className="invalid-feedback d-block">{errors.password[0]}</div>
                        )}
                    </div>

                    <button
                        type="submit"
                        className="btn btn-primary btn-login btn-lg w-100 mb-3"
                        disabled={isLoading}
                    >
                        {isLoading ? (
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
