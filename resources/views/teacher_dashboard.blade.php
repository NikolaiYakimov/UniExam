

{{--    <!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Teacher Profile - Exam Manager</title>--}}
{{--    <script src="//unpkg.com/alpinejs" defer></script>--}}
{{--    <script src="https://cdn.tailwindcss.com"></script>--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">--}}
{{--</head>--}}
{{--<body class="bg-gradient-to-br from-indigo-50 to-blue-100 min-h-screen" x-data="{ showModal: false }">--}}
{{--<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">--}}
{{--    <!-- Profile Header Section -->--}}
{{--    <section class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl p-8 mb-12 border border-white/10 relative">--}}
{{--        <!-- Logout Button -->--}}
{{--        <form action="{{ route('logout') }}" method="POST" class="absolute top-4 right-4">--}}
{{--            @csrf--}}
{{--            <button type="submit" class="flex items-center gap-2 px-4 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors shadow-sm">--}}
{{--                <i class="fas fa-sign-out-alt"></i>--}}
{{--                <span>Изход от системата</span>--}}
{{--            </button>--}}
{{--        </form>--}}

{{--        <div class="flex items-center gap-6">--}}
{{--            <div>--}}
{{--                <h1 class="text-3xl font-bold text-gray-900 mb-2 flex items-center gap-2">--}}
{{--                    {{ $teacher->title }} {{ $teacher->first_name }} {{ $teacher->second_name }} {{ $teacher->last_name }}--}}
{{--                </h1>--}}

{{--                <div class="prose max-w-none">--}}
{{--                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Профил на учителя</h2>--}}
{{--                    <p class="text-gray-600 text-sm mb-4">--}}
{{--                        Добре дошли в личния ви преподавателски профил. Тук можете да управлявате всички изпити,--}}
{{--                        да преглеждате записаните студенти и да създавате нови изпитни сесии.--}}
{{--                    </p>--}}
{{--                </div>--}}

{{--                <div class="flex items-center gap-4 text-gray-600">--}}
{{--                    <span class="flex items-center gap-1.5">--}}
{{--                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>--}}
{{--                        </svg>--}}
{{--                        {{ $teacher->email }}--}}
{{--                    </span>--}}
{{--                    <span class="flex items-center gap-1.5">--}}
{{--                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>--}}
{{--                        </svg>--}}
{{--                        {{ $teacher->exams_count }} активни изпита--}}
{{--                    </span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <!-- Exams Section -->--}}
{{--    <section>--}}
{{--        <div class="prose max-w-none mb-8">--}}
{{--            <h2 class="text-2xl font-bold text-gray-900">Управление на изпити</h2>--}}
{{--            <p class="text-gray-600">--}}
{{--                Списък на всички предстоящи изпити. Можете да преглеждате детайли за всеки изпит,--}}
{{--                да следите свободните места и да създавате нови изпити чрез бутона "+" в долния десен ъгъл.--}}
{{--            </p>--}}
{{--        </div>--}}

{{--        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">--}}
{{--            @foreach($exams as $exam)--}}
{{--                <article class="bg-white/80 backdrop-blur-lg rounded-xl shadow-md hover:shadow-lg transition-all duration-300 p-6 group border border-white/10">--}}
{{--                    <header class="flex justify-between items-start mb-4">--}}
{{--                        <h3 class="text-xl font-bold text-gray-900">--}}
{{--                            {{ $exam->subject->subject_name }}--}}
{{--                            <span class="block text-sm font-normal text-gray-500 mt-1">--}}
{{--                        {{ $exam->subject->description }}--}}
{{--                    </span>--}}
{{--                        </h3>--}}
{{--                        <span class="px-2.5 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">--}}
{{--                    {{ $exam->exam_type }}--}}
{{--                </span>--}}
{{--                    </header>--}}

{{--                    <div class="space-y-3">--}}
{{--                        <div class="flex items-center gap-2 text-gray-600">--}}
{{--                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>--}}
{{--                            </svg>--}}
{{--                            <span>--}}
{{--                        <time datetime="{{ \Carbon\Carbon::parse($exam->date)->format('d.m.Y H:i') }}">--}}
{{--                            {{ \Carbon\Carbon::parse($exam->date)->format('d.m.Y H:i') }}--}}
{{--                        </time>--}}
{{--                    </span>--}}
{{--                        </div>--}}

{{--                        <div class="flex items-center gap-2 text-gray-600">--}}
{{--                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>--}}
{{--                            </svg>--}}
{{--                            <span>Зала {{ $exam->exam_hall }}</span>--}}
{{--                        </div>--}}

{{--                        <div class="flex items-center gap-2 text-gray-600">--}}
{{--                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>--}}
{{--                            </svg>--}}
{{--                            <span>--}}
{{--                        <span class="font-medium">{{ $exam->remainingSlots() }}</span> свободни места--}}
{{--                        от <span class="font-medium">{{ $exam->max_students }}</span>--}}
{{--                    </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </article>--}}
{{--            @endforeach--}}

{{--            @if($exams->isNotEmpty())--}}
{{--                <!-- Бутонът за създаване на нов изпит като нов "карточка" -->--}}
{{--                    <div class="flex items-center justify-center">--}}
{{--                        <button @click="showModal = true"--}}
{{--                                class="w-16 h-16 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white shadow-xl flex items-center justify-center transition-all duration-300 hover:rotate-90">--}}
{{--                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>--}}
{{--                            </svg>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--            @else--}}
{{--                <div class="col-span-full text-center py-12">--}}
{{--                    <p class="text-gray-500 mb-4">Все още нямате създадени изпити</p>--}}
{{--                    <button @click="showModal = true"--}}
{{--                            class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors">--}}
{{--                        Създайте първия изпит--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}

{{--    </section>--}}

{{--    <!-- Create Exam Modal -->--}}
{{--    <div x-cloak x-show="showModal"--}}
{{--         class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4"--}}
{{--         x-transition.opacity>--}}
{{--        <div @click.away="showModal = false"--}}
{{--             class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8"--}}
{{--             x-transition:enter="ease-out duration-300"--}}
{{--             x-transition:enter-start="opacity-0 scale-95"--}}
{{--             x-transition:enter-end="opacity-100 scale-100"--}}
{{--             x-transition:leave="ease-in duration-200"--}}
{{--             x-transition:leave-start="opacity-100 scale-100"--}}
{{--             x-transition:leave-end="opacity-0 scale-95">--}}

{{--            <h3 class="text-2xl font-bold text-gray-900 mb-6">Създаване на нов изпит</h3>--}}

{{--            <form method="POST" action="{{ route('exams.store') }}">--}}
{{--                @csrf--}}
{{--                <div class="space-y-5">--}}
{{--                    <div>--}}
{{--                        <label class="block text-sm font-medium text-gray-700 mb-2">Дисциплина</label>--}}
{{--                        <select name="subject_id" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">--}}
{{--                            @foreach($subjects as $subject)--}}
{{--                                <option value="{{ $subject->id }}">{{ $subject->subject_name }} (Семестър {{ $subject->semester }})</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                    <div class="grid grid-cols-2 gap-4">--}}
{{--                        <div>--}}
{{--                            <label class="block text-sm font-medium text-gray-700 mb-2">Тип изпит</label>--}}
{{--                            <select name="exam_type" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">--}}
{{--                                <option value="редовен">редовен</option>--}}
{{--                                <option value="поправителен">поправителен</option>--}}
{{--                                <option value="ликвидация">ликвидация</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <label class="block text-sm font-medium text-gray-700 mb-2">Макс. студенти</label>--}}
{{--                            <input type="number" name="max_students" required min="1"--}}
{{--                                   class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="grid grid-cols-2 gap-4">--}}
{{--                        <div>--}}
{{--                            <label class="block text-sm font-medium text-gray-700 mb-2">Дата и час</label>--}}
{{--                            <input type="datetime-local" name="exam_date" required--}}
{{--                                   class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <label class="block text-sm font-medium text-gray-700 mb-2">Изпитна зала</label>--}}
{{--                            <input type="text" name="exam_hall" required--}}
{{--                                   class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="flex justify-end gap-3 mt-8">--}}
{{--                        <button type="button" @click="showModal = false"--}}
{{--                                class="px-5 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors">--}}
{{--                            Отказ--}}
{{--                        </button>--}}
{{--                        <button type="submit"--}}
{{--                                class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors shadow-sm">--}}
{{--                            Създай изпит--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@if ($errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}

{{--<style>--}}
{{--    [x-cloak] { display: none !important; }--}}
{{--    .bg-indigo-50/80 { background-color: rgba(238, 242, 255, 0.8); }--}}
{{--    .backdrop-blur-lg { backdrop-filter: blur(16px); }--}}
{{--    .border-white/10 { border-color: rgba(255, 255, 255, 0.1); }--}}
{{--</style>--}}
{{--</body>--}}
{{--</html>--}}

{{-- <!DOCTYPE html>--}}
{{--<html lang="bg">--}}


{{--@include('partials.head')--}}
{{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}

{{--<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden" x-data="{ showModal: false }">--}}
{{--<!-- Student information sidebar with toggle button -->--}}
{{--@include('partials.sidebar')--}}

{{--<div class="ml-0 lg:ml-80 p-4 lg:p-8 transition-all duration-300">--}}

{{--    <!-- Header -->--}}
{{--    @include('partials.header',[--}}
{{--             'title'=>"Управление на изпити",--}}
{{--             'subtitle'=>'Преглед и създаване на изпитни сесии',--}}
{{--             'button'=>[--}}
{{--                        'route'=>route('logout'),--}}
{{--                        'text'=>'Изход от системата',--}}
{{--                        'icon' =>'fas fa-sign-out-alt'--}}
{{--                       ]--}}
{{--            ])--}}

{{--    <main>--}}

{{--        @include('partials.alerts')--}}

{{--        <div class="prose max-w-none mb-8">--}}
{{--            <h2 class="text-2xl font-bold text-gray-900">Преподавателски профил</h2>--}}
{{--            <div class="flex items-center gap-4 text-gray-600 mt-4">--}}
{{--                <div class="flex-1">--}}
{{--                    <h1 class="text-xl font-semibold text-gray-900 mb-2">--}}
{{--                        {{ $teacher->title }} {{ $teacher->user->first_name }} {{ $teacher->user->second_name }} {{ $teacher->user->last_name }}--}}
{{--                    </h1>--}}
{{--                    <div class="flex items-center gap-4 flex-wrap">--}}
{{--                        <span class="flex items-center gap-1.5">--}}
{{--                            <i class="fas fa-envelope text-gray-400"></i>--}}
{{--                            {{ $teacher->user->email }}--}}
{{--                        </span>--}}
{{--                        <span class="flex items-center gap-1.5">--}}
{{--                            <i class="fas fa-clipboard-list text-gray-400"></i>--}}
{{--                            {{ $teacher->exams_count }} активни изпита--}}
{{--                        </span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        @if($exams->isEmpty())--}}
{{--            <div class="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">--}}
{{--                <i class="fas fa-calendar-plus text-4xl text-gray-300 mb-4"></i>--}}
{{--                <h3 class="text-lg font-medium text-gray-700 mb-2">Няма създадени изпити</h3>--}}
{{--                <p class="text-gray-500">Можете да създадете нов изпит чрез бутона по-долу.</p>--}}
{{--                <button @click="showModal = true" class="mt-4 bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition-colors">--}}
{{--                    Нов изпит--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">--}}
{{--                @foreach($exams as $exam)--}}
{{--                    <div class="bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px]">--}}
{{--                        <div class="flex justify-between items-start gap-2 mb-3">--}}
{{--                            <h2 class="text-lg font-semibold text-gray-900">--}}
{{--                                {{ $exam->subject->subject_name }}--}}
{{--                                <span class="block text-sm font-normal text-gray-500 mt-1">--}}
{{--                                    {{ $exam->subject->description }}--}}
{{--                                </span>--}}
{{--                            </h2>--}}
{{--                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">--}}
{{--                                {{ $exam->exam_type }}--}}
{{--                            </span>--}}
{{--                        </div>--}}

{{--                        <div class="space-y-3 mb-5">--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-calendar-alt w-5 text-gray-400"></i>--}}
{{--                                <span>Дата: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y ') }}</span></span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-calendar-alt w-5 text-gray-400"></i>--}}
{{--                                <span>Продължителност: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format(' H:i')}}-{{\Carbon\Carbon::parse($exam->end_time)->format(' H:i')}}</span></span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-university w-5 text-gray-400"></i>--}}
{{--                                <span>Зала: <span class="font-medium text-gray-800">{{ $exam->hall->name }}</span></span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-users w-5 text-gray-400"></i>--}}
{{--                                <span class="font-medium {{ $exam->remainingSlots() > 0 ? 'text-green-700' : 'text-red-700' }}">--}}
{{--                                    {{ $exam->remainingSlots() }}/{{ $exam->max_students }} места--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}

{{--                <!-- Add New Exam Card -->--}}
{{--                    <div class="flex items-center justify-center">--}}
{{--                        <button @click="showModal = true" class="w-16 h-16 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white shadow-xl flex items-center justify-center transition-all duration-300 hover:rotate-90">--}}
{{--                             <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>--}}
{{--                             </svg>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </main>--}}
{{--</div>--}}

{{--<!-- Create Exam Modal -->--}}
{{--<div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4" >--}}
{{--    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 mx-4"--}}
{{--         @click.outside="showModal = false">--}}
{{--        <h3 class="text-xl font-bold text-gray-900 mb-4">Създаване на нов изпит</h3>--}}

{{--        <form method="POST" action="{{ route('exams.store') }}">--}}
{{--            @csrf--}}
{{--            <div class="space-y-4">--}}
{{--                <div>--}}
{{--                    <label class="block text-sm font-medium text-gray-700 mb-2">Дисциплина</label>--}}
{{--                    <select name="subject_id" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">--}}
{{--                        @foreach($subjects as $subject)--}}
{{--                            <option value="{{ $subject->id }}">{{ $subject->subject_name }} (Сем. {{ $subject->semester }})</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}

{{--                <div class="grid grid-cols-2 gap-4">--}}
{{--                    <div>--}}
{{--                        <label class="block text-sm font-medium text-gray-700 mb-2">Тип изпит</label>--}}
{{--                        <select name="exam_type" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">--}}
{{--                            <option value="редовен">Редовен</option>--}}
{{--                            <option value="поправителен">Поправителен</option>--}}
{{--                            <option value="ликвидация">Ликвидация</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <label class="block text-sm font-medium text-gray-700 mb-2">Макс. студенти</label>--}}
{{--                        <input type="number" name="max_students" required min="1" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Нов блок за избор на зала и дата -->--}}
{{--                <div>--}}
{{--                    <label class="block text-sm font-medium text-gray-700 mb-2">Изпитна зала</label>--}}
{{--                    <select name="hall_id" id="hall_id" required--}}
{{--                            class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">--}}
{{--                        @foreach($halls as $hall)--}}
{{--                            <option value="{{ $hall->id }}">{{ $hall->name }} (Капацитет: {{ $hall->capacity }})</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}

{{--                <!-- Календар -->--}}
{{--                <div id="calendarContainer" class="h-96"></div>--}}

{{--                <!-- Скрити полета за start/end time -->--}}
{{--                <input type="hidden" name="start_time" id="start_time">--}}
{{--                <input type="hidden" name="end_time" id="end_time">--}}

{{--                <div class="flex justify-end gap-3 mt-6">--}}
{{--                    <button type="button" @click="showModal = false" class="px-5 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors">--}}
{{--                        Отказ--}}
{{--                    </button>--}}
{{--                    <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">--}}
{{--                        Създай--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<script src="{{asset('js/menuFunctions.js')}}" defer></script>--}}
{{--@if ($errors->any())--}}
{{--    <script>--}}
{{--        document.addEventListener('DOMContentLoaded', () => {--}}
{{--            Alpine.data('main', () => ({--}}
{{--                showModal: true--}}
{{--            }))--}}
{{--        })--}}
{{--    </script>--}}
{{--@endif--}}

{{--</body>--}}
{{--</html>--}}

    <!DOCTYPE html>
<html lang="bg">
@include('partials.head')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden" x-data="{ showModal: false }">
@include('partials.sidebar')

<div class="ml-0 lg:ml-80 p-4 lg:p-8 transition-all duration-300">
    @include('partials.header',[
        'title'=>"Управление на изпити",
        'subtitle'=>'Преглед и създаване на изпитни сесии',
        'button'=>[
            'route'=>route('logout'),
            'text'=>'Изход от системата',
            'icon' =>'fas fa-sign-out-alt'
        ]
    ])

    <main>
        @include('partials.alerts')

        <div class="prose max-w-none mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Преподавателски профил</h2>
            <div class="flex items-center gap-4 text-gray-600 mt-4">
                <div class="flex-1">
                    <h1 class="text-xl font-semibold text-gray-900 mb-2">
                        {{ $teacher->title }} {{ $teacher->user->first_name }} {{ $teacher->user->second_name }} {{ $teacher->user->last_name }}
                    </h1>
                    <div class="flex items-center gap-4 flex-wrap">
                            <span class="flex items-center gap-1.5">
                                <i class="fas fa-envelope text-gray-400"></i>
                                {{ $teacher->user->email }}
                            </span>
                        <span class="flex items-center gap-1.5">
                                <i class="fas fa-clipboard-list text-gray-400"></i>
                                {{ $teacher->exams_count }} активни изпита
                            </span>
                    </div>
                </div>
            </div>
        </div>

        @if($exams->isEmpty())
            <div class="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
                <i class="fas fa-calendar-plus text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700 mb-2">Няма създадени изпити</h3>
                <button @click="showModal = true" class="mt-4 bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition-colors">
                    Нов изпит
                </button>
            </div>
        @else
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
                @foreach($exams as $exam)
                    <div class="bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px]">
                        <div class="flex justify-between items-start gap-2 mb-3">
                            <h2 class="text-lg font-semibold text-gray-900">
                                {{ $exam->subject->subject_name }}
                                <span class="block text-sm font-normal text-gray-500 mt-1">
                                    {{ $exam->subject->description }}
                                </span>
                            </h2>
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                {{ $exam->exam_type }}
                            </span>
                        </div>

                        <div class="space-y-3 mb-5">
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-calendar-alt w-5 text-gray-400"></i>
                                <span>Дата: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y') }}</span></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-clock w-5 text-gray-400"></i>
                                <span>Час: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($exam->end_time)->format('H:i') }}</span></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-university w-5 text-gray-400"></i>
                                <span>Зала: <span class="font-medium text-gray-800">{{ $exam->hall->name }}</span></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-users w-5 text-gray-400"></i>
                                <span class="font-medium {{ $exam->remainingSlots() > 0 ? 'text-green-700' : 'text-red-700' }}">
                                    {{ $exam->remainingSlots() }}/{{ $exam->max_students }} места
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="flex items-center justify-center">
                    <button @click="showModal = true" class="w-16 h-16 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white shadow-xl flex items-center justify-center transition-all duration-300 hover:rotate-90">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </button>
                </div>
            </div>
        @endif
    </main>
</div>

<!-- Create Exam Modal -->
<div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 mx-4" @click.outside="showModal = false">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Създаване на нов изпит</h3>

        <form method="POST" action="{{ route('exams.store') }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Дисциплина</label>
                    <select name="subject_id" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->subject_name }} (Сем. {{ $subject->semester }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Тип изпит</label>
                        <select name="exam_type" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">
                            <option value="редовен">Редовен</option>
                            <option value="поправителен">Поправителен</option>
                            <option value="ликвидация">Ликвидация</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Макс. студенти</label>
                        <input type="number" name="max_students" required min="1" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Изпитна зала</label>
                    <select name="hall_id" id="hall_id" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">
                        @foreach($halls as $hall)
                            <option value="{{ $hall->id }}">{{ $hall->name }} ({{ $hall->capacity }} места)</option>
                        @endforeach
                    </select>
                </div>

                <div id="calendarContainer" class="h-96"></div>

                <input type="hidden" name="start_time" id="start_time">
                <input type="hidden" name="end_time" id="end_time">

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" @click="showModal = false" class="px-5 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors">
                        Отказ
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                        Създай
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@vite(['resources/js/app.js'])
<script src="{{ asset('js/menuFunctions.js') }}" defer></script>
</body>
</html>
