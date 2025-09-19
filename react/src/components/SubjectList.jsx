// import React, { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
// import { api } from '../hooks/useAuth';
// import Alert from './Alert';
//
// const SubjectsList = () => {
//     const { user } = useAuth();
//     const [subjects, setSubjects] = useState([]);
//     const [alert, setAlert] = useState({ type: '', message: '' });
//     const [loading, setLoading] = useState(false);
//
//     useEffect(() => {
//         fetchSubjects();
//     }, []);
//
//     const fetchSubjects = async () => {
//         try {
//             setLoading(true);
//             const response = await api.get('/subjects');
//             console.log(response.data)
//             setSubjects(response.data.data);
//             console.log(subjects)
//         } catch (error) {
//             console.error('Грешка при зареждане на дисциплини:', error);
//             setAlert({ type: 'error', message: 'Грешка при зареждане на дисциплини' });
//         } finally {
//             setLoading(false);
//         }
//     };
//
//     const handleDelete = async (id) => {
//         if (!window.confirm('Сигурни ли сте, че искате да изтриете тази дисциплина?')) {
//             return;
//         }
//
//         try {
//             await api.delete(`/subjects/${id}`);
//             setAlert({ type: 'success', message: 'Дисциплината е изтрита успешно!' });
//             fetchSubjects(); // Презареждане на списъка
//         } catch (error) {
//             console.error('Грешка при изтриване на дисциплина:', error);
//             setAlert({ type: 'error', message: 'Грешка при изтриване на дисциплина' });
//         }
//     };
//
//     return (
//         <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">
//             {/* Header и Sidebar компоненти тук */}
//
//             <div className="page-layout">
//                 <div id="mainContent" className="ml-0 lg:ml-0 p-4 lg:p-8 transition-all duration-300">
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Управление на дисциплини</h1>
//                                 <p className="text-sm text-gray-500 mt-1">Добавяне, редактиране и премахване на дисциплини</p>
//                             </div>
//                             <a href="subjects/create" className="inline-flex items-center gap-1 px-4 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-700 transition-colors">
//                                 <i className="fas fa-plus"></i>
//                                 Добави дисциплина
//                             </a>
//                         </div>
//                     </div>
//
//                     {alert.message && (
//                         <Alert type={alert.type} message={alert.message} onClose={() => setAlert({ type: '', message: '' })} />
//                     )}
//
//                     <div className="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
//                         {loading ? (
//                             <div className="flex justify-center items-center py-8">
//                                 <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600"></div>
//                             </div>
//                         ) : (
//                             <div className="overflow-x-auto">
//                                 <table className="min-w-full divide-y divide-gray-200">
//                                     <thead className="bg-gray-50">
//                                     <tr>
//                                         <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                             Име на дисциплина
//                                         </th>
//                                         <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                             Семестър
//                                         </th>
//                                         <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                             Цена
//                                         </th>
//                                         <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                             Действия
//                                         </th>
//                                     </tr>
//                                     </thead>
//                                     <tbody className="bg-white divide-y divide-gray-200">
//                                     {subjects.map((subject) => (
//                                         <tr key={subject.id}>
//                                             <td className="px-6 py-4 whitespace-nowrap">
//                                                 <div className="text-sm font-medium text-gray-900">{subject.subject_name}</div>
//                                                 <div className="text-sm text-gray-500">
//                                                     {subject.description && subject.description.length > 50
//                                                         ? `${subject.description.substring(0, 50)}...`
//                                                         : subject.description}
//                                                 </div>
//                                             </td>
//                                             <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
//                                                 {subject.semester}
//                                             </td>
//                                             <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
//                                                 {parseFloat(subject.price).toFixed(2)} лв.
//                                             </td>
//                                             <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
//                                                 <a
//                                                     href={`/admin/subjects/${subject.id}/edit`}
//                                                     className="text-indigo-600 hover:text-indigo-900 mr-3"
//                                                 >
//                                                     <i className="fas fa-edit"></i> Редактирай
//                                                 </a>
//                                                 <button
//                                                     onClick={() => handleDelete(subject.id)}
//                                                     className="text-red-600 hover:text-red-900"
//                                                 >
//                                                     <i className="fas fa-trash"></i> Изтрий
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
//             </div>
//         </div>
//     );
// };
//
// export default SubjectsList;
// import React, { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
// import { api } from '../hooks/useAuth';
// import Alert from './Alert';
//
// const SubjectsList = () => {
//     const { user } = useAuth();
//     const [subjects, setSubjects] = useState([]);
//     const [alert, setAlert] = useState({ type: '', message: '' });
//     const [loading, setLoading] = useState(false);
//
//     useEffect(() => {
//         fetchSubjects();
//     }, []);
//
//     const fetchSubjects = async () => {
//         try {
//             setLoading(true);
//             const response = await api.get('/subjects');
//             console.log(response.data)
//             setSubjects(response.data.data);
//             console.log(subjects)
//         } catch (error) {
//             console.error('Грешка при зареждане на дисциплини:', error);
//             setAlert({ type: 'error', message: 'Грешка при зареждане на дисциплини' });
//         } finally {
//             setLoading(false);
//         }
//     };
//
//     const handleDelete = async (id) => {
//         if (!window.confirm('Сигурни ли сте, че искате да изтриете тази дисциплина?')) {
//             return;
//         }
//
//         try {
//             await api.delete(`/subjects/${id}`);
//             setAlert({ type: 'success', message: 'Дисциплината е изтрита успешно!' });
//             fetchSubjects(); // Презареждане на списъка
//         } catch (error) {
//             console.error('Грешка при изтриване на дисциплина:', error);
//             setAlert({ type: 'error', message: 'Грешка при изтриване на дисциплина' });
//         }
//     };
//
//     return (
//         <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 p-4 lg:p-8">
//             <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                 <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                     <div>
//                         <h1 className="text-2xl font-bold text-gray-800">Управление на дисциплини</h1>
//                         <p className="text-sm text-gray-500 mt-1">Добавяне, редактиране и премахване на дисциплини</p>
//                     </div>
//                     <a href="subjects/create" className="inline-flex items-center gap-1 px-4 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-700 transition-colors">
//                         <i className="fas fa-plus"></i>
//                         Добави дисциплина
//                     </a>
//                 </div>
//             </div>
//
//             {alert.message && (
//                 <Alert type={alert.type} message={alert.message} onClose={() => setAlert({ type: '', message: '' })} />
//             )}
//
//             <div className="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
//                 {loading ? (
//                     <div className="flex justify-center items-center py-8">
//                         <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600"></div>
//                     </div>
//                 ) : (
//                     <div className="overflow-x-auto">
//                         <table className="min-w-full divide-y divide-gray-200">
//                             <thead className="bg-gray-50">
//                             <tr>
//                                 <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                     Име на дисциплина
//                                 </th>
//                                 <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                     Семестър
//                                 </th>
//                                 <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                     Цена
//                                 </th>
//                                 <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                     Действия
//                                 </th>
//                             </tr>
//                             </thead>
//                             <tbody className="bg-white divide-y divide-gray-200">
//                             {subjects.map((subject) => (
//                                 <tr key={subject.id}>
//                                     <td className="px-6 py-4 whitespace-nowrap">
//                                         <div className="text-sm font-medium text-gray-900">{subject.subject_name}</div>
//                                         <div className="text-sm text-gray-500">
//                                             {subject.description && subject.description.length > 50
//                                                 ? `${subject.description.substring(0, 50)}...`
//                                                 : subject.description}
//                                         </div>
//                                     </td>
//                                     <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
//                                         {subject.semester}
//                                     </td>
//                                     <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
//                                         {parseFloat(subject.price).toFixed(2)} лв.
//                                     </td>
//                                     <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
//                                         <a
//                                             href={`/subjects/${subject.id}/edit`}
//                                             className="text-indigo-600 hover:text-indigo-900 mr-3"
//                                         >
//                                             <i className="fas fa-edit"></i> Редактирай
//                                         </a>
//                                         <button
//                                             onClick={() => handleDelete(subject.id)}
//                                             className="text-red-600 hover:text-red-900"
//                                         >
//                                             <i className="fas fa-trash"></i> Изтрий
//                                         </button>
//                                     </td>
//                                 </tr>
//                             ))}
//                             </tbody>
//                         </table>
//                     </div>
//                 )}
//             </div>
//         </div>
//     );
// };
//
// export default SubjectsList;
// import React, { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
// import { api } from '../hooks/useAuth';
// import Alert from './Alert';
// import { Link } from 'react-router-dom';
//
// const SubjectsList = () => {
//     const { user } = useAuth();
//     const [subjects, setSubjects] = useState([]);
//     const [alert, setAlert] = useState({ type: '', message: '' });
//     const [loading, setLoading] = useState(false);
//
//     useEffect(() => {
//         fetchSubjects();
//     }, []);
//
//     const fetchSubjects = async () => {
//         try {
//             setLoading(true);
//             const response = await api.get('/subjects');
//             console.log(response.data)
//             setSubjects(response.data.data);
//             console.log(subjects)
//         } catch (error) {
//             console.error('Грешка при зареждане на дисциплини:', error);
//             setAlert({ type: 'error', message: 'Грешка при зареждане на дисциплини' });
//         } finally {
//             setLoading(false);
//         }
//     };
//
//     const handleDelete = async (id) => {
//         if (!window.confirm('Сигурни ли сте, че искате да изтриете тази дисциплина?')) {
//             return;
//         }
//
//         try {
//             await api.delete(`/subjects/${id}`);
//             setAlert({ type: 'success', message: 'Дисциплината е изтрита успешно!' });
//             fetchSubjects(); // Презареждане на списъка
//         } catch (error) {
//             console.error('Грешка при изтриване на дисциплина:', error);
//             setAlert({ type: 'error', message: 'Грешка при изтриване на дисциплина' });
//         }
//     };
//
//     return (
//         <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 p-4 lg:p-8">
//             {/* Header - тук може да включите вашия Header компонент */}
//
//             <div className="flex">
//                 {/* Sidebar - тук може да включите вашия Sidebar компонент */}
//
//                 <div className="flex-1 ml-0 lg:ml-64"> {/* Ако Sidebar-ът е с фиксирана ширина, коригирайте ml стойността */}
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Управление на дисциплини</h1>
//                                 <p className="text-sm text-gray-500 mt-1">Добавяне, редактиране и премахване на дисциплини</p>
//                             </div>
//                             <Link
//                                 to="/subjects/create"
//                                 className="inline-flex items-center gap-1 px-4 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-700 transition-colors"
//                             >
//                                 <i className="fas fa-plus"></i>
//                                 Добави дисциплина
//                             </Link>
//                         </div>
//                     </div>
//
//                     {alert.message && (
//                         <Alert type={alert.type} message={alert.message} onClose={() => setAlert({ type: '', message: '' })} />
//                     )}
//
//                     <div className="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
//                         {loading ? (
//                             <div className="flex justify-center items-center py-8">
//                                 <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600"></div>
//                             </div>
//                         ) : (
//                             <div className="overflow-x-auto">
//                                 <table className="min-w-full divide-y divide-gray-200">
//                                     <thead className="bg-gray-50">
//                                     <tr>
//                                         <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                             Име на дисциплина
//                                         </th>
//                                         <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                             Семестър
//                                         </th>
//                                         <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                             Цена
//                                         </th>
//                                         <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
//                                             Действия
//                                         </th>
//                                     </tr>
//                                     </thead>
//                                     <tbody className="bg-white divide-y divide-gray-200">
//                                     {subjects.map((subject) => (
//                                         <tr key={subject.id}>
//                                             <td className="px-6 py-4 whitespace-nowrap">
//                                                 <div className="text-sm font-medium text-gray-900">{subject.subject_name}</div>
//                                                 <div className="text-sm text-gray-500">
//                                                     {subject.description && subject.description.length > 50
//                                                         ? `${subject.description.substring(0, 50)}...`
//                                                         : subject.description}
//                                                 </div>
//                                             </td>
//                                             <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
//                                                 {subject.semester}
//                                             </td>
//                                             <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
//                                                 {parseFloat(subject.price).toFixed(2)} лв.
//                                             </td>
//                                             <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
//                                                 <Link
//                                                     to={`/subjects/${subject.id}/edit`}
//                                                     className="text-indigo-600 hover:text-indigo-900 mr-3"
//                                                 >
//                                                     <i className="fas fa-edit"></i> Редактирай
//                                                 </Link>
//                                                 <button
//                                                     onClick={() => handleDelete(subject.id)}
//                                                     className="text-red-600 hover:text-red-900"
//                                                 >
//                                                     <i className="fas fa-trash"></i> Изтрий
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
//             </div>
//         </div>
//     );
// };
//
// export default SubjectsList;
import React, { useState, useEffect } from 'react';
import { useAuth } from '../hooks/useAuth';
import { api } from '../hooks/useAuth';
import Alert from './Alert';
import { Link } from 'react-router-dom';
import Header from './Header';
import Sidebar from './Sidebar';

const SubjectsList = () => {
    const { user } = useAuth();
    const [subjects, setSubjects] = useState([]);
    const [alert, setAlert] = useState({ type: '', message: '' });
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        fetchSubjects();
    }, []);

    const fetchSubjects = async () => {
        try {
            setLoading(true);
            const response = await api.get('/subjects');
            setSubjects(response.data.data);
        } catch (error) {
            console.error('Грешка при зареждане на дисциплини:', error);
            setAlert({ type: 'error', message: 'Грешка при зареждане на дисциплини' });
        } finally {
            setLoading(false);
        }
    };

    const handleDelete = async (id) => {
        if (!window.confirm('Сигурни ли сте, че искате да изтриете тази дисциплина?')) {
            return;
        }

        try {
            await api.delete(`/subjects/${id}`);
            setAlert({ type: 'success', message: 'Дисциплината е изтрита успешно!' });
            fetchSubjects();
        } catch (error) {
            console.error('Грешка при изтриване на дисциплина:', error);
            setAlert({ type: 'error', message: 'Грешка при изтриване на дисциплина' });
        }
    };

    return (
        <div className="min-h-screen bg-gray-50">
            <Header />
            <div className="flex pt-0">
                <Sidebar user={user} />
                <div className="flex-1 p-4 lg:p-8 ml-0 lg:ml-0">
                    <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
                        <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                            <div>
                                <h1 className="text-2xl font-bold text-gray-800">Управление на дисциплини</h1>
                                <p className="text-sm text-gray-500 mt-1">Добавяне, редактиране и премахване на дисциплини</p>
                            </div>
                            <Link
                                to="/subjects/create"
                                className="inline-flex items-center gap-1 px-4 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-700 transition-colors"
                            >
                                <i className="fas fa-plus"></i>
                                Добави дисциплина
                            </Link>
                        </div>
                    </div>

                    {alert.message && (
                        <Alert type={alert.type} message={alert.message} onClose={() => setAlert({ type: '', message: '' })} />
                    )}

                    <div className="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
                        {loading ? (
                            <div className="flex justify-center items-center py-8">
                                <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600"></div>
                            </div>
                        ) : (
                            <div className="overflow-x-auto">
                                <table className="min-w-full divide-y divide-gray-200">
                                    <thead className="bg-gray-50">
                                    <tr>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Име на дисциплина
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Семестър
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Цена
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Действия
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody className="bg-white divide-y divide-gray-200">
                                    {subjects.map((subject) => (
                                        <tr key={subject.id}>
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <div className="text-sm font-medium text-gray-900">{subject.subject_name}</div>
                                                <div className="text-sm text-gray-500">
                                                    {subject.description && subject.description.length > 50
                                                        ? `${subject.description.substring(0, 50)}...`
                                                        : subject.description}
                                                </div>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {subject.semester}
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {parseFloat(subject.price).toFixed(2)} лв.
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <Link
                                                    to={`/subjects/${subject.id}/edit`}
                                                    className="text-indigo-600 hover:text-indigo-900 mr-3"
                                                >
                                                    <i className="fas fa-edit"></i> Редактирай
                                                </Link>
                                                <button
                                                    onClick={() => handleDelete(subject.id)}
                                                    className="text-red-600 hover:text-red-900"
                                                >
                                                    <i className="fas fa-trash"></i> Изтрий
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
    );
};

export default SubjectsList;
