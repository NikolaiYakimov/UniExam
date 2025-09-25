
@extends('emails.email-base')

@section('title', 'Потвърждение за записване на изпит')

@section('content')
    <div class="greeting">
        <h2>Здравей, {{ $student->user->first_name }}!</h2>
    </div>

    <div class="success-message">
        <p>Успешно се записа за ликвидационен изпит и плащането е прието.</p>
    </div>

    <h3 class="email-title">Детайли за изпита</h3>

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
@endsection
