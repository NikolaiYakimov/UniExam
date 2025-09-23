
import React from 'react';

const UserForm = ({
                      formData,
                      handleChange,
                      handleSubmit,
                      faculties,
                      specialties,
                      groups,
                      errors,
                      loading,
                      isEdit
                  }) => {

    return (
        <div className="bg-white border border-gray-100 rounded-xl p-6 shadow-sm w-full">
            <form onSubmit={handleSubmit}>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label htmlFor="first_name" className="block text-sm font-medium text-gray-700 mb-1">
                            Име
                        </label>
                        <input
                            type="text"
                            name="first_name"
                            id="first_name"
                            value={formData.first_name}
                            onChange={handleChange}
                            className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            required
                        />
                        {errors.first_name && <p className="text-red-500 text-xs mt-1">{errors.first_name[0]}</p>}
                    </div>

                    <div>
                        <label htmlFor="second_name" className="block text-sm font-medium text-gray-700 mb-1">
                            Презиме
                        </label>
                        <input
                            type="text"
                            name="second_name"
                            id="second_name"
                            value={formData.second_name}
                            onChange={handleChange}
                            className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        />
                        {errors.second_name && <p className="text-red-500 text-xs mt-1">{errors.second_name[0]}</p>}
                    </div>

                    <div>
                        <label htmlFor="last_name" className="block text-sm font-medium text-gray-700 mb-1">
                            Фамилия
                        </label>
                        <input
                            type="text"
                            name="last_name"
                            id="last_name"
                            value={formData.last_name}
                            onChange={handleChange}
                            className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            required
                        />
                        {errors.last_name && <p className="text-red-500 text-xs mt-1">{errors.last_name[0]}</p>}
                    </div>

                    <div>
                        <label htmlFor="phone" className="block text-sm font-medium text-gray-700 mb-1">
                            Телефон
                        </label>
                        <input
                            type="text"
                            name="phone"
                            id="phone"
                            value={formData.phone}
                            onChange={handleChange}
                            className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        />
                        {errors.phone && <p className="text-red-500 text-xs mt-1">{errors.phone[0]}</p>}
                    </div>

                    <div>
                        <label htmlFor="username" className="block text-sm font-medium text-gray-700 mb-1">
                            Потребителско име
                        </label>
                        <input
                            type="text"
                            name="username"
                            id="username"
                            value={formData.username}
                            onChange={handleChange}
                            className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            required
                        />
                        {errors.username && <p className="text-red-500 text-xs mt-1">{errors.username[0]}</p>}
                    </div>

                    <div>
                        <label htmlFor="email" className="block text-sm font-medium text-gray-700 mb-1">
                            Имейл
                        </label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value={formData.email}
                            onChange={handleChange}
                            className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            required
                        />
                        {errors.email && <p className="text-red-500 text-xs mt-1">{errors.email[0]}</p>}
                    </div>

                    <div>
                        <label htmlFor="password" className="block text-sm font-medium text-gray-700 mb-1">
                            {isEdit ? 'Парола (оставете празно за да запазите текущата)' : 'Парола'}
                        </label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            value={formData.password}
                            onChange={handleChange}
                            className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            required={!isEdit}
                        />
                        {errors.password && <p className="text-red-500 text-xs mt-1">{errors.password[0]}</p>}
                    </div>

                    <div>
                        <label htmlFor="role" className="block text-sm font-medium text-gray-700 mb-1">
                            Роля
                        </label>
                        <select
                            name="role"
                            id="role"
                            value={formData.role}
                            onChange={handleChange}
                            className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            required
                        >
                            <option value="">Изберете роля</option>
                            <option value="student">Студент</option>
                            <option value="teacher">Преподавател</option>
                            <option value="administrator">Администратор</option>
                        </select>
                        {errors.role && <p className="text-red-500 text-xs mt-1">{errors.role[0]}</p>}
                    </div>
                </div>

                {/* Student Fields */}
                {formData.role === 'student' && (
                    <div id="student-fields" className="mb-6">
                        <h3 className="text-lg font-semibold text-gray-800 mb-4">Информация за студент</h3>
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label htmlFor="faculty_number" className="block text-sm font-medium text-gray-700 mb-1">
                                    Факултетен номер
                                </label>
                                <input
                                    type="text"
                                    name="faculty_number"
                                    id="faculty_number"
                                    value={formData.faculty_number}
                                    onChange={handleChange}
                                    className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                />
                                {errors.faculty_number && <p className="text-red-500 text-xs mt-1">{errors.faculty_number[0]}</p>}
                            </div>

                            <div>
                                <label htmlFor="faculty_id" className="block text-sm font-medium text-gray-700 mb-1">
                                    Факултет
                                </label>
                                <select
                                    name="faculty_id"
                                    id="faculty_id"
                                    value={formData.faculty_id}
                                    onChange={handleChange}
                                    className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                >
                                    <option value="">Изберете факултет</option>
                                    {faculties.map(faculty => (
                                        <option key={faculty.id} value={faculty.id}>
                                            {faculty.name}
                                        </option>
                                    ))}
                                </select>
                                {errors.faculty_id && <p className="text-red-500 text-xs mt-1">{errors.faculty_id[0]}</p>}
                            </div>

                            <div>
                                <label htmlFor="specialty_id" className="block text-sm font-medium text-gray-700 mb-1">
                                    Специалност
                                </label>
                                <select
                                    name="specialty_id"
                                    id="specialty_id"
                                    value={formData.specialty_id}
                                    onChange={handleChange}
                                    className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                >
                                    <option value="">Изберете специалност</option>
                                    {specialties.map(specialty => (
                                        <option key={specialty.id} value={specialty.id}>
                                            {specialty.name}
                                        </option>
                                    ))}
                                </select>
                                {errors.specialty_id && <p className="text-red-500 text-xs mt-1">{errors.specialty_id[0]}</p>}
                            </div>

                            <div>
                                <label htmlFor="semester" className="block text-sm font-medium text-gray-700 mb-1">
                                    Семестър
                                </label>
                                <input
                                    type="number"
                                    name="semester"
                                    id="semester"
                                    value={formData.semester}
                                    onChange={handleChange}
                                    min="1"
                                    max="10"
                                    className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                />
                                {errors.semester && <p className="text-red-500 text-xs mt-1">{errors.semester[0]}</p>}
                            </div>

                            <div>
                                <label htmlFor="group_id" className="block text-sm font-medium text-gray-700 mb-1">
                                    Група
                                </label>
                                <select
                                    name="group_id"
                                    id="group_id"
                                    value={formData.group_id}
                                    onChange={handleChange}
                                    className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                >
                                    <option value="">Изберете група</option>
                                    {groups.map(group => (
                                        <option key={group.id} value={group.id}>
                                            {group.name}
                                        </option>
                                    ))}
                                </select>
                                {errors.group_id && <p className="text-red-500 text-xs mt-1">{errors.group_id[0]}</p>}
                            </div>
                        </div>
                    </div>
                )}

                {/* Teacher Fields */}
                {formData.role === 'teacher' && (
                    <div id="teacher-fields" className="mb-6">
                        <h3 className="text-lg font-semibold text-gray-800 mb-4">Информация за преподавател</h3>
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label htmlFor="title" className="block text-sm font-medium text-gray-700 mb-1">
                                    Титла
                                </label>
                                <input
                                    type="text"
                                    name="title"
                                    id="title"
                                    value={formData.title}
                                    onChange={handleChange}
                                    className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                />
                                {errors.title && <p className="text-red-500 text-xs mt-1">{errors.title[0]}</p>}
                            </div>

                            <div>
                                <label htmlFor="teacher_faculty_id" className="block text-sm font-medium text-gray-700 mb-1">
                                    Факултет
                                </label>
                                <select
                                    name="faculty_id"
                                    id="teacher_faculty_id"
                                    value={formData.faculty_id}
                                    onChange={handleChange}
                                    className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                >
                                    <option value="">Изберете факултет</option>
                                    {faculties.map(faculty => (
                                        <option key={faculty.id} value={faculty.id}>
                                            {faculty.name}
                                        </option>
                                    ))}
                                </select>
                                {errors.faculty_id && <p className="text-red-500 text-xs mt-1">{errors.faculty_id[0]}</p>}
                            </div>

                            <div>
                                <label htmlFor="teacher_specialty_id" className="block text-sm font-medium text-gray-700 mb-1">
                                    Специалност
                                </label>
                                <select
                                    name="specialty_id"
                                    id="teacher_specialty_id"
                                    value={formData.specialty_id}
                                    onChange={handleChange}
                                    className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                >
                                    <option value="">Изберете специалност</option>
                                    {specialties.map(specialty => (
                                        <option key={specialty.id} value={specialty.id}>
                                            {specialty.name}
                                        </option>
                                    ))}
                                </select>
                                {errors.specialty_id && <p className="text-red-500 text-xs mt-1">{errors.specialty_id[0]}</p>}
                            </div>
                        </div>
                    </div>
                )}

                <div className="flex justify-end">
                    <button
                        type="submit"
                        disabled={loading}
                        className="px-6 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 disabled:opacity-50"
                    >
                        {loading ? 'Зареждане...' : (isEdit ? 'Запази промените' : 'Запази потребител')}
                    </button>
                </div>
            </form>
        </div>
    );
};

export default UserForm;
