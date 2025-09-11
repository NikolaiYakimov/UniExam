{{--<!DOCTYPE html>--}}
{{--<html lang="bg">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Редактиране на потребител</title>--}}
{{--    <script src="https://cdn.tailwindcss.com"></script>--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">--}}
{{--    <script>--}}
{{--        document.addEventListener('DOMContentLoaded', function() {--}}
{{--            const roleSelect = document.getElementById('role');--}}
{{--            const studentFields = document.getElementById('student-fields');--}}
{{--            const teacherFields = document.getElementById('teacher-fields');--}}

{{--            function toggleFields() {--}}
{{--                const role = roleSelect.value;--}}

{{--                // Hide all fields first--}}
{{--                studentFields.classList.add('hidden');--}}
{{--                teacherFields.classList.add('hidden');--}}

{{--                // Show fields based on selected role--}}
{{--                if (role === 'student') {--}}
{{--                    studentFields.classList.remove('hidden');--}}
{{--                } else if (role === 'teacher') {--}}
{{--                    teacherFields.classList.remove('hidden');--}}
{{--                }--}}
{{--            }--}}

{{--            // Initial toggle based on current role--}}
{{--            toggleFields();--}}

{{--            // Add event listener--}}
{{--            roleSelect.addEventListener('change', toggleFields);--}}
{{--        });--}}
{{--    </script>--}}
{{--</head>--}}
{{--<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">--}}
{{--<!-- Header -->--}}
{{--@include('partials.header')--}}

{{--<div class="page-layout">--}}
{{--    <!-- Sidebar -->--}}
{{--    @include('partials.sidebar')--}}

{{--    <!-- Основно съдържание -->--}}
{{--    <div id="mainContent" class="ml-0 lg:ml-0 p-4 lg:p-8 transition-all duration-300">--}}
{{--        <!-- Page Header -->--}}
{{--        <div class="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">--}}
{{--            <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">--}}
{{--                <div>--}}
{{--                    <h1 class="text-2xl font-bold text-gray-800">Редактиране на потребител</h1>--}}
{{--                    <p class="text-sm text-gray-500 mt-1">Редактирайте потребителския профил</p>--}}
{{--                </div>--}}
{{--                <a href="{{ route('admin.users.uni_users') }}" class="inline-flex items-center gap-1 px-4 py-3 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-700 transition-colors">--}}
{{--                    <i class="fas fa-arrow-left"></i>--}}
{{--                    Назад към списъка--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        --}}{{-- Alerts --}}
{{--        @include('partials.alerts')--}}

{{--        <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">--}}
{{--            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">--}}
{{--                @csrf--}}
{{--                @method('PUT')--}}

{{--                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">--}}
{{--                    <div>--}}
{{--                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">Име</label>--}}
{{--                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label for="second_name" class="block text-sm font-medium text-gray-700 mb-1">Презиме</label>--}}
{{--                        <input type="text" name="second_name" id="second_name" value="{{ old('second_name', $user->second_name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Фамилия</label>--}}
{{--                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Телефон</label>--}}
{{--                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Потребителско име</label>--}}
{{--                        <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Имейл</label>--}}
{{--                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Парола (оставете празно за да запазите текущата)</label>--}}
{{--                        <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Роля</label>--}}
{{--                        <select name="role" id="role" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>--}}
{{--                            <option value="">Изберете роля</option>--}}
{{--                            <option value="student" {{ old('role', $user->role) == 'student' ? 'selected' : '' }}>Студент</option>--}}
{{--                            <option value="teacher" {{ old('role', $user->role) == 'teacher' ? 'selected' : '' }}>Преподавател</option>--}}
{{--                            <option value="administrator" {{ old('role', $user->role) == 'administrator' ? 'selected' : '' }}>Администратор</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Student Fields -->--}}
{{--                <div id="student-fields" class="hidden mb-6">--}}
{{--                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Информация за студент</h3>--}}
{{--                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">--}}
{{--                        <div>--}}
{{--                            <label for="faculty_number" class="block text-sm font-medium text-gray-700 mb-1">Факултетен номер</label>--}}
{{--                            <input type="text" name="faculty_number" id="faculty_number" value="{{ old('faculty_number', $user->student->faculty_number ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <label for="faculty_id" class="block text-sm font-medium text-gray-700 mb-1">Факултет</label>--}}
{{--                            <select name="faculty_id" id="faculty_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">--}}
{{--                                <option value="">Изберете факултет</option>--}}
{{--                                @foreach($faculties as $faculty)--}}
{{--                                    <option value="{{ $faculty->id }}" {{ old('faculty_id', $user->student->faculty_id ?? '') == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <label for="specialty_id" class="block text-sm font-medium text-gray-700 mb-1">Специалност</label>--}}
{{--                            <select name="specialty_id" id="specialty_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">--}}
{{--                                <option value="">Изберете специалност</option>--}}
{{--                                @foreach($specialties as $specialty)--}}
{{--                                    <option value="{{ $specialty->id }}" {{ old('specialty_id', $user->student->specialty_id ?? '') == $specialty->id ? 'selected' : '' }}>{{ $specialty->name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <label for="semester" class="block text-sm font-medium text-gray-700 mb-1">Семестър</label>--}}
{{--                            <input type="number" name="semester" id="semester" min="1" max="10" value="{{ old('semester', $user->student->semester ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <label for="group_id" class="block text-sm font-medium text-gray-700 mb-1">Група</label>--}}
{{--                            <select name="group_id" id="group_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">--}}
{{--                                <option value="">Изберете група</option>--}}
{{--                                @foreach($groups as $group)--}}
{{--                                    <option value="{{ $group->id }}" {{ old('group_id', $user->student->group_id ?? '') == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Teacher Fields -->--}}
{{--                <div id="teacher-fields" class="hidden mb-6">--}}
{{--                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Информация за преподавател</h3>--}}
{{--                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">--}}
{{--                        <div>--}}
{{--                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Титла</label>--}}
{{--                            <input type="text" name="title" id="title" value="{{ old('title', $user->teacher->title ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <label for="teacher_faculty_id" class="block text-sm font-medium text-gray-700 mb-1">Факултет</label>--}}
{{--                            <select name="faculty_id" id="teacher_faculty_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">--}}
{{--                                <option value="">Изберете факултет</option>--}}
{{--                                @foreach($faculties as $faculty)--}}
{{--                                    <option value="{{ $faculty->id }}" {{ old('faculty_id', $user->teacher->faculty_id ?? '') == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <label for="teacher_specialty_id" class="block text-sm font-medium text-gray-700 mb-1">Специалност</label>--}}
{{--                            <select name="specialty_id" id="teacher_specialty_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">--}}
{{--                                <option value="">Изберете специалност</option>--}}
{{--                                @foreach($specialties as $specialty)--}}
{{--                                    <option value="{{ $specialty->id }}" {{ old('specialty_id', $user->teacher->specialty_id ?? '') == $specialty->id ? 'selected' : '' }}>{{ $specialty->name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="flex justify-end">--}}
{{--                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">--}}
{{--                        Запази промените--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<script src="{{ asset('js/menuFunctions.js') }}" defer></script>--}}
{{--<script src="{{ asset('js/alertClosingFunctions.js') }}" defer></script>--}}
{{--</body>--}}
{{--</html>--}}

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактиране на потребител</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const studentFields = document.getElementById('student-fields');
            const teacherFields = document.getElementById('teacher-fields');

            function toggleFields() {
                const role = roleSelect.value;

                // Hide all fields first
                studentFields.classList.add('hidden');
                teacherFields.classList.add('hidden');

                // Show fields based on selected role
                if (role === 'student') {
                    studentFields.classList.remove('hidden');
                } else if (role === 'teacher') {
                    teacherFields.classList.remove('hidden');
                }
            }

            // Initial toggle based on current role
            toggleFields();

            // Add event listener
            roleSelect.addEventListener('change', toggleFields);
        });
    </script>
</head>
<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">
<!-- Header -->
@include('partials.header')

<div class="page-layout">
    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Основно съдържание -->
    <div id="mainContent" class="ml-0 lg:ml-0 p-4 lg:p-8 transition-all duration-300">
        <!-- Page Header -->
        <div class="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Редактиране на потребител</h1>
                    <p class="text-sm text-gray-500 mt-1">Редактирайте потребителския профил</p>
                </div>
                <a href="{{ route('admin.users.uni_users') }}" class="inline-flex items-center gap-1 px-4 py-3 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-700 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                    Назад към списъка
                </a>
            </div>
        </div>

        {{-- Alerts --}}
        @include('partials.alerts')

        <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">Име</label>
                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>

                    <div>
                        <label for="second_name" class="block text-sm font-medium text-gray-700 mb-1">Презиме</label>
                        <input type="text" name="second_name" id="second_name" value="{{ old('second_name', $user->second_name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Фамилия</label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Телефон</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Потребителско име</label>
                        <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Имейл</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Парола (оставете празно за да запазите текущата)</label>
                        <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Роля</label>
                        <select name="role" id="role" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            <option value="">Изберете роля</option>
                            <option value="student" {{ old('role', $user->role) == 'student' ? 'selected' : '' }}>Студент</option>
                            <option value="teacher" {{ old('role', $user->role) == 'teacher' ? 'selected' : '' }}>Преподавател</option>
                            <option value="administrator" {{ old('role', $user->role) == 'administrator' ? 'selected' : '' }}>Администратор</option>
                        </select>
                    </div>
                </div>

                <!-- Student Fields -->
                <div id="student-fields" class="hidden mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Информация за студент</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="faculty_number" class="block text-sm font-medium text-gray-700 mb-1">Факултетен номер</label>
                            <input type="text" name="faculty_number" id="faculty_number" value="{{ old('faculty_number', $user->student->faculty_number ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="faculty_id" class="block text-sm font-medium text-gray-700 mb-1">Факултет</label>
                            <select name="faculty_id" id="faculty_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">Изберете факултет</option>
                                @foreach($faculties as $faculty)
                                    <option value="{{ $faculty->id }}" {{ old('faculty_id', $user->student->faculty_id ?? '') == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="specialty_id" class="block text-sm font-medium text-gray-700 mb-1">Специалност</label>
                            <select name="specialty_id" id="specialty_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">Изберете специалност</option>
                                @foreach($specialties as $specialty)
                                    <option value="{{ $specialty->id }}" {{ old('specialty_id', $user->student->specialty_id ?? '') == $specialty->id ? 'selected' : '' }}>{{ $specialty->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="semester" class="block text-sm font-medium text-gray-700 mb-1">Семестър</label>
                            <input type="number" name="semester" id="semester" min="1" max="10" value="{{ old('semester', $user->student->semester ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="group_id" class="block text-sm font-medium text-gray-700 mb-1">Група</label>
                            <select name="group_id" id="group_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">Изберете група</option>
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}" {{ old('group_id', $user->student->group_id ?? '') == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Teacher Fields -->
                <div id="teacher-fields" class="hidden mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Информация за преподавател</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Титла</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $user->teacher->title ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="teacher_faculty_id" class="block text-sm font-medium text-gray-700 mb-1">Факултет</label>
                            <select name="faculty_id" id="teacher_faculty_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">Изберете факултет</option>
                                @foreach($faculties as $faculty)
                                    <option value="{{ $faculty->id }}" {{ old('faculty_id', $user->teacher->faculty_id ?? '') == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="teacher_specialty_id" class="block text-sm font-medium text-gray-700 mb-1">Специалност</label>
                            <select name="specialty_id" id="teacher_specialty_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">Изберете специалност</option>
                                @foreach($specialties as $specialty)
                                    <option value="{{ $specialty->id }}" {{ old('specialty_id', $user->teacher->specialty_id ?? '') == $specialty->id ? 'selected' : '' }}>{{ $specialty->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Запази промените
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/menuFunctions.js') }}" defer></script>
<script src="{{ asset('js/alertClosingFunctions.js') }}" defer></script>
</body>
</html>
