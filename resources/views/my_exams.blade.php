<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Моите изпити</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Преизползване на оригиналните стилове */
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

        .back-btn {
            background-color: white;
            color: black;
        }
        .back-btn:hover {
            background-color: #5c636a;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Моите изпити</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('exams') }}" class="btn back-btn">
                <i class="fas fa-arrow-left "></i> Достъпни изпити
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
        <div class="alert alert-info text-center mt-4">
            Все още нямате записани изпити.
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
                                <strong>{{ $exam->teacher->first_name }} {{ $exam->teacher->last_name }}</strong>
                            </p>

                            <p class="exam-detail">
                                <i class="fas fa-calendar-alt"></i> Дата:
                                <strong>{{ \Carbon\Carbon::parse($exam->exam_date)->format('d.m.Y H:i') }}</strong>
                            </p>

                            <p class="exam-detail">
                                <i class="fas fa-chalkboard-teacher"></i> Зала:
                                <strong>{{$exam->exam_hall}}</strong>
                            </p>


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
