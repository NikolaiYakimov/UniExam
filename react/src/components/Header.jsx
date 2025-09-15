// import { useState } from 'react';
// import { useAuth } from '../hooks/useAuth';
//
// export default function Header() {
//     const { user, logout } = useAuth();
//     const [showMobileMenu, setShowMobileMenu] = useState(false);
//     const [showProfileMenu, setShowProfileMenu] = useState(false);
//
//     const handleLogout = () => {
//         logout();
//     };
//
//     return (
//         <header id="siteHeader" className="bg-white border-b border-gray-200 sticky top-0 z-30">
//             <div className="container-fluid py-1 flex items-center gap-3 px-4 relative">
//                 <a className="navbar-brand m-4 text-xl font-semibold text-indigo-700">
//                     <i className="fas fa-graduation-cap"></i>
//                     UNI Portal
//                 </a>
//
//                 <div className="header-nav ms-10">
//                     <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">
//                         <i className="fa fa-home me-2 text-gray-500"></i>Начало
//                     </a>
//                     <a className="nav-link flex items-center text-indigo-700 bg-indigo-50" href="/exams">
//                         <i className="fa fa-file-pen me-2 text-indigo-600"></i>Достъпни изпити
//                     </a>
//                     <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/my-exams">
//                         <i className="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
//                     </a>
//                     <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">
//                         <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
//                     </a>
//                     <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">
//                         <i className="fa fa-wallet me-2 text-gray-500"></i>Плащания
//                     </a>
//                     <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/profile">
//                         <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
//                     </a>
//                 </div>
//
//                 <div className="d-flex align-items-center gap-3 ms-auto profile-section">
//                     <button
//                         className="mobile-nav-toggle"
//                         onClick={() => setShowMobileMenu(!showMobileMenu)}
//                     >
//                         <i className="fas fa-bars"></i>
//                     </button>
//
//                     {user && (
//                         <div className="relative">
//                             <button
//                                 className="dropdown-toggle btn btn-outline-primary flex items-center gap-2 px-3 py-1.5 border border-indigo-300 rounded-full text-indigo-700 hover:bg-indigo-50"
//                                 onClick={() => setShowProfileMenu(!showProfileMenu)}
//                             >
//                                 <i className="fa fa-user-circle"></i> {user.first_name} {user.last_name}
//                             </button>
//
//                             {showProfileMenu && (
//                                 <ul className="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
//                                     <li>
//                                         <a className="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="/profile">
//                                             Моят профил
//                                         </a>
//                                     </li>
//                                     <li>
//                                         <hr className="dropdown-divider my-2 border-gray-200" />
//                                     </li>
//                                     <li>
//                                         <button
//                                             className="dropdown-item text-danger block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
//                                             onClick={handleLogout}
//                                         >
//                                             Изход
//                                         </button>
//                                     </li>
//                                 </ul>
//                             )}
//                         </div>
//                     )}
//                 </div>
//
//                 {showMobileMenu && (
//                     <div className="mobile-nav-dropdown">
//                         <a className="nav-link flex items-center text-gray-700" href="#">
//                             <i className="fa fa-home me-2 text-gray-500"></i>Начало
//                         </a>
//                         <a className="nav-link flex items-center text-indigo-700 bg-indigo-50" href="/exams">
//                             <i className="fa fa-file-pen me-2 text-indigo-600"></i>Достъпни изпити
//                         </a>
//                         <a className="nav-link flex items-center text-gray-700" href="/my-exams">
//                             <i className="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
//                         </a>
//                         <a className="nav-link flex items-center text-gray-700" href="#">
//                             <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
//                         </a>
//                         <a className="nav-link flex items-center text-gray-700" href="#">
//                             <i className="fa fa-wallet me-2 text-gray-500"></i>Плащания
//                         </a>
//                         <a className="nav-link flex items-center text-gray-700" href="/profile">
//                             <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
//                         </a>
//                     </div>
//                 )}
//             </div>
//         </header>
//     );
// }
// import { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
//
// export default function Header() {
//     const { user, logout } = useAuth();
//     const [showMobileMenu, setShowMobileMenu] = useState(false);
//     const [showProfileMenu, setShowProfileMenu] = useState(false);
//
//     const handleLogout = () => {
//         logout();
//     };
//
//     useEffect(() => {
//         const handleClickOutside = (event) => {
//             if (!event.target.closest('.profile-section')) {
//                 setShowProfileMenu(false);
//             }
//             if (!event.target.closest('.mobile-nav-toggle') &&
//                 !event.target.closest('.mobile-nav-dropdown')) {
//                 setShowMobileMenu(false);
//             }
//         };
//
//         document.addEventListener('click', handleClickOutside);
//         return () => document.removeEventListener('click', handleClickOutside);
//     }, []);
//
//     return (
//         <header id="siteHeader" className="bg-white border-b border-gray-200 sticky top-0 z-30">
//             <div className="container-fluid py-1 flex items-center gap-3 px-4 relative">
//                 <a className="navbar-brand m-4 text-xl font-semibold text-indigo-700">
//                     <i className="fas fa-graduation-cap"></i>
//                     UNI Portal
//                 </a>
//
//                 <div className="header-nav ms-10">
//                     <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">
//                         <i className="fa fa-home me-2 text-gray-500"></i>Начало
//                     </a>
//                     <a className="nav-link flex items-center text-indigo-700 bg-indigo-50" href="/exams">
//                         <i className="fa fa-file-pen me-2 text-indigo-600"></i>Достъпни изпити
//                     </a>
//                     <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/my-exams">
//                         <i className="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
//                     </a>
//                     <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">
//                         <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
//                     </a>
//                     <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">
//                         <i className="fa fa-wallet me-2 text-gray-500"></i>Плащания
//                     </a>
//                     <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/profile">
//                         <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
//                     </a>
//                 </div>
//
//                 <div className="d-flex align-items-center gap-3 ms-auto profile-section">
//                     <button
//                         className="mobile-nav-toggle"
//                         onClick={() => setShowMobileMenu(!showMobileMenu)}
//                     >
//                         <i className="fas fa-bars"></i>
//                     </button>
//
//                     {user && (
//                         <div className="relative">
//                             <button
//                                 className="dropdown-toggle btn btn-outline-primary flex items-center gap-2 px-3 py-1.5 border border-indigo-300 rounded-full text-indigo-700 hover:bg-indigo-50"
//                                 onClick={() => setShowProfileMenu(!showProfileMenu)}
//                             >
//                                 <i className="fa fa-user-circle"></i> {user.first_name} {user.last_name}
//                             </button>
//
//                             {showProfileMenu && (
//                                 <ul className="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
//                                     <li>
//                                         <a className="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="/profile">
//                                             Моят профил
//                                         </a>
//                                     </li>
//                                     <li>
//                                         <hr className="dropdown-divider my-2 border-gray-200" />
//                                     </li>
//                                     <li>
//                                         <button
//                                             className="dropdown-item text-danger block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
//                                             onClick={handleLogout}
//                                         >
//                                             Изход
//                                         </button>
//                                     </li>
//                                 </ul>
//                             )}
//                         </div>
//                     )}
//                 </div>
//
//                 {showMobileMenu && (
//                     <div className="mobile-nav-dropdown show">
//                         <a className="nav-link flex items-center text-gray-700" href="#">
//                             <i className="fa fa-home me-2 text-gray-500"></i>Начало
//                         </a>
//                         <a className="nav-link flex items-center text-indigo-700 bg-indigo-50" href="/exams">
//                             <i className="fa fa-file-pen me-2 text-indigo-600"></i>Достъпни изпити
//                         </a>
//                         <a className="nav-link flex items-center text-gray-700" href="/my-exams">
//                             <i className="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
//                         </a>
//                         <a className="nav-link flex items-center text-gray-700" href="#">
//                             <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
//                         </a>
//                         <a className="nav-link flex items-center text-gray-700" href="#">
//                             <i className="fa fa-wallet me-2 text-gray-500"></i>Плащания
//                         </a>
//                         <a className="nav-link flex items-center text-gray-700" href="/profile">
//                             <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
//                         </a>
//                     </div>
//                 )}
//             </div>
//         </header>
//     );
// }
// Header.jsx - Updated to match Blade template
// import { useState, useEffect } from 'react';
// import { useAuth } from '../hooks/useAuth';
// import './RightFile.css';
//
//
// export default function Header() {
//     const { user, logout } = useAuth();
//     const [showMobileMenu, setShowMobileMenu] = useState(false);
//     const [showProfileMenu, setShowProfileMenu] = useState(false);
//
//     const handleLogout = () => {
//         logout();
//     };
//
//     useEffect(() => {
//         const handleClickOutside = (event) => {
//             if (!event.target.closest('.profile-section')) {
//                 setShowProfileMenu(false);
//             }
//             if (!event.target.closest('.mobile-nav-toggle') &&
//                 !event.target.closest('.mobile-nav-dropdown')) {
//                 setShowMobileMenu(false);
//             }
//         };
//
//         document.addEventListener('click', handleClickOutside);
//         return () => document.removeEventListener('click', handleClickOutside);
//     }, []);
//
//     return (
//         <header id="siteHeader" className="bg-white border-b border-gray-200 sticky top-0 z-30">
//             <div className="container-fluid py-1 flex items-center gap-3 px-4 relative">
//                 <a className="navbar-brand m-4 text-xl font-semibold text-indigo-700">
//                     <i className="fas fa-graduation-cap"></i>
//                     UNI Portal
//                 </a>
//
//                 <div className="header-nav ms-10">
//                     {user.role === 'teacher' && (
//                         <>
//                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/teacher-dashboard">
//                                 <i className="fa fa-file-pen me-2 text-gray-500"></i>Предстоящи изпити
//                             </a>
//                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/conducted-exams">
//                                 <i className="fa fa-calendar me-2 text-gray-500"></i>Изминали изпити
//                             </a>
//                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/teacher-subjects">
//                                 <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
//                             </a>
//                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/teacher-profile">
//                                 <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
//                             </a>
//                         </>
//                     )}
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
//                     {user.role === 'administrator' && (
//                         <>
//                             <a className="nav-link flex items-center text-gray-700" href="/admin-subjects">
//                                 <i className="fa fa-file-pen me-2 text-gray-500"></i>Изпити
//                             </a>
//                             <a className="nav-link flex items-center text-gray-700" href="/admin-users">
//                                 <i className="fa fa-wallet me-2 text-gray-500"></i>Създаване на потребители
//                             </a>
//                             <a className="nav-link flex items-center text-gray-700" href="/teacher-subjects">
//                                 <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
//                             </a>
//                             <a className="nav-link flex items-center text-gray-700" href="/teacher-profile">
//                                 <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
//                             </a>
//                         </>
//                     )}
//                 </div>
//
//                 <div className="d-flex align-items-center gap-3 ms-auto profile-section">
//                     <button
//                         className="mobile-nav-toggle"
//                         onClick={() => setShowMobileMenu(!showMobileMenu)}
//                     >
//                         <i className="fas fa-bars"></i>
//                     </button>
//
//                     {user && (
//                         <div className="relative">
//                             <button
//                                 className="dropdown-toggle btn btn-outline-primary flex items-center gap-2 px-3 py-1.5 border border-indigo-300 rounded-full text-indigo-700 hover:bg-indigo-50"
//                                 onClick={() => setShowProfileMenu(!showProfileMenu)}
//                             >
//                                 <i className="fa fa-user-circle"></i> {user.first_name} {user.last_name}
//                             </button>
//
//                             {showProfileMenu && (
//                                 <ul className="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
//                                     <li>
//                                         <a className="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="/profile">
//                                             Моят профил
//                                         </a>
//                                     </li>
//                                     <li>
//                                         <hr className="dropdown-divider my-2 border-gray-200" />
//                                     </li>
//                                     <li>
//                                         <button
//                                             className="dropdown-item text-danger block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
//                                             onClick={handleLogout}
//                                         >
//                                             Изход
//                                         </button>
//                                     </li>
//                                 </ul>
//                             )}
//                         </div>
//                     )}
//                 </div>
//
//                 {showMobileMenu && (
//                     <div className="mobile-nav-dropdown show">
//                         {user.role === 'student' && (
//                             <>
//                                 <a className="nav-link flex items-center text-gray-700" href="/exams">
//                                     <i className="fa fa-file-pen me-2 text-gray-500"></i>Достъпни изпити
//                                 </a>
//                                 <a className="nav-link flex items-center text-gray-700" href="/my-exams">
//                                     <i className="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
//                                 </a>
//                                 <a className="nav-link flex items-center text-gray-700" href="/my-past-exams">
//                                     <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
//                                 </a>
//                                 <a className="nav-link flex items-center text-gray-700" href="/payments">
//                                     <i className="fa fa-wallet me-2 text-gray-500"></i>Плащания
//                                 </a>
//                                 <a className="nav-link flex items-center text-gray-700" href="/student-profile">
//                                     <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
//                                 </a>
//                             </>
//                         )}
//                         {user.role === 'teacher' && (
//                             <>
//                                 <a className="nav-link flex items-center text-gray-700" href="/teacher-dashboard">
//                                     <i className="fa fa-file-pen me-2 text-gray-500"></i>Изпити
//                                 </a>
//                                 <a className="nav-link flex items-center text-gray-700" href="/conducted-exams">
//                                     <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
//                                 </a>
//                                 <a className="nav-link flex items-center text-gray-700" href="/teacher-subjects">
//                                     <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
//                                 </a>
//                                 <a className="nav-link flex items-center text-gray-700" href="/teacher-profile">
//                                     <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
//                                 </a>
//                             </>
//                         )}
//                         {user.role === 'administrator' && (
//                             <>
//                                 <a className="nav-link flex items-center text-gray-700" href="/admin-subjects">
//                                     <i className="fa fa-file-pen me-2 text-gray-500"></i>Изпити
//                                 </a>
//                                 <a className="nav-link flex items-center text-gray-700" href="/admin-users">
//                                     <i className="fa fa-wallet me-2 text-gray-500"></i>Създаване на потребители
//                                 </a>
//                                 <a className="nav-link flex items-center text-gray-700" href="/teacher-subjects">
//                                     <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
//                                 </a>
//                                 <a className="nav-link flex items-center text-gray-700" href="/teacher-profile">
//                                     <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
//                                 </a>
//                             </>
//                         )}
//                     </div>
//                 )}
//             </div>
//         </header>
//     );
// }
// components/Header.jsx
import { useState, useEffect } from 'react';
import { useAuth } from '../hooks/useAuth';

export default function Header() {
    const { user, logout } = useAuth();
    const [showMobileMenu, setShowMobileMenu] = useState(false);
    const [showProfileMenu, setShowProfileMenu] = useState(false);

    const handleLogout = () => {
        logout();
    };

    useEffect(() => {
        const handleClickOutside = (event) => {
            if (!event.target.closest('.profile-section')) {
                setShowProfileMenu(false);
            }
            if (!event.target.closest('.mobile-nav-toggle') &&
                !event.target.closest('.mobile-nav-dropdown')) {
                setShowMobileMenu(false);
            }
        };

        document.addEventListener('click', handleClickOutside);
        return () => document.removeEventListener('click', handleClickOutside);
    }, []);

    return (
        <header id="siteHeader" className="bg-white border-b border-gray-200 sticky top-0 z-30">
            <div className="container-fluid py-1 flex items-center gap-3 px-4 relative">
                <a className="navbar-brand m-4 text-xl font-semibold text-indigo-700">
                    <i className="fas fa-graduation-cap"></i>
                    UNI Portal
                </a>

                <div className="header-nav ms-10">
                    {user.role === 'teacher' && (
                        <>
                            <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/teacher-dashboard">
                                <i className="fa fa-file-pen me-2 text-gray-500"></i>Предстоящи изпити
                            </a>
                            <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/conducted-exams">
                                <i className="fa fa-calendar me-2 text-gray-500"></i>Изминали изпити
                            </a>
                            <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/teacher-subjects">
                                <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
                            </a>
                            <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/teacher-profile">
                                <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
                            </a>
                        </>
                    )}
                    {user.role === 'student' && (
                        <>
                            <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/exams">
                                <i className="fa fa-file-pen me-2 text-gray-500"></i>Достъпни изпити
                            </a>
                            <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/my-exams">
                                <i className="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
                            </a>
                            <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/my-past-exams">
                                <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
                            </a>
                            <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/payments">
                                <i className="fa fa-wallet me-2 text-gray-500"></i>Плащания
                            </a>
                            <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/student-profile">
                                <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
                            </a>
                        </>
                    )}
                    {user.role === 'administrator' && (
                        <>
                            <a className="nav-link flex items-center text-gray-700" href="/admin-subjects">
                                <i className="fa fa-file-pen me-2 text-gray-500"></i>Изпити
                            </a>
                            <a className="nav-link flex items-center text-gray-700" href="/admin-users">
                                <i className="fa fa-wallet me-2 text-gray-500"></i>Създаване на потребители
                            </a>
                            <a className="nav-link flex items-center text-gray-700" href="/teacher-subjects">
                                <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
                            </a>
                            <a className="nav-link flex items-center text-gray-700" href="/teacher-profile">
                                <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
                            </a>
                        </>
                    )}
                </div>

                <div className="d-flex align-items-center gap-3 ms-auto profile-section">
                    <button
                        className="mobile-nav-toggle"
                        onClick={() => setShowMobileMenu(!showMobileMenu)}
                    >
                        <i className="fas fa-bars"></i>
                    </button>

                    {user && (
                        <div className="relative">
                            <button
                                className="dropdown-toggle btn btn-outline-primary flex items-center gap-2 px-3 py-1.5 border border-indigo-300 rounded-full text-indigo-700 hover:bg-indigo-50"
                                onClick={() => setShowProfileMenu(!showProfileMenu)}
                            >
                                <i className="fa fa-user-circle"></i> {user.first_name} {user.last_name}
                            </button>

                            {showProfileMenu && (
                                <ul className="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
                                    <li>
                                        <a className="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="/profile">
                                            Моят профил
                                        </a>
                                    </li>
                                    <li>
                                        <hr className="dropdown-divider my-2 border-gray-200" />
                                    </li>
                                    <li>
                                        <button
                                            className="dropdown-item text-danger block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
                                            onClick={handleLogout}
                                        >
                                            Изход
                                        </button>
                                    </li>
                                </ul>
                            )}
                        </div>
                    )}
                </div>

                {showMobileMenu && (
                    <div className="mobile-nav-dropdown show">
                        {user.role === 'student' && (
                            <>
                                <a className="nav-link flex items-center text-gray-700" href="/exams">
                                    <i className="fa fa-file-pen me-2 text-gray-500"></i>Достъпни изпити
                                </a>
                                <a className="nav-link flex items-center text-gray-700" href="/my-exams">
                                    <i className="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
                                </a>
                                <a className="nav-link flex items-center text-gray-700" href="/my-past-exams">
                                    <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
                                </a>
                                <a className="nav-link flex items-center text-gray-700" href="/payments">
                                    <i className="fa fa-wallet me-2 text-gray-500"></i>Плащания
                                </a>
                                <a className="nav-link flex items-center text-gray-700" href="/student-profile">
                                    <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
                                </a>
                            </>
                        )}
                        {user.role === 'teacher' && (
                            <>
                                <a className="nav-link flex items-center text-gray-700" href="/teacher-dashboard">
                                    <i className="fa fa-file-pen me-2 text-gray-500"></i>Изпити
                                </a>
                                <a className="nav-link flex items-center text-gray-700" href="/conducted-exams">
                                    <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
                                </a>
                                <a className="nav-link flex items-center text-gray-700" href="/teacher-subjects">
                                    <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
                                </a>
                                <a className="nav-link flex items-center text-gray-700" href="/teacher-profile">
                                    <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
                                </a>
                            </>
                        )}
                        {user.role === 'administrator' && (
                            <>
                                <a className="nav-link flex items-center text-gray-700" href="/admin-subjects">
                                    <i className="fa fa-file-pen me-2 text-gray-500"></i>Изпити
                                </a>
                                <a className="nav-link flex items-center text-gray-700" href="/admin-users">
                                    <i className="fa fa-wallet me-2 text-gray-500"></i>Създаване на потребители
                                </a>
                                <a className="nav-link flex items-center text-gray-700" href="/teacher-subjects">
                                    <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
                                </a>
                                <a className="nav-link flex items-center text-gray-700" href="/teacher-profile">
                                    <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
                                </a>
                            </>
                        )}
                    </div>
                )}
            </div>
        </header>
    );
}
