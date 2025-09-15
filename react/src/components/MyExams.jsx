// // components/MyExams.jsx
// import { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
// import './Exam.css';
//
// // import  '.RightFile.css'
// import axios from 'axios';
//
// const MyExams = () => {
//     const { user, token, logout } = useAuth();
//     const [exams, setExams] = useState([]);
//     const [isLoading, setIsLoading] = useState(true);
//     const [error, setError] = useState(null);
//
//     useEffect(() => {
//         fetchMyExams();
//     }, []);
//
//     const fetchMyExams = async () => {
//         try {
//             const response = await axios.get('/api/my-exams', {
//                 headers: {
//                     'Authorization': `Bearer ${token}`
//                 }
//             });
//             setExams(response.data.exams);
//         } catch (err) {
//             console.error('Failed to fetch exams', err);
//             if (err.response?.status === 401 || err.response?.status === 419) {
//                 logout();
//             } else {
//                 setError('Грешка при зареждане на изпитите');
//             }
//         } finally {
//             setIsLoading(false);
//         }
//     };
//
//     const handleUnregister = async (examId, examDate) => {
//         const examDateTime = new Date(examDate);
//         const now = new Date();
//         const hoursDifference = (examDateTime - now) / (1000 * 60 * 60);
//
//         if (hoursDifference < 48) {
//             alert('Отписването от изпита е невъзможно по-малко от 48 часа преди изпита');
//             return;
//         }
//
//         if (!window.confirm('Сигурни ли сте, че искате да се отпишете от този изпит?')) {
//             return;
//         }
//
//         try {
//             await axios.post(`/api/exams/${examId}/unregister`, {}, {
//                 headers: {
//                     'Authorization': `Bearer ${token}`
//                 }
//             });
//
//             setExams(exams.filter(exam => exam.id !== examId));
//             alert('Успешно се отписахте от изпита');
//         } catch (err) {
//             console.error('Failed to unregister from exam', err);
//             alert(err.response?.data?.message || 'Грешка при отписване от изпита');
//         }
//     };
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
//     if (error) {
//         return (
//             <div className="alert alert-danger m-4" role="alert">
//                 {error}
//             </div>
//         );
//     }
//
//     return (
//         <div className="page-layout">
//             <div id="mainContent" className="ml-0 lg:ml-0 p-4 lg:p-8 transition-all duration-300">
//                 <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                     <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                         <div>
//                             <h1 className="text-2xl font-bold text-gray-800">Предстоящи изпити</h1>
//                             <p className="text-sm text-gray-500 mt-1">Преглед на записани изпити</p>
//                         </div>
//                     </div>
//                 </div>
//
//                 {exams.length === 0 ? (
//                     <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
//                         <i className="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
//                         <h3 className="text-lg font-medium text-gray-700 mb-2">Няма записани изпити</h3>
//                         <p className="text-gray-500">Все още нямате записани изпити. Моля, изберете от списъка с достъпни изпити.</p>
//                     </div>
//                 ) : (
//                     <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
//                         {exams.map((exam) => {
//                             const registration = exam.registrations?.find(
//                                 reg => reg.student_id === user.student.id
//                             );
//
//                             return (
//                                 <div key={exam.id} className="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px]">
//                                     <div className="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">
//                                         <h2 className="text-lg font-semibold text-gray-900 leading-tight">
//                                             {exam.subject?.subject_name}
//                                         </h2>
//                                         <div className="flex flex-wrap gap-2">
//                       <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
//                         {exam.exam_type}
//                       </span>
//                                             <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${exam.remaining_slots > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`}>
//                         {exam.remaining_slots} Свободни места
//                       </span>
//                                         </div>
//                                     </div>
//
//                                     <div className="space-y-3 mb-5">
//                                         <div className="flex items-center gap-2 text-gray-600">
//                                             <i className="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
//                                             <span>Преподавател: <span className="font-medium text-gray-800">{exam.teacher?.user?.first_name} {exam.teacher?.user?.last_name}</span></span>
//                                         </div>
//                                         <div className="flex items-center gap-2 text-gray-600">
//                                             <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
//                                             <span>Дата: <span className="font-medium text-gray-800">
//                         {new Date(exam.start_time).toLocaleDateString('bg-BG')}
//                       </span></span>
//                                         </div>
//                                         <div className="flex items-center gap-2 text-gray-600">
//                                             <i className="fas fa-clock w-5 text-gray-400"></i>
//                                             <span>Продължителност: <span className="font-medium text-gray-800">
//                         {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} - {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
//                       </span></span>
//                                         </div>
//                                         <div className="flex items-center gap-2 text-gray-600">
//                                             <i className="fas fa-university w-5 text-gray-400"></i>
//                                             <span>Зала: <span className="font-medium text-gray-800">{exam.hall?.name}</span></span>
//                                         </div>
//
//                                         <div className="flex items-center gap-2 text-gray-600">
//                                             <i className="fas fa-star w-5 text-gray-400"></i>
//                                             <span>Оценка:
//                                                 {registration && registration.grade ? (
//                                                     <span className="font-medium text-gray-800"> {registration.grade}</span>
//                                                 ) : (
//                                                     <span className="text-gray-500 italic"> ---</span>
//                                                 )}
//                       </span>
//                                         </div>
//                                     </div>
//
//                                     {new Date(exam.start_time) > new Date() && (
//                                         <button
//                                             onClick={() => handleUnregister(exam.id, exam.start_time)}
//                                             className="w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 bg-red-600 hover:bg-red-700"
//                                         >
//                                             <i className="fas fa-edit mr-2"></i> Отпиши се
//                                         </button>
//                                     )}
//                                 </div>
//                             );
//                         })}
//                     </div>
//                 )}
//             </div>
//         </div>
//     );
// };
//
// export default MyExams;
// MyExams.jsx
import { useState, useEffect } from 'react';
import { useAuth } from '../hooks/useAuth';
import axios from 'axios';
import Header from './Header';
import Sidebar from './Sidebar';

const MyExams = () => {
    const { user, token, logout } = useAuth();
    const [exams, setExams] = useState([]);
    const [isLoading, setIsLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        fetchMyExams();
    }, []);

    const fetchMyExams = async () => {
        try {
            const response = await axios.get('/api/my-exams', {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            });
            setExams(response.data.exams);
        } catch (err) {
            console.error('Failed to fetch exams', err);
            if (err.response?.status === 401 || err.response?.status === 419) {
                logout();
            } else {
                setError('Грешка при зареждане на изпитите');
            }
        } finally {
            setIsLoading(false);
        }
    };

    const handleUnregister = async (examId, examDate) => {
        const examDateTime = new Date(examDate);
        const now = new Date();
        const hoursDifference = (examDateTime - now) / (1000 * 60 * 60);

        if (hoursDifference < 48) {
            alert('Отписването от изпита е невъзможно по-малко от 48 часа преди изпита');
            return;
        }

        if (!window.confirm('Сигурни ли сте, че искате да се отпишете от този изпит?')) {
            return;
        }

        try {
            await axios.post(`/api/exams/${examId}/unregister`, {}, {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            });

            setExams(exams.filter(exam => exam.id !== examId));
            alert('Успешно се отписахте от изпита');
        } catch (err) {
            console.error('Failed to unregister from exam', err);
            alert(err.response?.data?.message || 'Грешка при отписване от изпита');
        }
    };

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
        <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">
            <Header />

            <div className="page-layout">
                <Sidebar user={user} />

                <div id="mainContent" className="ml-0 lg:ml-0 p-4 lg:p-8 transition-all duration-300">
                    <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
                        <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                            <div>
                                <h1 className="text-2xl font-bold text-gray-800">Предстоящи изпити</h1>
                                <p className="text-sm text-gray-500 mt-1">Преглед на записани изпити</p>
                            </div>
                        </div>
                    </div>

                    {error && (
                        <div className="alert alert-danger m-4" role="alert">
                            {error}
                        </div>
                    )}

                    {exams.length === 0 ? (
                        <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
                            <i className="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
                            <h3 className="text-lg font-medium text-gray-700 mb-2">Няма записани изпити</h3>
                            <p className="text-gray-500">Все още нямате записани изпити. Моля, изберете от списъка с достъпни изпити.</p>
                        </div>
                    ) : (
                        <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
                            {exams.map((exam) => {
                                const examDate = new Date(exam.start_time);
                                const isPast = examDate < new Date();

                                return (
                                    <div key={exam.id} className="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px]">
                                        <div className="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">
                                            <h2 className="text-lg font-semibold text-gray-900 leading-tight">
                                                {exam.subject?.subject_name}
                                            </h2>
                                            <div className="flex flex-wrap gap-2">
                        <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                          {exam.exam_type}
                        </span>
                                                <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${exam.remaining_slots > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`}>
                          {exam.remaining_slots} Свободни места
                        </span>
                                            </div>
                                        </div>

                                        <div className="space-y-3 mb-5">
                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
                                                <span>Преподавател: <span className="font-medium text-gray-800">{exam.teacher?.user?.first_name} {exam.teacher?.user?.last_name}</span></span>
                                            </div>
                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
                                                <span>Дата: <span className="font-medium text-gray-800">
                          {examDate.toLocaleDateString('bg-BG')}
                        </span></span>
                                            </div>
                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-clock w-5 text-gray-400"></i>
                                                <span>Продължителност: <span className="font-medium text-gray-800">
                          {examDate.toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} - {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
                        </span></span>
                                            </div>
                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-university w-5 text-gray-400"></i>
                                                <span>Зала: <span className="font-medium text-gray-800">{exam.hall?.name}</span></span>
                                            </div>
                                        </div>

                                        {!isPast && (
                                            <button
                                                onClick={() => handleUnregister(exam.id, exam.start_time)}
                                                className="recorded-exam w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 bg-red-600 hover:bg-red-700"
                                                data-exam-date={exam.start_time}
                                            >
                                                <i className="fas fa-edit mr-2"></i> Отпиши се
                                            </button>
                                        )}
                                    </div>
                                );
                            })}
                        </div>
                    )}
                </div>
            </div>

            <script dangerouslySetInnerHTML={{
                __html: `
          const examsButtons = document.querySelectorAll('.recorded-exam');
          examsButtons.forEach(button => {
            const examDateString = button.getAttribute("data-exam-date");
            const examDate = new Date(examDateString);
            const hourDifference = (examDate - new Date()) / (1000 * 60 * 60);

            if (hourDifference < 48) {
              button.disabled = true;
              button.classList.replace('bg-red-600', 'bg-gray-300');
              button.classList.add('cursor-not-allowed');
              button.classList.remove('hover:bg-red-700');
            }
          });
        `
            }} />
        </div>
    );
};

export default MyExams;
