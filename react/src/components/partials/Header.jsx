
import { useEffect, useRef, useState } from 'react';
import { useAuth } from '../../hooks/useAuth.jsx';
import { NavLink, useNavigate } from 'react-router-dom';

export default function Header() {
    const { user, logout } = useAuth();
    const navigate = useNavigate();
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

    const handleLogout = () => {
        logout();
        navigate('/login');
    };

    const NavLinks = ({ variant = 'desktop' }) => {
        const baseLinkCls = `flex items-center no-underline ${variant === 'desktop' ? 'px-3 py-2 rounded-md mx-1' : 'px-3 py-2'}`;

        const getNavLinkClass = ({ isActive }) => {
            return isActive
                ? `${baseLinkCls} bg-indigo-100 text-indigo-700 font-medium`
                : `${baseLinkCls} text-gray-700 hover:bg-gray-100`;
        };

        if (user?.role === 'teacher') {
            return (
                <>
                    <NavLink className={getNavLinkClass} to="/upcoming-exams">
                        <i className="fa fa-file-pen me-2 text-gray-500"></i>Предстоящи изпити
                    </NavLink>
                    <NavLink className={getNavLinkClass} to="/conducted-exams">
                        <i className="fa fa-calendar me-2 text-gray-500"></i>Изминали изпити
                    </NavLink>
                    <NavLink className={getNavLinkClass} to="/teacher-subjects">
                        <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
                    </NavLink>
                    <NavLink className={getNavLinkClass} to="/teacher-profile">
                        <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
                    </NavLink>
                </>
            );
        }

        if (user?.role === 'administrator') {
            return (

                <>
                    <NavLink className={getNavLinkClass} to="/subjects">
                        <i className="fa fa-file-pen me-2 text-gray-500"></i>Управление на дисциплини
                    </NavLink>
                    <NavLink className={getNavLinkClass} to="/users">
                        <i className="fa fa-wallet me-2 text-gray-500"></i>Управление на потребители
                    </NavLink>
                    <NavLink className={getNavLinkClass} to="/exam-halls">
                        <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на зали
                    </NavLink>
                    <NavLink className={getNavLinkClass} to="/faculties">
                        <i className="fa fa-building me-2 text-gray-500"></i>Управление на факултети
                    </NavLink>
                    <NavLink className={getNavLinkClass} to="/specialties">
                        <i className="fa fa-graduation-cap me-2 text-gray-500"></i>Управление на специалности
                    </NavLink>
                </>
            );
        }

        // Default to student view
        return (
            <>
                <NavLink className={getNavLinkClass} to="/exams">
                    <i className="fa fa-file-pen me-2 text-gray-500"></i>Достъпни изпити
                </NavLink>
                <NavLink className={getNavLinkClass} to="/my-exams">
                    <i className="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
                </NavLink>
                <NavLink className={getNavLinkClass} to="/my-past-exams">
                    <i className="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
                </NavLink>
                <NavLink className={getNavLinkClass} to="/payments">
                    <i className="fa fa-wallet me-2 text-gray-500"></i>Плащания
                </NavLink>
                <NavLink className={getNavLinkClass} to="/student-profile">
                    <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
                </NavLink>
            </>
        );
    };

    return (
        <header ref={headerRef} id="siteHeader" className="bg-white border-b border-gray-200 sticky top-0 z-30">
            <div className="w-full py-1 flex items-center gap-3 px-4 relative">
                <NavLink className="m-4 text-xl font-semibold text-indigo-700 no-underline" to="/">
                    <i className="fas fa-graduation-cap"></i> UNI Portal
                </NavLink>

                {/* Desktop nav */}
                <nav className="ml-10 hidden lg:flex space-x-1">
                    <NavLinks variant="desktop" />
                </nav>

                <div className="flex items-center gap-3 ml-auto profile-section">
                    <button
                        id="mobileNavToggle"
                        className="lg:hidden p-2 rounded-md hover:bg-gray-100 relative"
                        onClick={() => setShowMobile(!showMobile)}
                    >
                        <i className="fas fa-bars"></i>
                    </button>

                    {user && (
                        <div className="relative">
                            <button
                                className="flex items-center gap-2 px-3 py-1.5 border border-indigo-300 rounded-full text-indigo-700 hover:bg-indigo-50"
                                onClick={() => setShowProfile(!showProfile)}
                            >
                                <i className="fa fa-user-circle"></i> {user.first_name} {user.last_name}
                            </button>

                            {showProfile && (
                                <div className="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50 border border-gray-200">
                                    <NavLink
                                        className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 no-underline"
                                        to={user.role === 'teacher' ? '/teacher-profile' : '/student-profile'}
                                        onClick={() => setShowProfile(false)}
                                    >
                                        Моят профил
                                    </NavLink>
                                    <hr className="my-2 border-gray-200" />
                                    <button
                                        className="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
                                        onClick={handleLogout}
                                    >
                                        Изход
                                    </button>
                                </div>
                            )}
                        </div>
                    )}
                </div>

                {/* Mobile dropdown - Променено да не е на целия екран */}
                {showMobile && (
                    <div
                        id="mobileNavDropdown"
                        className="lg:hidden absolute top-full right-0 mt-2 w-56 bg-white rounded-md shadow-lg py-2 z-50 border border-gray-200"
                    >
                        <div className="space-y-1">
                            <NavLinks variant="mobile" />
                        </div>
                    </div>
                )}
            </div>
        </header>
    );
}
