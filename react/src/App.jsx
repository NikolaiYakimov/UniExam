// import { useState } from 'react'
// import reactLogo from './assets/react.svg'
// import viteLogo from '/vite.svg'
// import './App.css'
//
// function App() {
//   const [count, setCount] = useState(0)
//
//   return (
//     <>
//       <div>
//         <a href="https://vite.dev" target="_blank">
//           <img src={viteLogo} className="logo" alt="Vite logo" />
//         </a>
//         <a href="https://react.dev" target="_blank">
//           <img src={reactLogo} className="logo react" alt="React logo" />
//         </a>
//       </div>
//       <h1>Vite + React</h1>
//       <div className="card">
//         <button onClick={() => setCount((count) => count + 1)}>
//           count is {count}
//         </button>
//         <p>
//           Edit <code>src/App.jsx</code> and save to test HMR
//         </p>
//       </div>
//       <p className="read-the-docs">
//         Click on the Vite and React logos to learn more
//       </p>
//     </>
//   )
// }
//
// export default App
// import { AuthProvider, useAuth } from './hooks/useAuth.jsx';
// import Login from './components/Login';
// import Dashboard from './components/Dashboard';
//
// function AppContent() {
//     const { isAuthenticated, isLoading } = useAuth();
//
//     if (isLoading) {
//         return <div>Зареждане...</div>;
//     }
//
//     return isAuthenticated ? <Dashboard /> : <Login />;
// }
//
// function App() {
//     return (
//         <AuthProvider>
//             <AppContent />
//         </AuthProvider>
//     );
// }
//
// // export default App;
// import { AuthProvider, useAuth } from './hooks/useAuth';
// import Login from './components/Login';
// import Dashboard from './components/Dashboard';
//
// function AppContent() {
//     const { isAuthenticated, isLoading } = useAuth();
//
//     if (isLoading) {
//         return (
//             <div className="d-flex justify-content-center align-items-center min-vh-100">
//                 <div className="spinner-border text-primary" role="status">
//                     <span className="visually-hidden">Зареждане...</span>
//                 </div>
//             </div>
//         );
//     }
//
//     return isAuthenticated ? <Dashboard /> : <Login />;
// }
//
// function App() {
//     return (
//         <AuthProvider>
//             <AppContent />
//         </AuthProvider>
//     );
// }
//
// export default App;
// import { AuthProvider, useAuth } from './hooks/useAuth';
// import Login from './components/Login';
// import Dashboard from './components/Dashboard';
// import Exams from './components/Exam';
// import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
// import 'bootstrap/dist/css/bootstrap.min.css';
// import 'bootstrap/dist/js/bootstrap.bundle.min.js';
//
// function AppContent() {
//     const { isAuthenticated, isLoading, user } = useAuth();
//
//     if (isLoading) {
//         return (
//             <div className="d-flex justify-content-center align-items-center min-vh-100">
//                 <div className="spinner-border text-primary" role="status">
//                     <span className="visually-hidden">Зареждане...</span>
//                 </div>
//             </div>
//         );
//     }
//
//     return (
//         <Router>
//             <Routes>
//                 {!isAuthenticated ? (
//                     <Route path="*" element={<Login />} />
//                 ) : (
//                     <>
//                         {user.role === 'student' ? (
//                             <Route path="/exams" element={<Exams />} />
//                         ) : (
//                             <Route path="/dashboard" element={<Dashboard />} />
//                         )}
//                         <Route path="*" element={<Navigate to={user.role === 'student' ? '/exams' : '/dashboard'} />} />
//                     </>
//                 )}
//             </Routes>
//         </Router>
//     );
// }
//
// function App() {
//     return (
//         <AuthProvider>
//             <AppContent />
//         </AuthProvider>
//     );
// }
//
// export default App;
import { AuthProvider, useAuth } from './hooks/useAuth';
import Login from './components/Login';
import Exams from './components/Exam';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import './App.css';

function AppContent() {
    const { isAuthenticated, isLoading, user } = useAuth();

    if (isLoading) {
        return (
            <div className="d-flex justify-content-center align-items-center min-vh-100">
                <div className="spinner-border text-primary" role="status">
                    <span className="visually-hidden">Зареждане...</span>
                </div>
            </div>
        );
    }

    return (
        <Router>
            <Routes>
                <Route
                    path="/login"
                    element={!isAuthenticated ? <Login /> : <Navigate to="/exams" />}
                />
                <Route
                    path="/exams"
                    element={isAuthenticated ? <Exams /> : <Navigate to="/login" />}
                />
                <Route
                    path="/"
                    element={<Navigate to={isAuthenticated ? "/exams" : "/login"} />}
                />
                <Route
                    path="*"
                    element={<Navigate to={isAuthenticated ? "/exams" : "/login"} />}
                />
            </Routes>
        </Router>
    );
}

function App() {
    return (
        <AuthProvider>
            <AppContent />
        </AuthProvider>
    );
}

export default App;
