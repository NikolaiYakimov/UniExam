//
//
// import React, { useState, useEffect } from 'react';
// import { api } from '../hooks/useAuth';
// import { useAuth } from '../hooks/useAuth';
// import Header from './Header';
// import Sidebar from './Sidebar';
// import Alert from './Alert';
// import { Link } from 'react-router-dom';
//
// const UserManagement = () => {
//     const [users, setUsers] = useState([]);
//     const [loading, setLoading] = useState(true);
//     const [alert, setAlert] = useState({ type: '', message: '' });
//     const { user: currentUser } = useAuth();
//
//     useEffect(() => {
//         if (currentUser?.role === 'administrator') {
//             fetchUsers();
//         }
//     }, [currentUser]);
//
//     const fetchUsers = async () => {
//         try {
//             const response = await api.get('/users');
//             setUsers(response.data.data);
//             setLoading(false);
//         } catch (error) {
//             console.error('Failed to fetch users', error);
//             setAlert({ type: 'error', message: 'Неуспешно зареждане на потребителите' });
//             setLoading(false);
//         }
//     };
//
//     const handleDelete = async (userId) => {
//         if (!window.confirm('Сигурни ли сте, че искате да изтриете този потребител?')) {
//             return;
//         }
//
//         try {
//             await api.delete(`/users/${userId}`);
//             setUsers(users.filter(user => user.id !== userId));
//             setAlert({ type: 'success', message: 'Потребителят е изтрит успешно!' });
//         } catch (error) {
//             console.error('Failed to delete user', error);
//             setAlert({ type: 'error', message: 'Неуспешно изтриване на потребителя' });
//         }
//     };
//
//     if (!currentUser || currentUser.role !== 'administrator') {
//         return (
//             <div className="min-h-screen bg-gray-50 flex items-center justify-center">
//                 <div className="text-center">
//                     <h1 className="text-2xl font-bold text-red-600">Достъп отказан</h1>
//                     <p className="mt-2">Нямате необходимите права за достъп до тази страница.</p>
//                 </div>
//             </div>
//         );
//     }
//
//     return (
//         <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50">
//             <Header />
//             <div className="flex pt-0">
//                 <Sidebar user={currentUser} />
//                 <div className="flex-1 p-4 lg:p-8 ml-0 lg:ml-0">
//                     {/* Page Header */}
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Управление на потребители</h1>
//                                 <p className="text-sm text-gray-500 mt-1">Добавяне, редактиране и премахване на потребители</p>
//                             </div>
//                             <Link
//                                 to="/users/create"
//                                 className="inline-flex items-center gap-1 px-4 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-700 transition-colors"
//                             >
//                                 <i className="fas fa-plus"></i>
//                                 Добави потребител
//                             </Link>
//                         </div>
//                     </div>
//
//                     {alert.message && (
//                         <Alert type={alert.type} message={alert.message} onClose={() => setAlert({ type: '', message: '' })} />
//                     )}
//
//                     {/* Users Table */}
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
//                                         <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Име</th>
//                                         <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Имейл</th>
//                                         <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Телефон</th>
//                                         <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Роля</th>
//                                         <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Действия</th>
//                                     </tr>
//                                     </thead>
//                                     <tbody className="bg-white divide-y divide-gray-200">
//                                     {users.map((user) => (
//                                         <tr key={user.id}>
//                                             <td className="px-6 py-4 whitespace-nowrap">
//                                                 <div className="text-sm font-medium text-gray-900">{user.first_name} {user.last_name}</div>
//                                                 <div className="text-sm text-gray-500">{user.username}</div>
//                                             </td>
//                                             <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
//                                                 {user.email}
//                                             </td>
//                                             <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
//                                                 {user.phone || '-'}
//                                             </td>
//                                             <td>
//                                             {/*<td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">*/}
//                                                 <span className="badge bg-secondary">{user.role}</span>
//                                             </td>
//                                             {/*<td className="px-6 py-4 whitespace-nowrap text-sm font-medium">*/}
//                                             {/*    <Link*/}
//                                             {/*        to={`/admin/users/edit/${user.id}`}*/}
//                                             {/*        className="text-indigo-600 hover:text-indigo-900 mr-3"*/}
//                                             {/*    >*/}
//                                             {/*        <i className="fas fa-edit"></i> Редактирай*/}
//                                             {/*    </Link>*/}
//                                             {/*    <button*/}
//                                             {/*        onClick={() => handleDelete(user.id)}*/}
//                                             {/*        className="text-red-600 hover:text-red-900"*/}
//                                             {/*    >*/}
//                                             {/*        <i className="fas fa-trash"></i> Изтрий*/}
//                                             {/*    </button>*/}
//                                             {/*</td>*/}
//                                             <td>
//                                                                   <div className="d-flex gap-2">
//                                                                      <a
//                                                                      href={`/users/${user.id}/edit`}
//                                                                      className="btn btn-sm btn-outline-primary"
//                                                                  >
//                                                                      <i className="fas fa-edit me-1"></i>
//                                                                      Редактирай
//                                                                  </a>
//                                                                  <button
//                                                                      className="btn btn-sm btn-outline-danger"
//                                                                      onClick={() => handleDelete(user.id)}
//                                                                  >
//                                                                      <i className="fas fa-trash me-1"></i>
//                                                                      Изтрий
//                                                                  </button>
//                                                              </div>
//                                                          </td>
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
// export default UserManagement;
import React, { useState, useEffect } from 'react';
import { api } from '../hooks/useAuth';
import { useAuth } from '../hooks/useAuth';
import Header from './Header';
import Sidebar from './Sidebar';
import Alert from './Alert';
import { Link, useLocation, useNavigate } from 'react-router-dom';

const UserManagement = () => {
    const [users, setUsers] = useState([]);
    const [loading, setLoading] = useState(true);
    const [alert, setAlert] = useState({ type: '', message: '' });
    const { user: currentUser } = useAuth();
    const location = useLocation();
    const navigate = useNavigate();

    useEffect(() => {
        if (currentUser?.role === 'administrator') {
            fetchUsers();

            // Проверка за съобщение от навигация
            if (location.state?.message) {
                setAlert({ type: 'success', message: location.state.message });
                // Премахване на състоянието, за да не се показва повторно
                window.history.replaceState({}, document.title);
            }
        }
    }, [currentUser, location.state]);

    const fetchUsers = async () => {
        try {
            const response = await api.get('/users');
            setUsers(response.data.data);
            setLoading(false);
        } catch (error) {
            console.error('Failed to fetch users', error);
            setAlert({ type: 'error', message: 'Неуспешно зареждане на потребителите' });
            setLoading(false);
        }
    };

    const handleDelete = async (userId) => {
        if (!window.confirm('Сигурни ли сте, че искате да изтриете този потребител?')) {
            return;
        }

        try {
            await api.delete(`/users/${userId}`);
            setUsers(users.filter(user => user.id !== userId));
            setAlert({ type: 'success', message: 'Потребителят е изтрит успешно!' });
        } catch (error) {
            console.error('Failed to delete user', error);
            setAlert({ type: 'error', message: 'Неуспешно изтриване на потребителя' });
        }
    };

    if (!currentUser || currentUser.role !== 'administrator') {
        return (
            <div className="min-h-screen bg-gray-50 flex items-center justify-center">
                <div className="text-center">
                    <h1 className="text-2xl font-bold text-red-600">Достъп отказан</h1>
                    <p className="mt-2">Нямате необходимите права за достъп до тази страница.</p>
                </div>
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50">
            <Header />
            <div className="flex pt-0">
                <Sidebar user={currentUser} />
                <div className="flex-1 p-4 lg:p-8 ml-0 lg:ml-0">
                    {/* Page Header */}
                    <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
                        <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                            <div>
                                <h1 className="text-2xl font-bold text-gray-800">Управление на потребители</h1>
                                <p className="text-sm text-gray-500 mt-1">Добавяне, редактиране и премахване на потребители</p>
                            </div>
                            <Link
                                to="/users/create"
                                className="inline-flex items-center gap-1 px-4 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-700 transition-colors"
                            >
                                <i className="fas fa-plus"></i>
                                Добави потребител
                            </Link>
                        </div>
                    </div>

                    {alert.message && (
                        <Alert type={alert.type} message={alert.message} onClose={() => setAlert({ type: '', message: '' })} />
                    )}

                    {/* Users Table */}
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
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Име</th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Имейл</th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Телефон</th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Роля</th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody className="bg-white divide-y divide-gray-200">
                                    {users.map((user) => (
                                        <tr key={user.id}>
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <div className="text-sm font-medium text-gray-900">{user.first_name} {user.last_name}</div>
                                                <div className="text-sm text-gray-500">{user.username}</div>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {user.email}
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {user.phone || '-'}
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {user.role}
                                                </span>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div className="flex gap-2">
                                                    <Link
                                                        to={`/users/${user.id}/edit`}
                                                        className="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                    >
                                                        <i className="fas fa-edit mr-1"></i>
                                                        Редактирай
                                                    </Link>
                                                    <button
                                                        onClick={() => handleDelete(user.id)}
                                                        className="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                                    >
                                                        <i className="fas fa-trash mr-1"></i>
                                                        Изтрий
                                                    </button>
                                                </div>
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

export default UserManagement;
