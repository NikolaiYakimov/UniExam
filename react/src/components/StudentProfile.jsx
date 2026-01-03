
import React, { useState, useEffect } from 'react';
import { useAuth, api } from '../hooks/useAuth';
import { useLocation } from 'react-router-dom';
import Header from './Header';
import Sidebar from './Sidebar';
import Alert from './Alert';

const StudentProfile = () => {
    const { user, logout } = useAuth();
    const location = useLocation();
    const [isEditing, setIsEditing] = useState(false);
    const [loading, setLoading] = useState(true);
    const [alert, setAlert] = useState({ type: '', message: '' });
    const [personalInfo, setPersonalInfo] = useState({
        email: '',
        phone: ''
    });
    const [passwordForm, setPasswordForm] = useState({
        current_password: '',
        new_password: '',
        new_password_confirmation: ''
    });
    const [originalData, setOriginalData] = useState({});
    const [errors, setErrors] = useState({
        email: '',
        phone: '',
        current_password: '',
        new_password: '',
        new_password_confirmation: ''
    });

    useEffect(() => {
        if (location.state?.message) {
            setAlert({ type: 'success', message: location.state.message });
            window.history.replaceState({}, document.title);
        }

        if (user) {
            const userData = {
                email: user.email || '',
                phone: user.phone || ''
            };
            setPersonalInfo(userData);
            setOriginalData(userData);
            setLoading(false);
        }
    }, [user, location.state]);

    const handlePersonalInfoChange = (e) => {
        const { name, value } = e.target;
        setPersonalInfo(prev => ({
            ...prev,
            [name]: value
        }));

        if (errors[name]) {
            setErrors(prev => ({
                ...prev,
                [name]: ''
            }));
        }
    };

    const handlePasswordChange = (e) => {
        const { name, value } = e.target;
        setPasswordForm(prev => ({
            ...prev,
            [name]: value
        }));

        if (errors[name]) {
            setErrors(prev => ({
                ...prev,
                [name]: ''
            }));
        }
    };

    const handleEditToggle = () => {
        if (isEditing) {
            setPersonalInfo(originalData);
            setErrors({
                email: '',
                phone: '',
                current_password: '',
                new_password: '',
                new_password_confirmation: ''
            });
        }
        setIsEditing(!isEditing);
    };

    const validatePersonalInfo = () => {
        const newErrors = {};

        if (!personalInfo.email) {
            newErrors.email = 'Имейл адресът е задължителен';
        } else if (!/\S+@\S+\.\S+/.test(personalInfo.email)) {
            newErrors.email = 'Моля, въведете валиден имейл адрес';
        }

        setErrors(prev => ({ ...prev, ...newErrors }));
        return Object.keys(newErrors).length === 0;
    };

    const validatePasswordForm = () => {
        const newErrors = {};

        if (!passwordForm.current_password) {
            newErrors.current_password = 'Настоящата парола е задължителна';
        }

        if (!passwordForm.new_password) {
            newErrors.new_password = 'Новата парола е задължителна';
        } else if (passwordForm.new_password.length < 8) {
            newErrors.new_password = 'Паролата трябва да бъде поне 8 символа';
        }

        if (!passwordForm.new_password_confirmation) {
            newErrors.new_password_confirmation = 'Потвърждението на паролата е задължително';
        } else if (passwordForm.new_password !== passwordForm.new_password_confirmation) {
            newErrors.new_password_confirmation = 'Паролите не съвпадат';
        }

        setErrors(prev => ({ ...prev, ...newErrors }));
        return Object.keys(newErrors).length === 0;
    };

    const updateProfile = async (e) => {
        e.preventDefault();

        if (!validatePersonalInfo()) return;

        try {
            const response = await api.put('/profile-update', personalInfo);
            setAlert({
                type: 'success',
                message: response.data.message || 'Профилът е обновен успешно'
            });
            setIsEditing(false);
            setOriginalData(personalInfo);
        } catch (error) {
            if (error.response?.data?.errors) {
                const serverErrors = error.response.data.errors;
                const newErrors = {};

                if (serverErrors.email) {
                    newErrors.email = serverErrors.email[0];
                }

                if (serverErrors.phone) {
                    newErrors.phone = serverErrors.phone[0];
                }

                setErrors(prev => ({ ...prev, ...newErrors }));

                setAlert({
                    type: 'error',
                    message: 'Моля, коригирайте грешките във формата'
                });
            } else {
                const errorMessage = error.response?.data?.message || 'Грешка при обновяване на профила';
                setAlert({
                    type: 'error',
                    message: errorMessage
                });
            }
        }
    };

    const changePassword = async (e) => {
        e.preventDefault();

        if (!validatePasswordForm()) return;

        try {
            const response = await api.put('/student-profile/password', passwordForm);
            setAlert({
                type: 'success',
                message: response.data.message || 'Паролата е сменена успешно'
            });
            setPasswordForm({
                current_password: '',
                new_password: '',
                new_password_confirmation: ''
            });

            setErrors(prev => ({
                ...prev,
                current_password: '',
                new_password: '',
                new_password_confirmation: ''
            }));
        } catch (error) {
            console.error('Password change error:', error.response?.data);

            if (error.response?.status === 422) {
                const validationErrors = error.response.data.errors || {};
                const newErrors = {};

                Object.keys(validationErrors).forEach(field => {
                    const fieldName = field.replace('new_password_confirmation', 'new_password_confirmation');
                    newErrors[fieldName] = validationErrors[field][0];
                });

                setErrors(prev => ({ ...prev, ...newErrors }));

                setAlert({
                    type: 'error',
                    message: 'Моля, коригирайте грешките във формата'
                });
            } else {
                const errorMessage = error.response?.data?.message || 'Грешка при смяна на паролата';
                setAlert({
                    type: 'error',
                    message: errorMessage
                });
            }
        }
    };

    if (loading || !user) {
        return (
            <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50">
                <Header user={user} logout={logout} />
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
            <Header user={user} logout={logout} />

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
                        <Alert
                            type={alert.type}
                            message={alert.message}
                            onClose={() => setAlert({ type: '', message: '' })}
                        />
                    )}

                    <div className="space-y-6">
                        {/* Лична информация */}
                        <div className="bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
                            <div className="flex flex-wrap items-center justify-between mb-6 gap-4">
                                <h2 className="text-xl font-semibold text-gray-800">
                                    <i className="fas fa-user-circle text-indigo-500 mr-2"></i> Лична информация
                                </h2>
                                <button
                                    onClick={handleEditToggle}
                                    className="text-indigo-600 hover:text-indigo-800 flex items-center bg-indigo-50 px-4 py-2 rounded-lg"
                                >
                                    <i className="fas fa-edit mr-2"></i>
                                    {isEditing ? 'Откажи' : 'Редактирай'}
                                </button>
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
                                    <form id="personalInfoForm" onSubmit={updateProfile} className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label className="block text-sm font-medium text-gray-700 mb-1">Пълно име</label>
                                            <input
                                                type="text"
                                                value={`${user.first_name} ${user.last_name}`}
                                                className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50"
                                                disabled
                                            />
                                        </div>

                                        <div>
                                            <label className="block text-sm font-medium text-gray-700 mb-1">Факултетен номер</label>
                                            <input
                                                type="text"
                                                value={user.student?.faculty_number || ''}
                                                className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-100"
                                                disabled
                                            />
                                        </div>

                                        <div>
                                            <label className="block text-sm font-medium text-gray-700 mb-1">Имейл адрес</label>
                                            <input
                                                type="email"
                                                name="email"
                                                value={personalInfo.email}
                                                onChange={handlePersonalInfoChange}
                                                className={`w-full px-4 py-3 border border-gray-300 rounded-xl ${
                                                    isEditing && errors.email ? 'border-red-500' : ''
                                                } ${isEditing ? 'bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500' : 'bg-gray-50'}`}
                                                disabled={!isEditing}
                                            />
                                            {errors.email && <p className="text-red-600 text-sm mt-1">{errors.email}</p>}
                                        </div>

                                        <div>
                                            <label className="block text-sm font-medium text-gray-700 mb-1">Телефон</label>
                                            <input
                                                type="tel"
                                                name="phone"
                                                value={personalInfo.phone}
                                                onChange={handlePersonalInfoChange}
                                                className={`w-full px-4 py-3 border border-gray-300 rounded-xl ${
                                                    isEditing && errors.phone ? 'border-red-500' : ''
                                                } ${isEditing ? 'bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500' : 'bg-gray-50'}`}
                                                disabled={!isEditing}
                                            />
                                            {errors.phone && <p className="text-red-600 text-sm mt-1">{errors.phone}</p>}
                                        </div>
                                    </form>
                                </div>
                            </div>

                            {isEditing && (
                                <div className="mt-8 flex space-x-4 justify-end">
                                    <button
                                        type="button"
                                        onClick={handleEditToggle}
                                        className="px-5 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 font-medium transition-colors"
                                    >
                                        Откажи
                                    </button>
                                    <button
                                        type="submit"
                                        form="personalInfoForm"
                                        className="px-5 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 font-medium transition-colors"
                                    >
                                        Запази промените
                                    </button>
                                </div>
                            )}
                        </div>

                        {/* Академична информация */}
                        <div className="bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
                            <div className="flex flex-wrap items-center justify-between mb-6 gap-4">
                                <h2 className="text-xl font-semibold text-gray-800">
                                    <i className="fas fa-graduation-cap text-indigo-500 mr-2"></i> Академична информация
                                </h2>
                                {user.student?.semester < 8 ? (
                                    <span className="px-4 py-2 bg-green-100 text-green-800 text-sm font-medium rounded-full flex items-center">
                                        <i className="fas fa-check-circle mr-2"></i> Активен
                                    </span>
                                ) : (
                                    <span className="px-4 py-2 bg-red-100 text-red-700 text-sm font-medium rounded-full flex items-center">
                                        <i className="fas fa-times-circle mr-2"></i> Неактивен
                                    </span>
                                )}
                            </div>

                            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">Факултет</label>
                                    <div className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
                                        <i className="fas fa-university text-gray-400 mr-3"></i>
                                        {user.student?.faculty?.name || 'Не е зададен'}
                                    </div>
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">Специалност</label>
                                    <div className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
                                        <i className="fas fa-book-open text-gray-400 mr-3"></i>
                                        {user.student?.specialty?.name || 'Не е зададена'}
                                    </div>
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">Група</label>
                                    <div className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
                                        <i className="fas fa-users text-gray-400 mr-3"></i>
                                        {user.student?.group?.name || 'Не е зададена'}
                                    </div>
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">Семестър</label>
                                    <div className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
                                        <i className="fas fa-layer-group text-gray-400 mr-3"></i>
                                        {user.student?.semester || ''}
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
                                    <form id="changePasswordForm" onSubmit={changePassword} className="space-y-4">
                                        <div>
                                            <label className="block text-sm font-medium text-gray-700 mb-1">Настояща парола</label>
                                            <input
                                                type="password"
                                                name="current_password"
                                                value={passwordForm.current_password}
                                                onChange={handlePasswordChange}
                                                className={`w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 ${
                                                    errors.current_password ? 'border-red-500' : ''
                                                }`}
                                                required
                                            />
                                            {errors.current_password && <p className="text-red-600 text-sm mt-1">{errors.current_password}</p>}
                                        </div>

                                        <div>
                                            <label className="block text-sm font-medium text-gray-700 mb-1">Нова парола</label>
                                            <input
                                                type="password"
                                                name="new_password"
                                                value={passwordForm.new_password}
                                                onChange={handlePasswordChange}
                                                className={`w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 ${
                                                    errors.new_password ? 'border-red-500' : ''
                                                }`}
                                                required
                                                minLength="8"
                                            />
                                            {errors.new_password && <p className="text-red-600 text-sm mt-1">{errors.new_password}</p>}
                                        </div>

                                        <div>
                                            <label className="block text-sm font-medium text-gray-700 mb-1">Потвърди новата парола</label>
                                            <input
                                                type="password"
                                                name="new_password_confirmation"
                                                value={passwordForm.new_password_confirmation}
                                                onChange={handlePasswordChange}
                                                className={`w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 ${
                                                    errors.new_password_confirmation ? 'border-red-500' : ''
                                                }`}
                                                required
                                                minLength="8"
                                            />
                                            {errors.new_password_confirmation && <p className="text-red-600 text-sm mt-1">{errors.new_password_confirmation}</p>}
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

export default StudentProfile;
