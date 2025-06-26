@component('mail::message')

    <h2>Здравей, {{ $student->user->first_name }}!</h2>

<p>Успешно се записа за ликвидационен изпит и плащането е прието.</p>

<p>Ето подробности за изпита:</p>
<ul>
    <li><strong>Дисциплина:</strong> {{ $exam->subject->subject_name }}</li>
    <li><strong>Дата:</strong> {{ \Carbon\Carbon::parse($exam->start_time)->toDateString() }}</li>
    <li><strong>Зала:</strong> {{ $exam->hall->name }}</li>
    <li><strong>Начален час:</strong> {{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }}</li>
</ul>

<p><strong>Платена сума:</strong> {{ $exam->subject->price }} лв.</p>

<p>Благодарим ти, че използва нашата система!</p>
<p>Желаем ти успех на изпита!</p>

<hr>
<p style="font-size: 0.9em; color: gray;">
    Това съобщение е автоматично генерирано. Моля, не отговаряй на него.
</p>
@endcomponent
