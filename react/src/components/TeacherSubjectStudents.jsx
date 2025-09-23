
// import React, { useState, useEffect } from 'react';
// import { useParams, Link } from 'react-router-dom';
// import Header from './Header';
// import Sidebar from './Sidebar';
// import Alert from './Alert';
// import { useAuth, api } from '../hooks/useAuth';
//
// const TeacherSubjectStudents = () => {
//     const { id } = useParams();
//     const [subject, setSubject] = useState(null);
//     const [students, setStudents] = useState([]);
//     const [loading, setLoading] = useState(true);
//     const [alert, setAlert] = useState({ type: '', message: '' });
//     const { user } = useAuth();
//
//     useEffect(() => {
//         fetchSubjectStudents();
//     }, [id]);
//
//     const fetchSubjectStudents = async () => {
//         try {
//             const response = await api.get(`/subjects/${id}/students`);
//
//             if (response.data.success) {
//                 setSubject(response.data.data.subject);
//                 setStudents(response.data.data.students);
//             } else {
//                 throw new Error(response.data.message);
//             }
//         } catch (err) {
//             setAlert({ type: 'error', message: err.message });
//         } finally {
//             setLoading(false);
//         }
//     };
//
//     const toggleAttestation = async (studentId) => {
//         try {
//             const response = await api.post(`/subjects/${id}/students/${studentId}/toggle-attestation`);
//
//             if (response.data.success) {
//                 setStudents(prevStudents =>
//                     prevStudents.map(student =>
//                         student.id === studentId
//                             ? {
//                                 ...student,
//                                 pivot: { ...student.pivot, has_attestation: response.data.has_attestation }
//                             }
//                             : student
//                     )
//                 );
//                 setAlert({ type: 'success', message: 'Статусът на заверката е променен успешно!' });
//             } else {
//                 throw new Error(response.data.message);
//             }
//         } catch (err) {
//             setAlert({ type: 'error', message: 'Възникна грешка при промяна на заверката.' });
//         }
//     };
//
//     const closeAlert = () => {
//         setAlert({ type: '', message: '' });
//     };
//
//     if (loading) {
//         return (
//             <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden">
//                 <Header />
//                 <div className="page-layout">
//                     <Sidebar user={user} />
//                     <main className="p-4 lg:p-6">
//                         <div className="flex justify-center items-center h-64">
//                             <div className="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
//                         </div>
//                     </main>
//                 </div>
//             </div>
//         );
//     }
//
//     return (
//         <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden">
//             <Header />
//             <div className="page-layout">
//                 <Sidebar user={user} />
//                 <main className="p-4 lg:p-6">
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Управление на заверки</h1>
//                                 <p className="text-sm text-gray-500 mt-1">{subject.subject_name} - {subject.description}</p>
//                             </div>
//                             <Link
//                                 to="/teacher-subjects"
//                                 className="inline-flex items-center gap-1 px-4 py-2.5 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition-colors"
//                             >
//                                 <i className="fa-solid fa-arrow-left"></i>
//                                 Назад към предмети
//                             </Link>
//                         </div>
//                     </div>
//
//                     {alert.message && (
//                         <Alert type={alert.type} message={alert.message} onClose={closeAlert} />
//                     )}
//
//                     <div className="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
//                         <div className="p-6">
//                             <h2 className="text-lg font-semibold text-gray-800 mb-4">Списък със студенти</h2>
//
//                             {students.length === 0 ? (
//                                 <div className="text-center py-8">
//                                     <i className="fas fa-user-graduate text-3xl text-gray-300 mb-3"></i>
//                                     <p className="text-gray-500">Няма студенти, записани по този предмет.</p>
//                                 </div>
//                             ) : (
//                                 <div className="overflow-x-auto">
//                                     <table className="w-full">
//                                         <thead>
//                                         <tr className="text-left border-b border-gray-200">
//                                             <th className="pb-3 font-medium text-gray-700">Факултетен номер</th>
//                                             <th className="pb-3 font-medium text-gray-700">Име на студент</th>
//                                             <th className="pb-3 font-medium text-gray-700">Специалност</th>
//                                             <th className="pb-3 font-medium text-gray-700">Заверка</th>
//                                             <th className="pb-3 font-medium text-gray-700">Действия</th>
//                                         </tr>
//                                         </thead>
//                                         <tbody>
//                                         {students.map((student) => (
//                                             <tr key={student.id} className="border-b border-gray-100 hover:bg-gray-50">
//                                                 <td className="py-4 text-gray-700">{student.faculty_number}</td>
//                                                 <td className="py-4 text-gray-700">
//                                                     {student.user.first_name} {student.user.second_name} {student.user.last_name}
//                                                 </td>
//                                                 <td className="py-4 text-gray-700">{student.specialty.name}</td>
//                                                 <td className="py-4">
//                                                     <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${
//                                                         student.pivot.has_attestation
//                                                             ? 'bg-green-100 text-green-800'
//                                                             : 'bg-red-100 text-red-800'
//                                                     }`}>
//                                                         {student.pivot.has_attestation ? 'Има заверка' : 'Няма заверка'}
//                                                     </span>
//                                                 </td>
//                                                 <td className="py-4">
//                                                     <button
//                                                         onClick={() => toggleAttestation(student.id)}
//                                                         className={`px-3 py-1.5 rounded-lg text-white font-medium transition-colors duration-200 ${
//                                                             student.pivot.has_attestation
//                                                                 ? 'bg-red-600 hover:bg-red-700'
//                                                                 : 'bg-green-600 hover:bg-green-700'
//                                                         }`}
//                                                     >
//                                                         {student.pivot.has_attestation ? 'Премахни заверка' : 'Добави заверка'}
//                                                     </button>
//                                                 </td>
//                                             </tr>
//                                         ))}
//                                         </tbody>
//                                     </table>
//                                 </div>
//                             )}
//                         </div>
//                     </div>
//                 </main>
//             </div>
//         </div>
//     );
// };
//
// export default TeacherSubjectStudents;
import React, { useState, useEffect } from 'react';
import { useAuth, api } from '../hooks/useAuth';
import { useParams, useLocation, Link } from 'react-router-dom';
import Header from './Header';
import Sidebar from './Sidebar';
import Alert from './Alert';

const TeacherSubjectStudents = () => {
    const { user } = useAuth();
    const { id } = useParams();
    const location = useLocation();
    const [subject, setSubject] = useState(null);
    const [students, setStudents] = useState([]);
    const [loading, setLoading] = useState(true);
    const [alert, setAlert] = useState({ type: '', message: '' });

    useEffect(() => {
        fetchSubjectStudents();

        if (location.state?.message) {
            setAlert({ type: 'success', message: location.state.message });
            window.history.replaceState({}, document.title);
        }
    }, [id, location.state]);

    const fetchSubjectStudents = async () => {
        try {
            setLoading(true);
            const response = await api.get(`/subjects/${id}/students`);

            if (response.data.success) {
                setSubject(response.data.data.subject);
                setStudents(response.data.data.students || []);
            } else {
                setAlert({ type: 'error', message: response.data.message || 'Грешка при зареждане на студентите' });
            }
        } catch (error) {
            console.error('Грешка при зареждане на студентите:', error);
            setAlert({ type: 'error', message: 'Грешка при зареждане на студентите' });
        } finally {
            setLoading(false);
        }
    };

    const toggleAttestation = async (studentId) => {
        try {
            const response = await api.post(`/subjects/${id}/students/${studentId}/toggle-attestation`);

            if (response.data.success) {
                setStudents(prevStudents =>
                    prevStudents.map(student =>
                        student.id === studentId
                            ? {
                                ...student,
                                pivot: { ...student.pivot, has_attestation: response.data.has_attestation }
                            }
                            : student
                    )
                );
                setAlert({ type: 'success', message: 'Статусът на заверката е променен успешно!' });
            } else {
                throw new Error(response.data.message);
            }
        } catch (err) {
            setAlert({ type: 'error', message: 'Възникна грешка при промяна на заверката.' });
        }
    };

    if (loading) {
        return (
            <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50">
                <Header />
                <div className="flex pt-0">
                    <Sidebar user={user} />
                    <div className="flex-1 p-4 lg:p-8 ml-0 lg:ml-0 flex justify-center items-center">
                        <div className="flex justify-center items-center py-8">
                            <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600"></div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50">
            <Header />
            <div className="flex pt-0">
                <Sidebar user={user} />

                <div className="flex-1 p-4 lg:p-8 ml-0 lg:ml-0">
                    <div className="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">
                        <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                            <div>
                                <h1 className="text-2xl font-bold text-gray-800">Управление на заверки</h1>
                                <p className="text-sm text-gray-500 mt-1">{subject?.subject_name} - {subject?.description}</p>
                            </div>
                            <Link
                                to="/teacher-subjects"
                                className="inline-flex items-center gap-1 px-4 py-2.5 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition-colors"
                            >
                                <i className="fa-solid fa-arrow-left"></i>
                                Назад към предмети
                            </Link>
                        </div>
                    </div>

                    {alert.message && (
                        <Alert type={alert.type} message={alert.message} onClose={() => setAlert({ type: '', message: '' })} />
                    )}

                    <div className="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div className="p-6">
                            <h2 className="text-lg font-semibold text-gray-800 mb-4">Списък със студенти</h2>

                            {students.length === 0 ? (
                                <div className="text-center py-8">
                                    <i className="fas fa-user-graduate text-3xl text-gray-300 mb-3"></i>
                                    <p className="text-gray-500">Няма студенти, записани по този предмет.</p>
                                </div>
                            ) : (
                                <div className="overflow-x-auto">
                                    <table className="w-full">
                                        <thead>
                                        <tr className="text-left border-b border-gray-200">
                                            <th className="pb-3 font-medium text-gray-700">Факултетен номер</th>
                                            <th className="pb-3 font-medium text-gray-700">Име на студент</th>
                                            <th className="pb-3 font-medium text-gray-700">Специалност</th>
                                            <th className="pb-3 font-medium text-gray-700">Заверка</th>
                                            <th className="pb-3 font-medium text-gray-700">Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {students.map((student) => (
                                            <tr key={student.id} className="border-b border-gray-100 hover:bg-gray-50">
                                                <td className="py-4 text-gray-700">{student.faculty_number}</td>
                                                <td className="py-4 text-gray-700">
                                                    {student.user.first_name} {student.user.second_name} {student.user.last_name}
                                                </td>
                                                <td className="py-4 text-gray-700">{student.specialty.name}</td>
                                                <td className="py-4">
                                                    <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${
                                                        student.pivot.has_attestation
                                                            ? 'bg-green-100 text-green-800'
                                                            : 'bg-red-100 text-red-800'
                                                    }`}>
                                                        {student.pivot.has_attestation ? 'Има заверка' : 'Няма заверка'}
                                                    </span>
                                                </td>
                                                <td className="py-4">
                                                    <button
                                                        onClick={() => toggleAttestation(student.id)}
                                                        className={`px-3 py-1.5 rounded-lg text-white font-medium transition-colors duration-200 ${
                                                            student.pivot.has_attestation
                                                                ? 'bg-red-600 hover:bg-red-700'
                                                                : 'bg-green-600 hover:bg-green-700'
                                                        }`}
                                                    >
                                                        {student.pivot.has_attestation ? 'Премахни заверка' : 'Добави заверка'}
                                                    </button>
                                                </td>
                                            </tr>
                                        ))}
                                        </tbody>
                                    </table>
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default TeacherSubjectStudents;
