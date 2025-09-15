// MyPastExams.jsx
// import { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
// import Header from './Header';
// import Sidebar from './Sidebar';
// import Alert from './Alert';
//
// const MyPastExams = () => {
//     const { user, token } = useAuth();
//     const [exams, setExams] = useState([]);
//     const [alert, setAlert] = useState({ type: '', message: '', show: false });
//
//     useEffect(() => {
//         fetchPastExams();
//     }, []);
//
//     const fetchPastExams = async () => {
//         try {
//             const response = await fetch('/api/my-past-exams', {
//                 headers: {
//                     'Authorization': `Bearer ${token}`,
//                     'Accept': 'application/json',
//                 },
//             });
//
//             if (response.ok) {
//                 const data = await response.json();
//                 setExams(data.exams);
//             } else {
//                 setAlert({ type: 'error', message: 'Грешка при зареждане на изпитите', show: true });
//             }
//         } catch (error) {
//             console.error('Грешка при заявка:', error);
//             setAlert({ type: 'error', message: 'Грешка при зареждане на изпитите', show: true });
//         }
//     };
//
//     const formatDate = (dateString) => {
//         const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
//         return new Date(dateString).toLocaleDateString('bg-BG', options);
//     };
//
//     const formatTime = (dateString) => {
//         const options = { hour: '2-digit', minute: '2-digit' };
//         return new Date(dateString).toLocaleTimeString('bg-BG', options);
//     };
//
//     const closeAlert = () => {
//         setAlert({ ...alert, show: false });
//     };
//
//     return (
//         <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden font-[Inter]">
//             <Header />
//
//             <div className="page-layout">
//                 <Sidebar user={user} />
//
//                 <div id="mainContent" className="ml-0 lg:ml-0 p-4 lg:p-8 transition-all duration-300">
//                     {/* Page Header */}
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Изминали изпити</h1>
//                                 <p className="text-sm text-gray-500 mt-1">Преглед на изминалите изпити</p>
//                             </div>
//                         </div>
//                     </div>
//
//                     {/* Alerts */}
//                     {alert.show && (
//                         <Alert type={alert.type} message={alert.message} onClose={closeAlert} />
//                     )}
//
//                     {exams.length === 0 ? (
//                         <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
//                             <i className="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
//                             <h3 className="text-lg font-medium text-gray-700 mb-2">Няма записани изпити</h3>
//                             <p className="text-gray-500">Все още нямате записани изпити. Моля, изберете от списъка с достъпни изпити.</p>
//                         </div>
//                     ) : (
//                         <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
//                             {exams.map((exam) => {
//                                 const registration = exam.registrations?.find(
//                                     (reg) => reg.student_id === user.student.id
//                                 );
//
//                                 return (
//                                     <div
//                                         key={exam.id}
//                                         className="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px]"
//                                     >
//                                         <div className="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">
//                                             <h2 className="text-lg font-semibold text-gray-900 leading-tight">
//                                                 {exam.subject?.subject_name}
//                                             </h2>
//                                             <div className="flex flex-wrap gap-2">
//                         <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
//                           {exam.exam_type}
//                         </span>
//                                                 <span
//                                                     className={`px-2.5 py-1 rounded-full text-xs font-medium ${
//                                                         exam.remainingSlots > 0
//                                                             ? 'bg-green-100 text-green-800'
//                                                             : 'bg-red-100 text-red-800'
//                                                     }`}
//                                                 >
//                           {exam.remainingSlots} Свободни места
//                         </span>
//                                             </div>
//                                         </div>
//
//                                         <div className="space-y-3 mb-5">
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
//                                                 <span>
//                           Преподавател:{' '}
//                                                     <span className="font-medium text-gray-800">
//                             {exam.teacher?.user.first_name} {exam.teacher?.user.last_name}
//                           </span>
//                         </span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
//                                                 <span>
//                           Дата:{' '}
//                                                     <span className="font-medium text-gray-800">
//                             {formatDate(exam.start_time)}
//                           </span>
//                         </span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-clock w-5 text-gray-400"></i>
//                                                 <span>
//                           Продължителност:{' '}
//                                                     <span className="font-medium text-gray-800">
//                             {formatTime(exam.start_time)} - {formatTime(exam.end_time)}
//                           </span>
//                         </span>
//                                             </div>
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-university w-5 text-gray-400"></i>
//                                                 <span>
//                           Зала: <span className="font-medium text-gray-800">{exam.hall?.name}</span>
//                         </span>
//                                             </div>
//
//                                             <div className="flex items-center gap-2 text-gray-600">
//                                                 <i className="fas fa-star w-5 text-gray-400"></i>
//                                                 <span>
//                           Оценка:
//                                                     {registration && registration.grade ? (
//                                                         <span className="font-medium text-gray-800">{registration.grade}</span>
//                                                     ) : (
//                                                         <span className="text-gray-500 italic">---</span>
//                                                     )}
//                         </span>
//                                             </div>
//                                         </div>
//
//
//                                     </div>
//                                 );
//                             })}
//                         </div>
//                     )}
//                 </div>
//             </div>
//
//             <style jsx>{`
//         .page-layout {
//           display: grid;
//           grid-template-columns: 20rem 1fr;
//           gap: 0;
//           min-height: calc(100vh - var(--header-h, 64px));
//         }
//
//         @media (max-width: 1538px) {
//           .page-layout {
//             display: block;
//           }
//         }
//       `}</style>
//         </div>
//     );
// };
//
// export default MyPastExams;
// MyPastExams.jsx
import { useState, useEffect } from 'react';
import { useAuth } from '../hooks/useAuth';
import Header from './Header';
import Sidebar from './Sidebar';
import Alert from './Alert';

const MyPastExams = () => {
    const { user, token } = useAuth();
    const [exams, setExams] = useState([]);
    const [alert, setAlert] = useState({ type: '', message: '', show: false });

    useEffect(() => {
        fetchPastExams();
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, []);

    const fetchPastExams = async () => {
        try {
            const response = await fetch('/api/my-past-exams', {
                headers: {
                    Authorization: `Bearer ${token}`,
                    Accept: 'application/json',
                },
            });

            if (response.ok) {
                const data = await response.json();
                console.log(data)
                // setExams(Array.isArray(data?.exams) ? data.exams : []);
                setExams(Array.isArray(data?.exams) ? data.exams : []);
            } else {
                setAlert({ type: 'error', message: 'Грешка при зареждане на изпитите', show: true });
            }
        } catch (error) {
            console.error('Грешка при заявка:', error);
            setAlert({ type: 'error', message: 'Грешка при зареждане на изпитите', show: true });
        }
    };

    const formatDate = (dateString) => {
        if (!dateString) return '—';
        const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
        return new Date(dateString).toLocaleDateString('bg-BG', options);
    };

    const formatTime = (dateString) => {
        if (!dateString) return '—';
        const options = { hour: '2-digit', minute: '2-digit' };
        return new Date(dateString).toLocaleTimeString('bg-BG', options);
    };

    const closeAlert = () => setAlert((a) => ({ ...a, show: false }));

    const handleUnregister = (examId) => {
        // TODO: добави реална логика за отписване при нужда
        console.log('Unregister examId=', examId);
    };

    return (
        <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden font-[Inter]">
            <Header />

            <div className="page-layout">
                <Sidebar user={user} />

                <div id="mainContent" className="ml-0 lg:ml-0 p-4 lg:p-8 transition-all duration-300">
                    {/* Page Header */}
                    <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
                        <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                            <div>
                                <h1 className="text-2xl font-bold text-gray-800">Изминали изпити</h1>
                                <p className="text-sm text-gray-500 mt-1">Преглед на изминалите изпити</p>
                            </div>
                        </div>
                    </div>

                    {/* Alerts */}
                    {alert.show && <Alert type={alert.type} message={alert.message} onClose={closeAlert} />}

                    {!exams || exams.length === 0 ? (
                        <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
                            <i className="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
                            <h3 className="text-lg font-medium text-gray-700 mb-2">Няма записани изпити</h3>
                            <p className="text-gray-500">
                                Все още нямате записани изпити. Моля, изберете от списъка с достъпни изпити.
                            </p>
                        </div>
                    ) : (
                        <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
                            {exams.map((registration) => {
                                const  exam=registration.exam;
                                // console.log(exam)
                                // безопасно взимаме регистрацията на текущия студент
                                // const registration = exam?.registrations?.find(
                                //     (reg) => reg?.student_id === user?.student?.id
                                // );

                                // безопасно взимаме останали места (snake_case или camelCase)
                                const remaining =
                                    typeof exam?.remainingSlots === 'number'
                                        ? exam.remainingSlots
                                        : typeof exam?.remaining_slots === 'number'
                                            ? exam.remaining_slots
                                            : 0;

                                const teacherFirst = exam?.teacher?.user?.first_name ?? '';
                                const teacherLast = exam?.teacher?.user?.last_name ?? '';

                                return (
                                    <div

                                        key={exam?.id ?? Math.random()}
                                        className="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px]"
                                    >
                                        <div className="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">
                                            <h2 className="text-lg font-semibold text-gray-900 leading-tight">
                                                {exam?.subject?.subject_name ?? 'Неизвестна дисциплина'}
                                            </h2>
                                            <div className="flex flex-wrap gap-2">
                        <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                          {exam?.exam_type ?? '—'}
                        </span>
                        {/*                        <span*/}
                        {/*                            className={`px-2.5 py-1 rounded-full text-xs font-medium ${*/}
                        {/*                                remaining > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'*/}
                        {/*                            }`}*/}
                        {/*                        >*/}
                        {/*  {remaining} Свободни места*/}
                        {/*</span>*/}
                                            </div>
                                        </div>

                                        <div className="space-y-3 mb-5">
                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
                                                <span>
                          Преподавател:{' '}
                                                    <span className="font-medium text-gray-800">
                            {(teacherFirst + ' ' + teacherLast).trim() || '—'}
                          </span>
                        </span>
                                            </div>

                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
                                                <span>
                          Дата:{' '}
                                                    <span className="font-medium text-gray-800">{formatDate(exam?.start_time)}</span>
                        </span>
                                            </div>

                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-clock w-5 text-gray-400"></i>
                                                <span>
                          Продължителност:{' '}
                                                    <span className="font-medium text-gray-800">
                            {formatTime(exam?.start_time)} - {formatTime(exam?.end_time)}
                          </span>
                        </span>
                                            </div>

                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-university w-5 text-gray-400"></i>
                                                <span>
                          Зала:{' '}
                                                    <span className="font-medium text-gray-800">{exam?.hall?.name ?? '—'}</span>
                        </span>
                                            </div>

                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-star w-5 text-gray-400"></i>
                                                <span>
                          Оценка:{' '}
                                                    {registration?.grade != null && registration?.grade !== ''
                                                        ? <span className="font-medium text-gray-800">{registration.grade}</span>
                                                        : <span className="text-gray-500 italic">---</span>}
                        </span>
                                            </div>
                                        </div>

                                        {exam?.start_time && new Date(exam.start_time) > new Date() && (
                                            <button
                                                className="recorded-exam w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 bg-red-600 hover:bg-red-700"
                                                data-exam-date={exam.start_time}
                                                onClick={() => handleUnregister(exam?.id)}
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

            {/* ВАЖНО: махаме 'jsx' атрибута — обикновен <style> е достатъчен */}
            <style>{`
        .page-layout {
          display: grid;
          grid-template-columns: 20rem 1fr;
          gap: 0;
          min-height: calc(100vh - var(--header-h, 64px));
        }
        @media (max-width: 1538px) {
          .page-layout { display: block; }
        }
      `}</style>
        </div>
    );
};

export default MyPastExams;
