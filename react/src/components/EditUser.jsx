
import React, { useState, useEffect } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import UserForm from './UserForm';
import { useAuth } from '../hooks/useAuth';
import { api } from '../hooks/useAuth';
import Header from './Header';
import Sidebar from './Sidebar';

const EditUser = () => {
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
    const { id } = useParams();
    const { user: currentUser } = useAuth();

    useEffect(() => {
        fetchUserData();
    }, [id]);

    const fetchUserData = async () => {
        try {
            const response = await api.get(`/users/${id}/edit`);
            const userData = response.data.data;

            setFormData({
                first_name: userData.first_name || '',
                second_name: userData.second_name || '',
                last_name: userData.last_name || '',
                phone: userData.phone || '',
                username: userData.username || '',
                email: userData.email || '',
                password: '',
                role: userData.role || '',
                faculty_number: userData.student?.faculty_number || '',
                faculty_id: userData.student?.faculty_id || userData.teacher?.faculty_id || '',
                specialty_id: userData.student?.specialty_id || userData.teacher?.specialty_id || '',
                semester: userData.student?.semester || '',
                group_id: userData.student?.group_id || '',
                title: userData.teacher?.title || ''
            });

            setFaculties(response.data.faculties);
            setSpecialties(response.data.specialties);
            setGroups(response.data.groups);
        } catch (error) {
            console.error('Грешка при зареждане на данните за потребителя:', error);
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
            const response = await api.put(`/users/${id}`, formData);
            if (response.data.success) {
                navigate('/users', {
                    state: { message: 'Потребителят е актуализиран успешно.' },
                    replace: true // Добавяне на replace: true
                });
            }
        } catch (error) {
            if (error.response && error.response.data.errors) {
                setErrors(error.response.data.errors);
            } else {
                console.error('Грешка при актуализиране на потребител:', error);
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
                                <h1 className="text-2xl font-bold text-gray-800">Редактиране на потребител</h1>
                                <p className="text-sm text-gray-500 mt-1">Редактирайте потребителския профил</p>
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
                        isEdit={true}
                    />
                </div>
            </div>
        </div>
    );
};

export default EditUser;
