import React, { useState, useEffect } from 'react';
import { useAuth } from '../hooks/useAuth';
import { api } from '../hooks/useAuth';
import Alert from './Alert';
import { Link, useLocation } from 'react-router-dom';
import Header from './Header';
import Sidebar from './Sidebar';

const SpecialtyList = () => {
    const { user } = useAuth();
    const [specialties, setSpecialties] = useState([]);
    const [faculties, setFaculties] = useState({});
    const [alert, setAlert] = useState({ type: '', message: '' });
    const [loading, setLoading] = useState(false);
    const location = useLocation();

    useEffect(() => {
        fetchSpecialties();
        fetchFaculties();

        if (location.state?.message) {
            setAlert({ type: 'success', message: location.state.message });
            window.history.replaceState({}, document.title);
        }
    }, [location.state]);

    const fetchSpecialties = async () => {
        try {
            setLoading(true);
            const response = await api.get('/specialties');
            console.log(response)
            setSpecialties(response.data.data);
        } catch (error) {
            console.error('Грешка при зареждане на специалности:', error);
            setAlert({ type: 'error', message: 'Грешка при зареждане на специалности' });
        } finally {
            setLoading(false);
        }
    };

    const fetchFaculties = async () => {
        try {
            const response = await api.get('/faculties');
            const facultiesMap = {};
            response.data.data.forEach(faculty => {
                facultiesMap[faculty.id] = faculty.name;
            });
            setFaculties(facultiesMap);
        } catch (error) {
            console.error('Грешка при зареждане на факултети:', error);
        }
    };

    const handleDelete = async (id) => {
        if (!window.confirm('Сигурни ли сте, че искате да изтриете тази специалност?')) {
            return;
        }

        try {
            await api.delete(`/specialties/${id}`);
            setAlert({ type: 'success', message: 'Специалността е изтрита успешно!' });
            fetchSpecialties();
        } catch (error) {
            console.error('Грешка при изтриване на специалност:', error);
            if (error.response?.data?.message) {
                setAlert({ type: 'error', message: error.response.data.message });
            } else {
                setAlert({ type: 'error', message: 'Грешка при изтриване на специалност' });
            }
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
                                <h1 className="text-2xl font-bold text-gray-800">Управление на специалности</h1>
                                <p className="text-sm text-gray-500 mt-1">Добавяне, редактиране и премахване на специалности</p>
                            </div>
                            <Link
                                to="/specialties/create"
                                className="inline-flex items-center gap-1 px-4 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-700 transition-colors"
                            >
                                <i className="fas fa-plus"></i>
                                Добави специалност
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
                                            Име на специалност
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Факултет
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Действия
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody className="bg-white divide-y divide-gray-200">
                                    {specialties.map((specialty) => (
                                        <tr key={specialty.id}>
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <div className="text-sm font-medium text-gray-900">{specialty.name}</div>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {faculties[specialty.faculty_id] || 'Неизвестен факултет'}
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <Link
                                                    to={`/specialties/${specialty.id}/edit`}
                                                    className="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-2"
                                                >
                                                    <i className="fas fa-edit mr-1"></i>
                                                    Редактирай
                                                </Link>
                                                <button
                                                    onClick={() => handleDelete(specialty.id)}
                                                    className="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                                >
                                                    <i className="fas fa-trash mr-1"></i>
                                                    Изтрий
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

export default SpecialtyList;
