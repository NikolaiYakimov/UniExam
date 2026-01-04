import React, { useState, useEffect } from 'react';
import { useParams, useNavigate, useLocation } from 'react-router-dom';
import { useAuth, api } from '../hooks/useAuth';
import Header from './partials/Header.jsx';
import Sidebar from './Sidebar';
import Alert from './Alert';

const TeacherExamDetails = () => {
    const { id } = useParams();
    const navigate = useNavigate();
    const location = useLocation();
    const { user } = useAuth();
    const [exam, setExam] = useState(null);
    const [grades, setGrades] = useState({});
    const [loading, setLoading] = useState(true);
    const [saving, setSaving] = useState(false);
    const [alert, setAlert] = useState({ type: '', message: '' });

    useEffect(() => {
        fetchExamDetails();

        if (location.state?.message) {
            setAlert({ type: 'success', message: location.state.message });
            window.history.replaceState({}, document.title);
        }
    }, [id, location.state]);

    const fetchExamDetails = async () => {
        try {
            setLoading(true);
            const response = await api.get(`/exam/${id}`);

            if (response.data.success) {
                setExam(response.data.data.exam);

                // Инициализиране на оценките
                const initialGrades = {};
                response.data.data.exam.registrations.forEach(reg => {
                    initialGrades[reg.id] = reg.grade || '';
                });
                setGrades(initialGrades);
            } else {
                setAlert({ type: 'error', message: response.data.message || 'Грешка при зареждане на детайлите за изпита' });
            }
        } catch (error) {
            console.error('Грешка при зареждане на детайлите за изпита:', error);
            setAlert({ type: 'error', message: 'Грешка при зареждане на детайлите за изпита' });
        } finally {
            setLoading(false);
        }
    };

    const handleGradeChange = (registrationId, value) => {
        setGrades(prev => ({
            ...prev,
            [registrationId]: value
        }));
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setSaving(true);
        setAlert({ type: '', message: '' });

        try {
            const response = await api.post(`/exam/${id}/grades`, { grades });

            if (response.data.success) {
                setAlert({ type: 'success', message: 'Оценките бяха актуализирани успешно!' });
            } else {
                setAlert({ type: 'error', message: response.data.message || 'Грешка при запазване на оценките' });
            }
        } catch (error) {
            console.error('Грешка при запазване на оценките:', error);
            setAlert({ type: 'error', message: 'Грешка при запазване на оценките' });
        } finally {
            setSaving(false);
        }
    };

    const handleBack = () => {
        navigate('/conducted-exams');
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

    if (!exam) {
        return (
            <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50">
                <Header />
                <div className="flex pt-0">
                    <Sidebar user={user} />
                    <div className="flex-1 p-4 lg:p-8 ml-0 lg:ml-0 flex justify-center items-center">
                        <div className="text-center">
                            <i className="fas fa-exclamation-triangle text-4xl text-red-600 mb-4"></i>
                            <p className="text-gray-600">Изпитът не е намерен</p>
                            <button
                                onClick={handleBack}
                                className="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
                            >
                                Обратно към изпитите
                            </button>
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
                                <h1 className="text-2xl font-bold text-gray-800">Детайли за изпит</h1>
                                <p className="text-sm text-gray-500 mt-1">Въвеждане на оценки за студенти</p>
                            </div>
                            <button
                                onClick={handleBack}
                                className="inline-flex items-center gap-1 px-4 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors"
                            >
                                <i className="fa-solid fa-arrow-left"></i>
                                Обратно към изминали изпити
                            </button>
                        </div>
                    </div>

                    {alert.message && (
                        <Alert type={alert.type} message={alert.message} onClose={() => setAlert({ type: '', message: '' })} />
                    )}

                    <div className="bg-white rounded-xl shadow-sm p-6 mb-6">
                        <h2 className="text-xl font-bold text-gray-900 mb-2">
                            {exam.subject?.subject_name || 'Няма име на предмет'} - {exam.exam_type}
                        </h2>
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600">
                            <div>
                                <p>
                                    <i className="fas fa-calendar-alt mr-2 text-gray-400"></i>
                                    Дата: <span className="font-medium">
                                        {new Date(exam.start_time).toLocaleDateString('bg-BG')}
                                    </span>
                                </p>
                                <p>
                                    <i className="fas fa-clock mr-2 text-gray-400"></i>
                                    Час: <span className="font-medium">
                                        {new Date(exam.start_time).toLocaleTimeString('bg-BG', {hour: '2-digit', minute:'2-digit'})} -
                                    {new Date(exam.end_time).toLocaleTimeString('bg-BG', {hour: '2-digit', minute:'2-digit'})}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <p>
                                    <i className="fas fa-university mr-2 text-gray-400"></i>
                                    Зала: <span className="font-medium">{exam.hall?.name || 'Няма зала'}</span>
                                </p>
                                <p>
                                    <i className="fas fa-users mr-2 text-gray-400"></i>
                                    Записани студенти: <span className="font-medium">{exam.registrations?.length || 0}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white rounded-xl shadow-sm p-6">
                        <h3 className="text-lg font-semibold text-gray-900 mb-4">Списък със студенти</h3>

                        <form onSubmit={handleSubmit}>
                            <div className="overflow-x-auto">
                                <table className="min-w-full divide-y divide-gray-200">
                                    <thead className="bg-gray-50">
                                    <tr>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">№</th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Факултетен №</th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Име</th>
                                        <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Оценка</th>
                                    </tr>
                                    </thead>
                                    <tbody className="bg-white divide-y divide-gray-200">
                                    {exam.registrations?.map((registration, index) => (
                                        <tr key={registration.id}>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{index + 1}</td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {registration.student?.faculty_number || 'Няма номер'}
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {registration.student?.user?.first_name || ''}{' '}
                                                {registration.student?.user?.second_name || ''}{' '}
                                                {registration.student?.user?.last_name || ''}
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <input
                                                    type="number"
                                                    value={grades[registration.id] || ''}
                                                    onChange={(e) => handleGradeChange(registration.id, e.target.value)}
                                                    min="2"
                                                    max="6"
                                                    step="0.1"
                                                    className="w-20 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                />
                                            </td>
                                        </tr>
                                    ))}
                                    </tbody>
                                </table>
                            </div>

                            <div className="mt-6 flex justify-end">
                                <button
                                    type="submit"
                                    disabled={saving}
                                    className="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors disabled:bg-gray-300 disabled:cursor-not-allowed"
                                >
                                    {saving ? 'Запазване...' : 'Запази оценките'}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default TeacherExamDetails;
