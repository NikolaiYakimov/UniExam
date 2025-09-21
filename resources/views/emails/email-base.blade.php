<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title', config('app.name'))</title>
    <style>
        body, html {
            margin:0;
            padding:0;
            font-family:'Segoe UI','Helvetica Neue',Arial,sans-serif;
            line-height:1.6;
            color:#333;
            background-color:#f5f7fa;
        }
        .email-container {
            max-width:680px;
            margin:20px auto;
            background:#fff;
            border-radius:4px;
            overflow:hidden;
            box-shadow:0 2px 10px rgba(0,0,0,.05);
        }
        .email-header {
            padding:25px 30px;
            background-color:#2c3e50;
            color:#fff;
        }
        .university-name {
            font-size:20px;
            font-weight:500;
            margin-bottom:5px;
        }
        .system-name {
            font-size:14px;
            opacity:.9;
            font-weight:400;
        }
        .email-content {
            padding:40px 30px;
        }
        .greeting {
            font-size:18px;
            margin-bottom:25px;
            color:#2c3e50;
            line-height:1.7;
        }
        .email-title {
            font-size:22px;
            font-weight:500;
            color:#2c3e50;
            margin-bottom:30px;
            padding-bottom:15px;
            border-bottom:1px solid #eaeef2;
        }
        .exam-details {
            margin-bottom:30px;
        }
        .detail-item {
            margin-bottom:15px;
            padding-bottom:15px;
            border-bottom:1px solid #f0f4f8;
        }
        .detail-item:last-child {
            border-bottom:none;
        }
        .detail-label {
            font-weight:500;
            color:#5c6b80;
            margin-bottom:5px;
            font-size:15px;
        }
        .detail-value {
            font-size:16px;
            color:#2c3e50;
            font-weight:500;
        }
        .action-button {
            display:inline-block;
            background-color:#2c3e50;
            color:#fff !important;
            text-decoration:none;
            padding:12px 30px;
            border-radius:4px;
            font-weight:500;
            font-size:15px;
            text-align:center;
            margin:30px 0 20px;
            transition:background-color .2s;
        }
        .action-button:hover {
            background-color:#1a2530;
        }
        .additional-info {
            background-color:#f8fafc;
            border-left:3px solid #3498db;
            padding:20px;
            margin:30px 0;
            border-radius:0 4px 4px 0;
        }
        .info-title {
            font-weight:500;
            margin-bottom:10px;
            color:#2c3e50;
        }
        .email-footer {
            padding:25px 30px;
            background-color:#f8fafc;
            border-top:1px solid #eaeef2;
            font-size:13px;
            color:#7b8a9a;
        }
        .contact-info {
            margin-bottom:15px;
            line-height:1.7;
        }
        .disclaimer {
            padding-top:15px;
            border-top:1px solid #eaeef2;
            font-size:12px;
            color:#95a5a6;
        }
        .success-message {
            background-color: #f0fff4;
            border-left: 4px solid #38a169;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 0 4px 4px 0;
        }
        .details-grid {
            display: grid;
            grid-template-columns: 150px 1fr;
            gap: 12px 15px;
            margin-bottom: 25px;
        }
        .payment-card {
            background-color: #f8fafc;
            border: 1px solid #eaeef2;
            border-radius: 4px;
            padding: 20px;
            margin: 30px 0;
            text-align: center;
        }
        .payment-label {
            color: #5c6b80;
            margin-bottom: 8px;
        }
        .payment-amount {
            font-size: 24px;
            font-weight: 600;
            color: #2c3e50;
        }
        .wish-section {
            text-align: center;
            margin: 40px 0 30px;
            padding: 25px;
            background-color: #f8f9fc;
            border-radius: 4px;
        }
        .signature {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eaeef2;
            font-style: italic;
            color: #5c6b80;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <div class="university-name">{{ config('app.university_name', 'Вашият Университет') }}</div>
        <div class="system-name">Система за управление на изпити</div>
    </div>

    <div class="email-content">
        @yield('content')
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
