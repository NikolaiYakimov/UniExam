// // import { useState } from 'react';
// // import { useAuth } from '../hooks/useAuth';
// //
// // export default function Header() {
// //     const { user, logout } = useAuth();
// //     const [showMobileMenu, setShowMobileMenu] = useState(false);
// //     const [showProfileMenu, setShowProfileMenu] = useState(false);
// //
// //     const handleLogout = () => {
// //         logout();
// //     };
// //
// //     return (
// //         <header id="siteHeader" className="bg-white border-b border-gray-200 sticky top-0 z-30">
// //             <div className="container-fluid py-1 flex items-center gap-3 px-4 relative">
// //                 <a className="navbar-brand m-4 text-xl font-semibold text-indigo-700">
// //                     <i className="fas fa-graduation-cap"></i>
// //                     UNI Portal
// //                 </a>
// //
// //                 <div className="header-nav ms-10">
// //                     <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">
// //                         <i className="fa fa-home me-2 text-gray-500"></i>Начало
// //                     </a>
// //                     <a className="nav-link flex items-center text-indigo-700 bg-indigo-50" href="/exams">
// //                         <i className="fa fa-file-pen me-2 text-indigo-600"></i>Достъпни изпити
// //                     </a>
// //                     <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/my-exams">
// //                         <i className="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
// //                     </a>
// //                     <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">
// //                         <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
// //                     </a>
// //                     <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">
// //                         <i className="fa fa-wallet me-2 text-gray-500"></i>Плащания
// //                     </a>
// //                     <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/profile">
// //                         <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
// //                     </a>
// //                 </div>
// //
// //                 <div className="d-flex align-items-center gap-3 ms-auto profile-section">
// //                     <button
// //                         className="mobile-nav-toggle"
// //                         onClick={() => setShowMobileMenu(!showMobileMenu)}
// //                     >
// //                         <i className="fas fa-bars"></i>
// //                     </button>
// //
// //                     {user && (
// //                         <div className="relative">
// //                             <button
// //                                 className="dropdown-toggle btn btn-outline-primary flex items-center gap-2 px-3 py-1.5 border border-indigo-300 rounded-full text-indigo-700 hover:bg-indigo-50"
// //                                 onClick={() => setShowProfileMenu(!showProfileMenu)}
// //                             >
// //                                 <i className="fa fa-user-circle"></i> {user.first_name} {user.last_name}
// //                             </button>
// //
// //                             {showProfileMenu && (
// //                                 <ul className="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
// //                                     <li>
// //                                         <a className="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="/profile">
// //                                             Моят профил
// //                                         </a>
// //                                     </li>
// //                                     <li>
// //                                         <hr className="dropdown-divider my-2 border-gray-200" />
// //                                     </li>
// //                                     <li>
// //                                         <button
// //                                             className="dropdown-item text-danger block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
// //                                             onClick={handleLogout}
// //                                         >
// //                                             Изход
// //                                         </button>
// //                                     </li>
// //                                 </ul>
// //                             )}
// //                         </div>
// //                     )}
// //                 </div>
// //
// //                 {showMobileMenu && (
// //                     <div className="mobile-nav-dropdown">
// //                         <a className="nav-link flex items-center text-gray-700" href="#">
// //                             <i className="fa fa-home me-2 text-gray-500"></i>Начало
// //                         </a>
// //                         <a className="nav-link flex items-center text-indigo-700 bg-indigo-50" href="/exams">
// //                             <i className="fa fa-file-pen me-2 text-indigo-600"></i>Достъпни изпити
// //                         </a>
// //                         <a className="nav-link flex items-center text-gray-700" href="/my-exams">
// //                             <i className="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
// //                         </a>
// //                         <a className="nav-link flex items-center text-gray-700" href="#">
// //                             <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
// //                         </a>
// //                         <a className="nav-link flex items-center text-gray-700" href="#">
// //                             <i className="fa fa-wallet me-2 text-gray-500"></i>Плащания
// //                         </a>
// //                         <a className="nav-link flex items-center text-gray-700" href="/profile">
// //                             <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
// //                         </a>
// //                     </div>
// //                 )}
// //             </div>
// //         </header>
// //     );
// // }
// // import { useState, useEffect } from 'react';
// // import { useAuth } from '../hooks/useAuth';
// //
// // export default function Header() {
// //     const { user, logout } = useAuth();
// //     const [showMobileMenu, setShowMobileMenu] = useState(false);
// //     const [showProfileMenu, setShowProfileMenu] = useState(false);
// //
// //     const handleLogout = () => {
// //         logout();
// //     };
// //
// //     useEffect(() => {
// //         const handleClickOutside = (event) => {
// //             if (!event.target.closest('.profile-section')) {
// //                 setShowProfileMenu(false);
// //             }
// //             if (!event.target.closest('.mobile-nav-toggle') &&
// //                 !event.target.closest('.mobile-nav-dropdown')) {
// //                 setShowMobileMenu(false);
// //             }
// //         };
// //
// //         document.addEventListener('click', handleClickOutside);
// //         return () => document.removeEventListener('click', handleClickOutside);
// //     }, []);
// //
// //     return (
// //         <header id="siteHeader" className="bg-white border-b border-gray-200 sticky top-0 z-30">
// //             <div className="container-fluid py-1 flex items-center gap-3 px-4 relative">
// //                 <a className="navbar-brand m-4 text-xl font-semibold text-indigo-700">
// //                     <i className="fas fa-graduation-cap"></i>
// //                     UNI Portal
// //                 </a>
// //
// //                 <div className="header-nav ms-10">
// //                     <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">
// //                         <i className="fa fa-home me-2 text-gray-500"></i>Начало
// //                     </a>
// //                     <a className="nav-link flex items-center text-indigo-700 bg-indigo-50" href="/exams">
// //                         <i className="fa fa-file-pen me-2 text-indigo-600"></i>Достъпни изпити
// //                     </a>
// //                     <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/my-exams">
// //                         <i className="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
// //                     </a>
// //                     <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">
// //                         <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
// //                     </a>
// //                     <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">
// //                         <i className="fa fa-wallet me-2 text-gray-500"></i>Плащания
// //                     </a>
// //                     <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/profile">
// //                         <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
// //                     </a>
// //                 </div>
// //
// //                 <div className="d-flex align-items-center gap-3 ms-auto profile-section">
// //                     <button
// //                         className="mobile-nav-toggle"
// //                         onClick={() => setShowMobileMenu(!showMobileMenu)}
// //                     >
// //                         <i className="fas fa-bars"></i>
// //                     </button>
// //
// //                     {user && (
// //                         <div className="relative">
// //                             <button
// //                                 className="dropdown-toggle btn btn-outline-primary flex items-center gap-2 px-3 py-1.5 border border-indigo-300 rounded-full text-indigo-700 hover:bg-indigo-50"
// //                                 onClick={() => setShowProfileMenu(!showProfileMenu)}
// //                             >
// //                                 <i className="fa fa-user-circle"></i> {user.first_name} {user.last_name}
// //                             </button>
// //
// //                             {showProfileMenu && (
// //                                 <ul className="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
// //                                     <li>
// //                                         <a className="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="/profile">
// //                                             Моят профил
// //                                         </a>
// //                                     </li>
// //                                     <li>
// //                                         <hr className="dropdown-divider my-2 border-gray-200" />
// //                                     </li>
// //                                     <li>
// //                                         <button
// //                                             className="dropdown-item text-danger block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
// //                                             onClick={handleLogout}
// //                                         >
// //                                             Изход
// //                                         </button>
// //                                     </li>
// //                                 </ul>
// //                             )}
// //                         </div>
// //                     )}
// //                 </div>
// //
// //                 {showMobileMenu && (
// //                     <div className="mobile-nav-dropdown show">
// //                         <a className="nav-link flex items-center text-gray-700" href="#">
// //                             <i className="fa fa-home me-2 text-gray-500"></i>Начало
// //                         </a>
// //                         <a className="nav-link flex items-center text-indigo-700 bg-indigo-50" href="/exams">
// //                             <i className="fa fa-file-pen me-2 text-indigo-600"></i>Достъпни изпити
// //                         </a>
// //                         <a className="nav-link flex items-center text-gray-700" href="/my-exams">
// //                             <i className="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
// //                         </a>
// //                         <a className="nav-link flex items-center text-gray-700" href="#">
// //                             <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
// //                         </a>
// //                         <a className="nav-link flex items-center text-gray-700" href="#">
// //                             <i className="fa fa-wallet me-2 text-gray-500"></i>Плащания
// //                         </a>
// //                         <a className="nav-link flex items-center text-gray-700" href="/profile">
// //                             <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
// //                         </a>
// //                     </div>
// //                 )}
// //             </div>
// //         </header>
// //     );
// // }
// // Header.jsx - Updated to match Blade template
// // import { useState, useEffect } from 'react';
// // import { useAuth } from '../hooks/useAuth';
// // import './RightFile.css';
// //
// //
// // export default function Header() {
// //     const { user, logout } = useAuth();
// //     const [showMobileMenu, setShowMobileMenu] = useState(false);
// //     const [showProfileMenu, setShowProfileMenu] = useState(false);
// //
// //     const handleLogout = () => {
// //         logout();
// //     };
// //
// //     useEffect(() => {
// //         const handleClickOutside = (event) => {
// //             if (!event.target.closest('.profile-section')) {
// //                 setShowProfileMenu(false);
// //             }
// //             if (!event.target.closest('.mobile-nav-toggle') &&
// //                 !event.target.closest('.mobile-nav-dropdown')) {
// //                 setShowMobileMenu(false);
// //             }
// //         };
// //
// //         document.addEventListener('click', handleClickOutside);
// //         return () => document.removeEventListener('click', handleClickOutside);
// //     }, []);
// //
// //     return (
// //         <header id="siteHeader" className="bg-white border-b border-gray-200 sticky top-0 z-30">
// //             <div className="container-fluid py-1 flex items-center gap-3 px-4 relative">
// //                 <a className="navbar-brand m-4 text-xl font-semibold text-indigo-700">
// //                     <i className="fas fa-graduation-cap"></i>
// //                     UNI Portal
// //                 </a>
// //
// //                 <div className="header-nav ms-10">
// //                     {user.role === 'teacher' && (
// //                         <>
// //                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/teacher-dashboard">
// //                                 <i className="fa fa-file-pen me-2 text-gray-500"></i>Предстоящи изпити
// //                             </a>
// //                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/conducted-exams">
// //                                 <i className="fa fa-calendar me-2 text-gray-500"></i>Изминали изпити
// //                             </a>
// //                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/teacher-subjects">
// //                                 <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
// //                             </a>
// //                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/teacher-profile">
// //                                 <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
// //                             </a>
// //                         </>
// //                     )}
// //                     {user.role === 'student' && (
// //                         <>
// //                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/exams">
// //                                 <i className="fa fa-file-pen me-2 text-gray-500"></i>Достъпни изпити
// //                             </a>
// //                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/my-exams">
// //                                 <i className="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
// //                             </a>
// //                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/my-past-exams">
// //                                 <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
// //                             </a>
// //                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/payments">
// //                                 <i className="fa fa-wallet me-2 text-gray-500"></i>Плащания
// //                             </a>
// //                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/student-profile">
// //                                 <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
// //                             </a>
// //                         </>
// //                     )}
// //                     {user.role === 'administrator' && (
// //                         <>
// //                             <a className="nav-link flex items-center text-gray-700" href="/admin-subjects">
// //                                 <i className="fa fa-file-pen me-2 text-gray-500"></i>Изпити
// //                             </a>
// //                             <a className="nav-link flex items-center text-gray-700" href="/admin-users">
// //                                 <i className="fa fa-wallet me-2 text-gray-500"></i>Създаване на потребители
// //                             </a>
// //                             <a className="nav-link flex items-center text-gray-700" href="/teacher-subjects">
// //                                 <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
// //                             </a>
// //                             <a className="nav-link flex items-center text-gray-700" href="/teacher-profile">
// //                                 <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
// //                             </a>
// //                         </>
// //                     )}
// //                 </div>
// //
// //                 <div className="d-flex align-items-center gap-3 ms-auto profile-section">
// //                     <button
// //                         className="mobile-nav-toggle"
// //                         onClick={() => setShowMobileMenu(!showMobileMenu)}
// //                     >
// //                         <i className="fas fa-bars"></i>
// //                     </button>
// //
// //                     {user && (
// //                         <div className="relative">
// //                             <button
// //                                 className="dropdown-toggle btn btn-outline-primary flex items-center gap-2 px-3 py-1.5 border border-indigo-300 rounded-full text-indigo-700 hover:bg-indigo-50"
// //                                 onClick={() => setShowProfileMenu(!showProfileMenu)}
// //                             >
// //                                 <i className="fa fa-user-circle"></i> {user.first_name} {user.last_name}
// //                             </button>
// //
// //                             {showProfileMenu && (
// //                                 <ul className="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
// //                                     <li>
// //                                         <a className="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="/profile">
// //                                             Моят профил
// //                                         </a>
// //                                     </li>
// //                                     <li>
// //                                         <hr className="dropdown-divider my-2 border-gray-200" />
// //                                     </li>
// //                                     <li>
// //                                         <button
// //                                             className="dropdown-item text-danger block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
// //                                             onClick={handleLogout}
// //                                         >
// //                                             Изход
// //                                         </button>
// //                                     </li>
// //                                 </ul>
// //                             )}
// //                         </div>
// //                     )}
// //                 </div>
// //
// //                 {showMobileMenu && (
// //                     <div className="mobile-nav-dropdown show">
// //                         {user.role === 'student' && (
// //                             <>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/exams">
// //                                     <i className="fa fa-file-pen me-2 text-gray-500"></i>Достъпни изпити
// //                                 </a>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/my-exams">
// //                                     <i className="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
// //                                 </a>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/my-past-exams">
// //                                     <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
// //                                 </a>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/payments">
// //                                     <i className="fa fa-wallet me-2 text-gray-500"></i>Плащания
// //                                 </a>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/student-profile">
// //                                     <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
// //                                 </a>
// //                             </>
// //                         )}
// //                         {user.role === 'teacher' && (
// //                             <>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/teacher-dashboard">
// //                                     <i className="fa fa-file-pen me-2 text-gray-500"></i>Изпити
// //                                 </a>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/conducted-exams">
// //                                     <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
// //                                 </a>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/teacher-subjects">
// //                                     <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
// //                                 </a>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/teacher-profile">
// //                                     <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
// //                                 </a>
// //                             </>
// //                         )}
// //                         {user.role === 'administrator' && (
// //                             <>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/admin-subjects">
// //                                     <i className="fa fa-file-pen me-2 text-gray-500"></i>Изпити
// //                                 </a>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/admin-users">
// //                                     <i className="fa fa-wallet me-2 text-gray-500"></i>Създаване на потребители
// //                                 </a>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/teacher-subjects">
// //                                     <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
// //                                 </a>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/teacher-profile">
// //                                     <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
// //                                 </a>
// //                             </>
// //                         )}
// //                     </div>
// //                 )}
// //             </div>
// //         </header>
// //     );
// // }
// // components/Header.jsx
// // import { useState, useEffect } from 'react';
// // import { useAuth } from '../hooks/useAuth';
// //
// // export default function Header() {
// //     const { user, logout } = useAuth();
// //     const [showMobileMenu, setShowMobileMenu] = useState(false);
// //     const [showProfileMenu, setShowProfileMenu] = useState(false);
// //
// //     const handleLogout = () => {
// //         logout();
// //     };
// //
// //     useEffect(() => {
// //         const handleClickOutside = (event) => {
// //             if (!event.target.closest('.profile-section')) {
// //                 setShowProfileMenu(false);
// //             }
// //             if (!event.target.closest('.mobile-nav-toggle') &&
// //                 !event.target.closest('.mobile-nav-dropdown')) {
// //                 setShowMobileMenu(false);
// //             }
// //         };
// //
// //         document.addEventListener('click', handleClickOutside);
// //         return () => document.removeEventListener('click', handleClickOutside);
// //     }, []);
// //
// //     return (
// //         <header id="siteHeader" className="bg-white border-b border-gray-200 sticky top-0 z-30">
// //             <div className="container-fluid py-1 flex items-center gap-3 px-4 relative">
// //                 <a className="navbar-brand m-4 text-xl font-semibold text-indigo-700">
// //                     <i className="fas fa-graduation-cap"></i>
// //                     UNI Portal
// //                 </a>
// //
// //                 <div className="header-nav ms-10">
// //                     {user.role === 'teacher' && (
// //                         <>
// //                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/teacher-dashboard">
// //                                 <i className="fa fa-file-pen me-2 text-gray-500"></i>Предстоящи изпити
// //                             </a>
// //                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/conducted-exams">
// //                                 <i className="fa fa-calendar me-2 text-gray-500"></i>Изминали изпити
// //                             </a>
// //                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/subjects">
// //                                 <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
// //                             </a>
// //                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/teacher-profile">
// //                                 <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
// //                             </a>
// //                         </>
// //                     )}
// //                     {user.role === 'student' && (
// //                         <>
// //                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/exams">
// //                                 <i className="fa fa-file-pen me-2 text-gray-500"></i>Достъпни изпити
// //                             </a>
// //                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/my-exams">
// //                                 <i className="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
// //                             </a>
// //                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/my-past-exams">
// //                                 <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
// //                             </a>
// //                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/payments">
// //                                 <i className="fa fa-wallet me-2 text-gray-500"></i>Плащания
// //                             </a>
// //                             <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/student-profile">
// //                                 <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
// //                             </a>
// //                         </>
// //                     )}
// //                     {user.role === 'administrator' && (
// //                         <>
// //                             <a className="nav-link flex items-center text-gray-700" href="/subjects">
// //                                 <i className="fa fa-file-pen me-2 text-gray-500"></i>Изпити
// //                             </a>
// //                             <a className="nav-link flex items-center text-gray-700" href="/users">
// //                                 <i className="fa fa-wallet me-2 text-gray-500"></i>Създаване на потребители
// //                             </a>
// //                             <a className="nav-link flex items-center text-gray-700" href="/teacher-subjects">
// //                                 <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
// //                             </a>
// //                             <a className="nav-link flex items-center text-gray-700" href="/teacher-profile">
// //                                 <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
// //                             </a>
// //                         </>
// //                     )}
// //                 </div>
// //
// //                 <div className="d-flex align-items-center gap-3 ms-auto profile-section">
// //                     <button
// //                         className="mobile-nav-toggle"
// //                         onClick={() => setShowMobileMenu(!showMobileMenu)}
// //                     >
// //                         <i className="fas fa-bars"></i>
// //                     </button>
// //
// //                     {user && (
// //                         <div className="relative">
// //                             <button
// //                                 className="dropdown-toggle btn btn-outline-primary flex items-center gap-2 px-3 py-1.5 border border-indigo-300 rounded-full text-indigo-700 hover:bg-indigo-50"
// //                                 onClick={() => setShowProfileMenu(!showProfileMenu)}
// //                             >
// //                                 <i className="fa fa-user-circle"></i> {user.first_name} {user.last_name}
// //                             </button>
// //
// //                             {showProfileMenu && (
// //                                 <ul className="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
// //                                     <li>
// //                                         <a className="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="/profile">
// //                                             Моят профил
// //                                         </a>
// //                                     </li>
// //                                     <li>
// //                                         <hr className="dropdown-divider my-2 border-gray-200" />
// //                                     </li>
// //                                     <li>
// //                                         <button
// //                                             className="dropdown-item text-danger block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
// //                                             onClick={handleLogout}
// //                                         >
// //                                             Изход
// //                                         </button>
// //                                     </li>
// //                                 </ul>
// //                             )}
// //                         </div>
// //                     )}
// //                 </div>
// //
// //                 {showMobileMenu && (
// //                     <div className="mobile-nav-dropdown show">
// //                         {user.role === 'student' && (
// //                             <>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/exams">
// //                                     <i className="fa fa-file-pen me-2 text-gray-500"></i>Достъпни изпити
// //                                 </a>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/my-exams">
// //                                     <i className="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
// //                                 </a>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/my-past-exams">
// //                                     <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
// //                                 </a>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/payments">
// //                                     <i className="fa fa-wallet me-2 text-gray-500"></i>Плащания
// //                                 </a>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/student-profile">
// //                                     <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
// //                                 </a>
// //                             </>
// //                         )}
// //                         {user.role === 'teacher' && (
// //                             <>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/teacher-dashboard">
// //                                     <i className="fa fa-file-pen me-2 text-gray-500"></i>Изпити
// //                                 </a>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/conducted-exams">
// //                                     <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
// //                                 </a>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/subjects">
// //                                     <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
// //                                 </a>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/teacher-profile">
// //                                     <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
// //                                 </a>
// //                             </>
// //                         )}
// //                         {user.role === 'administrator' && (
// //                             <>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/subjects">
// //                                     <i className="fa fa-file-pen me-2 text-gray-500"></i>Изпити
// //                                 </a>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/users">
// //                                     <i className="fa fa-wallet me-2 text-gray-500"></i>Създаване на потребители
// //                                 </a>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/teacher-subjects">
// //                                     <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
// //                                 </a>
// //                                 <a className="nav-link flex items-center text-gray-700" href="/teacher-profile">
// //                                     <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
// //                                 </a>
// //                             </>
// //                         )}
// //                     </div>
// //                 )}
// //             </div>
// //         </header>
// //     );
// // }
// // components/Header.jsx
// import { useEffect, useRef, useState } from 'react';
// import { useAuth } from '../hooks/useAuth';
//
// export default function Header() {
//     const { user, logout } = useAuth();
//     const [showMobile, setShowMobile] = useState(false);
//     const [showProfile, setShowProfile] = useState(false);
//     const headerRef = useRef(null);
//
//     useEffect(() => {
//         const setHeaderVar = () => {
//             if (!headerRef.current) return;
//             const h = headerRef.current.getBoundingClientRect().height;
//             document.documentElement.style.setProperty('--header-h', `${h}px`);
//         };
//         setHeaderVar();
//         window.addEventListener('resize', setHeaderVar);
//         return () => window.removeEventListener('resize', setHeaderVar);
//     }, []);
//
//     useEffect(() => {
//         const closeOnOutside = (e) => {
//             const target = e.target;
//             if (!target.closest('.profile-section')) setShowProfile(false);
//             if (!target.closest('#mobileNavDropdown') && !target.closest('#mobileNavToggle')) setShowMobile(false);
//         };
//         document.addEventListener('click', closeOnOutside);
//         return () => document.removeEventListener('click', closeOnOutside);
//     }, []);
//
//     const NavLinks = ({ variant = 'desktop' }) => {
//         const linkCls = `nav-link flex items-center text-gray-700 ${variant === 'desktop' ? 'hover:bg-gray-100' : ''}`;
//         const A = (props) => <a className={linkCls} {...props} />;
//         if (user?.role === 'teacher') {
//             return (
//                 <>
//                     <A href="/teacher-dashboard"><i className="fa fa-file-pen me-2 text-gray-500"></i>Предстоящи изпити</A>
//                     <A href="/conducted-exams"><i className="fa fa-calendar me-2 text-gray-500"></i>Изминали изпити</A>
//                     <A href="/teacher-subjects"><i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки</A>
//                     <A href="/teacher-profile"><i className="fas fa-user me-2 text-gray-500"></i>Моят профил</A>
//                 </>
//             );
//         }
//         if (user?.role === 'administrator') {
//             return (
//                 <>
//                     <A href="/subjects"><i className="fa fa-file-pen me-2 text-gray-500"></i>Изпити</A>
//                     <A href="/users"><i className="fa fa-wallet me-2 text-gray-500"></i>Създаване на потребители</A>
//                     <A href="/teacher-subjects"><i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки</A>
//                     <A href="/teacher-profile"><i className="fas fa-user me-2 text-gray-500"></i>Моят профил</A>
//                 </>
//             );
//         }
//         return (
//             <>
//                 <A href="/exams"><i className="fa fa-file-pen me-2 text-gray-500"></i>Достъпни изпити</A>
//                 <A href="/my-exams"><i className="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити</A>
//                 <A href="/my-past-exams"><i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити</A>
//                 <A href="/payments"><i className="fa fa-wallet me-2 text-gray-500"></i>Плащания</A>
//                 <A href="/student-profile"><i className="fas fa-user me-2 text-gray-500"></i>Моят профил</A>
//             </>
//         );
//     };
//
//     return (
//         <header ref={headerRef} id="siteHeader" className="bg-white border-b border-gray-200 sticky top-0 z-30">
//             <div className="container-fluid py-1 flex items-center gap-3 px-4 relative">
//                 <a className="navbar-brand m-4 text-xl font-semibold text-indigo-700"><i className="fas fa-graduation-cap"></i>UNI Portal</a>
//
//                 {/* Desktop nav (hidden <1538px by app.css) */}
//                 <div className="header-nav ms-10">
//                     <NavLinks variant="desktop" />
//                 </div>
//
//                 <div className="d-flex align-items-center gap-3 ms-auto profile-section">
//                     <button id="mobileNavToggle" className="mobile-nav-toggle" onClick={() => setShowMobile((v) => !v)}>
//                         <i className="fas fa-bars"></i>
//                     </button>
//
//                     {user && (
//                         <div className="relative">
//                             <button
//                                 className="dropdown-toggle btn btn-outline-primary flex items-center gap-2 px-3 py-1.5 border border-indigo-300 rounded-full text-indigo-700 hover:bg-indigo-50"
//                                 onClick={() => setShowProfile((v) => !v)}
//                             >
//                                 <i className="fa fa-user-circle"></i> {user.first_name} {user.last_name}
//                             </button>
//
//                             {showProfile && (
//                                 <ul className="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
//                                     <li>
//                                         <a className="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href={user.role === 'teacher' ? '/teacher-profile' : '/student-profile'}>
//                                             Моят профил
//                                         </a>
//                                     </li>
//                                     <li><hr className="dropdown-divider my-2 border-gray-200" /></li>
//                                     <li>
//                                         <button className="dropdown-item text-danger block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100" onClick={logout}>
//                                             Изход
//                                         </button>
//                                     </li>
//                                 </ul>
//                             )}
//                         </div>
//                     )}
//                 </div>
//
//                 {/* Mobile dropdown (shown <1538px by app.css) */}
//                 <div id="mobileNavDropdown" className={`mobile-nav-dropdown ${showMobile ? 'show' : ''}`}>
//                     <NavLinks variant="mobile" />
//                 </div>
//             </div>
//         </header>
//     );
// }

// components/Header.jsx
import { useEffect, useRef, useState } from 'react';
import { useAuth } from '../hooks/useAuth';

export default function Header() {
    const { user, logout } = useAuth();
    const [showMobile, setShowMobile] = useState(false);
    const [showProfile, setShowProfile] = useState(false);
    const headerRef = useRef(null);

    useEffect(() => {
        const setHeaderVar = () => {
            if (!headerRef.current) return;
            const h = headerRef.current.getBoundingClientRect().height;
            document.documentElement.style.setProperty('--header-h', `${h}px`);
        };
        setHeaderVar();
        window.addEventListener('resize', setHeaderVar);
        return () => window.removeEventListener('resize', setHeaderVar);
    }, []);

    useEffect(() => {
        const closeOnOutside = (e) => {
            const target = e.target;
            if (!target.closest('.profile-section')) setShowProfile(false);
            if (!target.closest('#mobileNavDropdown') && !target.closest('#mobileNavToggle')) setShowMobile(false);
        };
        document.addEventListener('click', closeOnOutside);
        return () => document.removeEventListener('click', closeOnOutside);
    }, []);

    const NavLinks = ({ variant = 'desktop' }) => {
        const linkCls = `nav-link flex items-center text-gray-700 ${variant === 'desktop' ? 'hover:bg-gray-100' : ''}`;

        if (user?.role === 'teacher') {
            return (
                <>
                    <a className={linkCls} href="/teacher-dashboard">
                        <i className="fa fa-file-pen me-2 text-gray-500"></i>Предстоящи изпити
                    </a>
                    <a className={linkCls} href="/conducted-exams">
                        <i className="fa fa-calendar me-2 text-gray-500"></i>Изминали изпити
                    </a>
                    <a className={linkCls} href="/teacher-subjects">
                        <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
                    </a>
                    <a className={linkCls} href="/teacher-profile">
                        <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
                    </a>
                </>
            );
        }

        if (user?.role === 'administrator') {
            return (
                <>
                    <a className={linkCls} href="/admin-subjects">
                        <i className="fa fa-file-pen me-2 text-gray-500"></i>Изпити
                    </a>
                    <a className={linkCls} href="/admin-users">
                        <i className="fa fa-wallet me-2 text-gray-500"></i>Създаване на потребители
                    </a>
                    <a className={linkCls} href="/teacher-subjects">
                        <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
                    </a>
                    <a className={linkCls} href="/teacher-profile">
                        <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
                    </a>
                </>
            );
        }

        // Default to student view
        return (
            <>
                <a className={linkCls} href="/exams">
                    <i className="fa fa-file-pen me-2 text-gray-500"></i>Достъпни изпити
                </a>
                <a className={linkCls} href="/my-exams">
                    <i className="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
                </a>
                <a className={linkCls} href="/my-past-exams">
                    <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
                </a>
                <a className={linkCls} href="/payments">
                    <i className="fa fa-wallet me-2 text-gray-500"></i>Плащания
                </a>
                <a className={linkCls} href="/student-profile">
                    <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
                </a>
            </>
        );
    };

    return (
        <header ref={headerRef} id="siteHeader" className="bg-white border-b border-gray-200 sticky top-0 z-30">
            <div className="container-fluid py-1 flex items-center gap-3 px-4 relative">
                <a className="navbar-brand m-4 text-xl font-semibold text-indigo-700">
                    <i className="fas fa-graduation-cap"></i> UNI Portal
                </a>

                {/* Desktop nav */}
                <div className="header-nav ms-10 hidden lg:flex">
                    <NavLinks variant="desktop" />
                </div>

                <div className="d-flex align-items-center gap-3 ms-auto profile-section">
                    <button
                        id="mobileNavToggle"
                        className="mobile-nav-toggle lg:hidden"
                        onClick={() => setShowMobile(!showMobile)}
                    >
                        <i className="fas fa-bars"></i>
                    </button>

                    {user && (
                        <div className="relative">
                            <button
                                className="dropdown-toggle btn btn-outline-primary flex items-center gap-2 px-3 py-1.5 border border-indigo-300 rounded-full text-indigo-700 hover:bg-indigo-50"
                                onClick={() => setShowProfile(!showProfile)}
                            >
                                <i className="fa fa-user-circle"></i> {user.first_name} {user.last_name}
                            </button>

                            {showProfile && (
                                <ul className="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
                                    <li>
                                        <a className="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                           href={user.role === 'teacher' ? '/teacher-profile' : '/student-profile'}>
                                            Моят профил
                                        </a>
                                    </li>
                                    <li><hr className="dropdown-divider my-2 border-gray-200" /></li>
                                    <li>
                                        <button
                                            className="dropdown-item text-danger block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
                                            onClick={logout}
                                        >
                                            Изход
                                        </button>
                                    </li>
                                </ul>
                            )}
                        </div>
                    )}
                </div>

                {/* Mobile dropdown */}
                <div
                    id="mobileNavDropdown"
                    className={`mobile-nav-dropdown lg:hidden ${showMobile ? 'show' : ''}`}
                >
                    <NavLinks variant="mobile" />
                </div>
            </div>
        </header>
    );
}
