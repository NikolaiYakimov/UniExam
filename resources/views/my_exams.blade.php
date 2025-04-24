{{--<!DOCTYPE html>--}}
{{--<html lang="bg">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Моите изпити</title>--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">--}}
{{--    <style>--}}
{{--        /* Преизползване на оригиналните стилове */--}}
{{--        body {--}}
{{--            background-color: #f8f9fa;--}}
{{--            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;--}}
{{--        }--}}
{{--        .header {--}}
{{--            background-color: #343a40;--}}
{{--            color: white;--}}
{{--            padding: 20px 0;--}}
{{--            margin-bottom: 30px;--}}
{{--            box-shadow: 0 2px 10px rgba(0,0,0,0.1);--}}
{{--        }--}}
{{--        .exam-card {--}}
{{--            border: none;--}}
{{--            border-radius: 10px;--}}
{{--            box-shadow: 0 4px 6px rgba(0,0,0,0.1);--}}
{{--            transition: transform 0.3s ease, box-shadow 0.3s ease;--}}
{{--            margin-bottom: 20px;--}}
{{--        }--}}
{{--        .exam-card:hover {--}}
{{--            transform: translateY(-5px);--}}
{{--            box-shadow: 0 10px 20px rgba(0,0,0,0.1);--}}
{{--        }--}}
{{--        .exam-card .card-body {--}}
{{--            padding: 25px;--}}
{{--        }--}}
{{--        .exam-title {--}}
{{--            color: #2c3e50;--}}
{{--            font-weight: 600;--}}
{{--            margin-bottom: 15px;--}}
{{--        }--}}
{{--        .exam-detail {--}}
{{--            color: #495057;--}}
{{--            margin-bottom: 8px;--}}
{{--        }--}}

{{--        .back-btn {--}}
{{--            background-color: white;--}}
{{--            color: black;--}}
{{--        }--}}
{{--        .back-btn:hover {--}}
{{--            background-color: #5c636a;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="header">--}}
{{--    <div class="container d-flex justify-content-between align-items-center">--}}
{{--        <h1 class="mb-0">Моите изпити</h1>--}}
{{--        <div class="d-flex gap-2">--}}
{{--            <a href="{{ route('exams') }}" class="btn back-btn">--}}
{{--                <i class="fas fa-arrow-left "></i> Достъпни изпити--}}
{{--            </a>--}}
{{--            <form action="{{ route('logout') }}" method="POST">--}}
{{--                @csrf--}}
{{--                <button type="submit" class="btn btn-danger">--}}
{{--                    <i class="fas fa-sign-out-alt"></i> Изход--}}
{{--                </button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div class="container">--}}
{{--    @if(session('success'))--}}
{{--        <div class="alert alert-success alert-dismissible fade show" role="alert">--}}
{{--            {{ session('success') }}--}}
{{--            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    @if(session('error'))--}}
{{--        <div class="alert alert-danger alert-dismissible fade show" role="alert">--}}
{{--            {{ session('error') }}--}}
{{--            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    @if($exams->isEmpty())--}}
{{--        <div class="alert alert-info text-center mt-4">--}}
{{--            Все още нямате записани изпити.--}}
{{--        </div>--}}
{{--    @else--}}
{{--        <div class="row">--}}
{{--            @foreach ($exams as $exam)--}}
{{--                <div class="col-md-6 col-lg-4">--}}
{{--                    <div class="exam-card card">--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="exam-title">{{ $exam->subject->subject_name }}</h5>--}}

{{--                            <p class="exam-detail">--}}
{{--                                <i class="fas fa-chalkboard-teacher"></i> Преподавател:--}}
{{--                                <strong>{{ $exam->teacher->first_name }} {{ $exam->teacher->last_name }}</strong>--}}
{{--                            </p>--}}

{{--                            <p class="exam-detail">--}}
{{--                                <i class="fas fa-calendar-alt"></i> Дата:--}}
{{--                                <strong>{{ \Carbon\Carbon::parse($exam->exam_date)->format('d.m.Y H:i') }}</strong>--}}
{{--                            </p>--}}

{{--                            <p class="exam-detail">--}}
{{--                                <i class="fas fa-chalkboard-teacher"></i> Зала:--}}
{{--                                <strong>{{$exam->exam_hall}}</strong>--}}
{{--                            </p>--}}


{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    @endif--}}
{{--</div>--}}


{{--<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>--}}

{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>--}}
{{--</body>--}}
{{--</html>--}}

    <!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Достъпни изпити</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-indigo-50 to-blue-100 min-h-screen font-[Inter]">
<!-- Фиксирана навигационна лента отляво -->
<aside class="fixed left-0 top-0 h-screen w-72 bg-white shadow-xl p-6 border-r border-gray-200">
    <div class="flex flex-col h-full">
        <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-2 border-b border-gray-200">
            <i class="fas fa-user-graduate mr-2"></i>Студентски профил
        </h2>

        <div class="space-y-5 flex-1">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-user text-xl text-blue-600"></i>
                </div>
                <div>
                    <p class="font-medium">{{ Auth::user()->first_name }} {{ Auth::user()->second_name }} {{ Auth::user()->last_name }} </p>
                    <p class="text-sm text-gray-500">№: <strong>{{ Auth::user()->faculty_number }} </strong></p>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Специалност</p>
                    <p class="font-medium text-gray-800">{{ Auth::user()->major }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Username</p>
                    <p class="font-medium text-gray-800">{{ Auth::user()->username }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">Майл</p>
                    <p class="font-medium text-gray-800">{{ Auth::user()->email }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 mb-1">Телефонен номер</p>
                    <p class="font-medium text-gray-800">{{ Auth::user()->phone }}</p>
                </div>


                <div>
                    <p class="text-sm text-gray-500 mb-1">Статус</p>
                    <p class="font-medium text-green-600">
                        <i class="fas fa-check-circle"></i> Активен
                    </p>
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-gray-200">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full px-4 py-2.5 text-sm bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors">
                    <i class="fas fa-sign-out-alt mr-2"></i>Изход от системата
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Основно съдържание -->
<div class="ml-72 p-8">
    <!-- Хедър -->
    <header class="bg-white/80 backdrop-blur-md shadow-md py-6 mb-8 rounded-xl">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800 pl-4">Моите изпити</h1>
            <a href="{{ route('exams') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-gray-700 rounded-lg shadow hover:bg-gray-100 mr-4">
                <i class="fas fa-list-alt"></i> Достъпни изпити
            </a>
        </div>
    </header>

    <!-- Основен content -->
    <main>
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-800">
                {{ session('error') }}
            </div>
        @endif

        @if($exams->isEmpty())
            <div class="text-center p-8 bg-white shadow rounded-xl">
                В момента няма налични изпити за записване.
            </div>
        @else
            <div class="grid gap-6 grid-cols-1 md:grid-cols-2">
                @foreach ($exams as $exam)
                    <div class="bg-white shadow rounded-xl p-6 hover:shadow-lg transition-all">
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">
                            {{ $exam->subject->subject_name }}
                        </h2>
                        <p class="text-gray-700 mb-1">
                            <i class="fas fa-chalkboard-teacher"></i> Преподавател:
                            <strong>{{ $exam->teacher->first_name }} {{ $exam->teacher->last_name }}</strong>
                        </p>
                        <p class="text-gray-700 mb-1">
                            <i class="fas fa-calendar-alt"></i> Дата:
                            <strong>{{ \Carbon\Carbon::parse($exam->exam_date)->format('d.m.Y H:i') }}</strong>
                        </p>
                        <p class="text-gray-700 mb-1">
                            <i class="fas fa-university"></i> Зала:
                            <strong>{{ $exam->exam_hall }}</strong>
                        </p>
                        <p class="text-gray-700 mb-4">
                            <i class="fas fa-users"></i> Свободни места:
                            <span class="font-semibold {{ $exam->remainingSlots() > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $exam->remainingSlots() }}
                            </span>
                        </p>

                    </div>
                @endforeach
            </div>
        @endif
    </main>
</div>
</body>
</html>
