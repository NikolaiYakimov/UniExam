{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
{{--    <title>Нов изпит - {{ config('app.name') }}</title>--}}
{{--    <style>--}}
{{--        * {--}}
{{--            margin: 0;--}}
{{--            padding: 0;--}}
{{--            box-sizing: border-box;--}}
{{--            font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;--}}
{{--        }--}}
{{--        body {--}}
{{--            background-color: #f5f7fa;--}}
{{--            line-height: 1.6;--}}
{{--            color: #333;--}}
{{--        }--}}
{{--        .container {--}}
{{--            max-width: 680px;--}}
{{--            margin: 20px auto;--}}
{{--            background: #ffffff;--}}
{{--            border-radius: 4px;--}}
{{--            overflow: hidden;--}}
{{--            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);--}}
{{--        }--}}
{{--        .header {--}}
{{--            background-color: #2c3e50;--}}
{{--            padding: 25px 30px;--}}
{{--            color: #ffffff;--}}
{{--            border-bottom: 1px solid #1a2530;--}}
{{--        }--}}
{{--        .header-title {--}}
{{--            font-size: 22px;--}}
{{--            font-weight: 500;--}}
{{--            margin-bottom: 5px;--}}
{{--        }--}}
{{--        .header-subtitle {--}}
{{--            font-size: 15px;--}}
{{--            opacity: 0.85;--}}
{{--            font-weight: 400;--}}
{{--        }--}}
{{--        .content {--}}
{{--            padding: 35px 30px;--}}
{{--        }--}}
{{--        .exam-title {--}}
{{--            color: #2c3e50;--}}
{{--            font-size: 20px;--}}
{{--            font-weight: 500;--}}
{{--            margin-bottom: 25px;--}}
{{--            padding-bottom: 15px;--}}
{{--            border-bottom: 1px solid #eaeef2;--}}
{{--        }--}}
{{--        .exam-details {--}}
{{--            margin-bottom: 30px;--}}
{{--        }--}}
{{--        .detail-row {--}}
{{--            display: flex;--}}
{{--            padding: 12px 0;--}}
{{--            border-bottom: 1px solid #f0f4f8;--}}
{{--        }--}}
{{--        .detail-label {--}}
{{--            width: 150px;--}}
{{--            color: #5c6b80;--}}
{{--            font-weight: 500;--}}
{{--            font-size: 15px;--}}
{{--        }--}}
{{--        .detail-value {--}}
{{--            flex: 1;--}}
{{--            color: #2c3e50;--}}
{{--            font-size: 16px;--}}
{{--            font-weight: 500;--}}
{{--        }--}}
{{--        .action-button {--}}
{{--            display: inline-block;--}}
{{--            background-color: #3498db;--}}
{{--            color: #ffffff !important;--}}
{{--            text-decoration: none;--}}
{{--            padding: 12px 25px;--}}
{{--            border-radius: 4px;--}}
{{--            font-weight: 500;--}}
{{--            font-size: 15px;--}}
{{--            text-align: center;--}}
{{--            transition: background-color 0.2s;--}}
{{--            border: 1px solid #2980b9;--}}
{{--            margin: 15px 0 30px;--}}
{{--        }--}}
{{--        .action-button:hover {--}}
{{--            background-color: #2980b9;--}}
{{--        }--}}
{{--        .footer {--}}
{{--            padding: 25px 30px;--}}
{{--            background-color: #f8fafc;--}}
{{--            border-top: 1px solid #eaeef2;--}}
{{--            font-size: 13px;--}}
{{--            color: #7b8a9a;--}}
{{--        }--}}
{{--        .footer-title {--}}
{{--            font-weight: 500;--}}
{{--            margin-bottom: 8px;--}}
{{--            color: #5c6b80;--}}
{{--        }--}}
{{--        .footer-info {--}}
{{--            margin-bottom: 15px;--}}
{{--            line-height: 1.7;--}}
{{--        }--}}
{{--        .disclaimer {--}}
{{--            padding-top: 15px;--}}
{{--            border-top: 1px solid #eaeef2;--}}
{{--            font-size: 12px;--}}
{{--            color: #95a5a6;--}}
{{--        }--}}
{{--        .university-name {--}}
{{--            font-weight: 500;--}}
{{--            color: #2c3e50;--}}
{{--            margin-bottom: 5px;--}}
{{--            font-size: 16px;--}}
{{--        }--}}
{{--        .system-name {--}}
{{--            font-weight: 400;--}}
{{--            color: #7b8a9a;--}}
{{--            font-size: 14px;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="container">--}}
{{--    <div class="header">--}}
{{--        <div class="header-title">Нов изпит е добавен</div>--}}
{{--        <div class="header-subtitle">Система за управление на изпити</div>--}}
{{--    </div>--}}

{{--    <div class="content">--}}
{{--        <div class="exam-title">Информация за изпита</div>--}}

{{--        <div class="exam-details">--}}
{{--            <div class="detail-row">--}}
{{--                <div class="detail-label">Дисциплина</div>--}}
{{--                <div class="detail-value">{{ $exam->subject->subject_name ?? 'Неизвестна дисциплина' }}</div>--}}
{{--            </div>--}}

{{--            <div class="detail-row">--}}
{{--                <div class="detail-label">Дата</div>--}}
{{--                <div class="detail-value">--}}
{{--                    {{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y') }}--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="detail-row">--}}
{{--                <div class="detail-label">Час</div>--}}
{{--                <div class="detail-value">--}}
{{--                    {{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }} ч.--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="detail-row">--}}
{{--                <div class="detail-label">Зала</div>--}}
{{--                <div class="detail-value">{{ $exam->hall->name ?? 'Неизвестна зала' }}</div>--}}
{{--            </div>--}}

{{--            <div class="detail-row">--}}
{{--                <div class="detail-label">Тип изпит</div>--}}
{{--                <div class="detail-value">{{ $exam->exam_type }}</div>--}}
{{--            </div>--}}

{{--            <div class="detail-row">--}}
{{--                <div class="detail-label">Макс. студенти</div>--}}
{{--                <div class="detail-value">{{ $exam->max_students }}</div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <a href="{{ route('exams') }}" class="action-button">Виж детайли в системата</a>--}}
{{--    </div>--}}

{{--    <div class="footer">--}}
{{--        <div class="university-name">{{ config('app.university_name', 'Вашият Университет') }}</div>--}}
{{--        <div class="system-name">{{ config('app.name') }} - Система за управление на изпити</div>--}}

{{--        <div class="footer-info">--}}
{{--            <div class="footer-title">За контакти:</div>--}}
{{--            <div>Академичен отдел: academic@university.edu</div>--}}
{{--            <div>Телефон: +359 2 123 456</div>--}}
{{--        </div>--}}

{{--        <div class="disclaimer">--}}
{{--            <p>Това съобщение е изпратено автоматично. Моля, не отговаряйте на него.</p>--}}

{{--            <p>&copy; {{ date('Y') }} {{ config('app.university_name', 'Вашият Университет') }}. Всички права запазени.</p>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}
    <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Нов изпит - {{ config('app.name') }}</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f5f7fa;
        }
        .email-container {
            max-width: 680px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        .email-header {
            padding: 25px 30px;
            background-color: #2c3e50;
            color: #ffffff;
        }
        .university-name {
            font-size: 20px;
            font-weight: 500;
            margin-bottom: 5px;
        }
        .system-name {
            font-size: 14px;
            opacity: 0.9;
            font-weight: 400;
        }
        .email-content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 25px;
            color: #2c3e50;
            line-height: 1.7;
        }
        .email-title {
            font-size: 22px;
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eaeef2;
        }
        .exam-details {
            margin-bottom: 30px;
        }
        .detail-item {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f0f4f8;
        }
        .detail-item:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: 500;
            color: #5c6b80;
            margin-bottom: 5px;
            font-size: 15px;
        }
        .detail-value {
            font-size: 16px;
            color: #2c3e50;
            font-weight: 500;
        }
        .action-button {
            display: inline-block;
            background-color: #2c3e50;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 4px;
            font-weight: 500;
            font-size: 15px;
            text-align: center;
            margin: 30px 0 20px;
            transition: background-color 0.2s;
        }
        .action-button:hover {
            background-color: #1a2530;
        }
        .additional-info {
            background-color: #f8fafc;
            border-left: 3px solid #3498db;
            padding: 20px;
            margin: 30px 0;
            border-radius: 0 4px 4px 0;
        }
        .info-title {
            font-weight: 500;
            margin-bottom: 10px;
            color: #2c3e50;
        }
        .email-footer {
            padding: 25px 30px;
            background-color: #f8fafc;
            border-top: 1px solid #eaeef2;
            font-size: 13px;
            color: #7b8a9a;
        }
        .contact-info {
            margin-bottom: 15px;
            line-height: 1.7;
        }
        .disclaimer {
            padding-top: 15px;
            border-top: 1px solid #eaeef2;
            font-size: 12px;
            color: #95a5a6;
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
        <div class="greeting">
            Здравейте,<br>
            Имаме удоволствието да ви информираме, че е добавен нов изпит в системата. Моля, запознайте се с детайлите по-долу.
        </div>

        <h1 class="email-title">Информация за новия изпит</h1>

        <div class="exam-details">
            <div class="detail-item">
                <div class="detail-label">Дисциплина</div>
                <div class="detail-value">{{ $exam->subject->subject_name ?? 'Неизвестна дисциплина' }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Дата и час на провеждане</div>
                <div class="detail-value">
                    {{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y') }}
                    в {{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }} часа
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Място на провеждане</div>
                <div class="detail-value">
                    {{ $exam->hall->name ?? 'Неизвестна зала' }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Вид изпит</div>
                <div class="detail-value">{{ $exam->exam_type }}</div>
            </div>
        </div>

        <div class="additional-info">
            <div class="info-title">Важна информация:</div>
{{--            <p>За да се запишете за този изпит, моля посетете учебния портал. Регистрацията ще бъде отворена до 24 часа преди началото на изпита.</p>--}}
            <p style="margin-top: 10px;">Моля, обърнете внимание на максималния брой студенти за изпита: <strong>{{ $exam->max_students }}</strong>.</p>
        </div>

        <a href="{{ route('exams') }}" class="action-button">Запиши се за изпита</a>

        <p style="font-size: 14px; color: #7b8a9a; margin-top: 20px;">
            Ако имате въпроси или нужда от помощ, не се колебайте да се свържете с академичния отдел.
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
            <p>
                Това съобщение е изпратено автоматично. Моля, не отговаряйте на него.

            </p>
            <p>&copy; {{ date('Y') }} {{ config('app.university_name', 'Вашият Университет') }}. Всички права запазени.</p>
        </div>
    </div>
</div>
</body>
</html>
