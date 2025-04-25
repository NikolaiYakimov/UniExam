<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Достъпни изпити</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        secondary: {
                            500: '#10b981' // Цвят за бутона "Моите изпити"
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden">
<!-- Фиксирана навигационна лента отляво -->
<aside class="fixed left-0 top-0 h-screen w-72 lg:w-80 bg-white shadow-lg p-6 border-r border-gray-100">
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
<div class="ml-0 lg:ml-72 xl:ml-80 p-4 lg:p-8">
    <!-- Хедър -->
    <header class="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Достъпни изпити</h1>
                <p class="text-sm text-gray-500 mt-1">Преглед и записване за предстоящи изпити</p>
            </div>
            <a href="{{ route('my_exams') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-secondary-500 text-white rounded-lg shadow hover:bg-secondary-600 transition-colors">
                <i class="fas fa-list-alt"></i> Моите изпити
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
                <h3 class="text-lg font-medium text-gray-700 mb-2">Няма налични изпити</h3>
                <p class="text-gray-500">В момента няма изпити за записване. Моля, проверете по-късно.</p>
            </div>
        @else
            <div class="grid gap-6 grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($exams as $exam)
                    <div class="bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px]">
                        <div class="flex justify-between items-start mb-3">
                            <h2 class="text-lg font-semibold text-gray-900 leading-tight">
                                {{ $exam->subject->subject_name }}
                            </h2>
                            <div class="flex items-center gap-2 mb-3">
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

                        <form method="POST" action="{{ route('student.exam.register', $exam) }}">
                            @csrf
                            <button type="submit"
                                    class="w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200
                                {{ $exam->remainingSlots() <= 0 ? 'bg-gray-300 cursor-not-allowed' : 'bg-primary-600 hover:bg-primary-700' }}"
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
</body>
</html>
