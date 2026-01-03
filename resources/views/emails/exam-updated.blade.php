@extends('emails.email-base')

@section('title', 'Актуализация на изпит - ' . config('app.name'))

@section('content')
    <div class="greeting">
        Здравейте,<br>
        Уведомяваме Ви, че изпитът, за който сте записани, е актуализиран.
    </div>

    <h1 class="email-title">Актуализирани детайли за изпит</h1>

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

        <div class="detail-item">
            <div class="detail-label">Максимален брой студенти</div>
            <div class="detail-value">{{ $exam->max_students }}</div>
        </div>
    </div>

    <p style="font-size: 14px; color: #7b8a9a; margin-top: 20px;">
        Моля, обърнете внимание на актуализираните детайли. Ако имате въпроси, свържете се с академичния отдел.
    </p>
@endsection
