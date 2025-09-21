import React, { useState, useEffect } from 'react';
import { useAuth } from '../hooks/useAuth';
import { api } from '../hooks/useAuth';
import Alert from './Alert';
import { Link } from 'react-router-dom';
import Header from './Header';
import Sidebar from './Sidebar';

const ExamHallList = () => {
    const { user } = useAuth();
    const [examHalls, setExamHalls] = useState([]);
    const [alert, setAlert] = useState({ type: '', message: '' });
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        fetchExamHalls();
    }, []);

    const fetchExamHalls = async () => {
        try {
            setLoading(true);
            const response = await api.get('/exam-halls');
            setExamHalls(response.data.data);
        } catch (error) {
            console.error('Грешка при зареждане на зали:', error);
            setAlert({ type: 'error', message: 'Грешка при зареждане на зали' });
        } finally {
            setLoading(false);
        }
    };

    const handleDelete = async (id) => {
        if (!window.confirm('Сигурни ли сте, че искате да изтриете тази зала?')) {
            return;
        }

        try {
            await api.delete(`/exam-halls/${id}`);
            setAlert({ type: 'success', message: 'Залата е изтрита успешно!' });
            fetchExamHalls();
        } catch (error) {
            console.error('Грешка при изтриване на зала:', error);
            if (error.response?.data?.message) {
                setAlert({ type: 'error', message: error.response.data.message });
            } else {
                setAlert({ type: 'error', message: 'Грешка при изтриване на зала' });
            }
        }
    };

    const formatTime = (time) => {
        return time.substring(0, 5); // Format HH:mm
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
                                <h1 className="text-2xl font-bold text-gray-800">Управление на изпитни зали</h1>
                                <p className="text-sm text-gray-500 mt-1">Добавяне, редактиране и премахване на изпитни зали</p>
                            </div>
                            <Link
                                to="/exam-halls/create"
                                className="inline-flex items-center gap-1 px-4 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-700 transition-colors"
                            >
                                <i className="fas fa-plus"></i>
                                Добави зала
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
                                            Име на зала
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Капацитет
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Работно време
                                        </th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Действия
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody className="bg-white divide-y divide-gray-200">
                                    {examHalls.map((hall) => (
                                        <tr key={hall.id}>
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <div className="text-sm font-medium text-gray-900">{hall.name}</div>
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {hall.capacity} места
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {formatTime(hall.opening_time)} - {formatTime(hall.closing_time)}
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <Link
                                                    to={`/exam-halls/${hall.id}/edit`}
                                                    className="text-indigo-600 hover:text-indigo-900 mr-3"
                                                >
                                                    <i className="fas fa-edit"></i> Редактирай
                                                </Link>
                                                <button
                                                    onClick={() => handleDelete(hall.id)}
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

export default ExamHallList;
