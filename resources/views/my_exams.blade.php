

{{--    <!DOCTYPE html>--}}
{{--<html lang="bg">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Достъпни изпити</title>--}}
{{--    <script src="https://cdn.tailwindcss.com"></script>--}}
{{--    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">--}}
{{--</head>--}}
{{--<body class="bg-gradient-to-br from-indigo-50 to-blue-100 min-h-screen font-[Inter]">--}}
{{--<!-- Фиксирана навигационна лента отляво -->--}}
{{--<aside class="fixed left-0 top-0 h-screen w-72 bg-white shadow-xl p-6 border-r border-gray-200">--}}
{{--    <div class="flex flex-col h-full">--}}
{{--        <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-2 border-b border-gray-200">--}}
{{--            <i class="fas fa-user-graduate mr-2"></i>Студентски профил--}}
{{--        </h2>--}}

{{--        <div class="space-y-5 flex-1">--}}
{{--            <div class="flex items-center gap-3">--}}
{{--                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">--}}
{{--                    <i class="fas fa-user text-xl text-blue-600"></i>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <p class="font-medium">{{ Auth::user()->first_name }} {{ Auth::user()->second_name }} {{ Auth::user()->last_name }} </p>--}}
{{--                    <p class="text-sm text-gray-500">№: <strong>{{ Auth::user()->faculty_number }} </strong></p>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="space-y-4">--}}
{{--                <div>--}}
{{--                    <p class="text-sm text-gray-500 mb-1">Специалност</p>--}}
{{--                    <p class="font-medium text-gray-800">{{ Auth::user()->major }}</p>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <p class="text-sm text-gray-500 mb-1">Username</p>--}}
{{--                    <p class="font-medium text-gray-800">{{ Auth::user()->username }}</p>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <p class="text-sm text-gray-500 mb-1">Майл</p>--}}
{{--                    <p class="font-medium text-gray-800">{{ Auth::user()->email }}</p>--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    <p class="text-sm text-gray-500 mb-1">Телефонен номер</p>--}}
{{--                    <p class="font-medium text-gray-800">{{ Auth::user()->phone }}</p>--}}
{{--                </div>--}}


{{--                <div>--}}
{{--                    <p class="text-sm text-gray-500 mb-1">Статус</p>--}}
{{--                    <p class="font-medium text-green-600">--}}
{{--                        <i class="fas fa-check-circle"></i> Активен--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="pt-4 border-t border-gray-200">--}}
{{--            <form action="{{ route('logout') }}" method="POST">--}}
{{--                @csrf--}}
{{--                <button type="submit" class="w-full px-4 py-2.5 text-sm bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors">--}}
{{--                    <i class="fas fa-sign-out-alt mr-2"></i>Изход от системата--}}
{{--                </button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</aside>--}}

{{--<!-- Основно съдържание -->--}}
{{--<div class="ml-72 p-8">--}}
{{--    <!-- Хедър -->--}}
{{--    <header class="bg-white/80 backdrop-blur-md shadow-md py-6 mb-8 rounded-xl">--}}
{{--        <div class="flex justify-between items-center">--}}
{{--            <h1 class="text-3xl font-bold text-gray-800 pl-4">Моите изпити</h1>--}}
{{--            <a href="{{ route('exams') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-gray-700 rounded-lg shadow hover:bg-gray-100 mr-4">--}}
{{--                <i class="fas fa-list-alt"></i> Достъпни изпити--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </header>--}}

{{--    <!-- Основен content -->--}}
{{--    <main>--}}
{{--        @if(session('success'))--}}
{{--            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800">--}}
{{--                {{ session('success') }}--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        @if(session('error'))--}}
{{--            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-800">--}}
{{--                {{ session('error') }}--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        @if($exams->isEmpty())--}}
{{--            <div class="text-center p-8 bg-white shadow rounded-xl">--}}
{{--                В момента няма налични изпити за записване.--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <div class="grid gap-6 grid-cols-1 md:grid-cols-2">--}}
{{--                @foreach ($exams as $exam)--}}
{{--                    <div class="bg-white shadow rounded-xl p-6 hover:shadow-lg transition-all">--}}
{{--                        <h2 class="text-xl font-semibold text-gray-900 mb-2">--}}
{{--                            {{ $exam->subject->subject_name }}--}}
{{--                        </h2>--}}
{{--                        <p class="text-gray-700 mb-1">--}}
{{--                            <i class="fas fa-chalkboard-teacher"></i> Преподавател:--}}
{{--                            <strong>{{ $exam->teacher->first_name }} {{ $exam->teacher->last_name }}</strong>--}}
{{--                        </p>--}}
{{--                        <p class="text-gray-700 mb-1">--}}
{{--                            <i class="fas fa-calendar-alt"></i> Дата:--}}
{{--                            <strong>{{ \Carbon\Carbon::parse($exam->exam_date)->format('d.m.Y H:i') }}</strong>--}}
{{--                        </p>--}}
{{--                        <p class="text-gray-700 mb-1">--}}
{{--                            <i class="fas fa-university"></i> Зала:--}}
{{--                            <strong>{{ $exam->exam_hall }}</strong>--}}
{{--                        </p>--}}
{{--                        <p class="text-gray-700 mb-4">--}}
{{--                            <i class="fas fa-users"></i> Свободни места:--}}
{{--                            <span class="font-semibold {{ $exam->remainingSlots() > 0 ? 'text-green-600' : 'text-red-600' }}">--}}
{{--                                {{ $exam->remainingSlots() }}--}}
{{--                            </span>--}}
{{--                        </p>--}}

{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </main>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}
    <!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Моите изпити</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden">
<!-- Мобилен хамбургер меню -->
<div class="lg:hidden fixed top-4 left-4 z-50">
    <button id="menuToggle" class="p-2 rounded-lg bg-white shadow-md">
        <i class="fas fa-bars text-gray-600"></i>
    </button>
</div>

<!-- Фиксирана навигационна лента отляво -->
<aside id="sidebar" class="fixed left-[-100%] lg:left-0 top-0 h-screen w-72 lg:w-80 bg-white shadow-lg p-6 border-r border-gray-100 transition-all duration-300 lg:translate-x-0 z-40">
    <div class="flex flex-col h-full">
        <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-4 border-b border-gray-100 flex items-center">
            <div class="w-10 h-10 rounded-lg bg-primary-100 flex items-center justify-center mr-3 overflow-hidden">
                <img src="{{ asset('images/tu-image.png') }}" alt="Лого" class="w-full h-full object-cover">
            </div>
            Студентски профил
        </h2>

        <div class="space-y-5 flex-1">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-primary-100 flex items-center justify-center">
                    <i class="fas fa-user text-xl text-primary-600"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-900">{{ Auth::user()->first_name }} {{ Auth::user()->second_name }} {{ Auth::user()->last_name }}</p>
                    <p class="text-sm text-gray-500 mt-1">№: <span class="font-mono">{{ Auth::user()->faculty_number }}</span></p>
                </div>
            </div>

            <div class="space-y-3.5 mt-4">
                <div>
                    <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Специалност</p>
                    <p class="font-medium text-gray-800">{{ Auth::user()->major }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Username</p>
                    <p class="font-medium text-gray-800">{{ Auth::user()->username }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Майл</p>
                    <p class="font-medium text-gray-800">{{ Auth::user()->email }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Телефонен номер</p>
                    <p class="font-medium text-gray-800">{{ Auth::user()->phone }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Статус</p>
                    <p class="font-medium text-green-600 flex items-center gap-1.5">
                        <i class="fas fa-check-circle"></i> Активен
                    </p>
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-gray-100">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Изход от системата</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Основно съдържание -->
<div class="ml-0 lg:ml-80 p-4 lg:p-8 transition-all duration-300">
    <!-- Хедър -->
    <header class="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4 ml-8 lg:ml-0">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Моите изпити</h1>
                <p class="text-sm text-gray-500 mt-1">Преглед на записани изпити</p>
            </div>
            <a href="{{ route('exams') }}" class="inline-flex items-center gap-1 px-4 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Достъпни изпити
            </a>
        </div>
    </header>

    <!-- Основен content -->
    <main>
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800 flex items-start gap-3">
                <div class="mt-0.5 flex-shrink-0">
                    <i class="fas fa-check-circle text-green-500"></i>
                </div>
                <div>
                    <p class="font-medium">Успешно!</p>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-800 flex items-start gap-3">
                <div class="mt-0.5 flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-500"></i>
                </div>
                <div>
                    <p class="font-medium">Грешка!</p>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        @endif

        @if($exams->isEmpty())
            <div class="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
                <i class="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700 mb-2">Няма записани изпити</h3>
                <p class="text-gray-500">Все още нямате записани изпити. Моля, изберете от списъка с достъпни изпити.</p>
            </div>
        @else
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
                @foreach ($exams as $exam)
                    <div class="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px]">
                        <div class="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">
                            <h2 class="text-lg font-semibold text-gray-900 leading-tight">
                                {{ $exam->subject->subject_name }}
                            </h2>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    {{ $exam->exam_type }}
                                </span>
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $exam->remainingSlots() > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $exam->remainingSlots() }} места
                                </span>
                            </div>
                        </div>

                        <div class="space-y-3 mb-5">
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
                                <span>Преподавател: <span class="font-medium text-gray-800">{{ $exam->teacher->first_name }} {{ $exam->teacher->last_name }}</span></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-calendar-alt w-5 text-gray-400"></i>
                                <span>Дата: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->exam_date)->format('d.m.Y H:i') }}</span></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-university w-5 text-gray-400"></i>
                                <span>Зала: <span class="font-medium text-gray-800">{{ $exam->exam_hall }}</span></span>
                            </div>
                        </div>


                    </div>
                @endforeach
            </div>
        @endif
    </main>
</div>

<script src="{{asset('js/menuFunctions.js')}}" defer></script>

</body>
</html>
