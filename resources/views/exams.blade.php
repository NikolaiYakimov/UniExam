
<!DOCTYPE html>
<html lang="bg">

{{--Head--}}
@include('partials.head')

<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden">
<!-- Student information sidebar with toggle button -->
@include('partials.sidebar')

<!-- Основно съдържание -->

<div class="ml-0 lg:ml-80 p-4 lg:p-8 transition-all duration-300">

    <!-- Хедър -->
    @include('partials.header',[
             'title'=>"Достъпни изпити",
             'subtitle'=>'Преглед и записване за предстоящи изпити',
             'button'=>[
                        'route'=>route('my_exams'),
                        'text'=>'Моите изпити',
                        'icon' =>'fas fa-list-alt'
                       ]
            ])

    <!-- Основен content -->

    <main>
        {{--Alerts--}}

       @include('partials.alerts')

        @if($exams->isEmpty())
            <div class="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
                <i class="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700 mb-2">Няма налични изпити</h3>
                <p class="text-gray-500">В момента няма изпити за записване. Моля, проверете по-късно.</p>
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
                                    {{ $exam->remainingSlots() > 0 ? $exam->remainingSlots().' Свободни места' : 'Няма места' }}
                                </span>
                            </div>
                        </div>

                        <div class="space-y-3 mb-5">
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
                                <span>Преподавател: <span class="font-medium text-gray-800">{{ $exam->teacher->user->first_name }} {{ $exam->teacher->user->last_name }}</span></span>
                            </div>
                            < <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-calendar-alt w-5 text-gray-400"></i>
                                <span>Дата: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y ') }}</span></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-calendar-alt w-5 text-gray-400"></i>
                                <span>Продължителност: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format(' H:i') }} - {{ \Carbon\Carbon::parse($exam->end_time)->format(' H:i') }}</span></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-university w-5 text-gray-400"></i>
                                <span>Зала: <span class="font-medium text-gray-800">{{ $exam->hall->name }}</span></span>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('student.exam.register', $exam) }}">
                            @csrf
                            <button type="submit"
                                    class="w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200
                                {{ $exam->remainingSlots() <= 0 ? 'bg-gray-300 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' }}"
                                {{ $exam->remainingSlots() <= 0 ? 'disabled' : '' }}>
                                <i class="fas fa-edit mr-2"></i> Запиши се
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </main>
</div>

<script src="{{asset('js/menuFunctions.js')}}" defer></script>
</body>
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
            margin-top: 5.5rem; /* Оптимизирано отместване за мобилен режим */
        }
    }
</style>
</html>
