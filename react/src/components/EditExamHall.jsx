//
import React, { useState, useEffect } from 'react';
import { useAuth } from '../hooks/useAuth';
import { api } from '../hooks/useAuth';
import { useParams, useNavigate, Link } from 'react-router-dom';
import Alert from './Alert';
import Header from './partials/Header.jsx';
import Sidebar from './Sidebar';

const EditExamHall = () => {
    const { user } = useAuth();
    const { id } = useParams();
    const navigate = useNavigate();
    const [formData, setFormData] = useState({
        name: '',
        capacity: '',
        opening_time: '08:00',
        closing_time: '18:00'
    });
    const [alert, setAlert] = useState({ type: '', message: '' });
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        fetchExamHall();
    }, [id]);

    const fetchExamHall = async () => {
        try {
            const response = await api.get(`/exam-halls/${id}/edit`);
            const hall = response.data.data;
            setFormData({
                name: hall.name,
                capacity: hall.capacity,
                opening_time: hall.opening_time.substring(0, 5),
                closing_time: hall.closing_time.substring(0, 5)
            });
        } catch (error) {
            console.error('Грешка при зареждане на зала:', error);
            setAlert({ type: 'error', message: 'Грешка при зареждане на зала' });
        }
    };

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({ ...formData, [name]: value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);

        try {
            await api.put(`/exam-halls/${id}`, formData);
            // Навигиране към списъка със съобщение за успех
            navigate('/exam-halls', {
                state: { message: 'Залата е актуализирана успешно!' },
                replace: true
            });
        } catch (error) {
            console.error('Грешка при актуализация на зала:', error);
            if (error.response?.data?.message) {
                setAlert({ type: 'error', message: error.response.data.message });
            } else {
                setAlert({ type: 'error', message: 'Грешка при актуализация на зала' });
            }
        } finally {
            setLoading(false);
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
                                <h1 className="text-2xl font-bold text-gray-800">Редактиране на изпитна зала</h1>
                                <p className="text-sm text-gray-500 mt-1">Променете информацията за залата</p>
                            </div>
                            <Link
                                to="/exam-halls"
                                className="inline-flex items-center gap-1 px-4 py-3 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-700 transition-colors"
                            >
                                <i className="fas fa-arrow-left"></i>
                                Назад към списъка
                            </Link>
                        </div>
                    </div>

                    {alert.message && (
                        <Alert type={alert.type} message={alert.message} onClose={() => setAlert({ type: '', message: '' })} />
                    )}

                    <div className="bg-white border border-gray-100 rounded-xl p-6 shadow-sm max-w-3xl">
                        <form onSubmit={handleSubmit}>
                            <div className="space-y-6">
                                <div>
                                    <label htmlFor="name" className="block text-sm font-medium text-gray-700 mb-1">
                                        Име на зала *
                                    </label>
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        required
                                        value={formData.name}
                                        onChange={handleChange}
                                        className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border"
                                    />
                                </div>

                                <div>
                                    <label htmlFor="capacity" className="block text-sm font-medium text-gray-700 mb-1">
                                        Капацитет (брой места) *
                                    </label>
                                    <input
                                        type="number"
                                        min="1"
                                        name="capacity"
                                        id="capacity"
                                        required
                                        value={formData.capacity}
                                        onChange={handleChange}
                                        className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border"
                                    />
                                </div>

                                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label htmlFor="opening_time" className="block text-sm font-medium text-gray-700 mb-1">
                                            Начален час *
                                        </label>
                                        <input
                                            type="time"
                                            name="opening_time"
                                            id="opening_time"
                                            required
                                            value={formData.opening_time}
                                            onChange={handleChange}
                                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border"
                                        />
                                    </div>

                                    <div>
                                        <label htmlFor="closing_time" className="block text-sm font-medium text-gray-700 mb-1">
                                            Краен час *
                                        </label>
                                        <input
                                            type="time"
                                            name="closing_time"
                                            id="closing_time"
                                            required
                                            value={formData.closing_time}
                                            onChange={handleChange}
                                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border"
                                        />
                                    </div>
                                </div>

                                <div className="flex justify-end space-x-3 pt-4">
                                    <Link
                                        to="/exam-halls"
                                        className="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50"
                                    >
                                        Отказ
                                    </Link>
                                    <button
                                        type="submit"
                                        disabled={loading}
                                        className="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 disabled:opacity-50"
                                    >
                                        {loading ? 'Зареждане...' : 'Запази промените'}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default EditExamHall;
