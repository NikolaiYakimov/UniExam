// components/Header.jsx
import React, { useState } from 'react';
import { useAuth } from '../hooks/useAuth.jsx';

const Header = () => {
    const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
    const { user, logout } = useAuth();

    const handleLogout = async () => {
        try {
            const token = localStorage.getItem('token');
            await fetch('/api/logout', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                },
            });
            logout();
        } catch (error) {
            console.error('Logout error:', error);
        }
    };

    return (
        <header className="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-40">
            <div className="container-fluid mx-auto px-4 lg:px-6">
                <div className="flex justify-between items-center h-16">
                    {/* Logo/Brand */}
                    <div className="flex-shrink-0">
                        <h1 className="text-xl font-bold text-indigo-600">Университетска система</h1>
                    </div>

                    {/* Desktop Navigation */}
                    <nav className="hidden lg:flex header-nav">
                        <a href="/exams" className="nav-link">
                            <i className="fas fa-book mr-2"></i> Изпити
                        </a>
                        <a href="/my_exams" className="nav-link">
                            <i className="fas fa-calendar-check mr-2"></i> Моите изпити
                        </a>
                        <a href="/my_past_exams" className="nav-link">
                            <i className="fas fa-history mr-2"></i> Изминали изпити
                        </a>
                        <a href="/payments" className="nav-link active">
                            <i className="fas fa-credit-card mr-2"></i> Плащания
                        </a>
                    </nav>

                    {/* User Profile & Mobile Menu Button */}
                    <div className="flex items-center">
                        <div className="profile-section">
              <span className="hidden md:inline-block mr-4 text-gray-700">
                Здравейте, {user?.name}
              </span>
                            <button
                                onClick={handleLogout}
                                className="hidden md:inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Изход
                            </button>
                        </div>

                        {/* Mobile menu button */}
                        <button
                            className="mobile-nav-toggle lg:hidden"
                            onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)}
                        >
                            <i className={`fas ${isMobileMenuOpen ? 'fa-times' : 'fa-bars'}`}></i>
                        </button>
                    </div>
                </div>

                {/* Mobile Navigation Dropdown */}
                {isMobileMenuOpen && (
                    <div className="mobile-nav-dropdown lg:hidden">
                        <a href="/exams" className="nav-link">
                            <i className="fas fa-book mr-3"></i> Изпити
                        </a>
                        <a href="/my_exams" className="nav-link">
                            <i className="fas fa-calendar-check mr-3"></i> Моите изпити
                        </a>
                        <a href="/my_past_exams" className="nav-link">
                            <i className="fas fa-history mr-3"></i> Изминали изпити
                        </a>
                        <a href="/payments" className="nav-link active">
                            <i className="fas fa-credit-card mr-3"></i> Плащания
                        </a>
                        <div className="border-t border-gray-200 pt-2 mt-2">
                            <button
                                onClick={handleLogout}
                                className="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100"
                            >
                                <i className="fas fa-sign-out-alt mr-3"></i> Изход
                            </button>
                        </div>
                    </div>
                )}
            </div>
        </header>
    );
};

export default Header;
