@component('mail::message')
<h2>Здравей, {{ $student->user->first_name }}</h2>

<p>Успешно се регистрира за изпита:</p>
<ul>
    <li><strong>Дисциплина:</strong> {{ $exam->subject->subject_name }}</li>
    <li><strong>Дата:</strong> {{ \Carbon\Carbon::parse($exam->start_time)->toDateString() }}</li>
    <li><strong>Зала:</strong> {{ $exam->hall->name }}</li>
    <li><strong>Начален час:</strong> {{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }}</li>
</ul>

<p>Желаем ти успех!</p>
<@endcomponent>
