
@extends('emails.email-base')

@section('title', 'Смяна на парола - ' . config('app.name'))

@section('content')
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
@endsection
