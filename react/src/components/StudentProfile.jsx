// import { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
// // import api from '../hooks/useAuth.jsx';
//
// const StudentProfile = () => {
//     const { user, logout } = useAuth();
//     const [isEditing, setIsEditing] = useState(false);
//     const [personalInfo, setPersonalInfo] = useState({
//         email: '',
//         phone: ''
//     });
//     const [passwordForm, setPasswordForm] = useState({
//         current_password: '',
//         new_password: '',
//         new_password_confirmation: ''
//     });
//     const [alerts, setAlerts] = useState({
//         success: '',
//         error: ''
//     });
//     const [isLoading, setIsLoading] = useState(false);
//
//     useEffect(() => {
//         if (user) {
//             setPersonalInfo({
//                 email: user.email || '',
//                 phone: user.phone || ''
//             });
//         }
//     }, [user]);
//
//     const handlePersonalInfoChange = (e) => {
//         const { name, value } = e.target;
//         setPersonalInfo(prev => ({
//             ...prev,
//             [name]: value
//         }));
//     };
//
//     const handlePasswordChange = (e) => {
//         const { name, value } = e.target;
//         setPasswordForm(prev => ({
//             ...prev,
//             [name]: value
//         }));
//     };
//
//     const updateProfile = async (e) => {
//         e.preventDefault();
//         setIsLoading(true);
//
//         try {
//             const response = await api.put('/profile/update', personalInfo);
//             setAlerts({
//                 success: 'Профилът е обновен успешно',
//                 error: ''
//             });
//             setIsEditing(false);
//         } catch (error) {
//             setAlerts({
//                 success: '',
//                 error: 'Грешка при обновяване на профила'
//             });
//         } finally {
//             setIsLoading(false);
//         }
//     };
//
//     const changePassword = async (e) => {
//         e.preventDefault();
//         setIsLoading(true);
//
//         try {
//             const response = await api.put('/profile/password', passwordForm);
//             setAlerts({
//                 success: 'Паролата е сменена успешно',
//                 error: ''
//             });
//             setPasswordForm({
//                 current_password: '',
//                 new_password: '',
//                 new_password_confirmation: ''
//             });
//         } catch (error) {
//             setAlerts({
//                 success: '',
//                 error: 'Грешка при смяна на паролата'
//             });
//         } finally {
//             setIsLoading(false);
//         }
//     };
//
//     if (!user) {
//         return <div>Зареждане...</div>;
//     }
//
//     return (
//         <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">
//             {/* Header */}
//             <Header user={user} logout={logout} />
//
//             <div className="page-layout">
//                 {/* Sidebar */}
//                 <Sidebar user={user} />
//
//                 <main className="p-4 lg:p-6">
//                     {/* Page Title Section */}
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Моят профил</h1>
//                                 <p className="text-sm text-gray-500 mt-1">Лична информация и настройки на акаунта</p>
//                             </div>
//                         </div>
//                     </div>
//
//                     {/* Alerts */}
//                     {alerts.success && (
//                         <div className="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800 flex items-start gap-3 relative">
//                             <div className="mt-0.5 flex-shrink-0">
//                                 <i className="fas fa-check-circle text-green-500"></i>
//                             </div>
//                             <div>
//                                 <p className="font-medium">Успешно!</p>
//                                 <p>{alerts.success}</p>
//                             </div>
//                             <button
//                                 type="button"
//                                 className="absolute top-3 right-3 text-green-500 hover:text-green-700"
//                                 onClick={() => setAlerts({...alerts, success: ''})}
//                             >
//                                 <i className="fas fa-times"></i>
//                             </button>
//                         </div>
//                     )}
//
//                     {alerts.error && (
//                         <div className="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-800 flex items-start gap-3 relative">
//                             <div className="mt-0.5 flex-shrink-0">
//                                 <i className="fas fa-exclamation-circle text-red-500"></i>
//                             </div>
//                             <div>
//                                 <p className="font-medium">Грешка!</p>
//                                 <p>{alerts.error}</p>
//                             </div>
//                             <button
//                                 type="button"
//                                 className="absolute top-3 right-3 text-red-500 hover:text-red-700"
//                                 onClick={() => setAlerts({...alerts, error: ''})}
//                             >
//                                 <i className="fas fa-times"></i>
//                             </button>
//                         </div>
//                     )}
//
//                     {/* Profile Content */}
//                     <div className="space-y-6">
//                         {/* Лична информация */}
//                         <div className="profile-card bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
//                             <div className="flex flex-wrap items-center justify-between mb-6 gap-4">
//                                 <h2 className="text-xl font-semibold text-gray-800 section-title">
//                                     <i className="fas fa-user-circle text-indigo-500"></i> Лична информация
//                                 </h2>
//                                 {!isEditing && (
//                                     <button
//                                         id="editPersonalBtn"
//                                         className="text-indigo-600 hover:text-indigo-800 flex items-center bg-indigo-50 px-4 py-2 rounded-lg"
//                                         onClick={() => setIsEditing(true)}
//                                     >
//                                         <i className="fas fa-edit mr-2"></i> Редактирай
//                                     </button>
//                                 )}
//                             </div>
//
//                             <div className="flex flex-col lg:flex-row gap-8">
//                                 <div className="flex flex-col items-center lg:items-start lg:w-1/3 lg:pl-12">
//                                     <div className="relative mb-4">
//                                         <img
//                                             src={`https://ui-avatars.com/api/?name=${encodeURIComponent(user.first_name + ' ' + user.last_name)}&background=4f46e5&color=fff`}
//                                             alt="Profile"
//                                             className="w-40 h-50 rounded-full object-cover border-4 border-indigo-100 shadow-lg"
//                                         />
//                                         <label htmlFor="avatarUpload" className="absolute bottom-3 right-3 bg-indigo-500 text-white p-2 rounded-full cursor-pointer hover:bg-indigo-600 shadow-md transition-all">
//                                             <i className="fas fa-camera"></i>
//                                             <input type="file" id="avatarUpload" className="hidden" accept="image/*" />
//                                         </label>
//                                     </div>
//                                 </div>
//
//                                 <div className="flex-1">
//                                     <form id="personalInfoForm" className="info-grid">
//                                         <div>
//                                             <label className="block text-sm font-medium text-gray-700 mb-1">Пълно име</label>
//                                             <input
//                                                 type="text"
//                                                 value={`${user.first_name} ${user.last_name}`}
//                                                 className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
//                                                 disabled
//                                             />
//                                         </div>
//
//                                         <div>
//                                             <label className="block text-sm font-medium text-gray-700 mb-1">Факултетен номер</label>
//                                             <input
//                                                 type="text"
//                                                 value={user.student?.faculty_number || ''}
//                                                 className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-100"
//                                                 disabled
//                                             />
//                                         </div>
//
//                                         <div>
//                                             <label className="block text-sm font-medium text-gray-700 mb-1">Имейл адрес</label>
//                                             <input
//                                                 type="email"
//                                                 name="email"
//                                                 value={personalInfo.email}
//                                                 onChange={handlePersonalInfoChange}
//                                                 className={`w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 ${isEditing ? 'bg-white ring-2 ring-indigo-100' : 'bg-gray-50'}`}
//                                                 disabled={!isEditing}
//                                             />
//                                         </div>
//
//                                         <div>
//                                             <label className="block text-sm font-medium text-gray-700 mb-1">Телефон</label>
//                                             <input
//                                                 type="tel"
//                                                 name="phone"
//                                                 value={personalInfo.phone}
//                                                 onChange={handlePersonalInfoChange}
//                                                 className={`w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 ${isEditing ? 'bg-white ring-2 ring-indigo-100' : 'bg-gray-50'}`}
//                                                 disabled={!isEditing}
//                                             />
//                                         </div>
//                                     </form>
//                                 </div>
//                             </div>
//
//                             {isEditing && (
//                                 <div className="mt-8 flex space-x-4 justify-end">
//                                     <button
//                                         type="button"
//                                         className="px-5 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 font-medium transition-colors"
//                                         onClick={() => {
//                                             setIsEditing(false);
//                                             setPersonalInfo({
//                                                 email: user.email || '',
//                                                 phone: user.phone || ''
//                                             });
//                                         }}
//                                     >
//                                         Откажи
//                                     </button>
//                                     <button
//                                         type="submit"
//                                         form="personalInfoForm"
//                                         className="px-5 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 font-medium transition-colors"
//                                         onClick={updateProfile}
//                                         disabled={isLoading}
//                                     >
//                                         {isLoading ? 'Запазване...' : 'Запази промените'}
//                                     </button>
//                                 </div>
//                             )}
//                         </div>
//
//                         {/* Академична информация */}
//                         <div className="profile-card bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
//                             <div className="flex flex-wrap items-center justify-between mb-6 gap-4">
//                                 <h2 className="text-xl font-semibold text-gray-800 section-title">
//                                     <i className="fas fa-graduation-cap text-indigo-500"></i> Академична информация
//                                 </h2>
//                                 {user.student?.semester < 8 ? (
//                                     <span className="px-4 py-2 bg-green-100 text-green-800 text-sm font-medium rounded-full flex items-center">
//                     <i className="fas fa-check-circle mr-2"></i> Активен
//                   </span>
//                                 ) : (
//                                     <span className="px-4 py-2 bg-red-100 text-red-700 text-sm font-medium rounded-full flex items-center">
//                     <i className="fas fa-times-circle mr-2"></i> Неактивен
//                   </span>
//                                 )}
//                             </div>
//
//                             <div className="info-grid">
//                                 <div>
//                                     <label className="block text-sm font-medium text-gray-700 mb-1">Факултет</label>
//                                     <div className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
//                                         <i className="fas fa-university text-gray-400 mr-3"></i>
//                                         {user.student?.faculty?.name || 'Не е зададен'}
//                                     </div>
//                                 </div>
//
//                                 <div>
//                                     <label className="block text-sm font-medium text-gray-700 mb-1">Специалност</label>
//                                     <div className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
//                                         <i className="fas fa-book-open text-gray-400 mr-3"></i>
//                                         {user.student?.specialty?.name || 'Не е зададена'}
//                                     </div>
//                                 </div>
//
//                                 <div>
//                                     <label className="block text-sm font-medium text-gray-700 mb-1">Група</label>
//                                     <div className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
//                                         <i className="fas fa-users text-gray-400 mr-3"></i>
//                                         {user.student?.group?.name || 'Не е зададена'}
//                                     </div>
//                                 </div>
//
//                                 <div>
//                                     <label className="block text-sm font-medium text-gray-700 mb-1">Семестър</label>
//                                     <div className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
//                                         <i className="fas fa-layer-group text-gray-400 mr-3"></i>
//                                         {user.student?.semester || ''}
//                                     </div>
//                                 </div>
//                             </div>
//                         </div>
//
//                         {/* Настройки на акаунта */}
//                         <div className="profile-card bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
//                             <h2 className="text-xl font-semibold text-gray-800 section-title mb-6">
//                                 <i className="fas fa-cog text-indigo-500"></i> Настройки на акаунта
//                             </h2>
//
//                             <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
//                                 <div>
//                                     <h3 className="text-lg font-medium text-gray-800 mb-4">Смяна на парола</h3>
//                                     <form id="changePasswordForm" className="space-y-4" onSubmit={changePassword}>
//                                         <div>
//                                             <label className="block text-sm font-medium text-gray-700 mb-1">Настояща парола</label>
//                                             <input
//                                                 type="password"
//                                                 name="current_password"
//                                                 value={passwordForm.current_password}
//                                                 onChange={handlePasswordChange}
//                                                 className="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
//                                                 required
//                                             />
//                                         </div>
//
//                                         <div>
//                                             <label className="block text-sm font-medium text-gray-700 mb-1">Нова парола</label>
//                                             <input
//                                                 type="password"
//                                                 name="new_password"
//                                                 value={passwordForm.new_password}
//                                                 onChange={handlePasswordChange}
//                                                 className="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
//                                                 required
//                                             />
//                                         </div>
//
//                                         <div>
//                                             <label className="block text-sm font-medium text-gray-700 mb-1">Потвърди новата парола</label>
//                                             <input
//                                                 type="password"
//                                                 name="new_password_confirmation"
//                                                 value={passwordForm.new_password_confirmation}
//                                                 onChange={handlePasswordChange}
//                                                 className="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
//                                                 required
//                                             />
//                                         </div>
//
//                                         <button
//                                             type="submit"
//                                             className="px-5 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 font-medium transition-colors flex items-center"
//                                             disabled={isLoading}
//                                         >
//                                             <i className="fas fa-key mr-2"></i>
//                                             {isLoading ? 'Смяна...' : 'Смени парола'}
//                                         </button>
//                                     </form>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                 </main>
//             </div>
//         </div>
//     );
// };
//
// // Header Component
// const Header = ({ user, logout }) => {
//     const [dropdownOpen, setDropdownOpen] = useState(false);
//     const [mobileNavOpen, setMobileNavOpen] = useState(false);
//
//     return (
//         <header id="siteHeader" className="bg-white border-b border-gray-200 sticky top-0 z-30">
//             <div className="container-fluid py-1 flex items-center gap-3 px-4 relative">
//                 <a className="navbar-brand m-4 text-xl font-semibold text-indigo-700">
//                     <i className="fas fa-graduation-cap"></i>
//                     UNI Portal
//                 </a>
//
//                 <div className="header-nav ms-10 hidden md:flex">
//                     {user.role === 'student' && (
//                         <>
//                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/exams">
//                                 <i className="fa fa-file-pen me-2 text-gray-500"></i>Достъпни изпити
//                             </a>
//                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/my-exams">
//                                 <i className="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
//                             </a>
//                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/my-past-exams">
//                                 <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
//                             </a>
//                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/payments">
//                                 <i className="fa fa-wallet me-2 text-gray-500"></i>Плащания
//                             </a>
//                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/student-profile">
//                                 <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
//                             </a>
//                         </>
//                     )}
//                 </div>
//
//                 <div className="d-flex align-items-center gap-3 ms-auto profile-section">
//                     <button
//                         className="mobile-nav-toggle"
//                         id="mobileNavToggle"
//                         onClick={() => setMobileNavOpen(!mobileNavOpen)}
//                     >
//                         <i className="fas fa-bars"></i>
//                     </button>
//
//                     <div className="relative">
//                         <button
//                             className="dropdown-toggle btn btn-outline-primary flex items-center gap-2 px-3 py-1.5 border border-indigo-300 rounded-full text-indigo-700 hover:bg-indigo-50"
//                             onClick={() => setDropdownOpen(!dropdownOpen)}
//                         >
//                             <i className="fa fa-user-circle"></i> {user.first_name} {user.last_name}
//                         </button>
//                         {dropdownOpen && (
//                             <ul className="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
//                                 <li>
//                                     <a className="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="/student-profile">
//                                         Моят профил
//                                     </a>
//                                 </li>
//                                 <li>
//                                     <hr className="dropdown-divider my-2 border-gray-200" />
//                                 </li>
//                                 <li>
//                                     <button
//                                         className="dropdown-item text-danger block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
//                                         onClick={logout}
//                                     >
//                                         Изход
//                                     </button>
//                                 </li>
//                             </ul>
//                         )}
//                     </div>
//                 </div>
//
//                 {mobileNavOpen && (
//                     <div className="mobile-nav-dropdown absolute top-full left-0 right-0 bg-white shadow-lg z-40 md:hidden">
//                         {user.role === 'student' && (
//                             <>
//                                 <a className="nav-link flex items-center text-gray-700 p-4 border-b border-gray-100" href="/exams">
//                                     <i className="fa fa-file-pen me-2 text-gray-500"></i>Достъпни изпити
//                                 </a>
//                                 <a className="nav-link flex items-center text-gray-700 p-4 border-b border-gray-100" href="/my-exams">
//                                     <i className="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
//                                 </a>
//                                 <a className="nav-link flex items-center text-gray-700 p-4 border-b border-gray-100" href="/my-past-exams">
//                                     <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
//                                 </a>
//                                 <a className="nav-link flex items-center text-gray-700 p-4 border-b border-gray-100" href="/payments">
//                                     <i className="fa fa-wallet me-2 text-gray-500"></i>Плащания
//                                 </a>
//                                 <a className="nav-link flex items-center text-gray-700 p-4 border-b border-gray-100" href="/student-profile">
//                                     <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
//                                 </a>
//                             </>
//                         )}
//                     </div>
//                 )}
//             </div>
//         </header>
//     );
// };
//
// // Sidebar Component
// const Sidebar = ({ user }) => {
//     return (
//         <aside id="sidebar" className="fixed left-0 top-0 h-full w-80 bg-white shadow-lg z-20 hidden lg:block">
//             <div className="flex flex-col h-full p-6">
//                 <h2 className="text-xl font-semibold text-gray-900 mb-6 pb-4 border-b border-gray-100 flex items-center">
//                     <div className="w-10 h-10 rounded-lg flex items-center justify-center mr-3 overflow-hidden">
//                         <img src="/images/tu-image.png" alt="Лого" className="w-full h-full object-cover" loading="lazy" />
//                     </div>
//                     Студентски профил
//                 </h2>
//
//                 <div className="space-y-5 flex-1">
//                     <div className="flex items-center gap-4">
//                         <div className="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center">
//                             <i className="fas fa-user text-xl text-indigo-600"></i>
//                         </div>
//                         <div>
//                             <p className="font-medium text-gray-900">
//                                 {user.first_name} {user.second_name} {user.last_name}
//                             </p>
//                             <p className="text-sm text-gray-500 mt-1">
//                                 №: <span className="font-mono">{user.student?.faculty_number}</span>
//                             </p>
//                         </div>
//                     </div>
//
//                     <div className="space-y-3.5 mt-4">
//                         <div>
//                             <p className="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Специалност/Факултет</p>
//                             <p className="font-medium text-gray-800">
//                                 {user.student?.specialty?.name} / {user.student?.faculty?.name}
//                             </p>
//                         </div>
//
//                         <div>
//                             <p className="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Потребителско име</p>
//                             <p className="font-medium text-gray-800">{user.username}</p>
//                         </div>
//                         <div>
//                             <p className="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Майл</p>
//                             <p className="font-medium text-gray-800">{user.email}</p>
//                         </div>
//                         <div>
//                             <p className="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Телефонен номер</p>
//                             <p className="font-medium text-gray-800">{user.phone}</p>
//                         </div>
//
//                         <div>
//                             <p className="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Статус</p>
//                             {user.student?.semester < 8 ? (
//                                 <p className="font-medium text-green-600 flex items-center gap-1.5">
//                                     <i className="fas fa-check-circle"></i>Активен
//                                 </p>
//                             ) : (
//                                 <p className="font-medium text-red-600 flex items-center gap-1.5">
//                                     <i className="fas fa-times-circle"></i>Неактивен
//                                 </p>
//                             )}
//                         </div>
//                     </div>
//                 </div>
//
//                 <div className="pt-4 border-t border-gray-100">
//                     <button
//                         className="w-full flex items-center justify-center gap-2 px-4 py-3 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors"
//                         onClick={() => {
//                             // Handle logout
//                             document.getElementById('logout-form').submit();
//                         }}
//                     >
//                         <i className="fas fa-sign-out-alt"></i>
//                         <span>Изход от системата</span>
//                     </button>
//                     <form id="logout-form" action="/logout" method="POST" className="hidden">
//                         <input type="hidden" name="_token" value="{{ csrf_token() }}" />
//                     </form>
//                 </div>
//             </div>
//         </aside>
//     );
// };
//
// export default StudentProfile;
// import React, { useState, useEffect } from 'react';
// import axios from 'axios';
// import { useAuth } from '../hooks/useAuth.jsx';
//
// const StudentProfile = () => {
//     const { user, isLoading } = useAuth();
//     const [profileData, setProfileData] = useState({
//         email: '',
//         phone: ''
//     });
//     const [passwordData, setPasswordData] = useState({
//         current_password: '',
//         new_password: '',
//         new_password_confirmation: ''
//     });
//     const [message, setMessage] = useState('');
//     const [error, setError] = useState('');
//
//     // Зареждане на данните при инициализация
//     useEffect(() => {
//         if (user) {
//             setProfileData({
//                 email: user.email || '',
//                 phone: user.phone || ''
//             });
//         }
//     }, [user]);
//
//     const handleProfileChange = (e) => {
//         setProfileData({
//             ...profileData,
//             [e.target.name]: e.target.value
//         });
//     };
//
//     const handlePasswordChange = (e) => {
//         setPasswordData({
//             ...passwordData,
//             [e.target.name]: e.target.value
//         });
//     };
//
//     const handleProfileSubmit = async (e) => {
//         e.preventDefault();
//         try {
//             const response = await axios.put('/api/student-profile-profile', profileData);
//             setMessage(response.data.success || 'Профилът е обновен успешно');
//             setError('');
//         } catch (err) {
//             setError(err.response?.data?.message || 'Възникна грешка при актуализирането');
//             setMessage('');
//         }
//     };
//
//     const handlePasswordSubmit = async (e) => {
//         e.preventDefault();
//         try {
//             const response = await axios.put('/api/student-profile/password', passwordData);
//             setMessage(response.data.success || 'Паролата е сменена успешно');
//             setError('');
//             setPasswordData({
//                 current_password: '',
//                 new_password: '',
//                 new_password_confirmation: ''
//             });
//         } catch (err) {
//             setError(err.response?.data?.message || 'Възникна грешка при промяната на паролата');
//             setMessage('');
//         }
//     };
//
//     if (isLoading) {
//         return <div>Зареждане...</div>;
//     }
//
//     return (
//         <div className="container mx-auto p-4">
//             <h1 className="text-2xl font-bold mb-6">Студентски профил</h1>
//
//             {message && <div className="bg-green-100 text-green-700 p-3 rounded mb-4">{message}</div>}
//             {error && <div className="bg-red-100 text-red-700 p-3 rounded mb-4">{error}</div>}
//
//             <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
//                 {/* Форма за профил */}
//                 <div className="bg-white p-6 rounded shadow">
//                     <h2 className="text-xl font-semibold mb-4">Актуализиране на профил</h2>
//                     <form onSubmit={handleProfileSubmit}>
//                         <div className="mb-4">
//                             <label className="block text-gray-700 mb-2" htmlFor="email">
//                                 Имейл
//                             </label>
//                             <input
//                                 type="email"
//                                 id="email"
//                                 name="email"
//                                 value={profileData.email}
//                                 onChange={handleProfileChange}
//                                 className="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
//                                 required
//                             />
//                         </div>
//
//                         <div className="mb-4">
//                             <label className="block text-gray-700 mb-2" htmlFor="phone">
//                                 Телефон
//                             </label>
//                             <input
//                                 type="tel"
//                                 id="phone"
//                                 name="phone"
//                                 value={profileData.phone}
//                                 onChange={handleProfileChange}
//                                 className="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
//                             />
//                         </div>
//
//                         <button
//                             type="submit"
//                             className="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition"
//                         >
//                             Запази промените
//                         </button>
//                     </form>
//                 </div>
//
//                 {/* Форма за парола */}
//                 <div className="bg-white p-6 rounded shadow">
//                     <h2 className="text-xl font-semibold mb-4">Промяна на парола</h2>
//                     <form onSubmit={handlePasswordSubmit}>
//                         <div className="mb-4">
//                             <label className="block text-gray-700 mb-2" htmlFor="current_password">
//                                 Настояща парола
//                             </label>
//                             <input
//                                 type="password"
//                                 id="current_password"
//                                 name="current_password"
//                                 value={passwordData.current_password}
//                                 onChange={handlePasswordChange}
//                                 className="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
//                                 required
//                             />
//                         </div>
//
//                         <div className="mb-4">
//                             <label className="block text-gray-700 mb-2" htmlFor="new_password">
//                                 Нова парола
//                             </label>
//                             <input
//                                 type="password"
//                                 id="new_password"
//                                 name="new_password"
//                                 value={passwordData.new_password}
//                                 onChange={handlePasswordChange}
//                                 className="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
//                                 required
//                                 minLength="8"
//                             />
//                         </div>
//
//                         <div className="mb-4">
//                             <label className="block text-gray-700 mb-2" htmlFor="new_password_confirmation">
//                                 Потвърди новата парола
//                             </label>
//                             <input
//                                 type="password"
//                                 id="new_password_confirmation"
//                                 name="new_password_confirmation"
//                                 value={passwordData.new_password_confirmation}
//                                 onChange={handlePasswordChange}
//                                 className="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
//                                 required
//                                 minLength="8"
//                             />
//                         </div>
//
//                         <button
//                             type="submit"
//                             className="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition"
//                         >
//                             Промени паролата
//                         </button>
//                     </form>
//                 </div>
//             </div>
//         </div>
//     );
// };
//
// export default StudentProfile;
// import React, { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
// import api from './api';
//
// const StudentProfile = () => {
//     const { user, isLoading } = useAuth();
//     const [profileData, setProfileData] = useState({
//         email: '',
//         phone: ''
//     });
//     const [passwordData, setPasswordData] = useState({
//         current_password: '',
//         new_password: '',
//         new_password_confirmation: ''
//     });
//     const [editMode, setEditMode] = useState(false);
//     const [message, setMessage] = useState('');
//     const [error, setError] = useState('');
//     const [originalData, setOriginalData] = useState({});
//
//     // Зареждане на данните при инициализация
//     useEffect(() => {
//         if (user) {
//             const userData = {
//                 email: user.email || '',
//                 phone: user.phone || ''
//             };
//             setProfileData(userData);
//             setOriginalData(userData);
//         }
//     }, [user]);
//
//     const handleProfileChange = (e) => {
//         setProfileData({
//             ...profileData,
//             [e.target.name]: e.target.value
//         });
//     };
//
//     const handlePasswordChange = (e) => {
//         setPasswordData({
//             ...passwordData,
//             [e.target.name]: e.target.value
//         });
//     };
//
//     const handleEditToggle = () => {
//         if (editMode) {
//             // Ако отказваме редактирането, връщаме оригиналните стойности
//             setProfileData(originalData);
//         }
//         setEditMode(!editMode);
//     };
//
//     const handleProfileSubmit = async (e) => {
//         e.preventDefault();
//         try {
//             const response = await api.put('/student-profile-profile', profileData);
//             setMessage(response.data.success || 'Профилът е обновен успешно');
//             setError('');
//             setEditMode(false);
//             setOriginalData(profileData); // Запазваме новите данни като оригинални
//         } catch (err) {
//             setError(err.response?.data?.message || 'Възникна грешка при актуализирането');
//             setMessage('');
//         }
//     };
//
//     const handlePasswordSubmit = async (e) => {
//         e.preventDefault();
//         try {
//             const response = await api.put('/student-profile/password', passwordData);
//             setMessage(response.data.success || 'Паролата е сменена успешно');
//             setError('');
//             setPasswordData({
//                 current_password: '',
//                 new_password: '',
//                 new_password_confirmation: ''
//             });
//         } catch (err) {
//             setError(err.response?.data?.message || 'Възникна грешка при промяната на паролата');
//             setMessage('');
//         }
//     };
//
//     if (isLoading) {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center">
//                 <div className="text-center">
//                     <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600 mx-auto"></div>
//                     <p className="mt-4 text-gray-600">Зареждане на профила...</p>
//                 </div>
//             </div>
//         );
//     }
//
//     if (!user) {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center">
//                 <div className="text-center">
//                     <p className="text-red-600">Грешка при зареждане на потребителските данни.</p>
//                 </div>
//             </div>
//         );
//     }
//
//     return (
//         <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 font-[Inter] overflow-x-hidden">
//             <div className="ml-0 lg:ml-80 p-4 lg:p-8 transition-all duration-300">
//                 {/* Заглавие на страницата */}
//                 <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                     <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                         <div>
//                             <h1 className="text-2xl font-bold text-gray-800">Моят профил</h1>
//                             <p className="text-sm text-gray-500 mt-1">Лична информация и настройки на акаунта</p>
//                         </div>
//                     </div>
//                 </div>
//
//                 {/* Съобщения за грешка и успех */}
//                 {message && (
//                     <div className="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
//                         <span className="block sm:inline">{message}</span>
//                     </div>
//                 )}
//                 {error && (
//                     <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
//                         <span className="block sm:inline">{error}</span>
//                     </div>
//                 )}
//
//                 {/* Основно съдържание */}
//                 <div className="space-y-6">
//                     {/* Лична информация */}
//                     <div className="profile-card bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
//                         <div className="flex flex-wrap items-center justify-between mb-6 gap-4">
//                             <h2 className="text-xl font-semibold text-gray-800 section-title">
//                                 <i className="fas fa-user-circle text-indigo-500 mr-2"></i> Лична информация
//                             </h2>
//                             <button
//                                 onClick={handleEditToggle}
//                                 className="text-indigo-600 hover:text-indigo-800 flex items-center bg-indigo-50 px-4 py-2 rounded-lg"
//                             >
//                                 <i className="fas fa-edit mr-2"></i>
//                                 {editMode ? 'Откажи' : 'Редактирай'}
//                             </button>
//                         </div>
//
//                         <div className="flex flex-col lg:flex-row gap-8">
//                             <div className="flex flex-col items-center lg:items-start lg:w-1/3 lg:pl-12">
//                                 <div className="relative mb-4">
//                                     <img
//                                         src={`https://ui-avatars.com/api/?name=${encodeURIComponent(user.first_name + ' ' + user.last_name)}&background=4f46e5&color=fff`}
//                                         alt="Profile"
//                                         className="w-40 h-40 rounded-full object-cover border-4 border-indigo-100 shadow-lg"
//                                     />
//                                     <label className="absolute bottom-3 right-3 bg-indigo-500 text-white p-2 rounded-full cursor-pointer hover:bg-indigo-600 shadow-md transition-all">
//                                         <i className="fas fa-camera"></i>
//                                         <input type="file" className="hidden" accept="image/*" />
//                                     </label>
//                                 </div>
//                             </div>
//
//                             <div className="flex-1">
//                                 <form id="personalInfoForm" onSubmit={handleProfileSubmit} className="info-grid">
//                                     <div>
//                                         <label className="block text-sm font-medium text-gray-700 mb-1">Пълно име</label>
//                                         <input
//                                             type="text"
//                                             value={`${user.first_name} ${user.last_name}`}
//                                             className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
//                                             disabled
//                                         />
//                                     </div>
//
//                                     <div>
//                                         <label className="block text-sm font-medium text-gray-700 mb-1">Факултетен номер</label>
//                                         <input
//                                             type="text"
//                                             value={user.student?.faculty_number || ''}
//                                             className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-100"
//                                             disabled
//                                         />
//                                     </div>
//
//                                     <div>
//                                         <label className="block text-sm font-medium text-gray-700 mb-1">Имейл адрес</label>
//                                         <input
//                                             type="email"
//                                             name="email"
//                                             value={profileData.email}
//                                             onChange={handleProfileChange}
//                                             className={`w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 ${
//                                                 editMode ? 'bg-white ring-2 ring-indigo-100' : 'bg-gray-50'
//                                             }`}
//                                             disabled={!editMode}
//                                         />
//                                     </div>
//
//                                     <div>
//                                         <label className="block text-sm font-medium text-gray-700 mb-1">Телефон</label>
//                                         <input
//                                             type="tel"
//                                             name="phone"
//                                             value={profileData.phone}
//                                             onChange={handleProfileChange}
//                                             className={`w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 ${
//                                                 editMode ? 'bg-white ring-2 ring-indigo-100' : 'bg-gray-50'
//                                             }`}
//                                             disabled={!editMode}
//                                         />
//                                     </div>
//                                 </form>
//                             </div>
//                         </div>
//
//                         <div className={`mt-8 flex space-x-4 justify-end ${editMode ? '' : 'hidden'}`}>
//                             <button
//                                 type="button"
//                                 onClick={handleEditToggle}
//                                 className="px-5 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 font-medium transition-colors"
//                             >
//                                 Откажи
//                             </button>
//                             <button
//                                 type="submit"
//                                 form="personalInfoForm"
//                                 className="px-5 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 font-medium transition-colors"
//                             >
//                                 Запази промените
//                             </button>
//                         </div>
//                     </div>
//
//                     {/* Академична информация */}
//                     <div className="profile-card bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
//                         <div className="flex flex-wrap items-center justify-between mb-6 gap-4">
//                             <h2 className="text-xl font-semibold text-gray-800 section-title">
//                                 <i className="fas fa-graduation-cap text-indigo-500 mr-2"></i> Академична информация
//                             </h2>
//                             {user.student?.semester < 8 ? (
//                                 <span className="px-4 py-2 bg-green-100 text-green-800 text-sm font-medium rounded-full flex items-center">
//                   <i className="fas fa-check-circle mr-2"></i> Активен
//                 </span>
//                             ) : (
//                                 <span className="px-4 py-2 bg-red-100 text-red-700 text-sm font-medium rounded-full flex items-center">
//                   <i className="fas fa-times-circle mr-2"></i> Неактивен
//                 </span>
//                             )}
//                         </div>
//
//                         <div className="info-grid">
//                             <div>
//                                 <label className="block text-sm font-medium text-gray-700 mb-1">Факултет</label>
//                                 <div className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
//                                     <i className="fas fa-university text-gray-400 mr-3"></i>
//                                     {user.student?.faculty?.name || 'Не е зададен'}
//                                 </div>
//                             </div>
//
//                             <div>
//                                 <label className="block text-sm font-medium text-gray-700 mb-1">Специалност</label>
//                                 <div className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
//                                     <i className="fas fa-book-open text-gray-400 mr-3"></i>
//                                     {user.student?.specialty?.name || 'Не е зададена'}
//                                 </div>
//                             </div>
//
//                             <div>
//                                 <label className="block text-sm font-medium text-gray-700 mb-1">Група</label>
//                                 <div className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
//                                     <i className="fas fa-users text-gray-400 mr-3"></i>
//                                     {user.student?.group?.name || 'Не е зададена'}
//                                 </div>
//                             </div>
//
//                             <div>
//                                 <label className="block text-sm font-medium text-gray-700 mb-1">Семестър</label>
//                                 <div className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
//                                     <i className="fas fa-layer-group text-gray-400 mr-3"></i>
//                                     {user.student?.semester || ''}
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//
//                     {/* Настройки на акаунта */}
//                     <div className="profile-card bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
//                         <h2 className="text-xl font-semibold text-gray-800 section-title mb-6">
//                             <i className="fas fa-cog text-indigo-500 mr-2"></i> Настройки на акаунта
//                         </h2>
//
//                         <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
//                             <div>
//                                 <h3 className="text-lg font-medium text-gray-800 mb-4">Смяна на парола</h3>
//                                 <form id="changePasswordForm" onSubmit={handlePasswordSubmit} className="space-y-4">
//                                     <div>
//                                         <label className="block text-sm font-medium text-gray-700 mb-1">Настояща парола</label>
//                                         <input
//                                             type="password"
//                                             name="current_password"
//                                             value={passwordData.current_password}
//                                             onChange={handlePasswordChange}
//                                             className="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
//                                             required
//                                         />
//                                     </div>
//
//                                     <div>
//                                         <label className="block text-sm font-medium text-gray-700 mb-1">Нова парола</label>
//                                         <input
//                                             type="password"
//                                             name="new_password"
//                                             value={passwordData.new_password}
//                                             onChange={handlePasswordChange}
//                                             className="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
//                                             required
//                                             minLength="8"
//                                         />
//                                     </div>
//
//                                     <div>
//                                         <label className="block text-sm font-medium text-gray-700 mb-1">Потвърди новата парола</label>
//                                         <input
//                                             type="password"
//                                             name="new_password_confirmation"
//                                             value={passwordData.new_password_confirmation}
//                                             onChange={handlePasswordChange}
//                                             className="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
//                                             required
//                                             minLength="8"
//                                         />
//                                     </div>
//
//                                     <button
//                                         type="submit"
//                                         className="px-5 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 font-medium transition-colors flex items-center"
//                                     >
//                                         <i className="fas fa-key mr-2"></i> Смени парола
//                                     </button>
//                                 </form>
//                             </div>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//
//             <style jsx>{`
//         .profile-card {
//           transition: all 0.3s ease;
//         }
//         .profile-card:hover {
//           transform: translateY(-2px);
//           box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
//         }
//         .section-title {
//           position: relative;
//           padding-left: 2.5rem;
//         }
//         .info-grid {
//           display: grid;
//           grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
//           gap: 1.5rem;
//         }
//
//         @media (max-width: 1024px) {
//           .section-title {
//             padding-left: 2rem;
//           }
//           .info-grid {
//             grid-template-columns: 1fr;
//           }
//         }
//       `}</style>
//         </div>
//     );
// };
//
// export default StudentProfile;
// StudentProfile.jsx
// import React, { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
// import Header from './Header';
// import Sidebar from './Sidebar';
// import Alert from './Alert';
//
// const StudentProfile = () => {
//     const { user, logout } = useAuth();
//     const [isEditing, setIsEditing] = useState(false);
//     const [personalInfo, setPersonalInfo] = useState({
//         email: '',
//         phone: ''
//     });
//     const [passwordForm, setPasswordForm] = useState({
//         current_password: '',
//         new_password: '',
//         new_password_confirmation: ''
//     });
//     const [alerts, setAlerts] = useState({
//         success: '',
//         error: ''
//     });
//     const [originalData, setOriginalData] = useState({});
//     const [isLoading, setIsLoading] = useState(false);
//
//     useEffect(() => {
//         if (user) {
//             const userData = {
//                 email: user.email || '',
//                 phone: user.phone || ''
//             };
//             setPersonalInfo(userData);
//             setOriginalData(userData);
//         }
//     }, [user]);
//
//     const handlePersonalInfoChange = (e) => {
//         const { name, value } = e.target;
//         setPersonalInfo(prev => ({
//             ...prev,
//             [name]: value
//         }));
//     };
//
//     const handlePasswordChange = (e) => {
//         const { name, value } = e.target;
//         setPasswordForm(prev => ({
//             ...prev,
//             [name]: value
//         }));
//     };
//
//     const handleEditToggle = () => {
//         if (isEditing) {
//             // При отказване връщаме оригиналните стойности
//             setPersonalInfo(originalData);
//         }
//         setIsEditing(!isEditing);
//     };
//
//     const updateProfile = async (e) => {
//         e.preventDefault();
//         setIsLoading(true);
//
//         try {
//             // Тук ще се добави логиката за API заявка
//             console.log('Updating profile with:', personalInfo);
//
//             // Симулиране на успешно изпълнение
//             setTimeout(() => {
//                 setAlerts({
//                     success: 'Профилът е обновен успешно',
//                     error: ''
//                 });
//                 setIsEditing(false);
//                 setOriginalData(personalInfo);
//                 setIsLoading(false);
//             }, 1000);
//         } catch (error) {
//             setAlerts({
//                 success: '',
//                 error: 'Грешка при обновяване на профила'
//             });
//             setIsLoading(false);
//         }
//     };
//
//     const changePassword = async (e) => {
//         e.preventDefault();
//         setIsLoading(true);
//
//         try {
//             // Тук ще се добави логиката за API заявка
//             console.log('Changing password with:', passwordForm);
//
//             // Симулиране на успешно изпълнение
//             setTimeout(() => {
//                 setAlerts({
//                     success: 'Паролата е сменена успешно',
//                     error: ''
//                 });
//                 setPasswordForm({
//                     current_password: '',
//                     new_password: '',
//                     new_password_confirmation: ''
//                 });
//                 setIsLoading(false);
//             }, 1000);
//         } catch (error) {
//             setAlerts({
//                 success: '',
//                 error: 'Грешка при смяна на паролата'
//             });
//             setIsLoading(false);
//         }
//     };
//
//     const closeAlert = (type) => {
//         setAlerts(prev => ({ ...prev, [type]: '' }));
//     };
//
//     if (!user) {
//         return (
//             <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center">
//                 <div className="text-center">
//                     <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600 mx-auto"></div>
//                     <p className="mt-4 text-gray-600">Зареждане на профила...</p>
//                 </div>
//             </div>
//         );
//     }
//
//     return (
//         <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden">
//             <Header user={user} logout={logout} />
//
//             <div className="page-layout">
//                 <Sidebar user={user} />
//
//                 <main className="p-4 lg:p-6">
//                     {/* Page Title Section */}
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Моят профил</h1>
//                                 <p className="text-sm text-gray-500 mt-1">Лична информация и настройки на акаунта</p>
//                             </div>
//                         </div>
//                     </div>
//
//                     {/* Alerts */}
//                     {alerts.success && (
//                         <Alert
//                             type="success"
//                             message={alerts.success}
//                             onClose={() => closeAlert('success')}
//                         />
//                     )}
//                     {alerts.error && (
//                         <Alert
//                             type="error"
//                             message={alerts.error}
//                             onClose={() => closeAlert('error')}
//                         />
//                     )}
//
//                     {/* Profile Content */}
//                     <div className="space-y-6">
//                         {/* Лична информация */}
//                         <div className="profile-card bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
//                             <div className="flex flex-wrap items-center justify-between mb-6 gap-4">
//                                 <h2 className="text-xl font-semibold text-gray-800 section-title">
//                                     <i className="fas fa-user-circle text-indigo-500 mr-2"></i> Лична информация
//                                 </h2>
//                                 <button
//                                     onClick={handleEditToggle}
//                                     className="text-indigo-600 hover:text-indigo-800 flex items-center bg-indigo-50 px-4 py-2 rounded-lg"
//                                 >
//                                     <i className="fas fa-edit mr-2"></i>
//                                     {isEditing ? 'Откажи' : 'Редактирай'}
//                                 </button>
//                             </div>
//
//                             <div className="flex flex-col lg:flex-row gap-8">
//                                 <div className="flex flex-col items-center lg:items-start lg:w-1/3 lg:pl-12">
//                                     <div className="relative mb-4">
//                                         <img
//                                             src={`https://ui-avatars.com/api/?name=${encodeURIComponent(user.first_name + ' ' + user.last_name)}&background=4f46e5&color=fff`}
//                                             alt="Profile"
//                                             className="w-40 h-40 rounded-full object-cover border-4 border-indigo-100 shadow-lg"
//                                         />
//                                         <label className="absolute bottom-3 right-3 bg-indigo-500 text-white p-2 rounded-full cursor-pointer hover:bg-indigo-600 shadow-md transition-all">
//                                             <i className="fas fa-camera"></i>
//                                             <input type="file" className="hidden" accept="image/*" />
//                                         </label>
//                                     </div>
//                                 </div>
//
//                                 <div className="flex-1">
//                                     <form id="personalInfoForm" onSubmit={updateProfile} className="info-grid">
//                                         <div>
//                                             <label className="block text-sm font-medium text-gray-700 mb-1">Пълно име</label>
//                                             <input
//                                                 type="text"
//                                                 value={`${user.first_name} ${user.last_name}`}
//                                                 className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
//                                                 disabled
//                                             />
//                                         </div>
//
//                                         <div>
//                                             <label className="block text-sm font-medium text-gray-700 mb-1">Факултетен номер</label>
//                                             <input
//                                                 type="text"
//                                                 value={user.student?.faculty_number || ''}
//                                                 className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-100"
//                                                 disabled
//                                             />
//                                         </div>
//
//                                         <div>
//                                             <label className="block text-sm font-medium text-gray-700 mb-1">Имейл адрес</label>
//                                             <input
//                                                 type="email"
//                                                 name="email"
//                                                 value={personalInfo.email}
//                                                 onChange={handlePersonalInfoChange}
//                                                 className={`w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 ${
//                                                     isEditing ? 'bg-white ring-2 ring-indigo-100' : 'bg-gray-50'
//                                                 }`}
//                                                 disabled={!isEditing}
//                                             />
//                                         </div>
//
//                                         <div>
//                                             <label className="block text-sm font-medium text-gray-700 mb-1">Телефон</label>
//                                             <input
//                                                 type="tel"
//                                                 name="phone"
//                                                 value={personalInfo.phone}
//                                                 onChange={handlePersonalInfoChange}
//                                                 className={`w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 ${
//                                                     isEditing ? 'bg-white ring-2 ring-indigo-100' : 'bg-gray-50'
//                                                 }`}
//                                                 disabled={!isEditing}
//                                             />
//                                         </div>
//                                     </form>
//                                 </div>
//                             </div>
//
//                             {isEditing && (
//                                 <div className="mt-8 flex space-x-4 justify-end">
//                                     <button
//                                         type="button"
//                                         onClick={handleEditToggle}
//                                         className="px-5 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 font-medium transition-colors"
//                                     >
//                                         Откажи
//                                     </button>
//                                     <button
//                                         type="submit"
//                                         form="personalInfoForm"
//                                         className="px-5 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 font-medium transition-colors"
//                                         disabled={isLoading}
//                                     >
//                                         {isLoading ? 'Запазване...' : 'Запази промените'}
//                                     </button>
//                                 </div>
//                             )}
//                         </div>
//
//                         {/* Академична информация */}
//                         <div className="profile-card bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
//                             <div className="flex flex-wrap items-center justify-between mb-6 gap-4">
//                                 <h2 className="text-xl font-semibold text-gray-800 section-title">
//                                     <i className="fas fa-graduation-cap text-indigo-500 mr-2"></i> Академична информация
//                                 </h2>
//                                 {user.student?.semester < 8 ? (
//                                     <span className="px-4 py-2 bg-green-100 text-green-800 text-sm font-medium rounded-full flex items-center">
//                                         <i className="fas fa-check-circle mr-2"></i> Активен
//                                     </span>
//                                 ) : (
//                                     <span className="px-4 py-2 bg-red-100 text-red-700 text-sm font-medium rounded-full flex items-center">
//                                         <i className="fas fa-times-circle mr-2"></i> Неактивен
//                                     </span>
//                                 )}
//                             </div>
//
//                             <div className="info-grid">
//                                 <div>
//                                     <label className="block text-sm font-medium text-gray-700 mb-1">Факултет</label>
//                                     <div className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
//                                         <i className="fas fa-university text-gray-400 mr-3"></i>
//                                         {user.student?.faculty?.name || 'Не е зададен'}
//                                     </div>
//                                 </div>
//
//                                 <div>
//                                     <label className="block text-sm font-medium text-gray-700 mb-1">Специалност</label>
//                                     <div className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
//                                         <i className="fas fa-book-open text-gray-400 mr-3"></i>
//                                         {user.student?.specialty?.name || 'Не е зададена'}
//                                     </div>
//                                 </div>
//
//                                 <div>
//                                     <label className="block text-sm font-medium text-gray-700 mb-1">Група</label>
//                                     <div className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
//                                         <i className="fas fa-users text-gray-400 mr-3"></i>
//                                         {user.student?.group?.name || 'Не е зададена'}
//                                     </div>
//                                 </div>
//
//                                 <div>
//                                     <label className="block text-sm font-medium text-gray-700 mb-1">Семестър</label>
//                                     <div className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
//                                         <i className="fas fa-layer-group text-gray-400 mr-3"></i>
//                                         {user.student?.semester || ''}
//                                     </div>
//                                 </div>
//                             </div>
//                         </div>
//
//                         {/* Настройки на акаунта */}
//                         <div className="profile-card bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
//                             <h2 className="text-xl font-semibold text-gray-800 section-title mb-6">
//                                 <i className="fas fa-cog text-indigo-500 mr-2"></i> Настройки на акаунта
//                             </h2>
//
//                             <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
//                                 <div>
//                                     <h3 className="text-lg font-medium text-gray-800 mb-4">Смяна на парола</h3>
//                                     <form id="changePasswordForm" onSubmit={changePassword} className="space-y-4">
//                                         <div>
//                                             <label className="block text-sm font-medium text-gray-700 mb-1">Настояща парола</label>
//                                             <input
//                                                 type="password"
//                                                 name="current_password"
//                                                 value={passwordForm.current_password}
//                                                 onChange={handlePasswordChange}
//                                                 className="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
//                                                 required
//                                             />
//                                         </div>
//
//                                         <div>
//                                             <label className="block text-sm font-medium text-gray-700 mb-1">Нова парола</label>
//                                             <input
//                                                 type="password"
//                                                 name="new_password"
//                                                 value={passwordForm.new_password}
//                                                 onChange={handlePasswordChange}
//                                                 className="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
//                                                 required
//                                                 minLength="8"
//                                             />
//                                         </div>
//
//                                         <div>
//                                             <label className="block text-sm font-medium text-gray-700 mb-1">Потвърди новата парола</label>
//                                             <input
//                                                 type="password"
//                                                 name="new_password_confirmation"
//                                                 value={passwordForm.new_password_confirmation}
//                                                 onChange={handlePasswordChange}
//                                                 className="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
//                                                 required
//                                                 minLength="8"
//                                             />
//                                         </div>
//
//                                         <button
//                                             type="submit"
//                                             className="px-5 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 font-medium transition-colors flex items-center"
//                                             disabled={isLoading}
//                                         >
//                                             <i className="fas fa-key mr-2"></i>
//                                             {isLoading ? 'Смяна...' : 'Смени парола'}
//                                         </button>
//                                     </form>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                 </main>
//             </div>
//
//             <style jsx>{`
//                 .profile-card {
//                     transition: all 0.3s ease;
//                 }
//                 .profile-card:hover {
//                     transform: translateY(-2px);
//                     box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
//                 }
//                 .section-title {
//                     position: relative;
//                     padding-left: 2.5rem;
//                 }
//                 .section-title i {
//                     position: absolute;
//                     left: 0;
//                     top: 50%;
//                     transform: translateY(-50%);
//                     font-size: 1.5rem;
//                     width: 2rem;
//                     text-align: center;
//                 }
//                 .info-grid {
//                     display: grid;
//                     grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
//                     gap: 1.5rem;
//                 }
//
//                 @media (max-width: 1024px) {
//                     .section-title {
//                         padding-left: 2rem;
//                     }
//                     .info-grid {
//                         grid-template-columns: 1fr;
//                     }
//                 }
//             `}</style>
//         </div>
//     );
// };
//
// export default StudentProfile;
import React, { useState, useEffect } from 'react';
import { useAuth, api } from '../hooks/useAuth';
import Header from './Header';
import Sidebar from './Sidebar';
import Alert from './Alert';

const StudentProfile = () => {
    const { user, logout } = useAuth();
    const [isEditing, setIsEditing] = useState(false);
    const [personalInfo, setPersonalInfo] = useState({
        email: '',
        phone: ''
    });
    const [passwordForm, setPasswordForm] = useState({
        current_password: '',
        new_password: '',
        new_password_confirmation: ''
    });
    const [alerts, setAlerts] = useState({
        success: '',
        error: ''
    });
    const [originalData, setOriginalData] = useState({});
    const [isLoading, setIsLoading] = useState(false);
    const [errors, setErrors] = useState({
        email: '',
        phone: '',
        current_password: '',
        new_password: '',
        new_password_confirmation: ''
    });

    useEffect(() => {
        if (user) {
            const userData = {
                email: user.email || '',
                phone: user.phone || ''
            };
            setPersonalInfo(userData);
            setOriginalData(userData);
        }
    }, [user]);

    const handlePersonalInfoChange = (e) => {
        const { name, value } = e.target;
        setPersonalInfo(prev => ({
            ...prev,
            [name]: value
        }));

        // Clear error when user starts typing
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

        // Clear error when user starts typing
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
            // Clear errors when canceling
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

        setIsLoading(true);

        try {
            const response = await api.put('/profile-update', personalInfo);
            setAlerts({
                success: response.data.message || 'Профилът е обновен успешно',
                error: ''
            });
            setIsEditing(false);
            setOriginalData(personalInfo);
        } catch (error) {
            if (error.response?.data?.errors) {
                // Handle server-side validation errors
                const serverErrors = error.response.data.errors;
                const newErrors = {};

                if (serverErrors.email) {
                    newErrors.email = serverErrors.email[0];
                }

                if (serverErrors.phone) {
                    newErrors.phone = serverErrors.phone[0];
                }

                setErrors(prev => ({ ...prev, ...newErrors }));

                setAlerts({
                    success: '',
                    error: 'Моля, коригирайте грешките във формата'
                });
            } else {
                const errorMessage = error.response?.data?.message || 'Грешка при обновяване на профила';
                setAlerts({
                    success: '',
                    error: errorMessage
                });
            }
        } finally {
            setIsLoading(false);
        }
    };

    // const changePassword = async (e) => {
    //     e.preventDefault();
    //
    //     if (!validatePasswordForm()) return;
    //
    //     setIsLoading(true);
    //
    //     try {
    //         const response = await api.put('/student-profile/password', passwordForm);
    //         setAlerts({
    //             success: response.data.message || 'Паролата е сменена успешно',
    //             error: ''
    //         });
    //         setPasswordForm({
    //             current_password: '',
    //             new_password: '',
    //             new_password_confirmation: ''
    //         });
    //
    //         // Clear password errors
    //         setErrors(prev => ({
    //             ...prev,
    //             current_password: '',
    //             new_password: '',
    //             new_password_confirmation: ''
    //         }));
    //     } catch (error) {
    //         if (error.response?.data?.errors) {
    //             // Handle server-side validation errors
    //             const serverErrors = error.response.data.errors;
    //             const newErrors = {};
    //
    //             if (serverErrors.current_password) {
    //                 newErrors.current_password = serverErrors.current_password[0];
    //             }
    //
    //             if (serverErrors.new_password) {
    //                 newErrors.new_password = serverErrors.new_password[0];
    //             }
    //
    //             if (serverErrors.new_password_confirmation) {
    //                 newErrors.new_password_confirmation = serverErrors.new_password_confirmation[0];
    //             }
    //
    //             setErrors(prev => ({ ...prev, ...newErrors }));
    //
    //             setAlerts({
    //                 success: '',
    //                 error: 'Моля, коригирайте грешките във формата'
    //             });
    //         } else {
    //             const errorMessage = error.response?.data?.message || 'Грешка при смяна на паролата';
    //             setAlerts({
    //                 success: '',
    //                 error: errorMessage
    //             });
    //         }
    //     } finally {
    //         setIsLoading(false);
    //     }
    // };
    const changePassword = async (e) => {
        e.preventDefault();

        if (!validatePasswordForm()) return;

        setIsLoading(true);

        try {
            const response = await api.put('/student-profile/password', passwordForm);
            setAlerts({
                success: response.data.message || 'Паролата е сменена успешно',
                error: ''
            });
            setPasswordForm({
                current_password: '',
                new_password: '',
                new_password_confirmation: ''
            });

            // Clear password errors
            setErrors(prev => ({
                ...prev,
                current_password: '',
                new_password: '',
                new_password_confirmation: ''
            }));
        } catch (error) {
            console.error('Password change error:', error.response?.data);

            if (error.response?.status === 422) {
                // Handle Laravel validation errors
                const validationErrors = error.response.data.errors || {};
                const newErrors = {};

                // Map server errors to form fields
                Object.keys(validationErrors).forEach(field => {
                    const fieldName = field.replace('new_password_confirmation', 'new_password_confirmation');
                    newErrors[fieldName] = validationErrors[field][0];
                });

                setErrors(prev => ({ ...prev, ...newErrors }));

                setAlerts({
                    success: '',
                    error: 'Моля, коригирайте грешките във формата'
                });
            } else {
                const errorMessage = error.response?.data?.message || 'Грешка при смяна на паролата';
                setAlerts({
                    success: '',
                    error: errorMessage
                });
            }
        } finally {
            setIsLoading(false);
        }
    };
    const closeAlert = (type) => {
        setAlerts(prev => ({ ...prev, [type]: '' }));
    };

    if (!user) {
        return (
            <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center">
                <div className="text-center">
                    <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600 mx-auto"></div>
                    <p className="mt-4 text-gray-600">Зареждане на профила...</p>
                </div>
            </div>
        );
    }

    return (
        <div className="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden">
            <Header user={user} logout={logout} />

            <div className="page-layout">
                <Sidebar user={user} />

                <main className="p-4 lg:p-6">
                    {/* Page Title Section */}
                    <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
                        <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                            <div>
                                <h1 className="text-2xl font-bold text-gray-800">Моят профил</h1>
                                <p className="text-sm text-gray-500 mt-1">Лична информация и настройки на акаунта</p>
                            </div>
                        </div>
                    </div>

                    {/* Alerts */}
                    {alerts.success && (
                        <Alert
                            type="success"
                            message={alerts.success}
                            onClose={() => closeAlert('success')}
                        />
                    )}
                    {alerts.error && (
                        <Alert
                            type="error"
                            message={alerts.error}
                            onClose={() => closeAlert('error')}
                        />
                    )}

                    {/* Profile Content */}
                    <div className="space-y-6">
                        {/* Grid for personal and academic info */}
                        <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            {/* Лична информация */}
                            <div className="profile-card bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
                                <div className="flex flex-wrap items-center justify-between mb-6 gap-4">
                                    <h2 className="text-xl font-semibold text-gray-800 section-title">
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
                                    <div className="flex flex-col items-center lg:items-start lg:w-1/3 lg:pl-12">
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
                                        <form id="personalInfoForm" onSubmit={updateProfile} className="info-grid">
                                            <div>
                                                <label className="block text-sm font-medium text-gray-700 mb-1">Пълно име</label>
                                                <input
                                                    type="text"
                                                    value={`${user.first_name} ${user.last_name}`}
                                                    className="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
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
                                                    className={`w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 ${
                                                        isEditing && errors.email ? 'border-red-500' : ''
                                                    } ${isEditing ? 'bg-white ring-2 ring-indigo-100' : 'bg-gray-50'}`}
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
                                                    className={`w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 ${
                                                        isEditing && errors.phone ? 'border-red-500' : ''
                                                    } ${isEditing ? 'bg-white ring-2 ring-indigo-100' : 'bg-gray-50'}`}
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
                                            disabled={isLoading}
                                        >
                                            {isLoading ? 'Запазване...' : 'Запази промените'}
                                        </button>
                                    </div>
                                )}
                            </div>

                            {/* Академична информация */}
                            <div className="profile-card bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
                                <div className="flex flex-wrap items-center justify-between mb-6 gap-4">
                                    <h2 className="text-xl font-semibold text-gray-800 section-title">
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

                                <div className="info-grid">
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
                        </div>

                        {/* Настройки на акаунта */}
                        <div className="profile-card bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
                            <h2 className="text-xl font-semibold text-gray-800 section-title mb-6">
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
                                            disabled={isLoading}
                                        >
                                            <i className="fas fa-key mr-2"></i>
                                            {isLoading ? 'Смяна...' : 'Смени парола'}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

            <style jsx>{`
                .profile-card {
                    transition: all 0.3s ease;
                }
                .profile-card:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
                }
                .section-title {
                    position: relative;
                    padding-left: 2.5rem;
                }
                .section-title i {
                    position: absolute;
                    left: 0;
                    top: 50%;
                    transform: translateY(-50%);
                    font-size: 1.5rem;
                    width: 2rem;
                    text-align: center;
                }
                .info-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                    gap: 1.5rem;
                }

                @media (max-width: 1024px) {
                    .section-title {
                        padding-left: 2rem;
                    }
                    .info-grid {
                        grid-template-columns: 1fr;
                    }
                }
            `}</style>
        </div>
    );
};

export default StudentProfile;
