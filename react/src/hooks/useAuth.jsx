// import { useState, useContext, createContext, useEffect } from 'react';
// import axios from 'axios';
//
// const AuthContext = createContext();
//
// export function useAuth() {
//     return useContext(AuthContext);
// }
//
// export function AuthProvider({ children }) {
//     const [user, setUser] = useState(null);
//     const [token, setToken] = useState(localStorage.getItem('token'));
//     const [isLoading, setIsLoading] = useState(true);
//
//     // Set axios defaults
//     useEffect(() => {
//         if (token) {
//             axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
//             axios.defaults.headers.common['Accept'] = 'application/json';
//             axios.defaults.baseURL = 'http://localhost:8000/api';
//         } else {
//             delete axios.defaults.headers.common['Authorization'];
//         }
//     }, [token]);
//
//     // Load user on init if token exists
//     useEffect(() => {
//         if (token) {
//             getUser();
//         } else {
//             setIsLoading(false);
//         }
//     }, [token]);
//
//     const getUser = async () => {
//         try {
//             const response = await axios.get('/user');
//             setUser(response.data);
//         } catch (error) {
//             console.error('Failed to get user', error);
//             logout();
//         } finally {
//             setIsLoading(false);
//         }
//     };
//
//     const login = async (credentials) => {
//         try {
//             const response = await axios.post('/login', credentials);
//             const { token: newToken, user: userData } = response.data;
//
//             setToken(newToken);
//             setUser(userData);
//             localStorage.setItem('token', newToken);
//
//             return response.data;
//         } catch (error) {
//             console.error('Login failed', error);
//             throw error;
//         }
//     };
//
//     const logout = async () => {
//         try {
//             await axios.post('/logout');
//         } catch (error) {
//             console.error('Logout failed', error);
//         } finally {
//             setToken(null);
//             setUser(null);
//             localStorage.removeItem('token');
//         }
//     };
//
//     const value = {
//         user,
//         token,
//         isLoading,
//         login,
//         logout,
//         isAuthenticated: !!user,
//     };
//
//     return (
//         <AuthContext.Provider value={value}>
//             {children}
//         </AuthContext.Provider>
//     );
// }
// import { useState, useContext, createContext, useEffect } from 'react';
// import axios from 'axios';
//
// const AuthContext = createContext();
//
// export function useAuth() {
//     return useContext(AuthContext);
// }
//
// export function AuthProvider({ children }) {
//     const [user, setUser] = useState(null);
//     const [token, setToken] = useState(localStorage.getItem('token'));
//     const [isLoading, setIsLoading] = useState(true);
//
//     // Set axios defaults
//     useEffect(() => {
//         if (token) {
//             axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
//             axios.defaults.headers.common['Accept'] = 'application/json';
//             axios.defaults.baseURL = 'http://localhost:8000/api';
//         } else {
//             delete axios.defaults.headers.common['Authorization'];
//         }
//     }, [token]);
//
//     // Load user on init if token exists
//     useEffect(() => {
//         if (token) {
//             getUser();
//         } else {
//             setIsLoading(false);
//         }
//     }, [token]);
//
//     const getUser = async () => {
//         try {
//             const response = await axios.get('/user');
//             setUser(response.data);
//         } catch (error) {
//             console.error('Failed to get user', error);
//             logout();
//         } finally {
//             setIsLoading(false);
//         }
//     };
//
//     const login = async (credentials) => {
//         try {
//             setIsLoading(true);
//             const response = await axios.post('/login', credentials);
//             const { token: newToken, user: userData } = response.data;
//
//             setToken(newToken);
//             setUser(userData);
//             localStorage.setItem('token', newToken);
//
//             return response.data;
//         } catch (error) {
//             console.error('Login failed', error);
//             throw error;
//         } finally {
//             setIsLoading(false);
//         }
//     };
//
//     const logout = async () => {
//         try {
//             await axios.post('/logout');
//         } catch (error) {
//             console.error('Logout failed', error);
//         } finally {
//             setToken(null);
//             setUser(null);
//             localStorage.removeItem('token');
//         }
//     };
//
//     const value = {
//         user,
//         token,
//         isLoading,
//         login,
//         logout,
//         isAuthenticated: !!user,
//     };
//
//     return (
//         <AuthContext.Provider value={value}>
//             {children}
//         </AuthContext.Provider>
//     );
// }
import { useState, useContext, createContext, useEffect } from 'react';
import axios from 'axios';

// Създаване на axios инстанция с базови настройки
const api = axios.create({
    baseURL: 'http://localhost:8000/api',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
    },
});

const AuthContext = createContext();

export function useAuth() {
    return useContext(AuthContext);
}

export function AuthProvider({ children }) {
    const [user, setUser] = useState(null);
    const [token, setToken] = useState(localStorage.getItem('token'));
    const [isLoading, setIsLoading] = useState(true);

    // Автоматично добавяне на токена към заявките
    useEffect(() => {
        if (token) {
            api.defaults.headers.common['Authorization'] = `Bearer ${token}`;
            localStorage.setItem('token', token);
        } else {
            delete api.defaults.headers.common['Authorization'];
            localStorage.removeItem('token');
        }
    }, [token]);

    // Зареждане на потребител при наличие на токен
    useEffect(() => {
        if (token) {
            getUser();
        } else {
            setIsLoading(false);
        }
    }, [token]);

    const getUser = async () => {
        try {
            const response = await api.get('/user');
            setUser(response.data);
        } catch (error) {
            console.error('Failed to get user', error);
            logout();
        } finally {
            setIsLoading(false);
        }
    };

    const login = async (credentials) => {
        try {
            setIsLoading(true);
            const response = await api.post('/login', credentials);
            const { token: newToken, user: userData } = response.data;

            setToken(newToken);
            setUser(userData);

            return response.data;
        } catch (error) {
            console.error('Login failed', error);
            throw error;
        } finally {
            setIsLoading(false);
        }
    };

    const logout = async () => {
        try {
            await api.post('/logout');
        } catch (error) {
            console.error('Logout failed', error);
        } finally {
            setToken(null);
            setUser(null);
        }
    };

    const value = {
        user,
        token,
        isLoading,
        login,
        logout,
        isAuthenticated: !!user,
    };

    return (
        <AuthContext.Provider value={value}>
            {children}
        </AuthContext.Provider>
    );
}
