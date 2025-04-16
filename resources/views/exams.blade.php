<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Достъпни изпити</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .header {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .exam-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px;
        }
        .exam-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .exam-card .card-body {
            padding: 25px;
        }
        .exam-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 15px;
        }
        .exam-detail {
            color: #495057;
            margin-bottom: 8px;
        }
        .register-btn {
            background-color: #3490dc;
            border: none;
            padding: 8px 20px;
            font-weight: 500;
            margin-top: 15px;
        }
        .register-btn:hover {
            background-color: #227dc7;
        }
        .register-btn:disabled {
            background-color: #6c757d;
        }
        .slots-available {
            font-weight: bold;
            color: #28a745;
        }
        .slots-full {
            font-weight: bold;
            color: #dc3545;
        }
        .alert {
            margin-top: 15px;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Достъпни изпити</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('my_exams') }}" class="btn btn-light">
                <i class="fas fa-list-alt"></i> Моите изпити
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt"></i> Изход
                </button>
            </form>
        </div>
    </div>
</div>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($exams->isEmpty())
        <div class="alert alert-info text-center">
            В момента няма налични изпити за записване.
        </div>
    @else
        <div class="row">
            @foreach ($exams as $exam)
                <div class="col-md-6 col-lg-4">
                    <div class="exam-card card">
                        <div class="card-body">
                            <h5 class="exam-title">{{ $exam->subject->subject_name }}</h5>


                            <p class="exam-detail">
                                <i class="fas fa-chalkboard-teacher"></i> Преподавател:
                                <strong>{{ $exam->teacher->first_name }}  {{$exam->teacher->last_name }}</strong>
                            </p>

                            <p class="exam-detail">
                                <i class="fas fa-calendar-alt"></i> Дата:
                                <strong>{{{ \Carbon\Carbon::parse($exam->exam_date)->format('d.m.Y H:i') }}}</strong>
                            </p>

                            <p class="exam-detail">
                                <i class="fas fa-chalkboard-teacher"></i> Зала:
                                <strong>{{$exam->exam_hall}}</strong>
                            </p>

                            <p class="exam-detail">
                                <i class="fas fa-users"></i> Свободни места:
                                <span class="{{ $exam->remainingSlots() > 0 ? 'slots-available' : 'slots-full' }}">
                                        {{ $exam->remainingSlots() }}
                                    </span>
                            </p>

                            <form method="POST" action="{{ route('student.exam.register', $exam) }}">
                                @csrf
                                <button type="submit" class="btn register-btn w-100"
                                    {{ $exam->remainingSlots() <= 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-edit"></i> Запиши се
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>


<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
