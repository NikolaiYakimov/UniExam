@component('mail::message')


    Дисциплина: {{ $exam->subject->subject_name }}

    Дата: {{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y') }}

    Час: {{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }}

    Зала: {{ $exam->hall->name }}

    @component('mail::button', ['url' => route('exams')])
        Виж детайли за изпита
    @endcomponent

    Благодарим, че използвате нашата система!<br>
    {{ config('app.name') }}
    <hr>
    <p style="font-size: 0.9em; color: gray;">
        Това съобщение е автоматично генерирано. Моля, не отговаряй на него.
    </p>
@endcomponent
