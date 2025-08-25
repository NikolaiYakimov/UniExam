<?php
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Смяна на парола - {{ config('app.name') }}</title>
<style>
    body, html { margin:0; padding:0; font-family:'Segoe UI','Helvetica Neue',Arial,sans-serif; line-height:1.6; color:#333; background-color:#f5f7fa; }
    .email-container { max-width:680px; margin:20px auto; background:#fff; border-radius:4px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,.05); }
    .email-header { padding:25px 30px; background-color:#2c3e50; color:#fff; }
    .university-name { font-size:20px; font-weight:500; margin-bottom:5px; }
    .system-name { font-size:14px; opacity:.9; font-weight:400; }
    .email-content { padding:40px 30px; }
    .greeting { font-size:18px; margin-bottom:25px; color:#2c3e50; line-height:1.7; }
    .email-title { font-size:22px; font-weight:500; color:#2c3e50; margin-bottom:30px; padding-bottom:15px; border-bottom:1px solid #eaeef2; }
    .exam-details { margin-bottom:30px; }
    .detail-item { margin-bottom:15px; padding-bottom:15px; border-bottom:1px solid #f0f4f8; }
    .detail-item:last-child { border-bottom:none; }
    .detail-label { font-weight:500; color:#5c6b80; margin-bottom:5px; font-size:15px; }
    .detail-value { font-size:16px; color:#2c3e50; font-weight:500; }
    .action-button { display:inline-block; background-color:#2c3e50; color:#fff !important; text-decoration:none; padding:12px 30px; border-radius:4px; font-weight:500; font-size:15px; text-align:center; margin:30px 0 20px; transition:background-color .2s; }
    .action-button:hover { background-color:#1a2530; }
    .additional-info { background-color:#f8fafc; border-left:3px solid #3498db; padding:20px; margin:30px 0; border-radius:0 4px 4px 0; }
    .info-title { font-weight:500; margin-bottom:10px; color:#2c3e50; }
    .email-footer { padding:25px 30px; background-color:#f8fafc; border-top:1px solid #eaeef2; font-size:13px; color:#7b8a9a; }
    .contact-info { margin-bottom:15px; line-height:1.7; }
    .disclaimer { padding-top:15px; border-top:1px solid #eaeef2; font-size:12px; color:#95a5a6; }
</style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <div class="university-name">{{ config('app.university_name', 'Вашият Университет') }}</div>
        <div class="system-name">Система за управление на изпити</div>
    </div>

    <div class="email-content">
        <div class="greeting">
            Здравейте, {{ trim(($user->first_name ?? '').' '.($user->last_name ?? '')) }},
            <br>
            това е автоматично уведомление, че паролата на Вашия акаунт беше променена.
        </div>

        <h1 class="email-title">Потвърждение за смяна на парола</h1>

        <div class="exam-details">
            <div class="detail-item">
                <div class="detail-label">Профил</div>
                <div class="detail-value">{{ $user->email ?? '—' }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Дата и час на промяната</div>
                <div class="detail-value">{{ $changedAt->format('d.m.Y') }} в {{ $changedAt->format('H:i') }} часа</div>
            </div>
        </div>

        <div class="additional-info">
            <div class="info-title">Сигурност</div>
            <p>Ако Вие не сте извършили тази промяна, моля сменете паролата си незабавно.</p>
            <p style="margin-top:10px;">По съображения за сигурност не изпращаме пароли по имейл.</p>
        </div>

        <a href="{{ route('profile.edit') }}" class="action-button">Отвори настройките за сигурност</a>

        <p style="font-size:14px; color:#7b8a9a; margin-top:20px;">
            При нужда от съдействие, свържете се с академичния отдел.
        </p>
    </div>

    <div class="email-footer">
        <div class="contact-info">
            <div><strong>Академичен отдел</strong></div>
            <div>Телефон: +359 2 123 456</div>
            <div>Имейл: academic@university.edu</div>
            <div>Работно време: Понеделник - Петък, 09:00 - 17:00</div>
        </div>

        <div class="disclaimer">
            <p>Това съобщение е изпратено автоматично. Моля, не отговаряйте на него.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.university_name', 'Вашият Университет') }}. Всички права запазени.</p>
        </div>
    </div>
</div>
</body>
</html>
