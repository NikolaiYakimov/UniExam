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
// import { AuthProvider, useAuth } from './hooks/useAuth';
// import Login from './components/Login';
// import Exams from './components/Exam';
// import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
// import 'bootstrap/dist/css/bootstrap.min.css';
// import './App.css';
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
//                 <Route
//                     path="/login"
//                     element={!isAuthenticated ? <Login /> : <Navigate to="/exams" />}
//                 />
//                 <Route
//                     path="/exams"
//                     element={isAuthenticated ? <Exams /> : <Navigate to="/login" />}
//                 />
//                 <Route
//                     path="/"
//                     element={<Navigate to={isAuthenticated ? "/exams" : "/login"} />}
//                 />
//                 <Route
//                     path="*"
//                     element={<Navigate to={isAuthenticated ? "/exams" : "/login"} />}
//                 />
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
// import { AuthProvider, useAuth } from './hooks/useAuth';
// import Login from './components/Login';
// import Exams from './components/Exam';
// import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
// import 'bootstrap/dist/css/bootstrap.min.css';
// import './App.css';
//
// function AppContent() {
//     const { isAuthenticated, isLoading, user } = useAuth();
//
//     if (isLoading) {
//         return (
//             <div className="d-flex justify-content-center align-items-center min-vh-100 w-100">
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
//                 <Route
//                     path="/login"
//                     element={!isAuthenticated ? <Login /> : <Navigate to="/exams" />}
//                 />
//                 <Route
//                     path="/exams"
//                     element={isAuthenticated ? <Exams /> : <Navigate to="/login" />}
//                 />
//                 <Route
//                     path="/"
//                     element={<Navigate to={isAuthenticated ? "/exams" : "/login"} />}
//                 />
//                 <Route
//                     path="*"
//                     element={<Navigate to={isAuthenticated ? "/exams" : "/login"} />}
//                 />
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
// import { AuthProvider, useAuth } from './hooks/useAuth';
// import Login from './components/Login';
// import Exams from './components/Exam';
// import Dashboard from './components/Dashboard'; // Импортване на Dashboard компонента
// import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
// import 'bootstrap/dist/css/bootstrap.min.css';
// import './App.css';
//
// function AppContent() {
//     const { isAuthenticated, isLoading, user } = useAuth();
//
//     if (isLoading) {
//         return (
//             <div className="d-flex justify-content-center align-items-center min-vh-100 w-100">
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
//                 <Route
//                     path="/login"
//                     element={!isAuthenticated ? <Login /> : <Navigate to={getRedirectPath(user)} />}
//                 />
//                 <Route
//                     path="/exams"
//                     element={isAuthenticated && user?.role === 'student' ? <Exams /> : <Navigate to="/login" />}
//                 />
//                 <Route
//                     path="/dashboard"
//                     element={isAuthenticated && (user?.role === 'administrator' || user?.role === 'teacher') ? <Dashboard /> : <Navigate to="/login" />}
//                 />
//                 <Route
//                     path="/"
//                     element={<Navigate to={isAuthenticated ? getRedirectPath(user) : "/login"} />}
//                 />
//                 <Route
//                     path="*"
//                     element={<Navigate to={isAuthenticated ? getRedirectPath(user) : "/login"} />}
//                 />
//             </Routes>
//         </Router>
//     );
// }
//
// // Помощна функция за определяне на пътя за пренасочване според ролята
// function getRedirectPath(user) {
//     if (!user) return '/login';
//
//     switch (user.role) {
//         case 'student':
//             return '/exams';
//         case 'administrator':
//         case 'teacher':
//             return '/dashboard';
//         default:
//             return '/login';
//     }
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
// App.jsx
import { AuthProvider, useAuth } from './hooks/useAuth';
import Exams from './components/Exam';
import Dashboard from './components/Dashboard';
import Login from './components/Login';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import './App.css';
import 'tailwindcss'
import MyExams from "./components/MyExams.jsx";
import MyPastExams from "./components/MyPastExams.jsx";
import StudentPayments from "./components/StudentPayments.jsx";
import StudentProfile from './components/StudentProfile';
import TeacherDashboard from './components/TeacherDashboard.jsx';
import TeacherExamDetails from "./components/TeacherExamDetails.jsx";
import TeacherConductedExams from "./components/TeacherConductedExams.jsx";
import TeacherSubjects from "./components/TeacherSubjects.jsx";
import TeacherSubjectStudents from './components/TeacherSubjectStudents.jsx'
import TeacherProfile from "./components/TeacherProfile.jsx";
import SubjectList from "./components/SubjectList.jsx";
import CreateSubject from "./components/CreateSubject.jsx";
import EditSubject from "./components/EditSubject.jsx";
import UserManagement from "./components/UserManagement.jsx";
import CreateUser from "./components/CreateUser.jsx";
import EditUser from "./components/EditUser.jsx";



function AppContent() {
    const { isAuthenticated, isLoading, user } = useAuth();

    if (isLoading) {
        return (
            <div className="d-flex justify-content-center align-items-center min-vh-100 w-100">
                <div className="spinner-border text-primary" role="status">
                    <span className="visually-hidden">Зареждане...</span>
                </div>
            </div>
        );
    }

    return (
        <Router basename="/">

            <Routes>
                <Route
                    path="/login"
                    element={!isAuthenticated ? <Login /> : <Navigate to={getRedirectPath(user)} />}
                />
                <Route
                    path="/my-exams"
                    element={isAuthenticated && user?.role === 'student' ? <MyExams /> : <Navigate to="/login" />}
                />
                <Route
                    path="/exams"
                    element={isAuthenticated && user?.role === 'student' ? <Exams /> : <Navigate to="/login" />}
                />
                <Route
                    path="/my-past-exams"
                    element={isAuthenticated && user?.role === 'student' ? <MyPastExams /> : <Navigate to="/login" />}
                />
                <Route
                    path="/payments"
                    element={isAuthenticated && user?.role === 'student' ? <StudentPayments /> : <Navigate to="/login" />}
                />
                <Route
                    path="/student-profile"
                    element={isAuthenticated && user?.role === 'student' ? <StudentProfile /> : <Navigate to="/login" />}
                />

                <Route
                    path="/upcoming-exams"
                    element={isAuthenticated &&  user?.role === 'teacher' ? <TeacherDashboard /> : <Navigate to="/login" />}
                />
                <Route
                    path="/conducted-exams"
                    element={isAuthenticated &&  user?.role === 'teacher' ? <TeacherConductedExams /> : <Navigate to="/login" />}
                />
                <Route
                    path="/teacher/exam/:id"
                    element={isAuthenticated &&  user?.role === 'teacher' ? <TeacherExamDetails /> : <Navigate to="/login" />}
                />
                <Route
                    path='/teacher-subjects'
                    element={isAuthenticated && user?.role === 'teacher' ? <TeacherSubjects/>:  <Navigate to={'/login'} /> }
                    />
                <Route
                    path='/subjects/:id/students'
                    element={isAuthenticated && user?.role === 'teacher' ? <TeacherSubjectStudents/>:  <Navigate to={'/login'} /> }
                />
                <Route
                    path='/teacher-profile'
                    element={isAuthenticated && user?.role === 'teacher' ? <TeacherProfile/>:  <Navigate to={'/login'} /> }
                />
                <Route
                    path='/subjects'
                    element={isAuthenticated && user?.role === 'administrator' ? <SubjectList/>:  <Navigate to={'/login'} /> }
                />
                <Route
                    path='/subjects/create'
                    element={isAuthenticated && user?.role === 'administrator' ? <CreateSubject/>:  <Navigate to={'/login'} /> }
                />
                <Route
                    path='/subjects/:id/edit'
                    element={isAuthenticated && user?.role === 'administrator' ? <EditSubject/>:  <Navigate to={'/login'} /> }
                />
                <Route
                    path='/users'
                    element={isAuthenticated && user?.role === 'administrator' ? <UserManagement/>:  <Navigate to={'/login'} /> }
                />
                <Route
                    path='/users/create'
                    element={isAuthenticated && user?.role === 'administrator' ? <CreateUser/>:  <Navigate to={'/login'} /> }
                />
                <Route
                    path='/users/:id/edit'
                    element={isAuthenticated && user?.role === 'administrator' ? <EditUser/>:  <Navigate to={'/login'} /> }
                />


                <Route
                    path="/"
                    element={<Navigate to={isAuthenticated ? getRedirectPath(user) : "/login"} />}
                />
                <Route
                    path="*"
                    element={<Navigate to={isAuthenticated ? getRedirectPath(user) : "/login"} />}
                />
            </Routes>
        </Router>
    );
}

// Помощна функция за определяне на пътя за пренасочване според ролята
function getRedirectPath(user) {
    if (!user) return '/login';

    switch (user.role) {
        case 'student':
            return '/exams';
        case 'administrator':
            return '/subjects'
        case 'teacher':
            return '/upcoming-exams';
        // default:
        //     return '/login';
    }
}

function App() {
    return (
        <AuthProvider>
            <AppContent />
        </AuthProvider>
    );
}

export default App;
