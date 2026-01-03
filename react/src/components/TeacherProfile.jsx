
import React, { useState, useEffect } from 'react';
import { useAuth, api } from '../hooks/useAuth';
import { useLocation, Link } from 'react-router-dom';
import Header from './Header';
import Sidebar from './Sidebar';
import Alert from './Alert';

const TeacherProfile = () => {
    const { user } = useAuth();
    const location = useLocation();
    const [teacherData, setTeacherData] = useState(null);
    const [isEditing, setIsEditing] = useState(false);
    const [loading, setLoading] = useState(true);
    const [alert, setAlert] = useState({ type: '', message: '' });
    const [formData, setFormData] = useState({
        email: '',
        phone: ''
    });
    const [passwordData, setPasswordData] = useState({
        current_password: '',
        password: '',
        password_confirmation: ''
    });

    useEffect(() => {
        if (location.state?.message) {
            setAlert({ type: 'success', message: location.state.message });
            window.history.replaceState({}, document.title);
        }
        fetchTeacherData();
    }, [location.state]);

    useEffect(() => {
        if (user) {
            setFormData({
                email: user.email || '',
                phone: user.phone || ''
            });
        }
    }, [user]);

    const fetchTeacherData = async () => {
        try {
            setLoading(true);
            const response = await api.get('/teacher-profile');
            setTeacherData(response.data);
        } catch (error) {
            console.error('Грешка при зареждане на данните:', error);
            setAlert({ type: 'error', message: 'Възникна грешка при зареждане на данните.' });
        } finally {
            setLoading(false);
        }
    };

    const handleInputChange = (e) => {
        const { name, value } = e.target;
        setFormData(prev => ({ ...prev, [name]: value }));
    };

    const handlePasswordChange = (e) => {
        const { name, value } = e.target;
        setPasswordData(prev => ({ ...prev, [name]: value }));
    };

    const handlePersonalInfoSubmit = async (e) => {
        e.preventDefault();
        try {
            await api.put('/profile-update', formData);
            setAlert({ type: 'success', message: 'Профилът е обновен успешно.' });
            setIsEditing(false);
            fetchTeacherData();
        } catch (error) {
            console.error('Грешка при обновяване на профила:', error);
            setAlert({ type: 'error', message: error.response?.data?.message || 'Възникна грешка при обновяване на профила.' });
        }
    };

    const handlePasswordSubmit = async (e) => {
        e.preventDefault();
        try {
            await api.put('/profile/password', passwordData);
            setAlert({ type: 'success', message: 'Паролата е сменена успешно.' });
            setPasswordData({
                current_password: '',
                password: '',
                password_confirmation: ''
            });
        } catch (error) {
            console.error('Грешка при смяна на паролата:', error);
            setAlert({ type: 'error', message: error.response?.data?.message || 'Възникна грешка при смяна на паролата.' });
        }
    };

    if (loading || !user) {
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
                                <h1 className="text-2xl font-bold text-gray-800">Моят профил</h1>
                                <p className="text-sm text-gray-500 mt-1">Лична информация и настройки на акаунта</p>
                            </div>

                        </div>
                    </div>

                    {alert.message && (
                        <Alert type={alert.type} message={alert.message} onClose={() => setAlert({ type: '', message: '' })} />
                    )}

                    <div className="space-y-6">
                        {/* Лична информация */}
                        <div className="bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
                            <div className="flex flex-wrap items-center justify-between mb-6 gap-4">
                                <h2 className="text-xl font-semibold text-gray-800">
                                    <i className="fas fa-user-circle text-indigo-500 mr-2"></i> Лична информация
                                </h2>
                                {!isEditing && (
                                    <button
                                        onClick={() => setIsEditing(true)}
                                        className="text-indigo-600 hover:text-indigo-800 flex items-center bg-indigo-50 px-4 py-2 rounded-lg"
                                    >
                                        <i className="fas fa-edit mr-2"></i> Редактирай
                                    </button>
                                )}
                            </div>

                            <div className="flex flex-col lg:flex-row gap-8">
                                <div className="flex flex-col items-center lg:items-start lg:w-1/3">
                                    <div className="relative mb-4">
                                        <img
                                            src={`https://ui-avatars.com/api/?name=${encodeURIComponent(user.first_name + ' ' + user.last_name)}&background=4f46e5&color=fff`}
                                            alt="Profile"
                                            className="w-40 h-40 rounded-full object-cover border-4 border-indigo-100 shadow-lg"
                                        />
                                        <label className="absolute bottom-3 right-3 bg-indigo-500 text-white p-2 rounded-full cursor-pointer hover:bg-indigo-600 shadow-md transition-all">
                                            <i className="fas fa-camera"></i>
                                            <input type="file" className="hidden" accept="image/*" />
                                        </label>
                                    </div>
                                </div>

                                <div className="flex-1">
                                    <form onSubmit={handlePersonalInfoSubmit} className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label className="block text-sm font-medium text-gray-700 mb-1">Пълно име</label>
                                            <input
                                                type="text"
                                                value={`${user.first_name} ${user.second_name} ${user.last_name}`}
                                                className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50"
                                                disabled
                                            />
                                        </div>

                                        <div>
                                            <label className="block text-sm font-medium text-gray-700 mb-1">Титла</label>
                                            <input
                                                type="text"
                                                value={teacherData?.teacher?.title || ''}
                                                className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-100"
                                                disabled
                                            />
                                        </div>

                                        <div>
                                            <label className="block text-sm font-medium text-gray-700 mb-1">Имейл адрес</label>
                                            <input
                                                type="email"
                                                name="email"
                                                value={formData.email}
                                                onChange={handleInputChange}
                                                className={`w-full px-4 py-3 border border-gray-300 rounded-xl ${isEditing ? 'bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500' : 'bg-gray-50'}`}
                                                disabled={!isEditing}
                                            />
                                        </div>

                                        <div>
                                            <label className="block text-sm font-medium text-gray-700 mb-1">Телефон</label>
                                            <input
                                                type="tel"
                                                name="phone"
                                                value={formData.phone}
                                                onChange={handleInputChange}
                                                className={`w-full px-4 py-3 border border-gray-300 rounded-xl ${isEditing ? 'bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500' : 'bg-gray-50'}`}
                                                disabled={!isEditing}
                                            />
                                        </div>
                                    </form>
                                </div>
                            </div>

                            {isEditing && (
                                <div className="mt-8 flex space-x-4 justify-end">
                                    <button
                                        type="button"
                                        onClick={() => {
                                            setIsEditing(false);
                                            setFormData({
                                                email: user.email || '',
                                                phone: user.phone || ''
                                            });
                                        }}
                                        className="px-5 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 font-medium transition-colors"
                                    >
                                        Откажи
                                    </button>
                                    <button
                                        onClick={handlePersonalInfoSubmit}
                                        className="px-5 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 font-medium transition-colors"
                                    >
                                        Запази промените
                                    </button>
                                </div>
                            )}
                        </div>

                        {/* Професионална информация */}
                        <div className="bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
                            <div className="flex flex-wrap items-center justify-between mb-6 gap-4">
                                <h2 className="text-xl font-semibold text-gray-800">
                                    <i className="fas fa-briefcase text-indigo-500 mr-2"></i> Професионална информация
                                </h2>
                                <span className="px-4 py-2 bg-green-100 text-green-800 text-sm font-medium rounded-full flex items-center">
                                    <i className="fas fa-check-circle mr-2"></i> Активен
                                </span>
                            </div>

                            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">Факултет</label>
                                    <div className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
                                        <i className="fas fa-university text-gray-400 mr-3"></i>
                                        {teacherData?.teacher?.faculty?.name || 'Не е зададен'}
                                    </div>
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">Специалност</label>
                                    <div className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
                                        <i className="fas fa-book-open text-gray-400 mr-3"></i>
                                        {teacherData?.teacher?.specialty?.name || 'Не е зададена'}
                                    </div>
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">Брой предмети</label>
                                    <div className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
                                        <i className="fas fa-book text-gray-400 mr-3"></i>
                                        {teacherData?.subjects_count || 0} предмета
                                    </div>
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">Брой предстоящи изпити</label>
                                    <div className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
                                        <i className="fas fa-calendar-alt text-gray-400 mr-3"></i>
                                        {teacherData?.exams_count || 0} изпита
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Настройки на акаунта */}
                        <div className="bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
                            <h2 className="text-xl font-semibold text-gray-800 mb-6">
                                <i className="fas fa-cog text-indigo-500 mr-2"></i> Настройки на акаунта
                            </h2>

                            <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <div>
                                    <h3 className="text-lg font-medium text-gray-800 mb-4">Смяна на парола</h3>
                                    <form onSubmit={handlePasswordSubmit} className="space-y-4">
                                        <div>
                                            <label className="block text-sm font-medium text-gray-700 mb-1">Настояща парола</label>
                                            <input
                                                type="password"
                                                name="current_password"
                                                value={passwordData.current_password}
                                                onChange={handlePasswordChange}
                                                className="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                            />
                                        </div>

                                        <div>
                                            <label className="block text-sm font-medium text-gray-700 mb-1">Нова парола</label>
                                            <input
                                                type="password"
                                                name="password"
                                                value={passwordData.password}
                                                onChange={handlePasswordChange}
                                                className="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                            />
                                        </div>

                                        <div>
                                            <label className="block text-sm font-medium text-gray-700 mb-1">Потвърди новата парола</label>
                                            <input
                                                type="password"
                                                name="password_confirmation"
                                                value={passwordData.password_confirmation}
                                                onChange={handlePasswordChange}
                                                className="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                            />
                                        </div>

                                        <button
                                            type="submit"
                                            className="px-5 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 font-medium transition-colors flex items-center"
                                        >
                                            <i className="fas fa-key mr-2"></i> Смени парола
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default TeacherProfile;
