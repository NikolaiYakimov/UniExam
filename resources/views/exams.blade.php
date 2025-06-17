
<!DOCTYPE html>
<html lang="bg">

{{--Head--}}
@include('partials.head')

<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden">
<!-- Student information sidebar with toggle button -->
@include('partials.sidebar')

<!-- Основно съдържание -->

<div class="ml-0 lg:ml-80 p-4 lg:p-8 transition-all duration-300">

    <!-- Хедър -->
    @include('partials.header',[
             'title'=>"Достъпни изпити",
             'subtitle'=>'Преглед и записване за предстоящи изпити',
             'button'=>[
                        'route'=>route('my_exams'),
                        'text'=>'Моите изпити',
                        'icon' =>'fas fa-list-alt'
                       ]
            ])

    <!-- Основен content -->

    <main>
        {{--Alerts--}}

       @include('partials.alerts')

        @if($exams->isEmpty())
            <div class="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
                <i class="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700 mb-2">Няма налични изпити</h3>
                <p class="text-gray-500">В момента няма изпити за записване. Моля, проверете по-късно.</p>
            </div>
        @else
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
                @foreach ($exams as $exam)
                    <div class="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px]">
                        <div class="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">
                            <h2 class="text-lg font-semibold text-gray-900 leading-tight">
                                {{ $exam->subject->subject_name }}
                            </h2>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    {{ $exam->exam_type }}
                                </span>
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $exam->remainingSlots() > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $exam->remainingSlots() > 0 ? $exam->remainingSlots().' Свободни места' : 'Няма места' }}
                                </span>
                            </div>
                        </div>

                        <div class="space-y-3 mb-5">
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
                                <span>Преподавател: <span class="font-medium text-gray-800">{{ $exam->teacher->user->first_name }} {{ $exam->teacher->user->last_name }}</span></span>
                            </div>
                            < <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-calendar-alt w-5 text-gray-400"></i>
                                <span>Дата: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y ') }}</span></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-calendar-alt w-5 text-gray-400"></i>
                                <span>Продължителност: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format(' H:i') }} - {{ \Carbon\Carbon::parse($exam->end_time)->format(' H:i') }}</span></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-university w-5 text-gray-400"></i>
                                <span>Зала: <span class="font-medium text-gray-800">{{ $exam->hall->name }}</span></span>
                            </div>
                        </div>
                        @if($exam->exam_type === 'ликвидация')
                        <button type="button"
                                class="w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 bg-purple-600 hover:bg-purple-700 payment-btn"
                                data-exam-id="{{ $exam->id }}"
                                data-subject="{{ $exam->subject->subject_name }}"
                                data-price="{{ $exam->price }}">
                            <i class="fas fa-credit-card mr-2"></i> Регистрирай се и плати
                        </button>
                        @else
                            <form method="POST" action="{{ route('student.exam.register', $exam) }}">
                            @csrf
                            <button type="submit"
                                    class="w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200
                                {{ $exam->remainingSlots() <= 0 ? 'bg-gray-300 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' }}"
                                {{ $exam->remainingSlots() <= 0 ? 'disabled' : '' }}>
                                <i class="fas fa-edit mr-2"></i> Запиши се
                            </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </main>
</div>
<div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-semibold">Плащане за изпит</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-2">Предмет: <span id="modalSubject" class="font-medium"></span></p>
                <p class="mb-4">Сума за плащане: <span id="modalPrice" class="font-bold text-blue-600"></span> лв.</p>

                <!-- Форма за плащане -->
                <form id="paymentForm" method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Име на картата</label>
                        <input type="text" class="form-input w-full rounded-md border-gray-300 shadow-sm" placeholder="John Doe" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Номер на карта</label>
                        <input type="text" class="form-input w-full rounded-md border-gray-300 shadow-sm" placeholder="4242 4242 4242 4242" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Валидност</label>
                            <input type="text" class="form-input w-full rounded-md border-gray-300 shadow-sm" placeholder="MM/ГГ" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                            <input type="text" class="form-input w-full rounded-md border-gray-300 shadow-sm" placeholder="123" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отказ</button>
                <button type="submit" form="paymentForm" class="btn btn-primary bg-blue-600 hover:bg-blue-700">
                    <i class="fas fa-lock mr-2"></i>Плати сега
                </button>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/menuFunctions.js')}}" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentButtons = document.querySelectorAll('.payment-btn');
        const paymentModal = document.getElementById('paymentModal');

        paymentButtons.forEach(button => {
            button.addEventListener('click', function() {
                const subject = this.dataset.subject;
                const price = this.dataset.price;
                const examId = this.dataset.examId;

                document.getElementById('modalSubject').textContent = subject;
                document.getElementById('modalPrice').textContent = price;

                const paymentForm = document.getElementById('paymentForm');
                paymentForm.action = paymentForm.action.replace(':examId', examId);

                // Показване на модала с чист JavaScript
                paymentModal.classList.remove('hidden');
            });
        });

        // Добавете функционалност за затваряне
        // document.getElementById('closeModal').addEventListener('click', function() {
        //     paymentModal.classList.add('hidden');
        // });
    });
</script>
</body>
<style>
    @media (max-width: 1023px) {
        #sidebar {
            width: 288px;
            left: -288px;
            box-shadow: 8px 0 15px -3px rgba(0, 0, 0, 0.1);
        }
        #menuContainer {
            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            left: 1rem;
        }
        header {
            margin-top: 5.5rem; /* Оптимизирано отместване за мобилен режим */
        }
    }
</style>
</html>
