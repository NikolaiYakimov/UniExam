<h2>Здравей, {{ $student->user->first_name }}</h2>

<p>Успешно се регистрира за изпита:</p>
<ul>
    <li><strong>Предмет:</strong> {{ $exam->subject->subject_name }}</li>
    <li><strong>Дата:</strong> {{ $exam->start_time }}</li>
    <li><strong>Зала:</strong> {{ $exam->hall->name }}</li>
</ul>

<p>Желаем ти успех!</p>
