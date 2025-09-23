
import { AuthProvider, useAuth } from './hooks/useAuth';
import Exams from './components/Exam';
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
import ExamHallList from "./components/ExamHall.jsx";
import ExamHall from "./components/ExamHall.jsx";
import CreateExamHall from "./components/CreateExamHall.jsx";
import EditExamHall from "./components/EditExamHall.jsx";
import ForgotPassword from "./components/ForgotPassword.jsx";
import ResetPassword from "./components/ResetPassowrd.jsx";
import TeacherExamStudents from "./components/TeacherExamStudents.jsx";
import FacultyList from "./components/FacultyList.jsx";
import CreateFaculty from "./components/CreateFaculty.jsx";
import EditFaculty from "./components/EditFaculty.jsx";
import SpecialtyList from "./components/SpecialtyList.jsx";
import CreateSpecialty from "./components/CreateSpeciality.jsx";
import EditSpecialty from "./components/EditSoeciality.jsx";



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
                    path="/forgot-password"
                    element={!isAuthenticated ? <ForgotPassword /> : <Navigate to={getRedirectPath(user)} />}
                />
                <Route
                    path="/reset-password"
                    element={!isAuthenticated ? <ResetPassword /> : <Navigate to={getRedirectPath(user)} />}
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
                    path="/exam/:examId/students"
                    element={isAuthenticated && user?.role === 'teacher' ? <TeacherExamStudents /> : <Navigate to="/login" />}
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
                    path='/exam-halls'
                    element={isAuthenticated && user?.role === 'administrator' ? <ExamHall/>:  <Navigate to={'/login'} /> }
                />

                <Route
                    path='/exam-halls/create'
                    element={isAuthenticated && user?.role === 'administrator' ? <CreateExamHall/>:  <Navigate to={'/login'} /> }
                />

                <Route
                    path='/exam-halls/:id/edit'
                    element={isAuthenticated && user?.role === 'administrator' ? <EditExamHall/>: <Navigate to={'/login'} />}
                />
                <Route
                    path='/faculties'
                    element={isAuthenticated && user?.role === 'administrator' ? <FacultyList/> : <Navigate to={'/login'} />}
                />
                <Route
                    path='/faculties/create'
                    element={isAuthenticated && user?.role === 'administrator' ? <CreateFaculty/> : <Navigate to={'/login'} />}
                />
                <Route
                    path='/faculties/:id/edit'
                    element={isAuthenticated && user?.role === 'administrator' ? <EditFaculty/> : <Navigate to={'/login'} />}
                />
                <Route
                    path='/specialties'
                    element={isAuthenticated && user?.role === 'administrator' ? <SpecialtyList/> : <Navigate to={'/login'} />}
                />
                <Route
                    path='/specialties/create'
                    element={isAuthenticated && user?.role === 'administrator' ? <CreateSpecialty/> : <Navigate to={'/login'} />}
                />
                <Route
                    path='/specialties/:id/edit'
                    element={isAuthenticated && user?.role === 'administrator' ? <EditSpecialty/> : <Navigate to={'/login'} />}
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
