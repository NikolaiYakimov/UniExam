<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Университетски портал – Възстановяване на парола</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #3498db;
            --primary-hover: #2980b9;
            --secondary-color: #f8f9fa;
            --text-color: #2c3e50;
            --light-gray: #ecf0f1;
            --border-radius: 12px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', 'Helvetica Neue', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--text-color);
            line-height: 1.6;
        }

        .login-container {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 2.5rem;
            width: 100%;
            max-width: 450px;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #3498db, #2ecc71);
        }

        .logo {
            height: 70px;
            margin: 0 auto 2rem;
            display: block;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .login-title {
            font-size: 1.75rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1.5rem;
            color: var(--text-color);
            position: relative;
        }

        .login-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #3498db, #2ecc71);
            margin: 0.75rem auto 0;
            border-radius: 2px;
        }

        .form-control {
            border-radius: var(--border-radius);
            padding: 0.75rem 1.25rem;
            border: 1px solid var(--light-gray);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }

        .input-group-text {
            background-color: var(--secondary-color);
            border: 1px solid var(--light-gray);
            border-radius: var(--border-radius) 0 0 var(--border-radius);
        }

        .btn-login {
            background: linear-gradient(90deg, #3498db, #2ecc71);
            border: none;
            border-radius: var(--border-radius);
            padding: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: linear-gradient(90deg, #2980b9, #27ae60);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .form-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        .form-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .form-footer a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        .alert {
            border-radius: var(--border-radius);
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #95a5a6;
            z-index: 5;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .form-floating label {
            padding: 0.75rem 1.25rem;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: #95a5a6;
        }

        .divider::before, .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid var(--light-gray);
        }

        .divider::before {
            margin-right: 1rem;
        }

        .divider::after {
            margin-left: 1rem;
        }
    </style>
</head>
<body>
<div class="login-container">
    <!-- Университетско лого -->
    <img src="{{ asset('images/university-logo.png') }}" alt="Университетско лого" class="logo">

    <h2 class="login-title">Възстановяване на парола</h2>

    <!-- Display status message -->
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Display errors -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="form-control form-control-lg @error('email') is-invalid @enderror"
                       placeholder="Имейл адрес" required autofocus>
            </div>
            @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-login btn-lg w-100 mb-3">
            <i class="fas fa-paper-plane me-2"></i>Изпрати линк за възстановяване
        </button>

    </form>

    <div class="form-footer">
        <a href="{{ route('login') }}">Обратно към входа</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
