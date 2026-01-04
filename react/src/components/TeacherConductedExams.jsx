
import React, { useState, useEffect } from 'react';
import { useAuth, api } from '../hooks/useAuth';
import { useLocation, Link, useNavigate } from 'react-router-dom';
import Header from './partials/Header.jsx';
import Sidebar from './Sidebar';
import Alert from './Alert';

const TeacherConductedExams = () => {
    const { user } = useAuth();
    const location = useLocation();
    const navigate = useNavigate();
    const [exams, setExams] = useState([]);
    const [loading, setLoading] = useState(true);
    const [alert, setAlert] = useState({ type: '', message: '' });

    useEffect(() => {
        fetchConductedExams();

        if (location.state?.message) {
            setAlert({ type: 'success', message: location.state.message });
            window.history.replaceState({}, document.title);
        }
    }, [location.state]);

    const fetchConductedExams = async () => {
        try {
            setLoading(true);
            const response = await api.get('/conducted-exams');

            if (response.data.success) {
                setExams(response.data.data.exams || []);
            } else {
                setAlert({ type: 'error', message: response.data.message || 'Грешка при зареждане на изпитите' });
            }
        } catch (error) {
            console.error('Грешка при зареждане на изпитите:', error);
            setAlert({ type: 'error', message: 'Грешка при зареждане на изпитите' });
        } finally {
            setLoading(false);
        }
    };

    const handleEnterGrades = (examId) => {
        navigate(`/teacher/exam/${examId}`);
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
                                <h1 className="text-2xl font-bold text-gray-800">Управление на изминалите изпити</h1>
                                <p className="text-sm text-gray-500 mt-1">Преглед на изминалите изпити и нанасяне на оценки</p>
                            </div>
                            <Link
                                to="/teacher-dashboard"
                                className="inline-flex items-center gap-1 px-4 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors"
                            >
                                <i className="fa-solid fa-calendar-days"></i>
                                Предстоящи изпити
                            </Link>
                        </div>
                    </div>

                    {alert.message && (
                        <Alert type={alert.type} message={alert.message} onClose={() => setAlert({ type: '', message: '' })} />
                    )}

                    {exams.length === 0 ? (
                        <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
                            <i className="fas fa-calendar-plus text-4xl text-gray-300 mb-4"></i>
                            <h3 className="text-lg font-medium text-gray-700 mb-2">Няма създадени изпити</h3>
                        </div>
                    ) : (
                        <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
                            {exams.map((exam) => (
                                <div
                                    key={exam.id}
                                    className="bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px] flex flex-col h-full"
                                >
                                    <div className="flex justify-between items-start gap-2 mb-3">
                                        <h2 className="text-lg font-semibold text-gray-900">
                                            {exam.subject?.subject_name || 'Няма име на предмет'}
                                            <span className="block text-sm font-normal text-gray-500 mt-1">
                                                {exam.subject?.description || ''}
                                            </span>
                                        </h2>
                                        <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            {exam.exam_type}
                                        </span>
                                    </div>

                                    <div className="space-y-3 mb-5 flex-grow">
                                        <div className="flex items-center gap-2 text-gray-600">
                                            <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
                                            <span>
                                                Дата:
                                                <span className="font-medium text-gray-800">
                                                    {new Date(exam.start_time).toLocaleDateString('bg-BG')}
                                                </span>
                                            </span>
                                        </div>
                                        <div className="flex items-center gap-2 text-gray-600">
                                            <i className="fas fa-clock w-5 text-gray-400"></i>
                                            <span>
                                                Час:
                                                <span className="font-medium text-gray-800">
                                                    {new Date(exam.start_time).toLocaleTimeString('bg-BG', {hour: '2-digit', minute:'2-digit'})} -
                                                    {new Date(exam.end_time).toLocaleTimeString('bg-BG', {hour: '2-digit', minute:'2-digit'})}
                                                </span>
                                            </span>
                                        </div>

                                        <div className="flex items-center gap-2 text-gray-600">
                                            <i className="fas fa-university w-5 text-gray-400"></i>
                                            <span>
                                                Зала: <span className="font-medium text-gray-800">{exam.hall?.name || 'Няма зала'}</span>
                                            </span>
                                        </div>
                                        <div className="flex items-center gap-2 text-gray-600">
                                            <i className="fas fa-users w-5 text-gray-400"></i>
                                            <span className={`font-medium ${exam.remaining_slots > 0 ? 'text-green-700' : 'text-red-700'}`}>
                                                {exam.remaining_slots}/{exam.max_students} места
                                            </span>
                                        </div>
                                    </div>

                                    <div className="flex items-center gap-2 text-gray-600">
                                        <button
                                            onClick={() => handleEnterGrades(exam.id)}
                                            className="mt-auto inline-block w-full px-4 py-2.5 text-center rounded-xl text-white font-medium transition-colors duration-200 bg-blue-600 hover:bg-blue-700"
                                        >
                                            <i className="fa-solid fa-file-pen"></i> Въведи оценки
                                        </button>
                                    </div>
                                </div>
                            ))}
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
};

export default TeacherConductedExams;
