import React, { useState, useEffect } from 'react';
import { useAuth } from '../hooks/useAuth';
import { api } from '../hooks/useAuth';
import { useParams, useNavigate, Link } from 'react-router-dom';
import Alert from './Alert';
import Header from './Header';
import Sidebar from './Sidebar';

const EditSubject = () => {
    const { user } = useAuth();
    const { id } = useParams();
    const navigate = useNavigate();
    const [formData, setFormData] = useState({
        subject_name: '',
        description: '',
        semester: 1,
        price: 0,
        specialties: [],
        teachers: []
    });
    const [specialties, setSpecialties] = useState([]);
    const [availableTeachers, setAvailableTeachers] = useState({});
    const [alert, setAlert] = useState({ type: '', message: '' });
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        fetchSubject();
    }, [id]);

    // Филтрираме преподавателите според избраните специалности
    useEffect(() => {
        const selectedSpecialtyIds = formData.specialties.map(id => parseInt(id));

        const teachersBySpecialty = {};
        specialties.forEach(specialty => {
            if (selectedSpecialtyIds.includes(specialty.id)) {
                teachersBySpecialty[specialty.id] = {
                    specialtyName: specialty.name,
                    teachers: specialty.teachers || []
                };
            }
        });

        setAvailableTeachers(teachersBySpecialty);

        // Премахваме преподаватели, които не са в новия списък
        setFormData(prev => ({
            ...prev,
            teachers: prev.teachers.filter(teacherId =>
                Object.values(teachersBySpecialty).some(group =>
                    group.teachers.some(teacher => teacher.id.toString() === teacherId)
                )
            )
        }));
    }, [formData.specialties, specialties]);

    const fetchSubject = async () => {
        try {
            const response = await api.get(`/subjects/${id}/edit`);
            const { data, specialties: specialtiesData, selectedSpecialties, selectedTeachers } = response.data;

            // Конвертираме ID-тата към стрингове за правилно сравнение
            setFormData({
                subject_name: data.subject_name,
                description: data.description,
                semester: data.semester,
                price: data.price,
                specialties: selectedSpecialties.map(id => id.toString()),
                teachers: selectedTeachers.map(id => id.toString())
            });

            setSpecialties(specialtiesData);

            // Групираме преподавателите по специалности
            const teachersBySpecialty = {};
            specialtiesData.forEach(specialty => {
                teachersBySpecialty[specialty.id] = {
                    specialtyName: specialty.name,
                    teachers: specialty.teachers || []
                };
            });

            setAvailableTeachers(teachersBySpecialty);
        } catch (error) {
            console.error('Грешка при зареждане на дисциплина:', error);
            setAlert({ type: 'error', message: 'Грешка при зареждане на дисциплина' });
        }
    };

    const handleChange = (e) => {
        const { name, value, type, checked } = e.target;

        if (type === 'checkbox') {
            const updatedArray = checked
                ? [...formData[name], value]
                : formData[name].filter(id => id !== value);

            setFormData({ ...formData, [name]: updatedArray });
        } else {
            setFormData({ ...formData, [name]: value });
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);

        try {
            await api.put(`/subjects/${id}`, formData);
            // Навигиране към списъка със съобщение за успех
            navigate('/subjects', {
                state: { message: 'Дисциплината е актуализирана успешно!' },
                replace: true
            });
        } catch (error) {
            console.error('Грешка при актуализация на дисциплина:', error);
            setAlert({ type: 'error', message: 'Грешка при актуализация на дисциплина' });
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-50 overflow-x-hidden">
            <Header />
            <div className="flex">
                <Sidebar user={user} />
                <div className="flex-1 ml-0 lg:ml-0 p-4 lg:p-4">
                    <div className="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-4 rounded-xl border border-gray-100">
                        <div className="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                            <div>
                                <h1 className="text-2xl font-bold text-gray-800">Редактиране на дисциплина</h1>
                                <p className="text-sm text-gray-500 mt-1">Променете информацията за дисциплината</p>
                            </div>
                            <Link
                                to="/subjects"
                                className="inline-flex items-center gap-1 px-4 py-3 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-700 transition-colors"
                            >
                                <i className="fas fa-arrow-left"></i>
                                Назад към списъка
                            </Link>
                        </div>
                    </div>

                    {alert.message && (
                        <Alert type={alert.type} message={alert.message} onClose={() => setAlert({ type: '', message: '' })} />
                    )}

                    <div className="bg-white border border-gray-100 rounded-xl p-6 shadow-sm w-full">
                        <form onSubmit={handleSubmit}>
                            <div className="space-y-6">
                                <div>
                                    <label htmlFor="subject_name" className="block text-sm font-medium text-gray-700 mb-1">
                                        Име на дисциплина *
                                    </label>
                                    <input
                                        type="text"
                                        name="subject_name"
                                        id="subject_name"
                                        required
                                        value={formData.subject_name}
                                        disabled
                                        className="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 border bg-gray-100 text-gray-500 cursor-not-allowed"
                                    />
                                </div>

                                <div>
                                    <label htmlFor="description" className="block text-sm font-medium text-gray-700 mb-1">
                                        Описание
                                    </label>
                                    <textarea
                                        name="description"
                                        id="description"
                                        rows="3"
                                        value={formData.description}
                                        onChange={handleChange}
                                        className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border"
                                    ></textarea>
                                </div>

                                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label htmlFor="semester" className="block text-sm font-medium text-gray-700 mb-1">
                                            Семестър *
                                        </label>
                                        <select
                                            name="semester"
                                            id="semester"
                                            required
                                            value={formData.semester}
                                            onChange={handleChange}
                                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border"
                                        >
                                            {[...Array(8)].map((_, i) => (
                                                <option key={i + 1} value={i + 1}>
                                                    {i + 1}
                                                </option>
                                            ))}
                                        </select>
                                    </div>

                                    <div>
                                        <label htmlFor="price" className="block text-sm font-medium text-gray-700 mb-1">
                                            Цена (лв.) *
                                        </label>
                                        <input
                                            type="number"
                                            step="0.01"
                                            min="0"
                                            name="price"
                                            id="price"
                                            value={formData.price}
                                            disabled
                                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 border bg-gray-100 text-gray-500 cursor-not-allowed"
                                        />
                                    </div>
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-2">Специалности</label>
                                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 max-h-60 overflow-y-auto p-3 border border-gray-200 rounded-md bg-gray-50">
                                        {specialties.map((specialty) => (
                                            <div key={specialty.id} className="flex items-center">
                                                <input
                                                    type="checkbox"
                                                    name="specialties"
                                                    value={specialty.id}
                                                    id={`specialty_${specialty.id}`}
                                                    checked={formData.specialties.includes(specialty.id.toString())}
                                                    onChange={handleChange}
                                                    className="hidden"
                                                />
                                                <label
                                                    htmlFor={`specialty_${specialty.id}`}
                                                    className={`flex items-center cursor-pointer text-sm px-3 py-2 rounded-full transition-colors ${
                                                        formData.specialties.includes(specialty.id.toString())
                                                            ? 'bg-indigo-100 text-indigo-800 border border-indigo-300'
                                                            : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-100'
                                                    }`}
                                                >
                                                    <span className={`w-4 h-4 inline-block mr-2 rounded-sm border flex-shrink-0 ${
                                                        formData.specialties.includes(specialty.id.toString())
                                                            ? 'bg-indigo-600 border-indigo-600 text-white'
                                                            : 'bg-white border-gray-300'
                                                    }`}>
                                                        {formData.specialties.includes(specialty.id.toString()) && (
                                                            <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 13l4 4L19 7" />
                                                            </svg>
                                                        )}
                                                    </span>
                                                    {specialty.name}
                                                </label>
                                            </div>
                                        ))}
                                    </div>
                                </div>

                                {/* Поле за избор на преподаватели */}
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-2">Преподаватели</label>
                                    <div className="max-h-60 overflow-y-auto p-3 border border-gray-200 rounded-md bg-gray-50">
                                        {Object.entries(availableTeachers).length > 0 ? (
                                            Object.entries(availableTeachers).map(([specialtyId, group]) => (
                                                <div key={specialtyId} className="mb-4">
                                                    <h4 className="font-medium text-gray-700 mb-2 text-lg">
                                                        {group.specialtyName}
                                                    </h4>
                                                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                                        {group.teachers.map((teacher) => (
                                                            <div key={teacher.id} className="flex items-center">
                                                                <input
                                                                    type="checkbox"
                                                                    name="teachers"
                                                                    value={teacher.id}
                                                                    id={`teacher_${teacher.id}`}
                                                                    checked={formData.teachers.includes(teacher.id.toString())}
                                                                    onChange={handleChange}
                                                                    className="hidden"
                                                                />
                                                                <label
                                                                    htmlFor={`teacher_${teacher.id}`}
                                                                    className={`flex items-center cursor-pointer text-sm px-3 py-2 rounded-full transition-colors ${
                                                                        formData.teachers.includes(teacher.id.toString())
                                                                            ? 'bg-indigo-100 text-indigo-800 border border-indigo-300'
                                                                            : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-100'
                                                                    }`}
                                                                >
                                                                    <span className={`w-4 h-4 inline-block mr-2 rounded-sm border flex-shrink-0 ${
                                                                        formData.teachers.includes(teacher.id.toString())
                                                                            ? 'bg-indigo-600 border-indigo-600 text-white'
                                                                            : 'bg-white border-gray-300'
                                                                    }`}>
                                                                        {formData.teachers.includes(teacher.id.toString()) && (
                                                                            <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 13l4 4L19 7" />
                                                                            </svg>
                                                                        )}
                                                                    </span>
                                                                    {teacher.user.first_name} {teacher.user.last_name}
                                                                </label>
                                                            </div>
                                                        ))}
                                                    </div>
                                                </div>
                                            ))
                                        ) : (
                                            <p className="text-gray-500 text-center py-4">
                                                Моля, изберете поне една специалност, за да видите преподавателите.
                                            </p>
                                        )}
                                    </div>
                                </div>

                                <div className="flex justify-end space-x-3 pt-4">
                                    <Link
                                        to="/subjects"
                                        className="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50"
                                    >
                                        Отказ
                                    </Link>
                                    <button
                                        type="submit"
                                        disabled={loading}
                                        className="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 disabled:opacity-50"
                                    >
                                        {loading ? 'Зареждане...' : 'Запази промените'}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default EditSubject;
