
import { useState, useEffect } from 'react';
import { useAuth, api } from '../hooks/useAuth';
import { useLocation, Link, useNavigate } from 'react-router-dom';
import Header from './partials/Header.jsx';
import Sidebar from './Sidebar';
import Alert from './Alert';

const MyExams = () => {
    const { user } = useAuth();
    const location = useLocation();
    const navigate = useNavigate();
    const [exams, setExams] = useState([]);
    const [loading, setLoading] = useState(true);
    const [alert, setAlert] = useState({ type: '', message: '' });

    useEffect(() => {
        fetchMyExams();

        if (location.state?.message) {
            setAlert({ type: 'success', message: location.state.message });
            window.history.replaceState({}, document.title);
        }
    }, [location.state]);

    const fetchMyExams = async () => {
        try {
            setLoading(true);
            const response = await api.get('/my-exams');

            let examsData = [];
            if (Array.isArray(response.data)) {
                examsData = response.data;
            } else if (response.data.data && Array.isArray(response.data.data)) {
                examsData = response.data.data;
            } else if (response.data.exams && Array.isArray(response.data.exams)) {
                examsData = response.data.exams;
            } else {
                throw new Error('Неочакван формат на данните от сървъра');
            }

            setExams(examsData);
        } catch (error) {
            console.error('Failed to fetch exams', error);
            setAlert({
                type: 'error',
                message: error.response?.data?.message || 'Грешка при зареждане на изпитите'
            });
        } finally {
            setLoading(false);
        }
    };

    const handleUnregister = async (examId, examDate) => {
        const examDateTime = new Date(examDate);
        const now = new Date();
        const hoursDifference = (examDateTime - now) / (1000 * 60 * 60);

        if (hoursDifference < 48) {
            setAlert({
                type: 'error',
                message: 'Отписването от изпита е невъзможно по-малко от 48 часа преди изпита'
            });
            return;
        }

        if (!window.confirm('Сигурни ли сте, че искате да се отпишете от този изпит?')) {
            return;
        }

        try {
            await api.post(`/exams/${examId}/unregister`);
            setExams(exams.filter(exam => exam.id !== examId));
            setAlert({ type: 'success', message: 'Успешно се отписахте от изпита' });
        } catch (error) {
            console.error('Failed to unregister from exam', error);
            setAlert({
                type: 'error',
                message: error.response?.data?.message || 'Грешка при отписване от изпита'
            });
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
                                <h1 className="text-2xl font-bold text-gray-800">Предстоящи изпити</h1>
                                <p className="text-sm text-gray-500 mt-1">Преглед на записани изпити</p>
                            </div>
                            {/*<Link*/}
                            {/*    to="/available-exams"*/}
                            {/*    className="inline-flex items-center gap-1 px-4 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors"*/}
                            {/*>*/}
                            {/*    <i className="fa-solid fa-calendar-plus"></i>*/}
                            {/*    Достуни изпити*/}
                            {/*</Link>*/}
                        </div>
                    </div>

                    {alert.message && (
                        <Alert type={alert.type} message={alert.message} onClose={() => setAlert({ type: '', message: '' })} />
                    )}

                    {exams.length === 0 ? (
                        <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
                            <i className="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
                            <h3 className="text-lg font-medium text-gray-700 mb-2">Няма записани изпити</h3>
                            <p className="text-gray-500">Все още нямате записани изпити. Моля, изберете от списъка с достъпни изпити.</p>
                        </div>
                    ) : (
                        <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
                            {exams.map((exam) => {
                                const examDate = new Date(exam.start_time);
                                const isPast = examDate < new Date();
                                const hoursDifference = (examDate - new Date()) / (1000 * 60 * 60);
                                const isUnregisterDisabled = hoursDifference < 48;

                                return (
                                    <div
                                        key={exam.id}
                                        className="bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px] flex flex-col h-full"
                                    >
                                        <div className="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">
                                            <h2 className="text-lg font-semibold text-gray-900 leading-tight">
                                                {exam.subject?.subject_name}
                                            </h2>
                                            <div className="flex flex-wrap gap-2">
                                                <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                    {exam.exam_type}
                                                </span>
                                                <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${exam.remaining_slots > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`}>
                                                    {exam.remaining_slots} Свободни места
                                                </span>
                                            </div>
                                        </div>

                                        <div className="space-y-3 mb-5 flex-grow">
                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
                                                <span>Преподавател: <span className="font-medium text-gray-800">{exam.teacher?.user?.first_name} {exam.teacher?.user?.last_name}</span></span>
                                            </div>
                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
                                                <span>Дата: <span className="font-medium text-gray-800">
                                                    {examDate.toLocaleDateString('bg-BG')}
                                                </span></span>
                                            </div>
                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-clock w-5 text-gray-400"></i>
                                                <span>Продължителност: <span className="font-medium text-gray-800">
                                                    {examDate.toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} - {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
                                                </span></span>
                                            </div>
                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-university w-5 text-gray-400"></i>
                                                <span>Зала: <span className="font-medium text-gray-800">{exam.hall?.name}</span></span>
                                            </div>
                                        </div>

                                        {!isPast && (
                                            <button
                                                onClick={() => handleUnregister(exam.id, exam.start_time)}
                                                disabled={isUnregisterDisabled}
                                                className={`w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 mt-auto ${
                                                    isUnregisterDisabled
                                                        ? 'bg-gray-300 cursor-not-allowed'
                                                        : 'bg-red-600 hover:bg-red-700'
                                                }`}
                                            >
                                                <i className="fas fa-edit mr-2"></i> Отпиши се
                                            </button>
                                        )}
                                    </div>
                                );
                            })}
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
};

export default MyExams;
