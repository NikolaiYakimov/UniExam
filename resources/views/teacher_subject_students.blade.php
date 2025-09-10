<!DOCTYPE html>
<html lang="bg">
@include('partials.head')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden">
@include('partials.header')

<div class="page-layout">
    @include('partials.sidebar')

    <main class="p-4 lg:p-6">
        <div class="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Управление на заверки</h1>
                    <p class="text-sm text-gray-500 mt-1">{{ $subject->subject_name }} - {{ $subject->description }}</p>
                </div>
                <a href="{{ route('teacher.subjects') }}" class="inline-flex items-center gap-1 px-4 py-2.5 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition-colors">
                    <i class="fa-solid fa-arrow-left"></i>
                    Назад към предмети
                </a>
            </div>
        </div>

        @include('partials.alerts')

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Списък със студенти</h2>

                @if($students->isEmpty())
                    <div class="text-center py-8">
                        <i class="fas fa-user-graduate text-3xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">Няма студенти, записани по този предмет.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                            <tr class="text-left border-b border-gray-200">
                                <th class="pb-3 font-medium text-gray-700">Факултетен номер</th>
                                <th class="pb-3 font-medium text-gray-700">Име на студент</th>
                                <th class="pb-3 font-medium text-gray-700">Специалност</th>
                                <th class="pb-3 font-medium text-gray-700">Заверка</th>
                                <th class="pb-3 font-medium text-gray-700">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $student)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-4 text-gray-700">{{ $student->faculty_number }}</td>
                                    <td class="py-4 text-gray-700">{{ $student->user->name }}</td>
                                    <td class="py-4 text-gray-700">{{ $student->specialty->name }}</td>
                                    <td class="py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $student->pivot->has_attestation ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $student->pivot->has_attestation ? 'Има заверка' : 'Няма заверка' }}
                                </span>
                                    </td>
                                    <td class="py-4">
                                        <button
                                            class="toggle-attestation px-3 py-1.5 rounded-lg text-white font-medium transition-colors duration-200 {{ $student->pivot->has_attestation ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }}"
                                            data-student-id="{{ $student->id }}"
                                            data-subject-id="{{ $subject->id }}"
                                            data-current-state="{{ $student->pivot->has_attestation ? 1 : 0 }}"
                                        >
                                            {{ $student->pivot->has_attestation ? 'Премахни заверка' : 'Добави заверка' }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Обработка на кликовете за превключване на заверки
        document.querySelectorAll('.toggle-attestation').forEach(button => {
            button.addEventListener('click', function() {
                const studentId = this.getAttribute('data-student-id');
                const subjectId = this.getAttribute('data-subject-id');
                const currentState = this.getAttribute('data-current-state');

                // Показване на индикатор за зареждане
                const originalText = this.textContent;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                this.disabled = true;

                // Изпращане на AJAX заявка
                fetch(`/teacher/subjects/${subjectId}/students/${studentId}/toggle-attestation`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Обновяване на състоянието на бутона и статуса
                            const newState = data.has_attestation;
                            this.setAttribute('data-current-state', newState ? '1' : '0');

                            // Промяна на текста и стила на бутона
                            this.textContent = newState ? 'Премахни заверка' : 'Добави заверка';
                            this.className = `toggle-attestation px-3 py-1.5 rounded-lg text-white font-medium transition-colors duration-200 ${newState ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700'}`;

                            // Обновяване на статуса в таблицата
                            const statusCell = this.closest('tr').querySelector('td:nth-child(4) span');
                            statusCell.textContent = newState ? 'Има заверка' : 'Няма заверка';
                            statusCell.className = `px-2.5 py-1 rounded-full text-xs font-medium ${newState ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`;

                            // Показване на съобщение за успех
                            alert('Статусът на заверката е променен успешно!');
                        } else {
                            alert('Възникна грешка при промяна на заверката.');
                        }
                    })
                    .catch(error => {
                        console.error('Грешка:', error);
                        alert('Възникна грешка при промяна на заверката.');
                    })
                    .finally(() => {
                        this.disabled = false;
                    });
            });
        });
    });
</script>

<script src="{{ asset('js/menuFunctions.js') }}" defer></script>
<script src="{{ asset('js/alertClosingFunctions.js')}}" defer></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>
</html>
