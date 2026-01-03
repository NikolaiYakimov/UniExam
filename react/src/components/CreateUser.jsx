
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
                    state: { message: 'Потребителят е създаден успешно.' },
                    replace: true // Добавяне на replace: true
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
