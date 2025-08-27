{{--<!DOCTYPE html>--}}
{{--<html lang="bg">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Моят профил</title>--}}
{{--    <!-- Tailwind CSS -->--}}
{{--    <script src="https://cdn.tailwindcss.com"></script>--}}
{{--    <!-- Font Awesome -->--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">--}}
{{--    <!-- Google Fonts - Inter -->--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">--}}
{{--    <style>--}}
{{--        body {--}}
{{--            font-family: 'Inter', sans-serif;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden">--}}
{{--<!-- Student information sidebar with toggle button -->--}}
{{--@include('partials.sidebar')--}}

{{--<div class="ml-0 lg:ml-80 p-4 lg:p-8 transition-all duration-300">--}}
{{--    <!-- Header -->--}}
{{--    @include('partials.header',[--}}
{{--        'title'=>"Моят профил",--}}
{{--        'subtitle'=>'Лична информация и настройки на акаунта',--}}
{{--        'button'=>null--}}
{{--    ])--}}

{{--    <!-- Main content -->--}}
{{--    <main class="mt-6">--}}
{{--        --}}{{--Alerts--}}
{{--        @include('partials.alerts')--}}

{{--        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">--}}
{{--            <!-- Лична информация -->--}}
{{--            <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">--}}
{{--                <div class="flex items-center justify-between mb-6">--}}
{{--                    <h2 class="text-xl font-semibold text-gray-800 flex items-center">--}}
{{--                        <i class="fas fa-user-circle text-indigo-500 mr-2"></i> Лична информация--}}
{{--                    </h2>--}}
{{--                    <button id="editPersonalBtn" class="text-indigo-600 hover:text-indigo-800">--}}
{{--                        <i class="fas fa-edit mr-1"></i> Редактирай--}}
{{--                    </button>--}}
{{--                </div>--}}

{{--                <div class="flex flex-col items-center mb-6">--}}
{{--                    <div class="relative mb-4">--}}
{{--                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->first_name . ' ' . Auth::user()->last_name) }}&background=4f46e5&color=fff"--}}
{{--                             alt="Profile" class="w-32 h-32 rounded-full object-cover border-4 border-indigo-100">--}}
{{--                        <label for="avatarUpload" class="absolute bottom-0 right-0 bg-indigo-500 text-white p-2 rounded-full cursor-pointer hover:bg-indigo-600">--}}
{{--                            <i class="fas fa-camera"></i>--}}
{{--                            <input type="file" id="avatarUpload" class="hidden" accept="image/*">--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <form id="personalInfoForm">--}}
{{--                    <div class="space-y-4">--}}
{{--                        <div>--}}
{{--                            <label class="block text-sm font-medium text-gray-700 mb-1">Име</label>--}}
{{--                            <input type="text" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}"--}}
{{--                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" disabled>--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <label class="block text-sm font-medium text-gray-700 mb-1">Факултетен номер</label>--}}
{{--                            <input type="text" value="{{ Auth::user()->student->faculty_number }}"--}}
{{--                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100" disabled>--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <label class="block text-sm font-medium text-gray-700 mb-1">Имейл адрес</label>--}}
{{--                            <input type="email" name="email" value="{{ Auth::user()->email }}"--}}
{{--                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" disabled>--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <label class="block text-sm font-medium text-gray-700 mb-1">Телефон</label>--}}
{{--                            <input type="tel" name="phone" value="{{ Auth::user()->phone }}"--}}
{{--                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" disabled>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="mt-6 flex space-x-3 justify-end hidden" id="personalFormActions">--}}
{{--                        <button type="button" id="cancelPersonalBtn" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Откажи</button>--}}
{{--                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Запази</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}

{{--            <!-- Академична информация -->--}}
{{--            <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">--}}
{{--                <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">--}}
{{--                    <i class="fas fa-graduation-cap text-indigo-500 mr-2"></i> Академична информация--}}
{{--                </h2>--}}

{{--                <div class="space-y-4">--}}
{{--                    <div>--}}
{{--                        <label class="block text-sm font-medium text-gray-700 mb-1">Факултет</label>--}}
{{--                        <input type="text" value="{{ Auth::user()->student->faculty->name ?? 'Не е зададен' }}"--}}
{{--                               class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100" disabled>--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label class="block text-sm font-medium text-gray-700 mb-1">Специалност</label>--}}
{{--                        <input type="text" value="{{ Auth::user()->student->specialty->name ?? 'Не е зададена' }}"--}}
{{--                               class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100" disabled>--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label class="block text-sm font-medium text-gray-700 mb-1">Група</label>--}}
{{--                        <input type="text" value="{{ Auth::user()->student->group->name ?? 'Не е зададена' }}"--}}
{{--                               class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100" disabled>--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label class="block text-sm font-medium text-gray-700 mb-1">Семестър</label>--}}
{{--                        <input type="text" value="{{ Auth::user()->student->semester }}"--}}
{{--                               class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100" disabled>--}}
{{--                    </div>--}}

{{--                    <div>--}}
{{--                        <label class="block text-sm font-medium text-gray-700 mb-1">Статус</label>--}}
{{--                        <input type="text" value="Активен студент"--}}
{{--                               class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100" disabled>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Настройки на акаунта -->--}}
{{--        <div class="mt-6 bg-white border border-gray-100 rounded-xl p-6 shadow-sm">--}}
{{--            <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">--}}
{{--                <i class="fas fa-cog text-indigo-500 mr-2"></i> Настройки на акаунта--}}
{{--            </h2>--}}

{{--            <div class="space-y-6">--}}
{{--                <!-- Смяна на парола -->--}}
{{--                <div>--}}
{{--                    <h3 class="text-lg font-medium text-gray-800 mb-3">Смяна на парола</h3>--}}
{{--                    <form id="changePasswordForm" class="space-y-4 max-w-lg">--}}
{{--                        <div>--}}
{{--                            <label class="block text-sm font-medium text-gray-700 mb-1">Настояща парола</label>--}}
{{--                            <input type="password" name="current_password"--}}
{{--                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <label class="block text-sm font-medium text-gray-700 mb-1">Нова парола</label>--}}
{{--                            <input type="password" name="new_password"--}}
{{--                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <label class="block text-sm font-medium text-gray-700 mb-1">Потвърди новата парола</label>--}}
{{--                            <input type="password" name="new_password_confirmation"--}}
{{--                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">--}}
{{--                        </div>--}}

{{--                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 mt-2">--}}
{{--                            Смени парола--}}
{{--                        </button>--}}
{{--                    </form>--}}
{{--                </div>--}}

{{--                <!-- Настройки за известия -->--}}
{{--                <div class="pt-4 border-t border-gray-200">--}}
{{--                    <h3 class="text-lg font-medium text-gray-800 mb-3">Настройки за известия</h3>--}}
{{--                    <div class="flex items-center justify-between max-w-lg">--}}
{{--                        <div>--}}
{{--                            <p class="text-gray-700">Имейл известия</p>--}}
{{--                            <p class="text-sm text-gray-500">Получавай известия за нови изпити и важни събития</p>--}}
{{--                        </div>--}}
{{--                        <label class="relative inline-flex items-center cursor-pointer">--}}
{{--                            <input type="checkbox" class="sr-only peer" checked>--}}
{{--                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </main>--}}
{{--</div>--}}

{{--<script src="{{asset('js/menuFunctions.js')}}"></script>--}}
{{--<script src="{{asset('js/alertClosingFunctions.js')}}"></script>--}}

{{--<script>--}}
{{--    document.addEventListener('DOMContentLoaded', function() {--}}
{{--        // Toggle edit mode for personal information--}}
{{--        const editPersonalBtn = document.getElementById('editPersonalBtn');--}}
{{--        const cancelPersonalBtn = document.getElementById('cancelPersonalBtn');--}}
{{--        const personalFormActions = document.getElementById('personalFormActions');--}}
{{--        const personalInfoForm = document.getElementById('personalInfoForm');--}}
{{--        const personalInputs = personalInfoForm.querySelectorAll('input:not([disabled])');--}}

{{--        editPersonalBtn.addEventListener('click', function() {--}}
{{--            personalInputs.forEach(input => {--}}
{{--                input.disabled = false;--}}
{{--            });--}}
{{--            personalFormActions.classList.remove('hidden');--}}
{{--            editPersonalBtn.classList.add('hidden');--}}
{{--        });--}}

{{--        cancelPersonalBtn.addEventListener('click', function() {--}}
{{--            personalInputs.forEach(input => {--}}
{{--                input.disabled = true;--}}
{{--                // Reset form values here if needed--}}
{{--            });--}}
{{--            personalFormActions.classList.add('hidden');--}}
{{--            editPersonalBtn.classList.remove('hidden');--}}
{{--        });--}}

{{--        // Handle form submissions--}}
{{--        personalInfoForm.addEventListener('submit', function(e) {--}}
{{--            e.preventDefault();--}}
{{--            // Add form submission logic here--}}
{{--            console.log('Personal info form submitted');--}}

{{--            // Simulate successful submission--}}
{{--            personalInputs.forEach(input => {--}}
{{--                input.disabled = true;--}}
{{--            });--}}
{{--            personalFormActions.classList.add('hidden');--}}
{{--            editPersonalBtn.classList.remove('hidden');--}}

{{--            // Show success message--}}
{{--            alert('Информацията е запазена успешно!');--}}
{{--        });--}}

{{--        document.getElementById('changePasswordForm').addEventListener('submit', function(e) {--}}
{{--            e.preventDefault();--}}
{{--            // Add password change logic here--}}
{{--            console.log('Password change form submitted');--}}

{{--            // Show success message--}}
{{--            alert('Паролата е сменена успешно!');--}}
{{--            this.reset();--}}
{{--        });--}}

{{--        // Handle avatar upload--}}
{{--        document.getElementById('avatarUpload').addEventListener('change', function(e) {--}}
{{--            if (this.files && this.files[0]) {--}}
{{--                // Add avatar upload logic here--}}
{{--                console.log('Avatar upload triggered');--}}

{{--                // Simulate successful upload--}}
{{--                alert('Снимката е качена успешно!');--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}

{{--<style>--}}
{{--    @media (max-width: 1023px) {--}}
{{--        #sidebar {--}}
{{--            width: 288px;--}}
{{--            left: -288px;--}}
{{--            box-shadow: 8px 0 15px -3px rgba(0, 0, 0, 0.1);--}}
{{--        }--}}
{{--        #menuContainer {--}}
{{--            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);--}}
{{--            left: 1rem;--}}
{{--        }--}}
{{--        header {--}}
{{--            margin-top: 5.5rem;--}}
{{--        }--}}

{{--        .bg-green-50, .bg-red-50{--}}
{{--            transition: opacity 0.3s ease;--}}
{{--            position: relative;--}}
{{--        }--}}
{{--    }--}}
{{--</style>--}}
{{--</body>--}}
{{--</html>--}}
    <!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Моят профил</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .profile-card {
            transition: all 0.3s ease;
        }
        .profile-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .section-title {
            position: relative;
            padding-left: 2.5rem;
        }
        .section-title i {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.5rem;
            width: 2rem;
            text-align: center;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden">

@include('partials.sidebar')

<div class="ml-0 lg:ml-80 p-4 lg:p-8 transition-all duration-300">

    @include('partials.header',[
        'title'=>"Моят профил",
        'subtitle'=>'Лична информация и настройки на акаунта',
        'button'=>null
    ])


    <main class="mt-6 space-y-6 w-full">

        @include('partials.alerts')


        <div class="profile-card bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
            <div class="flex flex-wrap items-center justify-between mb-6 gap-4">
                <h2 class="text-xl font-semibold text-gray-800 section-title">
                    <i class="fas fa-user-circle text-indigo-500"></i> Лична информация
                </h2>
                <button id="editPersonalBtn" class="text-indigo-600 hover:text-indigo-800 flex items-center bg-indigo-50 px-4 py-2 rounded-lg">
                    <i class="fas fa-edit mr-2"></i> Редактирай
                </button>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <div class="flex flex-col items-center lg:items-start lg:w-1/3  lg:pl-12">
                    <div class="relative mb-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->first_name . ' ' . Auth::user()->last_name) }}&background=4f46e5&color=fff"
                             alt="Profile" class="w-40 h-50 rounded-full object-cover border-4 border-indigo-100 shadow-lg">
                        <label for="avatarUpload" class="absolute bottom-3 right-3 bg-indigo-500 text-white p-2 rounded-full cursor-pointer hover:bg-indigo-600 shadow-md transition-all">
                            <i class="fas fa-camera"></i>
                            <input type="file" id="avatarUpload" class="hidden" accept="image/*">
                        </label>
                    </div>
{{--                    <p class="text-sm text-gray-500 text-center lg:text-left mt-2 max-w-xs">Натисни иконата за да смениш профилната си снимка</p>--}}
                </div>

                <div class="flex-1">
                    <form id="personalInfoForm" method="POST" action="{{route('profile.update')}}" class="info-grid">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Пълно име</label>
                            <input type="text" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" disabled>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Факултетен номер</label>
                            <input type="text" value="{{ Auth::user()->student->faculty_number }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-100" disabled>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Имейл адрес</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror" disabled>
                            @error('email') <p class="text-red-600 text-sm mt-1 ">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Телефон</label>
                            <input type="tel" name="phone" value="{{ Auth::user()->phone }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('phone') border-red-500 @enderror" disabled >
                            @error('phone') <p class="text-red-600 text-sm mt-1 ">{{ $message }}</p> @enderror
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-8 flex space-x-4 justify-end hidden" id="personalFormActions">
                <button type="button" id="cancelPersonalBtn" class="px-5 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 font-medium transition-colors">Откажи</button>
                <button type="submit" form="personalInfoForm" class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 font-medium transition-colors">Запази промените</button>
            </div>
        </div>


        <div class="profile-card bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
            <div class="flex flex-wrap items-center justify-between mb-6 gap-4">
                <h2 class="text-xl font-semibold text-gray-800 section-title">
                    <i class="fas fa-graduation-cap text-indigo-500"></i> Академична информация
                </h2>
                @if(Auth::user()->student->semester<8)
                    <span class="px-4 py-2 bg-green-100 text-green-800 text-sm font-medium rounded-full flex items-center">
                        <i class="fas fa-check-circle mr-2"></i> Активен
                    </span>
                @else
                    <span class="px-4 py-2 bg-red-100 text-red-700 text-sm font-medium rounded-full flex items-center">
                        <i class="fas fa-times-circle mr-2 "></i> Неактивен
                    </span>
                @endif
            </div>

            <div class="info-grid">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Факултет</label>
                    <div class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
                        <i class="fas fa-university text-gray-400 mr-3"></i>
                        {{ Auth::user()->student->faculty->name ?? 'Не е зададен' }}
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Специалност</label>
                    <div class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
                        <i class="fas fa-book-open text-gray-400 mr-3"></i>
                        {{ Auth::user()->student->specialty->name ?? 'Не е зададена' }}
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Група</label>
                    <div class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
                        <i class="fas fa-users text-gray-400 mr-3"></i>
                        {{ Auth::user()->student->group->name ?? 'Не е зададена' }}
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Семестър</label>
                    <div class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
                        <i class="fas fa-layer-group text-gray-400 mr-3"></i>
                        {{ Auth::user()->student->semester }}
                    </div>
                </div>
            </div>
        </div>


        <div class="profile-card bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
            <h2 class="text-xl font-semibold text-gray-800 section-title mb-6">
                <i class="fas fa-cog text-indigo-500"></i> Настройки на акаунта
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <div>
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Смяна на парола</h3>
                    <form id="changePasswordForm" method="POST" action="{{route('profile.password')}}" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Настояща парола</label>
                            <input type="password" name="current_password"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('current_password') border-red-500 @enderror">
                            @error('current_password') <p class="text-red-600 text-sm mt-1 ">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Нова парола</label>
                            <input type="password" name="new_password"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('current_password') border-red-500 @enderror">
                            @error('new_password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Потвърди новата парола</label>
                            <input type="password" name="new_password_confirmation"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('current_password') border-red-500 @enderror">
                            @error('new_password_confirmation') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" class="px-5 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 font-medium transition-colors flex items-center">
                            <i class="fas fa-key mr-2"></i> Смени парола
                        </button>
                    </form>
                </div>


            </div>
        </div>
    </main>
</div>

<script src="{{asset('js/menuFunctions.js')}}"></script>
<script src="{{asset('js/alertClosingFunctions.js')}}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle edit mode for personal information
        const editPersonalBtn = document.getElementById('editPersonalBtn');
        const cancelPersonalBtn = document.getElementById('cancelPersonalBtn');
        const personalFormActions = document.getElementById('personalFormActions');
        const personalInfoForm = document.getElementById('personalInfoForm');
        const personalInputs = personalInfoForm.querySelectorAll('input[type="email"], input[type="tel"]');
        const storePersonalInputs=Array.from(personalInputs).map(inp=>inp.value);

        console.log(storePersonalInputs);

        editPersonalBtn.addEventListener('click', function() {
            personalInputs.forEach(input => {
                input.disabled = false;
                input.classList.remove('bg-gray-50');
                input.classList.add('bg-white', 'ring-2', 'ring-indigo-100');
            });
            personalFormActions.classList.remove('hidden');
            editPersonalBtn.classList.add('hidden');
        });

        cancelPersonalBtn.addEventListener('click', function() {
            personalInputs.forEach((input,index) => {
                input.disabled = true;
                input.classList.remove('bg-white', 'ring-2', 'ring-indigo-100');
                input.classList.add('bg-gray-50');
                input.value=storePersonalInputs[index];
            });
            personalFormActions.classList.add('hidden');
            editPersonalBtn.classList.remove('hidden');
        });

        // Handle form submissions
        personalInfoForm.addEventListener('submit', function(e) {

            personalFormActions.classList.add('hidden');
            editPersonalBtn.classList.remove('hidden');


        });


    });
</script>

<style>
    @media (max-width: 1023px) {
        #sidebar {
            width: 288px;
            left: -288px;
            box-shadow: 8px 0 15px -3px rgba(0, 0, 0, 0.1);
        }
        #menuContainer {
            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            left: 1rem;
        }
        header {
            margin-top: 5.5rem;
        }

        .bg-green-50, .bg-red-50{
            transition: opacity 0.3s ease;
            position: relative;
        }

        .section-title {
            padding-left: 2rem;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (min-width: 1024px) {
        .profile-card {
            padding: 2rem;
        }
    }

    @media (min-width: 1280px) {
        .profile-card {
            padding: 2.5rem;
        }
    }

    @media (min-width: 1536px) {
        .profile-card {
            padding: 3rem;
        }
    }
</style>
</body>
</html>
