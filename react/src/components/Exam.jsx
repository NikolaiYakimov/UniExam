
//
import { useEffect, useState } from 'react';
import { useAuth, api } from '../hooks/useAuth';
import { useLocation, Link, useNavigate } from 'react-router-dom';
import Header from '../components/Header';
import Sidebar from '../components/Sidebar';
import Alert from '../components/Alert';
import PaymentModal from "./PaymentModal.jsx";

export default function Exams() {
    const { user } = useAuth();
    const location = useLocation();
    const navigate = useNavigate();
    const [exams, setExams] = useState([]);
    const [loading, setLoading] = useState(true);
    const [alert, setAlert] = useState({ type: '', message: '' });
    const [showPaymentModal, setShowPaymentModal] = useState(false);
    const [selectedExam, setSelectedExam] = useState(null);

    useEffect(() => {
        fetchExams();

        if (location.state?.message) {
            setAlert({ type: 'success', message: location.state.message });
            window.history.replaceState({}, document.title);
        }
    }, [location.state]);

    const fetchExams = async () => {
        try {
            setLoading(true);
            const response = await api.get('/exams');
            const data = response.data;

            let examsData = [];
            if (Array.isArray(data)) {
                examsData = data;
            } else if (data.data && Array.isArray(data.data)) {
                examsData = data.data;
            } else if (data.exams && Array.isArray(data.exams)) {
                examsData = data.exams;
            } else {
                throw new Error('Неочакван формат на данните от сървъра');
            }

            setExams(examsData);
        } catch (err) {
            console.error('Грешка при зареждане на изпити:', err);
            setAlert({ type: 'error', message: err.response?.data?.message || err.message });
        } finally {
            setLoading(false);
        }
    };

    const handleRegister = async (exam) => {
        try {
            const requiresPayment = exam.exam_type === 'ликвидация' ||
                (exam.subject && exam.subject.semester < user.student?.semester);

            if (requiresPayment) {
                setSelectedExam(exam);
                setShowPaymentModal(true);
                return;
            }

            const response = await api.post(`/exams/${exam.id}/register`);
            setAlert({ type: 'success', message: response.data.message || 'Успешно се записахте за изпита!' });
            fetchExams();
        } catch (err) {
            setAlert({ type: 'error', message: err.response?.data?.message || err.message });
        }
    };

    const handlePaymentSuccess = () => {
        setShowPaymentModal(false);
        setSelectedExam(null);
        setAlert({ type: 'success', message: 'Плащането е успешно и сте записани за изпита!' });
        fetchExams();
    };

    const handlePaymentError = (error) => {
        setShowPaymentModal(false);
        setSelectedExam(null);
        setAlert({ type: 'error', message: error.message || 'Грешка при плащане' });
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
            {/* Обграждаме Header и Sidebar в blur контейнер */}
            <div className={showPaymentModal ? "blur-sm transition-all duration-300" : ""}>
                <Header />
                <div className="flex pt-0">
                    <Sidebar user={user} />

                    <div className="flex-1 p-4 lg:p-8 ml-0 lg:ml-0">
                        <div className="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">
                            <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                                <div>
                                    <h1 className="text-2xl font-bold text-gray-800">Достъпни изпити</h1>
                                    <p className="text-sm text-gray-500 mt-1">Преглед и записване за предстоящи изпити</p>
                                </div>
                                {/*<Link*/}
                                {/*    to="/my-exams"*/}
                                {/*    className="inline-flex items-center gap-1 px-4 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors"*/}
                                {/*>*/}
                                {/*    <i className="fas fa-list-alt"></i>*/}
                                {/*    Моите изпити*/}
                                {/*</Link>*/}
                            </div>
                        </div>

                        {alert.message && (
                            <Alert type={alert.type} message={alert.message} onClose={() => setAlert({ type: '', message: '' })} />
                        )}

                        {exams.length === 0 ? (
                            <div className="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
                                <i className="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
                                <h3 className="text-lg font-medium text-gray-700 mb-2">Няма налични изпити</h3>
                                <p className="text-gray-500">В момента няма изпити за записване. Моля, проверете по-късно.</p>
                            </div>
                        ) : (
                            <div className="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
                                {exams.map((exam) => {
                                    const subjectName = exam.subject?.subject_name || 'Неизвестен предмет';
                                    const teacherName = exam.teacher?.user ?
                                        `${exam.teacher.user.first_name} ${exam.teacher.user.last_name}` :
                                        'Неизвестен преподавател';
                                    const requiresPayment = exam.exam_type === 'ликвидация' ||
                                        (exam.subject && exam.subject.semester < user.student?.semester);

                                    return (
                                        <div key={exam.id} className="bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px] flex flex-col h-full">
                                            <div className="flex justify-between items-start gap-2 mb-3">
                                                <h2 className="text-lg font-semibold text-gray-900">
                                                    {subjectName}
                                                </h2>
                                                <div className="flex flex-wrap gap-2">
                                                    <span className="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                        {exam.exam_type}
                                                    </span>
                                                    <span className={`px-2.5 py-1 rounded-full text-xs font-medium ${
                                                        exam.remaining_slots > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                                                    }`}>
                                                        {exam.remaining_slots > 0 ? `${exam.remaining_slots} Свободни` : 'Няма места'}
                                                    </span>
                                                </div>
                                            </div>

                                            <div className="space-y-3 mb-5 flex-grow">
                                                <div className="flex items-center gap-2 text-gray-600">
                                                    <i className="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
                                                    <span>Преподавател: <span className="font-medium text-gray-800">{teacherName}</span></span>
                                                </div>
                                                <div className="flex items-center gap-2 text-gray-600">
                                                    <i className="fas fa-calendar-alt w-5 text-gray-400"></i>
                                                    <span>Дата: <span className="font-medium text-gray-800">
                                                        {new Date(exam.start_time).toLocaleDateString('bg-BG')}
                                                    </span></span>
                                                </div>
                                                <div className="flex items-center gap-2 text-gray-600">
                                                    <i className="fas fa-clock w-5 text-gray-400"></i>
                                                    <span>Час: <span className="font-medium text-gray-800">
                                                        {new Date(exam.start_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })} -
                                                        {new Date(exam.end_time).toLocaleTimeString('bg-BG', { hour: '2-digit', minute: '2-digit' })}
                                                    </span></span>
                                                </div>
                                                <div className="flex items-center gap-2 text-gray-600">
                                                    <i className="fas fa-university w-5 text-gray-400"></i>
                                                    <span>Зала: <span className="font-medium text-gray-800">{exam.hall?.name || 'Неизвестна зала'}</span></span>
                                                </div>
                                            </div>

                                            <button
                                                onClick={() => handleRegister(exam)}
                                                disabled={exam.remaining_slots <= 0}
                                                className={`mt-auto w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 ${
                                                    exam.remaining_slots <= 0
                                                        ? 'bg-gray-300 cursor-not-allowed'
                                                        : requiresPayment
                                                            ? 'bg-blue-600 hover:bg-blue-700'
                                                            : 'bg-green-600 hover:bg-green-700'
                                                }`}
                                            >
                                                <i className={`mr-2 ${requiresPayment ? 'fas fa-credit-card' : 'fas fa-edit'}`}></i>
                                                {requiresPayment ? 'Плати и се запиши' : 'Запиши се'}
                                            </button>
                                        </div>
                                    );
                                })}
                            </div>
                        )}
                    </div>
                </div>
            </div>

            {showPaymentModal && selectedExam && (
                <PaymentModal
                    exam={selectedExam}
                    onSuccess={handlePaymentSuccess}
                    onError={handlePaymentError}
                    onClose={() => {
                        setShowPaymentModal(false);
                        setSelectedExam(null);
                    }}
                />
            )}
        </div>
    );
}
