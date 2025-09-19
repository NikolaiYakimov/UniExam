// import React, { useState, useEffect } from 'react';
// import { api } from '../hooks/useAuth';
// import { useAuth } from '../hooks/useAuth';
// import Header from './Header';
// import Sidebar from './Sidebar';
// import Alert from './Alert';
// import { Link, useNavigate } from 'react-router-dom';
//
// const CreateUser = () => {
//     const [formData, setFormData] = useState({
//         first_name: '',
//         second_name: '',
//         last_name: '',
//         phone: '',
//         username: '',
//         email: '',
//         password: '',
//         role: '',
//         faculty_number: '',
//         faculty_id: '',
//         specialty_id: '',
//         semester: '',
//         group_id: '',
//         title: ''
//     });
//     const [faculties, setFaculties] = useState([]);
//     const [specialties, setSpecialties] = useState([]);
//     const [groups, setGroups] = useState([]);
//     const [loading, setLoading] = useState(false);
//     const [alert, setAlert] = useState({ type: '', message: '' });
//     const { user: currentUser } = useAuth();
//     const navigate = useNavigate();
//
//     useEffect(() => {
//         if (currentUser?.role === 'administrator') {
//             fetchFormData();
//         }
//     }, [currentUser]);
//
//     const fetchFormData = async () => {
//         try {
//             const [facultiesRes, specialtiesRes, groupsRes] = await Promise.all([
//                 api.get('/faculties'),
//                 api.get('/specialties'),
//                 api.get('/groups')
//             ]);
//
//             setFaculties(facultiesRes.data);
//             setSpecialties(specialtiesRes.data);
//             setGroups(groupsRes.data);
//         } catch (error) {
//             console.error('Failed to fetch form data', error);
//             setAlert({ type: 'error', message: 'Неуспешно зареждане на данните за формата' });
//         }
//     };
//
//     const handleChange = (e) => {
//         const { name, value } = e.target;
//         setFormData(prev => ({
//             ...prev,
//             [name]: value
//         }));
//     };
//
//     const handleSubmit = async (e) => {
//         e.preventDefault();
//         setLoading(true);
//
//         try {
//             await api.post('/users', formData);
//             setAlert({ type: 'success', message: 'Потребителят е създаден успешно!' });
//             setTimeout(() => {
//                 navigate('/admin/users');
//             }, 1500);
//         } catch (error) {
//             console.error('Failed to create user', error);
//             setAlert({ type: 'error', message: 'Неуспешно създаване на потребителя' });
//         } finally {
//             setLoading(false);
//         }
//     };
//
//     if (!currentUser || currentUser.role !== 'administrator') {
//         return (
//             <div className="min-h-screen bg-gray-50 flex items-center justify-center">
//                 <div className="text-center">
//                     <h1 className="text-2xl font-bold text-red-600">Достъп отказан</h1>
//                     <p className="mt-2">Нямате необходимите права за достъп до тази страница.</p>
//                 </div>
//             </div>
//         );
//     }
//
//     return (
//         <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50">
//             <Header />
//             <div className="flex pt-0">
//                 <Sidebar user={currentUser} />
//                 <div className="flex-1 p-4 lg:p-8 ml-0 lg:ml-0">
//                     {/* Page Header */}
//                     <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
//                         <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
//                             <div>
//                                 <h1 className="text-2xl font-bold text-gray-800">Добавяне на потребител</h1>
//                                 <p className="text-sm text-gray-500 mt-1">Добавете нов потребител в системата</p>
//                             </div>
//                             <Link
//                                 to="/admin/users"
//                                 className="inline-flex items-center gap-1 px-4 py-3 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-700 transition-colors"
//                             >
//                                 <i className="fas fa-arrow-left"></i>
//                                 Назад към списъка
//                             </Link>
//                         </div>
//                     </div>
//
//                     {alert.message && (
//                         <Alert type={alert.type} message={alert.message} onClose={() => setAlert({ type: '', message: '' })} />
//                     )}
//
//                     <div className="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
//                         <form onSubmit={handleSubmit}>
//                             <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
//                                 <div>
//                                     <label htmlFor="first_name" className="block text-sm font-medium text-gray-700 mb-1">Име</label>
//                                     <input
//                                         type="text"
//                                         name="first_name"
//                                         id="first_name"
//                                         value={formData.first_name}
//                                         onChange={handleChange}
//                                         className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
//                                         required
//                                     />
//                                 </div>
//
//                                 <div>
//                                     <label htmlFor="second_name" className="block text-sm font-medium text-gray-700 mb-1">Презиме</label>
//                                     <input
//                                         type="text"
//                                         name="second_name"
//                                         id="second_name"
//                                         value={formData.second_name}
//                                         onChange={handleChange}
//                                         className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
//                                     />
//                                 </div>
//
//                                 <div>
//                                     <label htmlFor="last_name" className="block text-sm font-medium text-gray-700 mb-1">Фамилия</label>
//                                     <input
//                                         type="text"
//                                         name="last_name"
//                                         id="last_name"
//                                         value={formData.last_name}
//                                         onChange={handleChange}
//                                         className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
//                                         required
//                                     />
//                                 </div>
//
//                                 <div>
//                                     <label htmlFor="phone" className="block text-sm font-medium text-gray-700 mb-1">Телефон</label>
//                                     <input
//                                         type="text"
//                                         name="phone"
//                                         id="phone"
//                                         value={formData.phone}
//                                         onChange={handleChange}
//                                         className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
//                                     />
//                                 </div>
//
//                                 <div>
//                                     <label htmlFor="username" className="block text-sm font-medium text-gray-700 mb-1">Потребителско име</label>
//                                     <input
//                                         type="text"
//                                         name="username"
//                                         id="username"
//                                         value={formData.username}
//                                         onChange={handleChange}
//                                         className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
//                                         required
//                                     />
//                                 </div>
//
//                                 <div>
//                                     <label htmlFor="email" className="block text-sm font-medium text-gray-700 mb-1">Имейл</label>
//                                     <input
//                                         type="email"
//                                         name="email"
//                                         id="email"
//                                         value={formData.email}
//                                         onChange={handleChange}
//                                         className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
//                                         required
//                                     />
//                                 </div>
//
//                                 <div>
//                                     <label htmlFor="password" className="block text-sm font-medium text-gray-700 mb-1">Парола</label>
//                                     <input
//                                         type="password"
//                                         name="password"
//                                         id="password"
//                                         value={formData.password}
//                                         onChange={handleChange}
//                                         className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
//                                         required
//                                     />
//                                 </div>
//
//                                 <div>
//                                     <label htmlFor="role" className="block text-sm font-medium text-gray-700 mb-1">Роля</label>
//                                     <select
//                                         name="role"
//                                         id="role"
//                                         value={formData.role}
//                                         onChange={handleChange}
//                                         className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
//                                         required
//                                     >
//                                         <option value="">Изберете роля</option>
//                                         <option value="student">Студент</option>
//                                         <option value="teacher">Преподавател</option>
//                                         <option value="administrator">Администратор</option>
//                                     </select>
//                                 </div>
//                             </div>
//
//                             {/* Student Fields */}
//                             {formData.role === 'student' && (
//                                 <div className="mb-6">
//                                     <h3 className="text-lg font-semibold text-gray-800 mb-4">Информация за студент</h3>
//                                     <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
//                                         <div>
//                                             <label htmlFor="faculty_number" className="block text-sm font-medium text-gray-700 mb-1">Факултетен номер</label>
//                                             <input
//                                                 type="text"
//                                                 name="faculty_number"
//                                                 id="faculty_number"
//                                                 value={formData.faculty_number}
//                                                 onChange={handleChange}
//                                                 className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
//                                             />
//                                         </div>
//
//                                         <div>
//                                             <label htmlFor="faculty_id" className="block text-sm font-medium text-gray-700 mb-1">Факултет</label>
//                                             <select
//                                                 name="faculty_id"
//                                                 id="faculty_id"
//                                                 value={formData.faculty_id}
//                                                 onChange={handleChange}
//                                                 className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
//                                             >
//                                                 <option value="">Изберете факултет</option>
//                                                 {faculties.map(faculty => (
//                                                     <option key={faculty.id} value={faculty.id}>{faculty.name}</option>
//                                                 ))}
//                                             </select>
//                                         </div>
//
//                                         <div>
//                                             <label htmlFor="specialty_id" className="block text-sm font-medium text-gray-700 mb-1">Специалност</label>
//                                             <select
//                                                 name="specialty_id"
//                                                 id="specialty_id"
//                                                 value={formData.specialty_id}
//                                                 onChange={handleChange}
//                                                 className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
//                                             >
//                                                 <option value="">Изберете специалност</option>
//                                                 {specialties.map(specialty => (
//                                                     <option key={specialty.id} value={specialty.id}>{specialty.name}</option>
//                                                 ))}
//                                             </select>
//                                         </div>
//
//                                         <div>
//                                             <label htmlFor="semester" className="block text-sm font-medium text-gray-700 mb-1">Семестър</label>
//                                             <input
//                                                 type="number"
//                                                 name="semester"
//                                                 id="semester"
//                                                 min="1"
//                                                 max="10"
//                                                 value={formData.semester}
//                                                 onChange={handleChange}
//                                                 className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
//                                             />
//                                         </div>
//
//                                         <div>
//                                             <label htmlFor="group_id" className="block text-sm font-medium text-gray-700 mb-1">Група</label>
//                                             <select
//                                                 name="group_id"
//                                                 id="group_id"
//                                                 value={formData.group_id}
//                                                 onChange={handleChange}
//                                                 className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
//                                             >
//                                                 <option value="">Изберете група</option>
//                                                 {groups.map(group => (
//                                                     <option key={group.id} value={group.id}>{group.name}</option>
//                                                 ))}
//                                             </select>
//                                         </div>
//                                     </div>
//                                 </div>
//                             )}
//
//                             {/* Teacher Fields */}
//                             {formData.role === 'teacher' && (
//                                 <div className="mb-6">
//                                     <h3 className="text-lg font-semibold text-gray-800 mb-4">Информация за преподавател</h3>
//                                     <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
//                                         <div>
//                                             <label htmlFor="title" className="block text-sm font-medium text-gray-700 mb-1">Титла</label>
//                                             <input
//                                                 type="text"
//                                                 name="title"
//                                                 id="title"
//                                                 value={formData.title}
//                                                 onChange={handleChange}
//                                                 className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
//                                             />
//                                         </div>
//
//                                         <div>
//                                             <label htmlFor="teacher_faculty_id" className="block text-sm font-medium text-gray-700 mb-1">Факултет</label>
//                                             <select
//                                                 name="faculty_id"
//                                                 id="teacher_faculty_id"
//                                                 value={formData.faculty_id}
//                                                 onChange={handleChange}
//                                                 className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
//                                             >
//                                                 <option value="">Изберете факултет</option>
//                                                 {faculties.map(faculty => (
//                                                     <option key={faculty.id} value={faculty.id}>{faculty.name}</option>
//                                                 ))}
//                                             </select>
//                                         </div>
//
//                                         <div>
//                                             <label htmlFor="teacher_specialty_id" className="block text-sm font-medium text-gray-700 mb-1">Специалност</label>
//                                             <select
//                                                 name="specialty_id"
//                                                 id="teacher_specialty_id"
//                                                 value={formData.specialty_id}
//                                                 onChange={handleChange}
//                                                 className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
//                                             >
//                                                 <option value="">Изберете специалност</option>
//                                                 {specialties.map(specialty => (
//                                                     <option key={specialty.id} value={specialty.id}>{specialty.name}</option>
//                                                 ))}
//                                             </select>
//                                         </div>
//                                     </div>
//                                 </div>
//                             )}
//
//                             <div className="flex justify-end">
//                                 <button
//                                     type="submit"
//                                     disabled={loading}
//                                     className="px-6 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 disabled:opacity-50"
//                                 >
//                                     {loading ? 'Зареждане...' : 'Запази потребител'}
//                                 </button>
//                             </div>
//                         </form>
//                     </div>
//                 </div>
//             </div>
//         </div>
//     );
// };
//
// export default CreateUser;

// import React, { useState, useEffect } from 'react';
// import { useNavigate } from 'react-router-dom';
// import UserForm from './UserForm';
// import { useAuth } from '../hooks/useAuth';
// import { api } from '../hooks/useAuth';
// const CreateUser = () => {
//     const [formData, setFormData] = useState({
//         first_name: '',
//         second_name: '',
//         last_name: '',
//         phone: '',
//         username: '',
//         email: '',
//         password: '',
//         role: '',
//         faculty_number: '',
//         faculty_id: '',
//         specialty_id: '',
//         semester: '',
//         group_id: '',
//         title: ''
//     });
//     const [faculties, setFaculties] = useState([]);
//     const [specialties, setSpecialties] = useState([]);
//     const [groups, setGroups] = useState([]);
//     const [loading, setLoading] = useState(false);
//     const [errors, setErrors] = useState({});
//     const navigate = useNavigate();
//
//     useEffect(() => {
//         fetchInitialData();
//     }, []);
//
//     const fetchInitialData = async () => {
//         try {
//             const response = await api.get('/users/create');
//             setFaculties(response.data.faculties);
//             setSpecialties(response.data.specialties);
//             setGroups(response.data.groups);
//         } catch (error) {
//             console.error('Грешка при зареждане на данните:', error);
//         }
//     };
//
//     const handleChange = (e) => {
//         const { name, value } = e.target;
//         setFormData(prev => ({
//             ...prev,
//             [name]: value
//         }));
//     };
//
//     const handleSubmit = async (e) => {
//         e.preventDefault();
//         setLoading(true);
//         setErrors({});
//
//         try {
//             const response = await api.post('/users/store', formData);
//             if (response.data.success) {
//                 navigate('/users', {
//                     state: { message: 'Потребителят е създаден успешно.' }
//                 });
//             }
//         } catch (error) {
//             if (error.response && error.response.data.errors) {
//                 setErrors(error.response.data.errors);
//             } else {
//                 console.error('Грешка при създаване на потребител:', error);
//             }
//         } finally {
//             setLoading(false);
//         }
//     };
//
//     return (
//         <UserForm
//             formData={formData}
//             handleChange={handleChange}
//             handleSubmit={handleSubmit}
//             faculties={faculties}
//             specialties={specialties}
//             groups={groups}
//             errors={errors}
//             loading={loading}
//             isEdit={false}
//         />
//     );
// };
//
// export default CreateUser;
import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import UserForm from './UserForm';
import { useAuth } from '../hooks/useAuth';
import { api } from '../hooks/useAuth';
import Header from './Header';
import Sidebar from './Sidebar';

const CreateUser = () => {
    const [formData, setFormData] = useState({
        first_name: '',
        second_name: '',
        last_name: '',
        phone: '',
        username: '',
        email: '',
        password: '',
        role: '',
        faculty_number: '',
        faculty_id: '',
        specialty_id: '',
        semester: '',
        group_id: '',
        title: ''
    });
    const [faculties, setFaculties] = useState([]);
    const [specialties, setSpecialties] = useState([]);
    const [groups, setGroups] = useState([]);
    const [loading, setLoading] = useState(false);
    const [errors, setErrors] = useState({});
    const navigate = useNavigate();
    const { user: currentUser } = useAuth();

    useEffect(() => {
        fetchInitialData();
    }, []);

    const fetchInitialData = async () => {
        try {
            const response = await api.get('/users/create');
            setFaculties(response.data.faculties);
            setSpecialties(response.data.specialties);
            setGroups(response.data.groups);
        } catch (error) {
            console.error('Грешка при зареждане на данните:', error);
        }
    };

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData(prev => ({
            ...prev,
            [name]: value
        }));
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        setErrors({});

        try {
            const response = await api.post('/users/store', formData);
            if (response.data.success) {
                navigate('/users', {
                    state: { message: 'Потребителят е създаден успешно.' }
                });
            }
        } catch (error) {
            if (error.response && error.response.data.errors) {
                setErrors(error.response.data.errors);
            } else {
                console.error('Грешка при създаване на потребител:', error);
            }
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 overflow-x-hidden">
            <Header />

            <div className="flex">
                <Sidebar user={currentUser} />

                <div className="flex-1 ml-0 lg:ml-0 p-4 lg:p-4">
                    <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-4 rounded-xl border border-gray-100">
                        <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                            <div>
                                <h1 className="text-2xl font-bold text-gray-800">Добавяне на потребител</h1>
                                <p className="text-sm text-gray-500 mt-1">Добавете нов потребител в системата</p>
                            </div>
                            <button
                                onClick={() => navigate('/users')}
                                className="inline-flex items-center gap-1 px-4 py-3 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-700 transition-colors"
                            >
                                <i className="fas fa-arrow-left"></i>
                                Назад към списъка
                            </button>
                        </div>
                    </div>

                    <UserForm
                        formData={formData}
                        handleChange={handleChange}
                        handleSubmit={handleSubmit}
                        faculties={faculties}
                        specialties={specialties}
                        groups={groups}
                        errors={errors}
                        loading={loading}
                        isEdit={false}
                    />
                </div>
            </div>
        </div>
    );
};

export default CreateUser;
