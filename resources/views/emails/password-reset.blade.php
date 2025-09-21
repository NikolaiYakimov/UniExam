{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <title>Заявка за възстановяване на парола</title>--}}
{{--</head>--}}
{{--<body>--}}
{{--<h2>Възстановяване на парола</h2>--}}
{{--<p>Получихте този имейл, защото поискахте възстановяване на парола за вашия акаунт.</p>--}}
{{--<p>Моля, кликнете на линка по-долу, за да зададете нова парола:</p>--}}

{{--<!-- Променете линка да сочи към React приложението -->--}}
{{--<a href="{{ config('app.frontend_url') }}/reset-password?token={{ $token }}&email={{ urlencode($user->email) }}">--}}
{{--    Възстанови парола--}}
{{--</a>--}}

{{--<p>Ако не сте поискали възстановяване на парола, игнорирайте този имейл.</p>--}}

{{--<p>Поздрави,<br>Екипът на {{ config('app.name') }}</p>--}}
{{--</body>--}}
{{--</html>--}}
@extends('emails.email-base')

@section('title', 'Заявка за възстановяване на парола')

@section('content')
    <div class="greeting">
        <h2>Възстановяване на парола</h2>
        <p>Получихте този имейл, защото поискахте възстановяване на парола за вашия акаунт.</p>
        <p>Моля, кликнете на бутона по-долу, за да зададете нова парола:</p>
    </div>

    <a href="{{ config('app.frontend_url') }}/reset-password?token={{ $token }}&email={{ urlencode($user->email) }}" class="action-button">
        Възстанови парола
    </a>

    <div class="additional-info">
        <div class="info-title">Важна информация:</div>
        <p>Ако не сте поискали възстановяване на парола, моля игнорирайте този имейл.</p>
        <p style="margin-top:10px;">Връзката е валидна за ограничен период от време.</p>
    </div>

    <p style="font-size:14px; color:#7b8a9a; margin-top:20px;">
        Ако имате проблеми с бутона, копирайте и поставете следния адрес във вашия браузър:<br>
        {{ config('app.frontend_url') }}/reset-password?token={{ $token }}&email={{ urlencode($user->email) }}
    </p>
@endsection
