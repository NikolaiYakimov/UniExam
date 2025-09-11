<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Моят профил - Преподавател</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">
<!-- Header -->
@include('partials.header')

<div class="page-layout">
    <!-- Sidebar -->
    @include('partials.sidebar')

    <main class="p-4 lg:p-6">
        <!-- Page Title Section -->
        <div class="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Моят профил</h1>
                    <p class="text-sm text-gray-500 mt-1">Лична информация и настройки на акаунта</p>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        @include('partials.alerts')

        <!-- Profile Content -->
        <div class="space-y-6">
            <!-- Лична информация -->
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
                    <div class="flex flex-col items-center lg:items-start lg:w-1/3 lg:pl-12">
                        <div class="relative mb-4">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->first_name . ' ' . Auth::user()->last_name) }}&background=4f46e5&color=fff"
                                 alt="Profile" class="w-40 h-40 rounded-full object-cover border-4 border-indigo-100 shadow-lg">
                            <label for="avatarUpload" class="absolute bottom-3 right-3 bg-indigo-500 text-white p-2 rounded-full cursor-pointer hover:bg-indigo-600 shadow-md transition-all">
                                <i class="fas fa-camera"></i>
                                <input type="file" id="avatarUpload" class="hidden" accept="image/*">
                            </label>
                        </div>
                    </div>

                    <div class="flex-1">
                        <form id="personalInfoForm" method="POST" action="{{route('profile.update')}}" class="info-grid">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Пълно име</label>
                                <input type="text" value="{{ Auth::user()->first_name }} {{ Auth::user()->second_name }} {{ Auth::user()->last_name }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" disabled>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Титла</label>
                                <input type="text" value="{{ Auth::user()->teacher->title }}"
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

            <!-- Професионална информация -->
            <div class="profile-card bg-white border border-gray-100 rounded-2xl p-6 lg:p-8 shadow-sm">
                <div class="flex flex-wrap items-center justify-between mb-6 gap-4">
                    <h2 class="text-xl font-semibold text-gray-800 section-title">
                        <i class="fas fa-briefcase text-indigo-500"></i> Професионална информация
                    </h2>
                    <span class="px-4 py-2 bg-green-100 text-green-800 text-sm font-medium rounded-full flex items-center">
                        <i class="fas fa-check-circle mr-2"></i> Активен
                    </span>
                </div>

                <div class="info-grid">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Факултет</label>
                        <div class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
                            <i class="fas fa-university text-gray-400 mr-3"></i>
                            {{ Auth::user()->teacher->faculty->name ?? 'Не е зададен' }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Специалност</label>
                        <div class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
                            <i class="fas fa-book-open text-gray-400 mr-3"></i>
                            {{ Auth::user()->teacher->specialty->name ?? 'Не е зададена' }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Брой предмети</label>
                        <div class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
                            <i class="fas fa-book text-gray-400 mr-3"></i>
                            {{ Auth::user()->teacher->subjects->count() }} предмета
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Брой предстоящи изпити</label>
                        <div class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 flex items-center">
                            <i class="fas fa-calendar-alt text-gray-400 mr-3"></i>
                            {{ Auth::user()->teacher->exams_count }} изпита
                        </div>
                    </div>
                </div>
            </div>

            <!-- Настройки на акаунта -->
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
                                <input type="password" name="password"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-500 @enderror">
                                @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Потвърди новата парола</label>
                                <input type="password" name="password_confirmation"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('password_confirmation') border-red-500 @enderror">
                                @error('password_confirmation') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <button type="submit" class="px-5 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 font-medium transition-colors flex items-center">
                                <i class="fas fa-key mr-2"></i> Смени парола
                            </button>
                        </form>
                    </div>
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
        const storePersonalInputs = Array.from(personalInputs).map(inp => inp.value);

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
            personalInputs.forEach((input, index) => {
                input.disabled = true;
                input.classList.remove('bg-white', 'ring-2', 'ring-indigo-100');
                input.classList.add('bg-gray-50');
                input.value = storePersonalInputs[index];
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

    /* Responsive adjustments */
    @media (max-width: 1538px) {
        .section-title {
            padding-left: 2rem;
        }
        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
</body>
</html>
