{{--<!DOCTYPE html>--}}
{{--<html lang="bg">--}}
{{--@include('partials.head')--}}
{{--<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}

{{--<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden" x-data="{ showModal: false }">--}}
{{--@include('partials.sidebar')--}}

{{--<div class="ml-0 lg:ml-80 p-4 lg:p-8 transition-all duration-300">--}}
{{--    @include('partials.header',[--}}
{{--        'title'=>"Управление на изпити",--}}
{{--        'subtitle'=>'Преглед на изминалите изпити',--}}
{{--        'button'=>[--}}
{{--            'route'=>route('teacher_dashboard'),--}}
{{--            'text'=>'Предстоящи изпити',--}}
{{--            'icon' =>'fa-solid fa-calendar-days'--}}
{{--        ]--}}
{{--    ])--}}

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
{{--                            <span class="flex items-center gap-1.5">--}}
{{--                                <i class="fas fa-envelope text-gray-400"></i>--}}
{{--                                {{ $teacher->user->email }}--}}
{{--                            </span>--}}
{{--                        <span class="flex items-center gap-1.5">--}}
{{--                                <i class="fas fa-clipboard-list text-gray-400"></i>--}}
{{--                                {{ $teacher->exams_count }} активни изпита--}}
{{--                            </span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        @if($exams->isEmpty())--}}
{{--            <div class="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">--}}
{{--                <i class="fas fa-calendar-plus text-4xl text-gray-300 mb-4"></i>--}}
{{--                <h3 class="text-lg font-medium text-gray-700 mb-2">Няма създадени изпити</h3>--}}
{{--                <button @click="showModal = true" class="mt-4 bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition-colors">--}}
{{--                    Нов изпит--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">--}}
{{--                @foreach($exams as $exam)--}}
{{--                    <div class="bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px] flex flex-col h-full">--}}
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

{{--                        <div class="space-y-3 mb-5 flex-grow">--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-calendar-alt w-5 text-gray-400"></i>--}}
{{--                                <span>Дата: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y') }}</span></span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-clock w-5 text-gray-400"></i>--}}
{{--                                <span>Час: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($exam->end_time)->format('H:i') }}</span></span>--}}
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
{{--                        <div class="flex items-center gap-2 text-gray-600">--}}

{{--                            <a href="{{ route('teacher.exam.details', $exam->id) }}"--}}
{{--                               class="mt-auto  inline-block w-full px-4 py-2.5 text-center rounded-xl text-white font-medium transition-colors duration-200 bg-blue-600 hover:bg-blue-700">--}}
{{--                                <i class="fa-solid fa-file-pen"></i> Въведи оценки--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                @endforeach--}}


{{--            </div>--}}
{{--        @endif--}}
{{--    </main>--}}
{{--</div>--}}




{{--<script src="{{ asset('js/menuFunctions.js') }}" defer></script>--}}
{{--<style>--}}

{{--    /*#sidebar {*/--}}
{{--    /*    width: 288px;*/--}}
{{--    /*    left: -288px;*/--}}
{{--    /*    box-shadow: 8px 0 15px -3px rgba(0, 0, 0, 0.1);*/--}}
{{--    /*}*/--}}
{{--    /*#menuContainer {*/--}}
{{--    /*    transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);*/--}}
{{--    /*    left: 1rem;*/--}}
{{--    /*}*/--}}
{{--    header {--}}
{{--        margin-top: 5.5rem; /* Оптимизирано отместване за мобилен режим */--}}
{{--    }--}}
{{--    .bg-green-50, .bg-red-50{--}}
{{--        transition: opacity 0.3s ease;--}}
{{--        position: relative; /* Задължително за позициониране на бутона */--}}
{{--    }--}}
{{--</style>--}}

{{--</body>--}}
{{--</html>--}}
    <!DOCTYPE html>
<html lang="bg">
@include('partials.head')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden">
@include('partials.header')

<div class="page-layout">
    @include('partials.sidebar')

    <main class="p-4 lg:p-6">
        <div class="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Управление на изпити</h1>
                    <p class="text-sm text-gray-500 mt-1">Преглед на изминалите изпити</p>
                </div>
{{--                <a href="{{ route('teacher_dashboard') }}" class="inline-flex items-center gap-1 px-4 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors">--}}
{{--                    <i class="fa-solid fa-calendar-days"></i>--}}
{{--                    Предстоящи изпити--}}
{{--                </a>--}}
            </div>
        </div>

        @include('partials.alerts')

{{--        <div class="prose max-w-none mb-8">--}}
{{--            <h2 class="text-2xl font-bold text-gray-900">Преподавателски профил</h2>--}}
{{--            <div class="flex items-center gap-4 text-gray-600 mt-4">--}}
{{--                <div class="flex-1">--}}
{{--                    <h1 class="text-xl font-semibold text-gray-900 mb-2">--}}
{{--                        {{ $teacher->title }} {{ $teacher->user->first_name }} {{ $teacher->user->second_name }} {{ $teacher->user->last_name }}--}}
{{--                    </h1>--}}
{{--                    <div class="flex items-center gap-4 flex-wrap">--}}
{{--                            <span class="flex items-center gap-1.5">--}}
{{--                                <i class="fas fa-envelope text-gray-400"></i>--}}
{{--                                {{ $teacher->user->email }}--}}
{{--                            </span>--}}
{{--                        <span class="flex items-center gap-1.5">--}}
{{--                                <i class="fas fa-clipboard-list text-gray-400"></i>--}}
{{--                                {{ $teacher->exams_count }} активни изпита--}}
{{--                            </span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

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
                    <div class="bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px] flex flex-col h-full">
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

                        <div class="space-y-3 mb-5 flex-grow">
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
                        <div class="flex items-center gap-2 text-gray-600">
                            <a href="{{ route('teacher.exam.details', $exam->id) }}"
                               class="mt-auto inline-block w-full px-4 py-2.5 text-center rounded-xl text-white font-medium transition-colors duration-200 bg-blue-600 hover:bg-blue-700">
                                <i class="fa-solid fa-file-pen"></i> Въведи оценки
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>
</div>

<script src="{{ asset('js/menuFunctions.js') }}" defer></script>
<script src="{{ asset('js/alertClosingFunctions.js')}}" defer></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
