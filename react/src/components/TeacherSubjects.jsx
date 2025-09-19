// // components/TeacherSubjects.js
// import React, { useState, useEffect } from 'react';
// import { Link } from 'react-router-dom';
// // import Header from './partials/Header';
// import Header from "./Header.jsx";
// import { useAuth, api } from '../hooks/useAuth';
//
// // import Sidebar from './partials/Sidebar';
// // import Alerts from './partials/Alerts';
//
// const TeacherSubjects = () => {
//     const [subjects, setSubjects] = useState([]);
//     const [teacher, setTeacher] = useState(null);
//     const [loading, setLoading] = useState(true);
//     const [error, setError] = useState(null);
//
//     useEffect(() => {
//         fetchTeacherSubjects();
//     }, []);
//
//     const fetchTeacherSubjects = async () => {
//         try {
//             // const response = await api.get('/subjects', {
//             //     headers: {
//             //         'Accept': 'application/json',
//             //         'X-Requested-With': 'XMLHttpRequest',
//             //     },
//             //     credentials: 'include'
//             // });
//             const response=await api.get('/teacher-subjects')
//             console.log(response)
//             if (response.status!==200) {
//                 throw new Error('Failed to load subjects');
//             }
//
//             // const data = await response.json();
//             const data=response.data;
//
//             if (data.success) {
//                 setSubjects(data.data.subjects);
//                 setTeacher(data.data.teacher);
//             } else {
//                 throw new Error(data.message);
//             }
//         } catch (err) {
//             setError(err.message);
//         } finally {
//             setLoading(false);
//         }
//     };
//
//     if (loading) {
//         return (
//             <div className="page-layout">
//                 <Header />
//                 {/*<Sidebar teacher={teacher} />*/}
//                 <main className="p-4 lg:p-6">
//                     <div className="flex justify-center items-center h-64">
//                         <div className="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
//                     </div>
//                 </main>
//             </div>
//         );
//     }
//
//     if (error) {
//         return (
//             <div className="page-layout">
//                 <Header />
//                 {/*<Sidebar teacher={teacher} />*/}
//                 <main className="p-4 lg:p-6">
//                     <div className="bg-red-50 border border-red-200 rounded-lg p-4 text-red-800">
//                         <p>{error}</p>
//                     </div>
//                 </main>
//             </div>
//         );
//     }
//
//     return (
//         <div className="page-layout">
//             <Header />
//             {/*<Sidebar teacher={teacher} />*/}
//             <main className="p-4 lg:p-6">
//                 <div className="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">
//                     <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                         <div>
//                             <h1 className="text-2xl font-bold text-gray-800">Моите предмети</h1>
//                             <p className="text-sm text-gray-500 mt-1">Преглед и управление на заверки по предмети</p>
//                         </div>
//                     </div>
//                 </div>
//
//                 {/*<Alerts />*/}
//
//                 {subjects.length === 0 ? (
//                     <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
//                         <i className="fas fa-book text-4xl text-gray-300 mb-4"></i>
//                         <h3 className="text-lg font-medium text-gray-700 mb-2">Нямате назначени предмети</h3>
//                         <p className="text-gray-500">Свържете се с администратор за да бъдете добавени към предмет.</p>
//                     </div>
//                 ) : (
//                     <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
//                         {subjects.map((subject) => (
//                             <div key={subject.id} className="flex flex-col bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px]">
//                                 <div className="flex justify-between items-start gap-2 mb-3">
//                                     <h2 className="text-lg font-semibold text-gray-900">
//                                         {subject.subject_name}
//                                     </h2>
//                                     <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
//                     Сем. {subject.semester}
//                   </span>
//                                 </div>
//
//                                 <div className="space-y-3 mb-5">
//                                     <div className="text-gray-600">
//                                         {subject.description}
//                                     </div>
//                                     <div className="flex items-center gap-2 text-gray-600">
//                                         <i className="fas fa-users w-5 text-gray-400"></i>
//                                         <span>Студенти: <span className="font-medium text-gray-800">{subject.students_count}</span></span>
//                                     </div>
//                                 </div>
//
//                                 <Link
//                                     to={`/subjects/${subject.id}/students`}
//                                     className="mt-auto w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 bg-blue-600 hover:bg-blue-700 text-center"
//                                 >
//                                     <i className="fa-solid fa-list-check"></i> Управление на заверки
//                                 </Link>
//                             </div>
//                         ))}
//                     </div>
//                 )}
//             </main>
//         </div>
//     );
// };
//
// export default TeacherSubjects;
// TeacherSubjects.jsx
import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import Header from './Header';
import Sidebar from './Sidebar';
import Alert from './Alert';
import { useAuth, api } from '../hooks/useAuth';

const TeacherSubjects = () => {
    const [subjects, setSubjects] = useState([]);
    const [loading, setLoading] = useState(true);
    const [alert, setAlert] = useState({ type: '', message: '' });
    const { user } = useAuth();

    useEffect(() => {
        fetchTeacherSubjects();
    }, []);

    const fetchTeacherSubjects = async () => {
        try {
            const response = await api.get('/teacher-subjects');

            if (response.data.success) {
                setSubjects(response.data.data.subjects);
            } else {
                throw new Error(response.data.message);
            }
        } catch (err) {
            setAlert({ type: 'error', message: err.message });
        } finally {
            setLoading(false);
        }
    };

    const closeAlert = () => {
        setAlert({ type: '', message: '' });
    };

    if (loading) {
        return (
            <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden">
                <Header />
                <div className="page-layout">
                    <Sidebar user={user} />
                    <main className="p-4 lg:p-6">
                        <div className="flex justify-center items-center h-64">
                            <div className="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
                        </div>
                    </main>
                </div>
            </div>
        );
    }

    return (
        <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden">
            <Header />
            <div className="page-layout">
                <Sidebar user={user} />
                <main className="p-4 lg:p-6">
                    <div className="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">
                        <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                            <div>
                                <h1 className="text-2xl font-bold text-gray-800">Моите предмети</h1>
                                <p className="text-sm text-gray-500 mt-1">Преглед и управление на заверки по предмети</p>
                            </div>
                        </div>
                    </div>

                    {alert.message && (
                        <Alert type={alert.type} message={alert.message} onClose={closeAlert} />
                    )}

                    {subjects.length === 0 ? (
                        <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
                            <i className="fas fa-book text-4xl text-gray-300 mb-4"></i>
                            <h3 className="text-lg font-medium text-gray-700 mb-2">Нямате назначени предмети</h3>
                            <p className="text-gray-500">Свържете се с администратор за да бъдете добавени към предмет.</p>
                        </div>
                    ) : (
                        <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
                            {subjects.map((subject) => (
                                <div key={subject.id} className="flex flex-col bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px]">
                                    <div className="flex justify-between items-start gap-2 mb-3">
                                        <h2 className="text-lg font-semibold text-gray-900">
                                            {subject.subject_name}
                                        </h2>
                                        <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            Сем. {subject.semester}
                                        </span>
                                    </div>

                                    <div className="space-y-3 mb-5">
                                        <div className="text-gray-600">
                                            {subject.description}
                                        </div>
                                        <div className="flex items-center gap-2 text-gray-600">
                                            <i className="fas fa-users w-5 text-gray-400"></i>
                                            <span>Студенти: <span className="font-medium text-gray-800">{subject.students_count}</span></span>
                                        </div>
                                    </div>

                                    <Link
                                        to={`/subjects/${subject.id}/students`}
                                        className="mt-auto w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 bg-blue-600 hover:bg-blue-700 text-center"
                                    >
                                        <i className="fa-solid fa-list-check"></i> Управление на заверки
                                    </Link>
                                </div>
                            ))}
                        </div>
                    )}
                </main>
            </div>
        </div>
    );
};

export default TeacherSubjects;
