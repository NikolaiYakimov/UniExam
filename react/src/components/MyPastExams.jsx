
import { useState, useEffect } from 'react';
import { useAuth, api } from '../hooks/useAuth';
import { useLocation, Link } from 'react-router-dom';
import Header from './Header';
import Sidebar from './Sidebar';
import Alert from './Alert';

const MyPastExams = () => {
    const { user } = useAuth();
    const location = useLocation();
    const [exams, setExams] = useState([]);
    const [loading, setLoading] = useState(true);
    const [alert, setAlert] = useState({ type: '', message: '', show: false });

    useEffect(() => {
        fetchPastExams();

        if (location.state?.message) {
            setAlert({ type: 'success', message: location.state.message, show: true });
            window.history.replaceState({}, document.title);
        }
    }, [location.state]);

    const fetchPastExams = async () => {
        try {
            setLoading(true);
            const response = await api.get('/my-past-exams');

            if (response.status === 200) {
                setExams(Array.isArray(response.data?.exams) ? response.data.exams : []);
            } else {
                setAlert({ type: 'error', message: 'Грешка при зареждане на изпитите', show: true });
            }
        } catch (error) {
            console.error('Грешка при заявка:', error);
            setAlert({ type: 'error', message: 'Грешка при зареждане на изпитите', show: true });
        } finally {
            setLoading(false);
        }
    };

    const formatDate = (dateString) => {
        if (!dateString) return '—';
        const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
        return new Date(dateString).toLocaleDateString('bg-BG', options);
    };

    const formatTime = (dateString) => {
        if (!dateString) return '—';
        const options = { hour: '2-digit', minute: '2-digit' };
        return new Date(dateString).toLocaleTimeString('bg-BG', options);
    };

    const closeAlert = () => setAlert({ type: '', message: '', show: false });

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
                    {/* Page Header */}
                    <div className="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">
                        <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                            <div>
                                <h1 className="text-2xl font-bold text-gray-800">Изминали изпити</h1>
                                <p className="text-sm text-gray-500 mt-1">Преглед на изминалите изпити</p>
                            </div>

                        </div>
                    </div>

                    {/* Alerts */}
                    {alert.show && (
                        <Alert type={alert.type} message={alert.message} onClose={closeAlert} />
                    )}

                    {/* Exams Grid */}
                    {exams.length === 0 ? (
                        <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
                            <i className="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
                            <h3 className="text-lg font-medium text-gray-700 mb-2">Няма записани изпити</h3>
                            <p className="text-gray-500">
                                Все още нямате записани изпити. Моля, изберете от списъка с достъпни изпити.
                            </p>
                        </div>
                    ) : (
                        <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
                            {exams.map((registration) => {
                                const exam = registration.exam;

                                const teacherFirst = exam?.teacher?.user?.first_name ?? '';
                                const teacherLast = exam?.teacher?.user?.last_name ?? '';

                                return (
                                    <div
                                        key={exam?.id ?? Math.random()}
                                        className="bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px] flex flex-col h-full"
                                    >
                                        <div className="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">
                                            <h2 className="text-lg font-semibold text-gray-900 leading-tight">
                                                {exam?.subject?.subject_name ?? 'Неизвестна дисциплина'}
                                            </h2>
                                            <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                {exam?.exam_type ?? '—'}
                                            </span>
                                        </div>

                                        <div className="space-y-3 mb-5 flex-grow">
                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
                                                <span>
                                                    Преподавател:{' '}
                                                    <span className="font-medium text-gray-800">
                                                        {(teacherFirst + ' ' + teacherLast).trim() || '—'}
                                                    </span>
                                                </span>
                                            </div>

                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
                                                <span>
                                                    Дата:{' '}
                                                    <span className="font-medium text-gray-800">
                                                        {formatDate(exam?.start_time)}
                                                    </span>
                                                </span>
                                            </div>

                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-clock w-5 text-gray-400"></i>
                                                <span>
                                                    Продължителност:{' '}
                                                    <span className="font-medium text-gray-800">
                                                        {formatTime(exam?.start_time)} - {formatTime(exam?.end_time)}
                                                    </span>
                                                </span>
                                            </div>

                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-university w-5 text-gray-400"></i>
                                                <span>
                                                    Зала:{' '}
                                                    <span className="font-medium text-gray-800">
                                                        {exam?.hall?.name ?? '—'}
                                                    </span>
                                                </span>
                                            </div>

                                            <div className="flex items-center gap-2 text-gray-600">
                                                <i className="fas fa-star w-5 text-gray-400"></i>
                                                <span>
                                                    Оценка:{' '}
                                                    {registration?.grade != null && registration?.grade !== '' ? (
                                                        <span className="font-medium text-gray-800">
                                                            {registration.grade}
                                                        </span>
                                                    ) : (
                                                        <span className="text-gray-500 italic">---</span>
                                                    )}
                                                </span>
                                            </div>
                                        </div>
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

export default MyPastExams;
