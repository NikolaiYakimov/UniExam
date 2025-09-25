
@extends('emails.email-base')

@section('title', 'Нов изпит - ' . config('app.name'))

@section('content')
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
        <p style="margin-top: 10px;">Моля, обърнете внимание на максималния брой студенти за изпита: <strong>{{ $exam->max_students }}</strong>.</p>
    </div>


    <p style="font-size: 14px; color: #7b8a9a; margin-top: 20px;">
        Ако имате въпроси или нужда от помощ, не се колебайте да се свържете с академичния отдел.
    </p>
@endsection
