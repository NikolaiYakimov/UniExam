import React, { useState, useEffect } from 'react';
import { useAuth } from '../hooks/useAuth';
import { api } from '../hooks/useAuth';
import { useParams, useNavigate, Link } from 'react-router-dom';
import Alert from './Alert';
import Header from './Header';
import Sidebar from './Sidebar';

const EditSpecialty = () => {
    const { user } = useAuth();
    const { id } = useParams();
    const navigate = useNavigate();
    const [formData, setFormData] = useState({
        name: '',
        faculty_id: ''
    });
    const [faculties, setFaculties] = useState([]);
    const [alert, setAlert] = useState({ type: '', message: '' });
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        fetchSpecialty();
        fetchFaculties();
    }, [id]);

    const fetchSpecialty = async () => {
        try {
            const response = await api.get(`/specialties/${id}/edit`);
            const specialty = response.data.data;
            setFormData({
                name: specialty.name,
                faculty_id: specialty.faculty_id
            });
        } catch (error) {
            console.error('Грешка при зареждане на специалност:', error);
            setAlert({ type: 'error', message: 'Грешка при зареждане на специалност' });
        }
    };

    const fetchFaculties = async () => {
        try {
            const response = await api.get('/faculties');
            setFaculties(response.data.data);
        } catch (error) {
            console.error('Грешка при зареждане на факултети:', error);
            setAlert({ type: 'error', message: 'Грешка при зареждане на факултети' });
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
            await api.put(`/specialties/${id}`, formData);
            navigate('/specialties', {
                state: { message: 'Специалността е актуализирана успешно!' },
                replace: true
            });
        } catch (error) {
            console.error('Грешка при актуализация на специалност:', error);
            if (error.response?.data?.message) {
                setAlert({ type: 'error', message: error.response.data.message });
            } else {
                setAlert({ type: 'error', message: 'Грешка при актуализация на специалност' });
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
                                <h1 className="text-2xl font-bold text-gray-800">Редактиране на специалност</h1>
                                <p className="text-sm text-gray-500 mt-1">Променете информацията за специалността</p>
                            </div>
                            <Link
                                to="/specialties"
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
                                        Име на специалност *
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
                                    <label htmlFor="faculty_id" className="block text-sm font-medium text-gray-700 mb-1">
                                        Факултет *
                                    </label>
                                    <select
                                        name="faculty_id"
                                        id="faculty_id"
                                        required
                                        value={formData.faculty_id}
                                        onChange={handleChange}
                                        className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border"
                                    >
                                        <option value="">Изберете факултет</option>
                                        {faculties.map((faculty) => (
                                            <option key={faculty.id} value={faculty.id}>
                                                {faculty.name}
                                            </option>
                                        ))}
                                    </select>
                                </div>

                                <div className="flex justify-end space-x-3 pt-4">
                                    <Link
                                        to="/specialties"
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

export default EditSpecialty;
