<!DOCTYPE html>
<html>
<head>
    <title>Вход за студенти</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h2 class="mb-4">Вход за студенти</h2>
            <form method="POST" action="{{ route('student.login') }}">
                @csrf
                <div class="mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Потребителско име" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Парола" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Вход</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
