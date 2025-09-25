
@extends('emails.email-base')

@section('title', 'Потвърждение за регистрация на изпит')

@section('content')
    <div class="greeting">
        <h2>Здравей, {{ $student->user->first_name }}!</h2>
    </div>

    <div class="success-message">
        <p>Успешно се регистрира за изпита по <strong>{{ $exam->subject->subject_name }}</strong>.</p>
    </div>

    <h3 class="email-title">Детайли за изпита</h3>

    <div class="exam-details">
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
@endsection
