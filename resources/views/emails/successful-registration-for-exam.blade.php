<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Потвърждение за регистрация на изпит</title>
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
            margin-bottom: 25px;
            color: #2c3e50;
        }
        .confirmation-message {
            background-color: #f0fff4;
            border-left: 4px solid #38a169;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 0 4px 4px 0;
        }
        .exam-details {
            margin: 30px 0;
        }
        .section-title {
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eaeef2;
        }
        .detail-item {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f0f4f8;
        }
        .detail-item:last-child {
            border-bottom: none;
        }
        .detail-label {
            width: 150px;
            color: #5c6b80;
            font-weight: 500;
        }
        .detail-value {
            flex: 1;
            color: #2c3e50;
            font-weight: 500;
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
        <div class="header-title">Потвърждение за регистрация на изпит</div>
        <div class="university-name">{{ config('app.university_name', 'Вашият Университет') }}</div>
    </div>

    <div class="email-content">
        <div class="greeting">
            <h2>Здравей, {{ $student->user->first_name }}!</h2>
        </div>

        <div class="confirmation-message">
            <p>Успешно се регистрира за изпита по <strong>{{ $exam->subject->subject_name }}</strong>.</p>
        </div>

        <div class="exam-details">
            <h3 class="section-title">Детайли за изпита</h3>

            <div class="detail-item">
                <div class="detail-label">Дисциплина:</div>
                <div class="detail-value">{{ $exam->subject->subject_name }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Дата:</div>
                <div class="detail-value">{{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y') }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Час:</div>
                <div class="detail-value">{{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }} ч.</div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Зала:</div>
                <div class="detail-value">{{ $exam->hall->name }}</div>
            </div>
        </div>

        <div class="wish-section">
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
