// components/partials/Header.js
import React, { useState, useEffect } from 'react';
const Header = () => {
    const [user, setUser] = useState(null);
    const [dropdownOpen, setDropdownOpen] = useState(false);
    const [mobileNavOpen, setMobileNavOpen] = useState(false);

    useEffect(() => {
        // Fetch user data or get from context/global state
        // This is a placeholder - you'll need to implement based on your auth system
        const fetchUser = async () => {
            try {
                const response = await fetch('/api/user')
                if (response.ok) {
                    const userData = await response.json();
                    setUser(userData);
                }
            } catch (error) {
                console.error('Failed to fetch user data', error);
            }
        };

        fetchUser();
    }, []);

    const handleLogout = async () => {
        try {
            await fetch('/logout', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                credentials: 'include'
            });
            window.location.href = '/login';
        } catch (error) {
            console.error('Logout failed', error);
        }
    };

    return (
        <header id="siteHeader" className="bg-white border-b border-gray-200 sticky top-0 z-30">
            <div className="container-fluid py-1 flex items-center gap-3 px-4 relative">
                <a className="navbar-brand m-4 text-xl font-semibold text-indigo-700">
                    <i className="fas fa-graduation-cap"></i>
                    UNI Portal
                </a>

                {/* Desktop Navigation */}
                <div className="header-nav ms-10">
                    {user && user.role === 'teacher' && (
                        <>
                            <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/teacher/dashboard">
                                <i className="fa fa-file-pen me-2 text-gray-500"></i>Предстоящи изпити
                            </a>
                            <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/teacher/conducted-exams">
                                <i className="fa fa-calendar me-2 text-gray-500"></i>Изминали изпити
                            </a>
                            <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/teacher/subjects">
                                <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
                            </a>
                            <a className="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="/teacher/profile">
                                <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
                            </a>
                        </>
                    )}
                    {/* Add other role navigations as needed */}
                </div>

                <div className="d-flex align-items-center gap-3 ms-auto profile-section">
                    <button
                        className="mobile-nav-toggle"
                        id="mobileNavToggle"
                        onClick={() => setMobileNavOpen(!mobileNavOpen)}
                    >
                        <i className="fas fa-bars"></i>
                    </button>

                    {user ? (
                        <div className="relative">
                            <button
                                className="dropdown-toggle btn btn-outline-primary flex items-center gap-2 px-3 py-1.5 border border-indigo-300 rounded-full text-indigo-700 hover:bg-indigo-50"
                                onClick={() => setDropdownOpen(!dropdownOpen)}
                            >
                                <i className="fa fa-user-circle"></i> {user.first_name} {user.last_name}
                            </button>
                            {dropdownOpen && (
                                <ul className="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
                                    <li>
                                        <a className="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="/teacher/profile">
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
                    ) : (
                        <div className="ms-auto ms-md-2">
                            <a className="btn btn-outline-primary" href="/login">Вход</a>
                        </div>
                    )}
                </div>

                {/* Mobile Navigation Dropdown */}
                {mobileNavOpen && (
                    <div className="mobile-nav-dropdown show" id="mobileNavDropdown">
                        {user && user.role === 'teacher' && (
                            <>
                                <a className="nav-link flex items-center text-gray-700" href="/teacher/dashboard">
                                    <i className="fa fa-file-pen me-2 text-gray-500"></i>Предстоящи изпити
                                </a>
                                <a className="nav-link flex items-center text-gray-700" href="/teacher/conducted-exams">
                                    <i className="fa fa-calendar me-2 text-gray-500"></i>Изминали изпити
                                </a>
                                <a className="nav-link flex items-center text-gray-700" href="/teacher/subjects">
                                    <i className="fa fa-clipboard-check me-2 text-gray-500"></i>Управление на заверки
                                </a>
                                <a className="nav-link flex items-center text-gray-700" href="/teacher/profile">
                                    <i className="fas fa-user me-2 text-gray-500"></i>Моят профил
                                </a>
                            </>
                        )}
                        {/* Add other role navigations as needed */}
                    </div>
                )}
            </div>
        </header>
    );
};

export default Header;
