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
                    <h1 class="text-2xl font-bold text-gray-800">Моите предмети</h1>
                    <p class="text-sm text-gray-500 mt-1">Преглед и управление на заверки по предмети</p>
                </div>
            </div>
        </div>

        @include('partials.alerts')

        @if($subjects->isEmpty())
            <div class="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
                <i class="fas fa-book text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700 mb-2">Нямате назначени предмети</h3>
                <p class="text-gray-500">Свържете се с администратор за да бъдете добавени към предмет.</p>
            </div>
        @else
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
                @foreach($subjects as $subject)
                    <div class="flex flex-col bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px]">
                        <div class="flex justify-between items-start gap-2 mb-3">
                            <h2 class="text-lg font-semibold text-gray-900">
                                {{ $subject->subject_name }}
                            </h2>
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                Сем. {{ $subject->semester }}
                            </span>
                        </div>

                        <div class="space-y-3 mb-5">
                            <div class="text-gray-600">
                                {{ $subject->description }}
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-users w-5 text-gray-400"></i>
                                <span>Студенти: <span class="font-medium text-gray-800">{{ $subject->students_count }}</span></span>
                            </div>
                        </div>

                        <a href="{{ route('teacher.subject.students', $subject) }}" class="mt-auto w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 bg-blue-600 hover:bg-blue-700 text-center">
                            <i class="fa-solid fa-list-check"></i> Управление на заверки
                        </a>
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
