{{--@component('mail::message')--}}
{{--    <style>--}}
{{--        .header {--}}
{{--            background-color: #2c3e50;--}}
{{--            padding: 25px 0;--}}
{{--            text-align: center;--}}
{{--            color: white;--}}
{{--            margin: -25px -25px 25px -25px;--}}
{{--            border-radius: 4px 4px 0 0;--}}
{{--        }--}}
{{--        .header-title {--}}
{{--            font-size: 20px;--}}
{{--            font-weight: 500;--}}
{{--        }--}}
{{--        .content-card {--}}
{{--            background: #ffffff;--}}
{{--            border-radius: 4px;--}}
{{--            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);--}}
{{--            padding: 25px;--}}
{{--            margin-bottom: 25px;--}}
{{--        }--}}
{{--        .greeting {--}}
{{--            font-size: 18px;--}}
{{--            margin-bottom: 20px;--}}
{{--            color: #2c3e50;--}}
{{--            line-height: 1.7;--}}
{{--        }--}}
{{--        .details-list {--}}
{{--            margin: 25px 0;--}}
{{--            padding: 0;--}}
{{--            list-style: none;--}}
{{--        }--}}
{{--        .details-list li {--}}
{{--            padding: 12px 0;--}}
{{--            border-bottom: 1px solid #f0f4f8;--}}
{{--            display: flex;--}}
{{--        }--}}
{{--        .details-list li:last-child {--}}
{{--            border-bottom: none;--}}
{{--        }--}}
{{--        .detail-label {--}}
{{--            width: 150px;--}}
{{--            color: #5c6b80;--}}
{{--            font-weight: 500;--}}
{{--        }--}}
{{--        .detail-value {--}}
{{--            flex: 1;--}}
{{--            color: #2c3e50;--}}
{{--            font-weight: 500;--}}
{{--        }--}}
{{--        .payment-box {--}}
{{--            background-color: #f8fafc;--}}
{{--            border-left: 3px solid #3498db;--}}
{{--            padding: 20px;--}}
{{--            margin: 25px 0;--}}
{{--            border-radius: 0 4px 4px 0;--}}
{{--        }--}}
{{--        .success-message {--}}
{{--            text-align: center;--}}
{{--            margin: 30px 0;--}}
{{--            padding: 20px;--}}
{{--            background-color: #f0fff4;--}}
{{--            border-radius: 4px;--}}
{{--            border-left: 4px solid #38a169;--}}
{{--        }--}}
{{--        .signature {--}}
{{--            margin-top: 30px;--}}
{{--            padding-top: 15px;--}}
{{--            border-top: 1px solid #eaeef2;--}}
{{--            font-style: italic;--}}
{{--            color: #5c6b80;--}}
{{--        }--}}
{{--    </style>--}}

{{--    <div class="header">--}}
{{--        <div class="header-title">Потвърждение за записване на изпит</div>--}}
{{--    </div>--}}

{{--    <div class="greeting">--}}
{{--        Здравей, {{ $student->user->first_name }}!--}}
{{--    </div>--}}

{{--    <div class="content-card">--}}
{{--        <p style="margin-bottom: 20px; font-size: 16px; color: #2c3e50;">--}}
{{--            Успешно се записа за ликвидационен изпит и плащането е прието.--}}
{{--        </p>--}}

{{--        <h2 style="font-size: 18px; color: #2c3e50; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #eaeef2;">--}}
{{--            Детайли за изпита--}}
{{--        </h2>--}}

{{--        <ul class="details-list">--}}
{{--            <li>--}}
{{--                <span class="detail-label">Дисциплина:</span>--}}
{{--                <span class="detail-value">{{ $exam->subject->subject_name }}</span>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <span class="detail-label">Дата:</span>--}}
{{--                <span class="detail-value">{{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y') }}</span>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <span class="detail-label">Час:</span>--}}
{{--                <span class="detail-value">{{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }} ч.</span>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <span class="detail-label">Зала:</span>--}}
{{--                <span class="detail-value">{{ $exam->hall->name }}</span>--}}
{{--            </li>--}}
{{--        </ul>--}}

{{--        <div class="payment-box">--}}
{{--            <div style="font-weight: 500; margin-bottom: 5px; color: #2c3e50;">--}}
{{--                Платена сума:--}}
{{--            </div>--}}
{{--            <div style="font-size: 18px; font-weight: 600; color: #2c3e50;">--}}
{{--                {{ $exam->subject->price }} лв.--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="success-message">--}}
{{--        <p style="font-size: 16px; margin: 0; color: #2c3e50;">--}}
{{--            Благодарим ти, че използва нашата система!--}}
{{--        </p>--}}
{{--        <p style="font-size: 16px; margin: 10px 0 0; font-weight: 500; color: #2c3e50;">--}}
{{--            Желаем ти успех на изпита!--}}
{{--        </p>--}}
{{--    </div>--}}

{{--    <div class="signature">--}}
{{--        <p style="margin: 0;">С уважение,</p>--}}
{{--        <p style="margin: 0;">Академичният отдел</p>--}}
{{--        <p style="margin: 5px 0 0;">{{ config('app.university_name', 'Вашият Университет') }}</p>--}}
{{--    </div>--}}

{{--    <hr style="margin: 30px 0; border: 0; border-top: 1px solid #eaeef2;">--}}

{{--    <p style="font-size: 0.9em; color: #95a5a6; text-align: center;">--}}
{{--        Това съобщение е автоматично генерирано. Моля, не отговаряйте на него.<br>--}}
{{--        Ако имате въпроси, моля свържете се с академичния отдел.--}}
{{--    </p>--}}
{{--@endcomponent--}}
    <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Потвърждение за записване на изпит</title>
    <style>
        body {
            font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
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
            background-color: #2c3e50;
            padding: 25px 30px;
            color: #ffffff;
            text-align: center;
        }
        .header-title {
            font-size: 20px;
            font-weight: 500;
            margin-bottom: 5px;
        }
        .university-name {
            font-size: 16px;
            opacity: 0.9;
        }
        .email-content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 30px;
            color: #2c3e50;
        }
        .success-message {
            background-color: #f0fff4;
            border-left: 4px solid #38a169;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 0 4px 4px 0;
        }
        .section-title {
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eaeef2;
        }
        .details-grid {
            display: grid;
            grid-template-columns: 150px 1fr;
            gap: 12px 15px;
            margin-bottom: 25px;
        }
        .detail-label {
            color: #5c6b80;
            font-weight: 500;
        }
        .detail-value {
            color: #2c3e50;
            font-weight: 500;
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
        .email-footer {
            padding: 25px 30px;
            background-color: #f8fafc;
            border-top: 1px solid #eaeef2;
            font-size: 13px;
            color: #7b8a9a;
            text-align: center;
        }
        .disclaimer {
            padding-top: 15px;
            margin-top: 15px;
            border-top: 1px solid #eaeef2;
            font-size: 12px;
            color: #95a5a6;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <div class="header-title">Потвърждение за записване на изпит</div>
        <div class="university-name">{{ config('app.university_name', 'Вашият Университет') }}</div>
    </div>

    <div class="email-content">
        <div class="greeting">
            <h2>Здравей, {{ $student->user->first_name }}!</h2>
        </div>

        <div class="success-message">
            <p>Успешно се записа за ликвидационен изпит и плащането е прието.</p>
        </div>

        <h3 class="section-title">Детайли за изпита</h3>

        <div class="details-grid">
            <div class="detail-label">Дисциплина:</div>
            <div class="detail-value">{{ $exam->subject->subject_name }}</div>

            <div class="detail-label">Дата:</div>
            <div class="detail-value">{{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y') }}</div>

            <div class="detail-label">Час:</div>
            <div class="detail-value">{{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }} ч.</div>

            <div class="detail-label">Зала:</div>
            <div class="detail-value">{{ $exam->hall->name }}</div>
        </div>

        <div class="payment-card">
            <div class="payment-label">Платена сума</div>
            <div class="payment-amount">{{ $exam->subject->price }} лв.</div>
        </div>

        <div class="wish-section">
            <p style="font-size: 16px; margin-bottom: 15px;">Благодарим ти, че използва нашата система!</p>
            <p style="font-size: 18px; font-weight: 500; color: #2c3e50;">Желаем ти успех на изпита!</p>
        </div>

        <div class="signature">
            <p>С уважение,</p>
            <p>Академичният отдел</p>
            <p>{{ config('app.university_name', 'Вашият Университет') }}</p>
        </div>
    </div>

    <div class="email-footer">
        <div class="contact-info">
            <p>Академичен отдел: academic@university.edu | Телефон: +359 2 123 456</p>
        </div>
        <div class="disclaimer">
            <p>Това съобщение е автоматично генерирано. Моля, не отговаряйте на него.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.university_name', 'Вашият Университет') }}. Всички права запазени.</p>
        </div>
    </div>
</div>
</body>
</html>
