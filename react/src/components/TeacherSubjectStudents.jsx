// // components/TeacherSubjectStudents.js
// // import React, { useState, useEffect } from 'react';
// // import { useParams, Link } from 'react-router-dom';
// // import Header from './partials/Header';
// // import {useAuth,api} from "../hooks/useAuth.jsx";
// // // import Sidebar from './partials/Sidebar';
// // // import Alerts from './partials/Alerts';
// //
// // const TeacherSubjectStudents = () => {
// //     const { id } = useParams();
// //     const [subject, setSubject] = useState(null);
// //     const [students, setStudents] = useState([]);
// //     const [teacher, setTeacher] = useState(null);
// //     const [loading, setLoading] = useState(true);
// //     const [error, setError] = useState(null);
// //
// //     useEffect(() => {
// //         fetchSubjectStudents();
// //     }, [id]);
// //
// //     const fetchSubjectStudents = async () => {
// //         try {
// //             // const response = await fetch(`/api/teacher/subjects/${id}/students`, {
// //                 // headers: {
// //             //         'Accept': 'application/json',
// //             //         'X-Requested-With': 'XMLHttpRequest',
// //             //     },
// //             //     credentials: 'include'
// //             // });
// //             const response=await api.get(`/subjects/${id}/students`)
// //             if (response.status!==200) {
// //                 throw new Error('Failed to load students');
// //             }
// //
// //             const data = response.data;
// //
// //             if (data.success) {
// //                 setSubject(data.data.subject);
// //                 setStudents(data.data.students);
// //                 setTeacher(data.data.teacher);
// //             } else {
// //                 throw new Error(data.message);
// //             }
// //         } catch (err) {
// //             setError(err.message);
// //         } finally {
// //             setLoading(false);
// //         }
// //     };
// //
// //     const toggleAttestation = async (studentId, currentStatus) => {
// //         try {
// //             const response = await fetch(`/api/teacher/subjects/${id}/students/${studentId}/toggle-attestation`, {
// //                 method: 'POST',
// //                 headers: {
// //                     'Content-Type': 'application/json',
// //                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
// //                     'X-Requested-With': 'XMLHttpRequest'
// //                 },
// //                 credentials: 'include',
// //                 body: JSON.stringify({})
// //             });
// //
// //             if (!response.ok) {
// //                 throw new Error('Failed to toggle attestation');
// //             }
// //
// //             const data = await response.json();
// //
// //             if (data.success) {
// //                 // Update the student's attestation status
// //                 setStudents(prevStudents =>
// //                     prevStudents.map(student =>
// //                         student.id === studentId
// //                             ? {
// //                                 ...student,
// //                                 pivot: { ...student.pivot, has_attestation: data.has_attestation }
// //                             }
// //                             : student
// //                     )
// //                 );
// //             } else {
// //                 throw new Error(data.message);
// //             }
// //         } catch (err) {
// //             alert('Възникна грешка при промяна на заверката.');
// //             console.error(err);
// //         }
// //     };
// //
// //     if (loading) {
// //         return (
// //             <div className="page-layout">
// //                 <Header />
// //                 {/*<Sidebar teacher={teacher} />*/}
// //                 <main className="p-4 lg:p-6">
// //                     <div className="flex justify-center items-center h-64">
// //                         <div className="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
// //                     </div>
// //                 </main>
// //             </div>
// //         );
// //     }
// //
// //     if (error) {
// //         return (
// //             <div className="page-layout">
// //                 <Header />
// //                 {/*<Sidebar teacher={teacher} />*/}
// //                 <main className="p-4 lg:p-6">
// //                     <div className="bg-red-50 border border-red-200 rounded-lg p-4 text-red-800">
// //                         <p>{error}</p>
// //                     </div>
// //                 </main>
// //             </div>
// //         );
// //     }
// //
// //     return (
// //         <div className="page-layout">
// //             <Header />
// //             {/*<Sidebar teacher={teacher} />*/}
// //             <main className="p-4 lg:p-6">
// //                 <div className="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">
// //                     <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
// //                         <div>
// //                             <h1 className="text-2xl font-bold text-gray-800">Управление на заверки</h1>
// //                             <p className="text-sm text-gray-500 mt-1">{subject.subject_name} - {subject.description}</p>
// //                         </div>
// //                         <Link
// //                             to="/subjects"
// //                             className="inline-flex items-center gap-1 px-4 py-2.5 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition-colors"
// //                         >
// //                             <i className="fa-solid fa-arrow-left"></i>
// //                             Назад към предмети
// //                         </Link>
// //                     </div>
// //                 </div>
// //
// //                 {/*<Alerts />*/}
// //
// //                 <div className="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
// //                     <div className="p-6">
// //                         <h2 className="text-lg font-semibold text-gray-800 mb-4">Списък със студенти</h2>
// //
// //                         {students.length === 0 ? (
// //                             <div className="text-center py-8">
// //                                 <i className="fas fa-user-graduate text-3xl text-gray-300 mb-3"></i>
// //                                 <p className="text-gray-500">Няма студенти, записани по този предмет.</p>
// //                             </div>
// //                         ) : (
// //                             <div className="overflow-x-auto">
// //                                 <table className="w-full">
// //                                     <thead>
// //                                     <tr className="text-left border-b border-gray-200">
// //                                         <th className="pb-3 font-medium text-gray-700">Факултетен номер</th>
// //                                         <th className="pb-3 font-medium text-gray-700">Име на студент</th>
// //                                         <th className="pb-3 font-medium text-gray-700">Специалност</th>
// //                                         <th className="pb-3 font-medium text-gray-700">Заверка</th>
// //                                         <th className="pb-3 font-medium text-gray-700">Действия</th>
// //                                     </tr>
// //                                     </thead>
// //                                     <tbody>
// //                                     {students.map((student) => (
// //                                         <tr key={student.id} className="border-b border-gray-100 hover:bg-gray-50">
// //                                             <td className="py-4 text-gray-700">{student.faculty_number}</td>
// //                                             <td className="py-4 text-gray-700">
// //                                                 {student.user.first_name} {student.user.second_name} {student.user.last_name}
// //                                             </td>
// //                                             <td className="py-4 text-gray-700">{student.specialty.name}</td>
// //                                             <td className="py-4">
// //                           <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${
// //                               student.pivot.has_attestation
// //                                   ? 'bg-green-100 text-green-800'
// //                                   : 'bg-red-100 text-red-800'
// //                           }`}>
// //                             {student.pivot.has_attestation ? 'Има заверка' : 'Няма заверка'}
// //                           </span>
// //                                             </td>
// //                                             <td className="py-4">
// //                                                 <button
// //                                                     onClick={() => toggleAttestation(student.id, student.pivot.has_attestation)}
// //                                                     className={`px-3 py-1.5 rounded-lg text-white font-medium transition-colors duration-200 ${
// //                                                         student.pivot.has_attestation
// //                                                             ? 'bg-red-600 hover:bg-red-700'
// //                                                             : 'bg-green-600 hover:bg-green-700'
// //                                                     }`}
// //                                                 >
// //                                                     {student.pivot.has_attestation ? 'Премахни заверка' : 'Добави заверка'}
// //                                                 </button>
// //                                             </td>
// //                                         </tr>
// //                                     ))}
// //                                     </tbody>
// //                                 </table>
// //                             </div>
// //                         )}
// //                     </div>
// //                 </div>
// //             </main>
// //         </div>
// //     );
// // };
// //
// // export default TeacherSubjectStudents;
// // components/TeacherSubjectStudents.jsx
// // import React, { useState, useEffect } from 'react';
// // import { useParams, Link } from 'react-router-dom';
// // import Header from './Header';
// // import Sidebar from './Sidebar';
// // import Alert from './Alert';
// // import { useAuth, api ,user} from '../hooks/useAuth';
// //
// // const TeacherSubjectStudents = () => {
// //     const { id } = useParams();
// //     const [subject, setSubject] = useState(null);
// //     const [students, setStudents] = useState([]);
// //     const [teacher, setTeacher] = useState(null);
// //     const [loading, setLoading] = useState(true);
// //     const [error, setError] = useState(null);
// //     const [alert, setAlert] = useState({ type: '', message: '' });
// //
// //     useEffect(() => {
// //         fetchSubjectStudents();
// //     }, [id]);
// //
// //     const fetchSubjectStudents = async () => {
// //         try {
// //             const response = await api.get(`/subjects/${id}/students`);
// //
// //             if (response.status !== 200) {
// //                 throw new Error('Failed to load students');
// //             }
// //
// //             const data = response.data;
// //
// //             if (data.success) {
// //                 setSubject(data.data.subject);
// //                 setStudents(data.data.students);
// //                 setTeacher(data.data.teacher);
// //             } else {
// //                 throw new Error(data.message);
// //             }
// //         } catch (err) {
// //             setError(err.message);
// //             setAlert({ type: 'error', message: err.message });
// //         } finally {
// //             setLoading(false);
// //         }
// //     };
// //
// //     const toggleAttestation = async (studentId, currentStatus) => {
// //         try {
// //             const response = await api.post(`/teacher/subjects/${id}/students/${studentId}/toggle-attestation`);
// //
// //             if (response.status !== 200) {
// //                 throw new Error('Failed to toggle attestation');
// //             }
// //
// //             const data = response.data;
// //
// //             if (data.success) {
// //                 setStudents(prevStudents =>
// //                     prevStudents.map(student =>
// //                         student.id === studentId
// //                             ? {
// //                                 ...student,
// //                                 pivot: { ...student.pivot, has_attestation: data.has_attestation }
// //                             }
// //                             : student
// //                     )
// //                 );
// //                 setAlert({ type: 'success', message: 'Статусът на заверката е променен успешно!' });
// //             } else {
// //                 throw new Error(data.message);
// //             }
// //         } catch (err) {
// //             setAlert({ type: 'error', message: 'Възникна грешка при промяна на заверката.' });
// //             console.error(err);
// //         }
// //     };
// //
// //     const closeAlert = () => {
// //         setAlert({ type: '', message: '' });
// //     };
// //
// //     if (loading) {
// //         return (
// //             <div className="page-layout">
// //                 <Header />
// //                 <Sidebar user={user} />
// //                 <main className="p-4 lg:p-6">
// //                     <div className="flex justify-center items-center h-64">
// //                         <div className="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
// //                     </div>
// //                 </main>
// //             </div>
// //         );
// //     }
// //
// //     return (
// //         <div className="page-layout">
// //             <Header />
// //             <Sidebar user={user} />
// //             <main className="p-4 lg:p-6">
// //                 <div className="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">
// //                     <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
// //                         <div>
// //                             <h1 className="text-2xl font-bold text-gray-800">Управление на заверки</h1>
// //                             <p className="text-sm text-gray-500 mt-1">{subject.subject_name} - {subject.description}</p>
// //                         </div>
// //                         <Link
// //                             to="/subjects"
// //                             className="inline-flex items-center gap-1 px-4 py-2.5 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition-colors"
// //                         >
// //                             <i className="fa-solid fa-arrow-left"></i>
// //                             Назад към предмети
// //                         </Link>
// //                     </div>
// //                 </div>
// //
// //                 {alert.message && (
// //                     <Alert type={alert.type} message={alert.message} onClose={closeAlert} />
// //                 )}
// //
// //                 <div className="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
// //                     <div className="p-6">
// //                         <h2 className="text-lg font-semibold text-gray-800 mb-4">Списък със студенти</h2>
// //
// //                         {students.length === 0 ? (
// //                             <div className="text-center py-8">
// //                                 <i className="fas fa-user-graduate text-3xl text-gray-300 mb-3"></i>
// //                                 <p className="text-gray-500">Няма студенти, записани по този предмет.</p>
// //                             </div>
// //                         ) : (
// //                             <div className="overflow-x-auto">
// //                                 <table className="w-full">
// //                                     <thead>
// //                                     <tr className="text-left border-b border-gray-200">
// //                                         <th className="pb-3 font-medium text-gray-700">Факултетен номер</th>
// //                                         <th className="pb-3 font-medium text-gray-700">Име на студент</th>
// //                                         <th className="pb-3 font-medium text-gray-700">Специалност</th>
// //                                         <th className="pb-3 font-medium text-gray-700">Заверка</th>
// //                                         <th className="pb-3 font-medium text-gray-700">Действия</th>
// //                                     </tr>
// //                                     </thead>
// //                                     <tbody>
// //                                     {students.map((student) => (
// //                                         <tr key={student.id} className="border-b border-gray-100 hover:bg-gray-50">
// //                                             <td className="py-4 text-gray-700">{student.faculty_number}</td>
// //                                             <td className="py-4 text-gray-700">
// //                                                 {student.user.first_name} {student.user.second_name} {student.user.last_name}
// //                                             </td>
// //                                             <td className="py-4 text-gray-700">{student.specialty.name}</td>
// //                                             <td className="py-4">
// //                                                 <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${
// //                                                     student.pivot.has_attestation
// //                                                         ? 'bg-green-100 text-green-800'
// //                                                         : 'bg-red-100 text-red-800'
// //                                                 }`}>
// //                                                     {student.pivot.has_attestation ? 'Има заверка' : 'Няма заверка'}
// //                                                 </span>
// //                                             </td>
// //                                             <td className="py-4">
// //                                                 <button
// //                                                     onClick={() => toggleAttestation(student.id, student.pivot.has_attestation)}
// //                                                     className={`px-3 py-1.5 rounded-lg text-white font-medium transition-colors duration-200 ${
// //                                                         student.pivot.has_attestation
// //                                                             ? 'bg-red-600 hover:bg-red-700'
// //                                                             : 'bg-green-600 hover:bg-green-700'
// //                                                     }`}
// //                                                 >
// //                                                     {student.pivot.has_attestation ? 'Премахни заверка' : 'Добави заверка'}
// //                                                 </button>
// //                                             </td>
// //                                         </tr>
// //                                     ))}
// //                                     </tbody>
// //                                 </table>
// //                             </div>
// //                         )}
// //                     </div>
// //                 </div>
// //             </main>
// //         </div>
// //     );
// // };
// //
// // export default TeacherSubjectStudents;
// // components/TeacherSubjectStudents.jsx
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
//     const [error, setError] = useState(null);
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
//             if (response.status !== 200) {
//                 throw new Error('Failed to load students');
//             }
//
//             const data = response.data;
//
//             if (data.success) {
//                 setSubject(data.data.subject);
//                 setStudents(data.data.students);
//             } else {
//                 throw new Error(data.message);
//             }
//         } catch (err) {
//             setError(err.message);
//             setAlert({ type: 'error', message: err.message });
//         } finally {
//             setLoading(false);
//         }
//     };
//
//     const toggleAttestation = async (studentId, currentStatus) => {
//         try {
//             const response = await api.post(`/subjects/${id}/students/${studentId}/toggle-attestation`);
//
//             if (response.status !== 200) {
//                 throw new Error('Failed to toggle attestation');
//             }
//
//             const data = response.data;
//
//             if (data.success) {
//                 setStudents(prevStudents =>
//                     prevStudents.map(student =>
//                         student.id === studentId
//                             ? {
//                                 ...student,
//                                 pivot: { ...student.pivot, has_attestation: data.has_attestation }
//                             }
//                             : student
//                     )
//                 );
//                 setAlert({ type: 'success', message: 'Статусът на заверката е променен успешно!' });
//             } else {
//                 throw new Error(data.message);
//             }
//         } catch (err) {
//             setAlert({ type: 'error', message: 'Възникна грешка при промяна на заверката.' });
//             console.error(err);
//         }
//     };
//
//     const closeAlert = () => {
//         setAlert({ type: '', message: '' });
//     };
//
//     if (loading) {
//         return (
//             <div className="page-layout">
//                 <Header />
//                 <Sidebar user={user} />
//                 <main className="p-4 lg:p-6">
//                     <div className="flex justify-center items-center h-64">
//                         <div className="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
//                     </div>
//                 </main>
//             </div>
//         );
//     }
//
//     return (
//         <div className="page-layout">
//             <Header />
//             <Sidebar user={user} />
//             <main className="p-4 lg:p-6">
//                 <div className="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">
//                     <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                         <div>
//                             <h1 className="text-2xl font-bold text-gray-800">Управление на заверки</h1>
//                             <p className="text-sm text-gray-500 mt-1">{subject.subject_name} - {subject.description}</p>
//                         </div>
//                         <Link
//                             to="/teacher-subjects"
//                             className="inline-flex items-center gap-1 px-4 py-2.5 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition-colors"
//                         >
//                             <i className="fa-solid fa-arrow-left"></i>
//                             Назад към предмети
//                         </Link>
//                     </div>
//                 </div>
//
//                 {alert.message && (
//                     <Alert type={alert.type} message={alert.message} onClose={closeAlert} />
//                 )}
//
//                 <div className="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
//                     <div className="p-6">
//                         <h2 className="text-lg font-semibold text-gray-800 mb-4">Списък със студенти</h2>
//
//                         {students.length === 0 ? (
//                             <div className="text-center py-8">
//                                 <i className="fas fa-user-graduate text-3xl text-gray-300 mb-3"></i>
//                                 <p className="text-gray-500">Няма студенти, записани по този предмет.</p>
//                             </div>
//                         ) : (
//                             <div className="overflow-x-auto">
//                                 <table className="w-full">
//                                     <thead>
//                                     <tr className="text-left border-b border-gray-200">
//                                         <th className="pb-3 font-medium text-gray-700">Факултетен номер</th>
//                                         <th className="pb-3 font-medium text-gray-700">Име на студент</th>
//                                         <th className="pb-3 font-medium text-gray-700">Специалност</th>
//                                         <th className="pb-3 font-medium text-gray-700">Заверка</th>
//                                         <th className="pb-3 font-medium text-gray-700">Действия</th>
//                                     </tr>
//                                     </thead>
//                                     <tbody>
//                                     {students.map((student) => (
//                                         <tr key={student.id} className="border-b border-gray-100 hover:bg-gray-50">
//                                             <td className="py-4 text-gray-700">{student.faculty_number}</td>
//                                             <td className="py-4 text-gray-700">
//                                                 {student.user.first_name} {student.user.second_name} {student.user.last_name}
//                                             </td>
//                                             <td className="py-4 text-gray-700">{student.specialty.name}</td>
//                                             <td className="py-4">
//                                                 <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${
//                                                     student.pivot.has_attestation
//                                                         ? 'bg-green-100 text-green-800'
//                                                         : 'bg-red-100 text-red-800'
//                                                 }`}>
//                                                     {student.pivot.has_attestation ? 'Има заверка' : 'Няма заверка'}
//                                                 </span>
//                                             </td>
//                                             <td className="py-4">
//                                                 <button
//                                                     onClick={() => toggleAttestation(student.id, student.pivot.has_attestation)}
//                                                     className={`px-3 py-1.5 rounded-lg text-white font-medium transition-colors duration-200 ${
//                                                         student.pivot.has_attestation
//                                                             ? 'bg-red-600 hover:bg-red-700'
//                                                             : 'bg-green-600 hover:bg-green-700'
//                                                     }`}
//                                                 >
//                                                     {student.pivot.has_attestation ? 'Премахни заверка' : 'Добави заверка'}
//                                                 </button>
//                                             </td>
//                                         </tr>
//                                     ))}
//                                     </tbody>
//                                 </table>
//                             </div>
//                         )}
//                     </div>
//                 </div>
//             </main>
//         </div>
//     );
// };
//
// export default TeacherSubjectStudents;
// TeacherSubjectStudents.jsx
import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import Header from './Header';
import Sidebar from './Sidebar';
import Alert from './Alert';
import { useAuth, api } from '../hooks/useAuth';

const TeacherSubjectStudents = () => {
    const { id } = useParams();
    const [subject, setSubject] = useState(null);
    const [students, setStudents] = useState([]);
    const [loading, setLoading] = useState(true);
    const [alert, setAlert] = useState({ type: '', message: '' });
    const { user } = useAuth();

    useEffect(() => {
        fetchSubjectStudents();
    }, [id]);

    const fetchSubjectStudents = async () => {
        try {
            const response = await api.get(`/subjects/${id}/students`);

            if (response.data.success) {
                setSubject(response.data.data.subject);
                setStudents(response.data.data.students);
            } else {
                throw new Error(response.data.message);
            }
        } catch (err) {
            setAlert({ type: 'error', message: err.message });
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
                                <h1 className="text-2xl font-bold text-gray-800">Управление на заверки</h1>
                                <p className="text-sm text-gray-500 mt-1">{subject.subject_name} - {subject.description}</p>
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
                        <Alert type={alert.type} message={alert.message} onClose={closeAlert} />
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
                </main>
            </div>
        </div>
    );
};

export default TeacherSubjectStudents;
