
import React, { useState, useEffect } from 'react';
import { useParams, useNavigate, useLocation } from 'react-router-dom';
import { useAuth, api } from '../hooks/useAuth';
import Header from './partials/Header.jsx';
import Sidebar from './Sidebar';
import Alert from './Alert';

const TeacherExamStudents = () => {
    const { examId } = useParams();
    const navigate = useNavigate();
    const location = useLocation();
    const { user } = useAuth();
    const [exam, setExam] = useState(null);
    const [students, setStudents] = useState([]);
    const [loading, setLoading] = useState(true);
    const [alert, setAlert] = useState({ type: '', message: '' });

    useEffect(() => {
        fetchExamStudents();

        if (location.state?.message) {
            setAlert({ type: 'success', message: location.state.message });
            window.history.replaceState({}, document.title);
        }
    }, [examId, location.state]);

    const fetchExamStudents = async () => {
        try {
            setLoading(true);
            const response = await api.get(`/exam/${examId}/registered-students`);

            setExam(response.data.exam);
            setStudents(response.data.students || []);
        } catch (error) {
            console.error('Грешка при зареждане на студентите:', error);
            setAlert({ type: 'error', message: 'Грешка при зареждане на студентите' });
        } finally {
            setLoading(false);
        }
    };

    const handleBack = () => {
        navigate('/upcoming-exams');
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
                                <h1 className="text-2xl font-bold text-gray-800">
                                    Студенти записани за {exam?.subject_name}
                                </h1>
                                <p className="text-sm text-gray-500 mt-1">
                                    Дата на провеждане: {exam?.start_time ? new Date(exam.start_time).toLocaleDateString('bg-BG') : 'Няма дата'}
                                </p>
                            </div>
                            <button
                                onClick={handleBack}
                                className="inline-flex items-center gap-1 px-4 py-3 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition-colors"
                            >
                                <i className="fas fa-arrow-left me-2"></i>
                                Назад
                            </button>
                        </div>
                    </div>

                    {alert.message && (
                        <Alert type={alert.type} message={alert.message} onClose={() => setAlert({ type: '', message: '' })} />
                    )}

                    <div className="bg-white rounded-xl shadow-sm p-6">
                        {students.length === 0 ? (
                            <div className="text-center py-8">
                                <i className="fas fa-users text-4xl text-gray-300 mb-4"></i>
                                <h3 className="text-lg font-medium text-gray-700 mb-2">
                                    Все още няма записани студенти
                                </h3>
                            </div>
                        ) : (
                            <div className="overflow-x-auto">
                                <table className="w-full table-auto">
                                    <thead>
                                    <tr className="bg-gray-50">
                                        <th className="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                            Факултетен номер
                                        </th>
                                        <th className="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                            Име
                                        </th>
                                        <th className="px-4 py-3 text-left text-sm font-medium text-gray-500">
                                            Имейл
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {students.map((student) => (
                                        <tr key={student.id} className="border-b border-gray-100">
                                            <td className="px-4 py-3 text-sm text-gray-700">
                                                {student.faculty_number}
                                            </td>
                                            <td className="px-4 py-3 text-sm text-gray-700">
                                                {student.first_name} {student.second_name} {student.last_name}
                                            </td>
                                            <td className="px-4 py-3 text-sm text-gray-700">
                                                {student.email}
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

export default TeacherExamStudents;
