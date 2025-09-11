
{{--<!DOCTYPE html>--}}
{{--<html lang="bg">--}}

{{--Head--}}
{{--@include('partials.head')--}}
{{--<style>--}}
{{--:root{--}}
{{----sb-w: 20rem;--}}
{{----header-h: 64px;--}}
{{--}--}}

{{--body{--}}
{{--background:#f8f9fa;--}}
{{--font-family:'Inter',sans-serif;--}}
{{--}--}}

{{--.nav-link.active, .list-group-item.active{--}}
{{--background:rgba(79,70,229,.08)!important;--}}
{{--font-weight:600;--}}
{{--color:#4f46e5!important;--}}
{{--}--}}

{{--.header-nav {--}}
{{--display: flex;--}}
{{--gap: .5rem;--}}
{{--padding: .5rem 1rem;--}}
{{--background: white;--}}
{{--overflow-x: auto;--}}
{{--white-space: nowrap;--}}
{{--}--}}

{{--.header-nav .nav-link {--}}
{{--padding: .5rem 1rem;--}}
{{--border-radius: .375rem;--}}
{{--transition: .2s;--}}
{{--display: flex;--}}
{{--align-items: center;--}}
{{--}--}}

{{--/* -------- Sidebar -------- */--}}

{{--#sidebar{--}}
{{--position: sticky;--}}
{{--top: 0;--}}
{{--height: 100dvh;--}}
{{--width: var(--sb-w);--}}
{{--background: #fff;--}}
{{--padding: 1.5rem;--}}
{{--border-right: 1px solid #e5e7eb;--}}
{{--overflow-y: auto;--}}
{{--}--}}

{{--/* Мобилни: скриваме sidebar */--}}
{{--@media (max-width: 1538px){--}}
{{--#sidebar{--}}
{{--display: none;--}}
{{--}--}}

{{--.header-nav {--}}
{{--display: none;--}}
{{--}--}}
{{--}--}}

{{--@media (min-width: 1538px){--}}
{{--#sidebar{--}}
{{--display: block;--}}
{{--}--}}

{{--.header-nav {--}}
{{--display: flex;--}}
{{--}--}}
{{--}--}}

{{--.page-layout{--}}
{{--}--}}

{{--@media (min-width: 1538px){--}}
{{--.page-layout{--}}
{{--display: grid;--}}
{{--grid-template-columns: var(--sb-w) 1fr;--}}
{{--gap: 0;--}}
{{--min-height: calc(100dvh - var(--header-h));--}}
{{--}--}}
{{--}--}}

{{--.mobile-nav-dropdown {--}}
{{--display: none;--}}
{{--position: absolute;--}}
{{--top: 100%;--}}
{{--right: 0;--}}
{{--width: 280px;--}}
{{--background: white;--}}
{{--box-shadow: 0 10px 25px rgba(0,0,0,0.15);--}}
{{--border-radius: 8px;--}}
{{--z-index: 50;--}}
{{--padding: 0.75rem;--}}
{{--margin-top: 0.5rem;--}}
{{--border: 1px solid #e5e7eb;--}}
{{--}--}}

{{--.mobile-nav-dropdown.show {--}}
{{--display: block;--}}
{{--}--}}

{{--.mobile-nav-dropdown .nav-link {--}}
{{--display: flex;--}}
{{--align-items: center;--}}
{{--padding: 0.75rem 1rem;--}}
{{--border-radius: 6px;--}}
{{--color: #374151;--}}
{{--transition: all 0.2s ease;--}}
{{--margin-bottom: 0.25rem;--}}
{{--}--}}

{{--.mobile-nav-dropdown .nav-link:hover {--}}
{{--background-color: #f3f4f6;--}}
{{--}--}}

{{--.mobile-nav-dropdown .nav-link.active {--}}
{{--background-color: #eef2ff;--}}
{{--color: #4f46e5;--}}
{{--}--}}

{{--.mobile-nav-dropdown .nav-link i {--}}
{{--width: 20px;--}}
{{--margin-right: 0.75rem;--}}
{{--}--}}

{{--.mobile-nav-toggle {--}}
{{--display: none;--}}
{{--align-items: center;--}}
{{--justify-content: center;--}}
{{--width: 42px;--}}
{{--height: 42px;--}}
{{--border-radius: 8px;--}}
{{--background: #f1f5f9;--}}
{{--border: 1px solid #e2e8f0;--}}
{{--color: #4f46e5;--}}
{{--font-size: 1.25rem;--}}
{{--cursor: pointer;--}}
{{--margin-left: 0.75rem;--}}
{{--transition: all 0.2s ease;--}}
{{--}--}}

{{--.mobile-nav-toggle:hover {--}}
{{--background-color: #e0e7ff;--}}
{{--}--}}

{{--@media (max-width: 1538px) {--}}
{{--.mobile-nav-toggle {--}}
{{--display: flex;--}}
{{--}--}}

{{--.profile-section {--}}
{{--display: flex;--}}
{{--align-items: center;--}}
{{--}--}}
{{--}--}}

{{--@media (max-width: 767px) {--}}
{{--header .container-fluid {--}}
{{--padding-left: 1rem;--}}
{{--padding-right: 1rem;--}}
{{--}--}}

{{--.navbar-brand {--}}
{{--font-size: 1.1rem;--}}
{{--}--}}

{{--.mobile-nav-dropdown {--}}
{{--width: 250px;--}}
{{--right: 0.5rem;--}}
{{--}--}}
{{--}--}}
{{--</style>--}}
{{--<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden">--}}
{{--<!-- Student information sidebar with toggle button-->--}}


{{--<!-- Основно съдържание -->--}}
{{--<div id="mainContent" class="ml-0 lg:ml-80 p-4 lg:p-8 transition-all duration-300">--}}
{{--    <!-- Хедър -->--}}
{{--    @include('partials.header',[--}}
{{--               'title'=>"Моите изпити",--}}
{{--               'subtitle'=>'Преглед на записани изпити',--}}
{{--               'button'=>[--}}
{{--                          'route'=>route('exams'),--}}
{{--                          'text'=>'Достъпни изпити',--}}
{{--                          'icon' =>'fas fa-list-alt'--}}
{{--                         ]--}}
{{--              ])--}}


{{--    <!-- Основен content -->--}}

{{--    <main>--}}
{{--        --}}{{--Alerts--}}
{{--        @include('partials.alerts')--}}
{{--        <div class="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">--}}
{{--            <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">--}}
{{--                <div>--}}
{{--                    <h1 class="text-2xl font-bold text-gray-800">Предстоящи изпити</h1>--}}
{{--                    <p class="text-sm text-gray-500 mt-1">Преглед на записани изпити</p>--}}
{{--                </div>--}}
{{--                --}}{{--                <a href="{{ route('my_exams') }}" class="inline-flex items-center gap-1 px-4 py-2.5 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors">--}}
{{--                --}}{{--                    <i class="fas fa-list-alt"></i>--}}
{{--                --}}{{--                    Моите изпити--}}
{{--                --}}{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        @if($exams->isEmpty()))--}}
{{--        <div class="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">--}}
{{--            <i class="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>--}}
{{--            <h3 class="text-lg font-medium text-gray-700 mb-2">Няма записани изпити</h3>--}}
{{--            <p class="text-gray-500">Все още нямате записани изпити. Моля, изберете от списъка с достъпни изпити.</p>--}}
{{--        </div>--}}
{{--        @else--}}
{{--            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">--}}

{{--                @foreach ($exams as $exam)--}}

{{--                    @php--}}
{{--                    $registration=$exam->registrations->where('student_id',auth()->user()->student->id)->first();--}}
{{--                    @endphp--}}
{{--                    <div class="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px]">--}}
{{--                        <div class="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">--}}
{{--                            <h2 class="text-lg font-semibold text-gray-900 leading-tight">--}}
{{--                                {{ $exam->subject->subject_name }}--}}
{{--                            </h2>--}}
{{--                            <div class="flex flex-wrap gap-2">--}}
{{--                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">--}}
{{--                                    {{ $exam->exam_type }}--}}
{{--                                </span>--}}
{{--                                <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $exam->remainingSlots() > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">--}}
{{--                                    {{ $exam->remainingSlots() }} Свободни места--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="space-y-3 mb-5">--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-chalkboard-teacher w-5 text-gray-400"></i>--}}
{{--                                <span>Преподавател: <span class="font-medium text-gray-800">{{ $exam->teacher->user->first_name }} {{ $exam->teacher->user->last_name }}</span></span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-calendar-alt w-5 text-gray-400"></i>--}}
{{--                                <span>Дата: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y ') }}</span></span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-clock w-5 text-gray-400"></i>--}}
{{--                                <span>Продължителност: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format(' H:i') }} - {{ \Carbon\Carbon::parse($exam->end_time)->format(' H:i') }}</span></span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-university w-5 text-gray-400"></i>--}}
{{--                                <span>Зала: <span class="font-medium text-gray-800">{{ $exam->hall->name }}</span></span>--}}
{{--                            </div>--}}

{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-star w-5 text-gray-400"></i>--}}
{{--                                <span>Оценка:--}}
{{--                                    @if($registration && $registration->grade)--}}
{{--                                        <span class="font-medium text-gray-800">{{ $registration->grade }}</span>--}}
{{--                                    @else--}}
{{--                                        <span class="text-gray-500 italic">---</span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        @if($exam->start_time->isPast())--}}
{{--                        @else--}}
{{--                        <form method="POST" action="{{ route('student.exam.unregister', $exam) }}">--}}
{{--                            @csrf--}}
{{--                            <button type="submit"--}}
{{--                                    class="recorded-exam w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 bg-red-600 hover:bg-red-700"--}}
{{--                                    data-exam-date="{{$exam->start_time}}">--}}
{{--                                <i class="fas fa-edit mr-2"></i> Отпиши се--}}
{{--                            </button>--}}
{{--                        </form>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </main>--}}
{{--</div>--}}

{{--<script src="{{asset('js/menuFunctions.js')}}" defer></script>--}}
{{--<script src="{{asset('js/alertClosingFunctions.js')}}" defer></script>--}}
{{--<script>--}}
{{--    const examsButtons=document.querySelectorAll('.recorded-exam');--}}

{{--    examsButtons.forEach(button=>{--}}
{{--        const examDateString=button.getAttribute("data-exam-date")--}}
{{--        const examDate=new Date(examDateString);--}}
{{--        const hourDifference=(examDate- new Date())/(1000*60*60);--}}

{{--        if(hourDifference<48){--}}
{{--            button.disabled=true;--}}
{{--            button.classList.replace('bg-red-600', 'bg-gray-300');--}}
{{--            button.classList.add('cursor-not-allowed');--}}
{{--            button.classList.remove('hover:bg-red-700');--}}
{{--        }--}}
{{--    });--}}

{{--</script>--}}
{{--</body>--}}

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
{{--            margin-top: 5.5rem; /* Оптимизирано отместване за мобилен режим */--}}
{{--        }--}}
{{--        .bg-green-50, .bg-red-50{--}}
{{--            transition: opacity 0.3s ease;--}}
{{--            position: relative; /* Задължително за позициониране на бутона */--}}
{{--        }--}}
{{--    }--}}
{{--</style>--}}

{{--</html>--}}
    <!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Моите изпити</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

{{--<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden">--}}
<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">
<!-- Header -->
@include('partials.header')

<div class="page-layout ">
    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Основно съдържание -->
    <div id="mainContent" class="ml-0 lg:ml-0 p-4 lg:p-8 transition-all duration-300">
        <!-- Page Header -->
        <div class="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Предстоящи изпити</h1>
                    <p class="text-sm text-gray-500 mt-1">Преглед на записани изпити</p>
                </div>
            </div>
        </div>

        {{-- Alerts --}}
        @include('partials.alerts')

        @if($exams->isEmpty())
            <div class="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
                <i class="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700 mb-2">Няма записани изпити</h3>
                <p class="text-gray-500">Все още нямате записани изпити. Моля, изберете от списъка с достъпни изпити.</p>
            </div>
        @else
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
                @foreach ($exams as $exam)
                    @php
                        $registration = $exam->registrations->where('student_id', auth()->user()->student->id)->first();
                    @endphp
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
                                        {{ $exam->remainingSlots() }} Свободни места
                                    </span>
                            </div>
                        </div>

                        <div class="space-y-3 mb-5">
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
                                <span>Преподавател: <span class="font-medium text-gray-800">{{ $exam->teacher->user->first_name }} {{ $exam->teacher->user->last_name }}</span></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-calendar-alt w-5 text-gray-400"></i>
                                <span>Дата: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y ') }}</span></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-clock w-5 text-gray-400"></i>
                                <span>Продължителност: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format(' H:i') }} - {{ \Carbon\Carbon::parse($exam->end_time)->format(' H:i') }}</span></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-university w-5 text-gray-400"></i>
                                <span>Зала: <span class="font-medium text-gray-800">{{ $exam->hall->name }}</span></span>
                            </div>

                            <div class="flex items-center gap-2 text-gray-600">
{{--                                <i class="fas fa-star w-5 text-gray-400"></i>--}}
{{--                                <span>Оценка:--}}
{{--                                        @if($registration && $registration->grade)--}}
{{--                                        <span class="font-medium text-gray-800">{{ $registration->grade }}</span>--}}
{{--                                    @else--}}
{{--                                        <span class="text-gray-500 italic">---</span>--}}
{{--                                    @endif--}}
{{--                                    </span>--}}
                            </div>
                        </div>

                        @if($exam->start_time->isPast())
                            <!-- Изпитът вече е минал -->
                        @else
                            <form method="POST" action="{{ route('student.exam.unregister', $exam) }}">
                                @csrf
                                <button type="submit"
                                        class="recorded-exam w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 bg-red-600 hover:bg-red-700"
                                        data-exam-date="{{$exam->start_time}}">
                                    <i class="fas fa-edit mr-2"></i> Отпиши се
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script src="{{ asset('js/menuFunctions.js') }}" defer></script>
<script src="{{ asset('js/alertClosingFunctions.js') }}" defer></script>
<script>
    const examsButtons = document.querySelectorAll('.recorded-exam');

    examsButtons.forEach(button => {
        const examDateString = button.getAttribute("data-exam-date")
        const examDate = new Date(examDateString);
        const hourDifference = (examDate - new Date()) / (1000 * 60 * 60);

        if (hourDifference < 48) {
            button.disabled = true;
            button.classList.replace('bg-red-600', 'bg-gray-300');
            button.classList.add('cursor-not-allowed');
            button.classList.remove('hover:bg-red-700');
        }
    });
</script>
</body>
</html>
