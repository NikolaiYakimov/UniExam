    <!DOCTYPE html>
<html lang="bg">
@include('partials.head')
{{--<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}

<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden" x-data="{ showModal: false }">
@include('partials.sidebar')

<div class="ml-0 lg:ml-80 p-4 lg:p-8 transition-all duration-300">
    @include('partials.header',[
        'title'=>"Управление на изпити",
        'subtitle'=>'Преглед на предстоящи изпити и възможност за добавяне',
        'button'=>[
            'route'=>route('conducted_exams'),
            'text'=>' Изминали изпити',
            'icon' =>'fa-duotone fa-solid fa-folder-open'
        ]
    ])

    <main>
        @include('partials.alerts')



        @if($exams->isEmpty())
            <div class="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
                <i class="fas fa-calendar-plus text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700 mb-2">Няма създадени изпити</h3>
                <button @click="showModal = true" class="mt-4 bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition-colors">
                    Нов изпит
                </button>
            </div>
        @else
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
                @foreach($exams as $exam)
                    <div class="flex flex-col bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px] ">
                        <div class="flex justify-between items-start gap-2 mb-3">
                            <h2 class="text-lg font-semibold text-gray-900">
                                {{ $exam->subject->subject_name }}
                                <span class="block text-sm font-normal text-gray-500 mt-1">
                                    {{ $exam->subject->description }}
                                </span>
                            </h2>
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                {{ $exam->exam_type }}
                            </span>
                        </div>

                        <div class="space-y-3 mb-5">
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-calendar-alt w-5 text-gray-400"></i>
                                <span>Дата: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y') }}</span></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-clock w-5 text-gray-400"></i>
                                <span>Час: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($exam->end_time)->format('H:i') }}</span></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-university w-5 text-gray-400"></i>
                                <span>Зала: <span class="font-medium text-gray-800">{{ $exam->hall->name }}</span></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-users w-5 text-gray-400"></i>
                                <span class="font-medium {{ $exam->remainingSlots() > 0 ? 'text-green-700' : 'text-red-700' }}">
                                    {{ $exam->remainingSlots() }}/{{ $exam->max_students }} места
                                </span>
                            </div>
                        </div>
{{--                        <form method="POST" action="{{ route('student.exam.register', $exam) }} "  class ="mt-auto">--}}
{{--                            @csrf--}}
{{--                            <button type="submit"--}}
{{--                                    data-exam-date="{{ $exam->start_time }}"--}}
{{--                                    class="edit-exam-btn w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 bg-blue-600 hover:bg-blue-700">--}}
{{--                                <i class="fa-solid fa-file-pen"></i> Редактирай изпит--}}
{{--                            </button>--}}
{{--                        </form>--}}

{{--                        <button @click=" showModal=true; openEditModal(@json($exam->id))"--}}
                        <button @click="openEditModal({{$exam->id}});showModal=true "
                                class=" mt-auto edit-exam-btn w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 bg-blue-600 hover:bg-blue-700"
                                data-exam-date="{{$exam->start_time}}">
                            <i class="fa-solid fa-file-pen"></i> Редактирай изпит
                        </button>

                    </div>
                @endforeach

                <div class="flex items-center justify-center">
                    <button @click=" resetExamForm(); showModal = true" class="w-16 h-16 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white shadow-xl flex items-center justify-center transition-all duration-300 hover:rotate-90">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </button>
                </div>
        @endif
    </main>
</div>

<!-- Create Exam Modal -->
<div x-cloak x-show="showModal " x-transition.opacity class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 mx-4" @click.outside="showModal = false">
        <h3 class="text-xl font-bold text-gray-900 mb-4" id="modalTitle">Създаване на нов изпит</h3>

        <form method="POST" action="{{ route('exams.store') }}" id="examForm">
            @csrf
            <div class="space-y-4">
                <div>
                    <input type="hidden" name="_method" id="formMethod" value="POST">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Дисциплина</label>
                    <select name="subject_id" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->subject_name }} (Сем. {{ $subject->semester }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Тип изпит</label>
                        <select name="exam_type" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">
                            <option value="редовен">Редовен</option>
                            <option value="поправителен">Поправителен</option>
                            <option value="ликвидация">Ликвидация</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Макс. студенти</label>
                        <input type="number" name="max_students" required min="1" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Изпитна зала</label>
                    <select name="hall_id" id="hall_id" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">
                        @foreach($halls as $hall)
                            <option value="{{ $hall->id }}">{{ $hall->name }} ({{ $hall->capacity }} места)</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Дата</label>
                    <input type="date" id="exam_date" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Изберете свободни часове</label>
                    <div class="mt-2">
                        <h4 class="text-center font-medium mb-2">Стая <span id="selected_room">---</span></h4>
                        <div id="time_slots_grid" class="grid grid-cols-3 gap-2">
                            <!-- Time slots will be generated here -->
                            <div id="loadingIndicator" class="text-center py-4 hidden">
                                <i class="fas fa-spinner fa-spin text-blue-500"></i>
                                <span class="ml-2 text-gray-600">Зареждане на слотове...</span>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="start_time" id="start_time" required>
                <input type="hidden" name="end_time" id="end_time" required>

                <div id="formErrors" class="text-red-600 font-medium hidden"></div>

                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" @click="showModal = false" class="px-5 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors">
                        Отказ
                    </button>
                    <button type="submit" id="submitBtn" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                        Създай
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('js/menuFunctions.js') }}" defer></script>
<script src="{{ asset('js/alertClosingFunctions.js')}}" defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Define and initialize  DOM elements
        const hallSelect = document.getElementById('hall_id');
        const dateInput = document.getElementById('exam_date');
        const timeGrid = document.getElementById('time_slots_grid');
        const selectedRoomDisplay = document.getElementById('selected_room');
        const startTimeInput = document.getElementById('start_time');
        const endTimeInput = document.getElementById('end_time');
        const examForm = document.getElementById('examForm');
        const formErrors = document.getElementById('formErrors');
        const modalSubmitButton = document.getElementById('submitBtn');
        const formMethod = document.getElementById('formMethod');
        const loadingIndicator = document.getElementById('loadingIndicator');


        let selectedSlots = [];
        let bookedSlots = [];

        // Инициализация на основни стойности
        const today = new Date();
        dateInput.value = today.toISOString().split('T')[0];
        // updateRoomDisplay();

        // Обработчик за подаване на формата
        examForm.addEventListener('submit', function(e) {
            if (!startTimeInput.value || !endTimeInput.value) {
                e.preventDefault();
                showFormError('Моля, изберете период за изпита от времевата мрежа.');
                return false;
            }

            if (selectedSlots.length === 0) {
                e.preventDefault();
                showFormError('Моля, изберете поне един времеви слот.');
                return false;
            }

            return true;
        });

        // Event Listeners
        hallSelect.addEventListener('change', function() {
            updateRoomDisplay();
                fetchBookedSlots();

        });

        dateInput.addEventListener('change', function() {

                generateTimeSlots();
                fetchBookedSlots();

        });

        // Помощни функции
        function showFormError(message) {
            formErrors.textContent = message;
            formErrors.classList.remove('hidden');
            setTimeout(() => {
                formErrors.classList.add('hidden');
            }, 5000);
        }

        function updateRoomDisplay() {
            if (hallSelect.selectedIndex >= 0) {
                const selectedRoom = hallSelect.options[hallSelect.selectedIndex].text;
                selectedRoomDisplay.textContent = selectedRoom;
            }
        }

        function isPastDate(dateString) {
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            return new Date(dateString) < today;
        }

        function isWithin48Hours(examDate) {
            const now = new Date();
            const hourDifference = Math.abs(examDate - now) / (1000 * 60 * 60);
            return hourDifference < 48;
        }

        function isValidDate(date, time = '00:00') {
            const examDate = new Date(`${date}T${time}`);
            return !isPastDate(date) && !isWithin48Hours(examDate);
        }

        function calculateExamDuration(slots) {
            return (slots.length * 45) + (Math.max(slots.length - 1, 0) * 15);
        }

        function generateTimeSlots() {
            if (!timeGrid) return;

            timeGrid.innerHTML = '';
            const selectedDate = dateInput.value;
            const timeSlots = [
                '07:00', '08:00', '09:00', '10:00', '11:00', '12:00',
                '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'
            ];

            let hasValidSlot = false;

            timeSlots.forEach(time => {
                const slot = document.createElement('button');
                slot.type = 'button';
                slot.className = 'time-slot py-3 rounded-lg text-white font-medium bg-green-500 hover:bg-green-600 transition-colors';
                slot.dataset.time = time;
                slot.textContent = time;

                if (!isValidDate(selectedDate, time)) {
                    slot.disabled = true;
                    slot.classList.replace('bg-green-500', 'bg-gray-300');
                    slot.classList.add('cursor-not-allowed')
                    slot.classList.remove('hover:bg-green-600');
                    slot.title = "Моля, изберете валидни дата и час за изпита.";
                } else {
                    hasValidSlot = true;
                    slot.addEventListener('click', () => selectTimeSlot(slot));
                }

                timeGrid.appendChild(slot);
            });

            updateFormState(hasValidSlot);
            checkBookedSlots();
        }

        function updateFormState(hasValidSlot) {
            if (!formErrors || !modalSubmitButton) return;

            if (hasValidSlot) {
                formErrors.classList.add('hidden');
                modalSubmitButton.disabled = false;
                modalSubmitButton.classList.remove('bg-gray-300');
                modalSubmitButton.classList.add('bg-blue-600', 'hover:bg-blue-700');
            } else {
                formErrors.textContent = "Не може да създавате изпити за минали дати или по-малко от 48 часа от сега.";
                formErrors.classList.remove('hidden');
                modalSubmitButton.disabled = true;
                modalSubmitButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');
                modalSubmitButton.classList.add('bg-gray-300');
            }
        }

        // Функция за избор на слот
        function selectTimeSlot(slot) {
            if (slot.disabled) return;

            const timeValue = slot.dataset.time;
            const allSlots = Array.from(document.querySelectorAll('.time-slot:not([disabled])'))
                .map(s => s.dataset.time)
                .sort();

            const currentIndex = allSlots.indexOf(timeValue);

            if (selectedSlots.includes(timeValue)) {
                const index = selectedSlots.indexOf(timeValue);
                selectedSlots = selectedSlots.slice(0, index);
            } else {
                if (selectedSlots.length === 0) {
                    selectedSlots.push(timeValue);
                } else {
                    const lastSlot = selectedSlots[selectedSlots.length - 1];
                    const lastIndex = allSlots.indexOf(lastSlot);

                    if (currentIndex === lastIndex + 1) {
                        selectedSlots.push(timeValue);
                    } else {
                        selectedSlots = [timeValue];
                    }
                }
            }

            updateSelectedSlots();
        }

        function updateSelectedSlots() {
            document.querySelectorAll('.time-slot').forEach(slot => {
                if (!slot.disabled) {
                    if (selectedSlots.includes(slot.dataset.time)) {
                        slot.classList.replace('bg-green-500', 'bg-blue-500');
                    } else {
                        slot.classList.replace('bg-blue-500', 'bg-green-500');
                    }
                }
            });

            if (selectedSlots.length > 0) {
                const selectedDate = dateInput.value;
                const firstSlot = selectedSlots[0];
                const totalMinutes = calculateExamDuration(selectedSlots);

                const startDateTime = new Date(`${selectedDate}T${firstSlot}:00`);
                const endDateTime = new Date(startDateTime.getTime() + totalMinutes * 60000);

                startTimeInput.value = formatDateTime(startDateTime);
                endTimeInput.value = formatDateTime(endDateTime);
            } else {
                startTimeInput.value = '';
                endTimeInput.value = '';
            }
        }

        function formatDateTime(date) {
            return [
                date.getFullYear(),
                String(date.getMonth() + 1).padStart(2, '0'),
                String(date.getDate()).padStart(2, '0')
            ].join('-') + ' ' + [
                String(date.getHours()).padStart(2, '0'),
                String(date.getMinutes()).padStart(2, '0'),
                '00'
            ].join(':');
        }

        // Функция за зареждане на заетите слотове
        async function fetchBookedSlots(excludeExamId=null) {
            const selectedDate = dateInput.value;
            const selectedHallId = hallSelect.value;

            if (!selectedDate || !selectedHallId) return;

            // Показване на индикатор за зареждане
            if (loadingIndicator) loadingIndicator.classList.remove('hidden');

            try {

                const url = `{{ route('exams.booked-slots') }}?date=${encodeURIComponent(selectedDate)}&hall_id=${encodeURIComponent(selectedHallId)}${excludeExamId ? `&exclude_exam_id=${excludeExamId}`:''}`;

                const response = await fetch(url);

                if (!response.ok) throw new Error('Грешка при зареждане');

                const data = await response.json();
                bookedSlots = data.bookedSlots || [];
                checkBookedSlots();
            } catch (error) {
                console.error('Грешка при зареждане на заетите слотове:', error);
                showFormError('Възникна проблем при зареждането на заетите часове');
            } finally {
                if (loadingIndicator) loadingIndicator.classList.add('hidden');
            }
        }

        function checkBookedSlots() {
            const selectedDate = dateInput.value;

            document.querySelectorAll('.time-slot').forEach(slot => {
                if (!slot.disabled) {
                    slot.classList.replace('bg-red-500', 'bg-green-500');
                    slot.disabled = false;
                }
            });

            if (!Array.isArray(bookedSlots)) return;

            bookedSlots.forEach(booking => {
                try {
                    if (!booking.start || !booking.end) return;

                    const bookingDate = booking.start.split('T')[0];
                    if (bookingDate !== selectedDate) return;

                    const startTime = booking.start.split('T')[1].substring(0, 5);
                    const endTime = booking.end.split('T')[1].substring(0, 5);

                    document.querySelectorAll('.time-slot').forEach(slot => {
                        const slotTime = slot.dataset.time;
                        if (slotTime >= startTime && slotTime < endTime) {
                            slot.classList.replace('bg-green-500', 'bg-red-500');
                            slot.disabled = true;
                        }
                    });
                } catch (error) {
                    console.error('Грешка при обработка на слот:', error);
                }
            });

            updateSelectedSlots();
        }

        // Функции за управление на модала
        window.resetExamForm = function() {
            document.getElementById('modalTitle').textContent = 'Създаване на нов изпит';
            document.getElementById('submitBtn').textContent="Създай";

            examForm.action = "{{ route('exams.store') }}";
            formMethod.value = 'POST';
            examForm.reset();

            document.querySelector('[name="subject_id"]').disabled = false;
            document.querySelector('[name="exam_type"]').disabled = false;

            // Задаване на днешна дата
            dateInput.value = today.toISOString().split('T')[0];
            updateRoomDisplay();

            selectedSlots = [];
            generateTimeSlots();
            fetchBookedSlots();
        };

        window.openEditModal = function(examId) {
            document.getElementById('modalTitle').textContent = 'Редактиране на изпит';
            document.getElementById('submitBtn').textContent="Редактирай";
            const baseUrl = "{{ route('exams.update', ['examId' => ':idExam']) }}";

            examForm.action = baseUrl.replace(':idExam',examId);
            formMethod.value = 'PUT';

            fetch(`/teacher/exam/${examId}/edit-data`)
                .then(res => res.json())
                .then(data => {
                    console.log(data)
                    document.querySelector('[name="subject_id"]').value = data.subject_id;
                    document.querySelector('[name="exam_type"]').value = data.exam_type;
                    document.querySelector('[name="max_students"]').value = data.max_students;
                    document.querySelector('[name="hall_id"]').value = data.hall_id;
                    dateInput.value = data.start_time.substring(0, 10);

                    document.querySelector('[name="subject_id"]').readonly = true;
                    document.querySelector('[name="exam_type"]').readonly = true;

                    updateRoomDisplay();
                    generateTimeSlots();
                    fetchBookedSlots(examId);
                })
                .catch(error => {
                    console.error('Грешка при зареждане на данните за изпит:', error);
                    showFormError('Грешка при зареждане на данните за изпит');
                });
        };

        // Деактивиране на бутони за редактиране на изпити, които започват след по-малко от 48 часа
        document.querySelectorAll('.edit-exam-btn').forEach(button => {
            const examDateString = button.getAttribute('data-exam-date');
            const examDate = new Date(examDateString);
            const hoursDifference = (examDate - new Date()) / (1000 * 60 * 60);

            if (hoursDifference < 48) {
                button.disabled = true;
                button.classList.replace('bg-blue-600', 'bg-gray-300');
                button.classList.add('cursor-not-allowed');
                button.classList.remove('hover:bg-blue-700');
            }
        });
    });
</script>
{{--<script>--}}
{{--document.addEventListener('DOMContentLoaded',function (){--}}
{{--   const editButtons=document.querySelectorAll('.edit-exam-btn');--}}
{{--   const currentDate=new Date();--}}

{{--   editButtons.forEach(button=>{--}}
{{--       const examDateString=button.getAttribute('data-exam-date');--}}
{{--       const examDate=new Date(examDateString);--}}

{{--       const examDifference=(examDate-currentDate)/(1000*60*60);--}}
{{--       if(examDifference<48){--}}
{{--           button.disabled=true;--}}
{{--           button.classList.remove('bg-blue-600', 'hover:bg-blue-700');--}}
{{--           button.classList.add('bg-gray-300', 'cursor-not-allowed');--}}
{{--       }--}}
{{--   })--}}

{{--});--}}
{{--</script>--}}
{{--<script>--}}
{{--    let selectedSlots=[]--}}
{{--    function resetExamForm(){--}}
{{--        document.getElementById('modalTitle').textContent='Създаване на нов изпит';--}}

{{--        document.getElementById('examForm').action="{{route('exams.store')}}"--}}
{{--        document.getElementById('formMethod').value='POST';--}}

{{--        document.getElementById('examForm').reset();--}}

{{--        document.querySelector('[name="subject_id"]').disabled=false;--}}
{{--        document.querySelector('[name="exam_type"]').disabled=false;--}}
{{--        const today=new Date().toISOString().split('T')[0];--}}
{{--        document.getElementById('exam_date').value=today;--}}

{{--        selectedSlots=[];--}}
{{--        generateTimeSlots();--}}
{{--        fetchBookedSlots();--}}
{{--    }--}}

{{--    function openEditModal(examId){--}}
{{--        try {--}}
{{--            fetch(`/teacher/exam/${examId}/edit-data`)--}}
{{--                .then(res => {--}}
{{--                if (!res.ok) {--}}
{{--                    throw new Error('Грешка при зареждане на данни.');--}}
{{--                }--}}
{{--                return res.json();--}}
{{--            })--}}
{{--                .then(data=>{--}}
{{--                    console.log(data)--}}
{{--                    document.querySelector('[name="subject_id"]').value=data.subject_id;--}}
{{--                    document.querySelector('[name="exam_type"]').value=data.exam_type;--}}
{{--                    document.querySelector('[name="max_students"]').value=data.max_students;--}}
{{--                    document.querySelector('[name="hall_id"]').value=data.hall_id--}}

{{--                    document.querySelector('[name="subject_id"]').disabled=true;--}}
{{--                    document.querySelector('[name="exam_type"]').disabled=true;--}}


{{--                    Alpine.store('showModal', true);--}}
{{--                });--}}
{{--        }catch (е){--}}
{{--            console.error(e)--}}
{{--        }--}}
{{--    }--}}
{{--</script>--}}
{{--<script>--}}
{{--document.addEventListener('DOMContentLoaded', function() {--}}
{{--    const hallSelect = document.getElementById('hall_id');--}}
{{--    const dateInput = document.getElementById('exam_date');--}}
{{--    const timeGrid = document.getElementById('time_slots_grid');--}}
{{--    const selectedRoomDisplay = document.getElementById('selected_room');--}}
{{--    const startTimeInput = document.getElementById('start_time');--}}
{{--    const endTimeInput = document.getElementById('end_time');--}}
{{--    const examForm = document.getElementById('examForm');--}}
{{--    const formErrors = document.getElementById('formErrors');--}}
{{--    const modalSubmitButton=document.getElementById('submitBtn');--}}
{{--    const formMethod=document.getElementById('formMethod');--}}

{{--    let selectedSlots = [];--}}
{{--    let bookedSlots = []--}}


{{--    const today = new Date();--}}
{{--    dateInput.value = today.toISOString().split('T')[0];--}}
{{--    updateRoomDisplay();--}}


{{--    // Form submission handling--}}
{{--    examForm.addEventListener('submit', function(e) {--}}
{{--        // Check if start and end time are set--}}
{{--        if (!startTimeInput.value || !endTimeInput.value) {--}}
{{--            e.preventDefault();--}}
{{--            alert('Моля, изберете период за изпита от времевата мрежа.');--}}
{{--            return false;--}}
{{--        }--}}

{{--        // Check if at least one time slot is selected--}}
{{--        if (selectedSlots.length === 0) {--}}
{{--            e.preventDefault();--}}
{{--            alert('Моля, изберете поне един времеви слот.');--}}
{{--            return false;--}}
{{--        }--}}

{{--        return true;--}}
{{--    });--}}

{{--    // Initialize time slots when page loads and fetch the bookedSlots--}}
{{--    // updateRoomDisplay();--}}
{{--    generateTimeSlots();--}}

{{--    // setTimeout(fetchBookedSlots, 300);--}}

{{--    // Re-fetch booked slots when tab becomes visible again--}}
{{--    // document.addEventListener('visibilitychange', function() {--}}
{{--    //     if (document.visibilityState === 'visible') {--}}
{{--    //         console.log('Tab became visible, refreshing booked slots');--}}
{{--    //         fetchBookedSlots();--}}
{{--    //     }--}}
{{--    // });--}}


{{--    // Update time slots when room or date changes--}}
{{--    hallSelect.addEventListener('change', function() {--}}
{{--        console.log('Hall changed, fetching new booked slots');--}}
{{--        updateRoomDisplay();--}}
{{--        fetchBookedSlots();--}}
{{--    });--}}

{{--    dateInput.addEventListener('change', function() {--}}
{{--        console.log('Date changed to:', dateInput.value, 'fetching new booked slots');--}}
{{--        generateTimeSlots();--}}
{{--        fetchBookedSlots();--}}

{{--        // selectedSlots=[];--}}
{{--        // formErrors.classList.add('hidden');--}}
{{--        // document.getElementById('submitBtn').disabled=false;--}}
{{--    });--}}

{{--    // When the modal opens, refresh the booked slots--}}
{{--    if (typeof Alpine !== 'undefined') {--}}
{{--        document.addEventListener('alpine:initialized', function() {--}}
{{--            document.querySelectorAll('[x-data]').forEach(el => {--}}
{{--                if (el.getAttribute('x-data').includes('showModal')) {--}}
{{--                    el.__x.$watch('showModal', value => {--}}
{{--                        if (value === true) {--}}
{{--                            console.log('Modal opened, refreshing booked slots');--}}
{{--                            setTimeout(fetchBookedSlots, 100); // Small delay to ensure DOM is ready--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    }--}}

{{--    function isPastDate(dateString){--}}

{{--        const today= new Date();--}}
{{--        today.setHours(0,0,0,0);--}}
{{--        return new Date(dateString)<today;--}}
{{--    }--}}

{{--    function isWithin48Hours(examDate){--}}
{{--        const now=new Date();--}}
{{--        const hourDifference=Math.abs(examDate-now)/(1000*60*60);--}}
{{--        return hourDifference<48;--}}

{{--    }--}}
{{--    function  isValidDate(date,time='00:00'){--}}
{{--        const examDate=new Date(`${date}T${time}`);--}}
{{--        return !isPastDate(date)&&!isWithin48Hours(examDate);--}}

{{--    }--}}
{{--    function calculateExamDuration(slots){--}}
{{--        return (slots.length*45) + (Math.max(slots.length-1,0)*15);--}}
{{--    }--}}

{{--    function updateRoomDisplay() {--}}
{{--        const selectedRoom = hallSelect.options[hallSelect.selectedIndex].text;--}}
{{--        selectedRoomDisplay.textContent = selectedRoom;--}}
{{--    }--}}

{{--    function  fetchBookedSlots() {--}}
{{--        const selectedDate = dateInput.value;--}}
{{--        const selectedHallId = hallSelect.value;--}}

{{--        console.log(`Fetching booked slots for date=${selectedDate}, hall_id=${selectedHallId}`);--}}

{{--        if (!selectedDate || !selectedHallId) {--}}
{{--            console.warn('Missing date or hall_id, cannot fetch booked slots');--}}
{{--            return;--}}
{{--        }--}}

{{--        // Show loading state--}}
{{--        document.querySelectorAll('.time-slot').forEach(slot => {--}}
{{--            slot.classList.add('opacity-50');--}}
{{--        });--}}

{{--        // Clear selected slots when date/room changes--}}
{{--        selectedSlots = [];--}}
{{--        startTimeInput.value = '';--}}
{{--        endTimeInput.value = '';--}}

{{--        // Construct the URL with the query parameters--}}
{{--        const url = `{{ route('exams.booked-slots') }}?date=${encodeURIComponent(selectedDate)}&hall_id=${encodeURIComponent(selectedHallId)}`;--}}
{{--        console.log('Fetching from URL:', url);--}}

{{--        // Fetch booked slots from the server for this specific date and hall--}}
{{--        fetch(url)--}}
{{--            .then(response => {--}}
{{--                if (!response.ok) {--}}
{{--                    console.error('Server responded with error:', response.status);--}}
{{--                    throw new Error('Failed to fetch booked slots');--}}
{{--                }--}}
{{--                return response.json();--}}
{{--            })--}}
{{--            .then(data => {--}}
{{--                console.log('Fetched booked slots:', data.bookedSlots);--}}
{{--                bookedSlots = data.bookedSlots;--}}
{{--                checkBookedSlots();--}}

{{--                // Remove loading state--}}
{{--                document.querySelectorAll('.time-slot').forEach(slot => {--}}
{{--                    slot.classList.remove('opacity-50');--}}
{{--                });--}}
{{--            })--}}
{{--            .catch(error => {--}}
{{--                console.error('Error fetching booked slots:', error);--}}

{{--                // Remove loading state--}}
{{--                document.querySelectorAll('.time-slot').forEach(slot => {--}}
{{--                    slot.classList.remove('opacity-50');--}}
{{--                });--}}

{{--                // Show error message--}}
{{--                alert('Грешка при зареждане на заетите часове. Моля, опитайте отново.');--}}
{{--            });--}}
{{--    }--}}

{{--    function checkBookedSlots() {--}}
{{--        const selectedDate = dateInput.value;--}}

{{--        console.log('Checking booked slots for date:', selectedDate);--}}
{{--        console.log('Total booked slots in memory:', bookedSlots.length);--}}

{{--        // Reset all slots to available--}}
{{--        document.querySelectorAll('.time-slot').forEach(slot => {--}}
{{--            if(!slot.disabled) {--}}
{{--                slot.classList.remove('bg-red-500', 'bg-green-500', 'bg-blue-500');--}}
{{--                slot.classList.add('bg-green-500');--}}
{{--                slot.disabled = false;--}}
{{--            }--}}
{{--        });--}}

{{--        // Mark booked slots as unavailable--}}
{{--        let bookedCount = 0;--}}

{{--        if (!Array.isArray(bookedSlots)) {--}}
{{--            console.error('bookedSlots is not an array:', bookedSlots);--}}
{{--            return;--}}
{{--        }--}}
{{--        console.log(bookedCount)--}}
{{--        bookedSlots.forEach(booking => {--}}
{{--            try {--}}
{{--                if (!booking.start || !booking.end) {--}}
{{--                    console.warn('Invalid booking data:', booking);--}}
{{--                    return;--}}
{{--                }--}}

{{--                const bookingDate = booking.start.split('T')[0];--}}

{{--                if (bookingDate === selectedDate) {--}}
{{--                    const startTime = booking.start.split('T')[1].substring(0, 5);--}}
{{--                    const endTime = booking.end.split('T')[1].substring(0, 5);--}}

{{--                    console.log(`Found booked slot for current date: ${startTime} to ${endTime}`);--}}
{{--                    bookedCount++;--}}

{{--                    document.querySelectorAll('.time-slot').forEach(slot => {--}}
{{--                        // if(slot.disabled) return;--}}
{{--                        const slotTime = slot.dataset.time;--}}

{{--                        // If slot time is between start and end of booking--}}
{{--                        if (slotTime >= startTime && slotTime < endTime) {--}}
{{--                            slot.classList.remove('bg-green-500', 'hover:bg-green-600','transition-colors','bg-gray-300');--}}
{{--                            slot.classList.add('bg-red-500','cursor-not-allowed');--}}
{{--                            slot.disabled = true;--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--            } catch (error) {--}}
{{--                console.error('Error processing booking:', booking, error);--}}
{{--            }--}}
{{--        });--}}

{{--        console.log(`Marked ${bookedCount} slots as booked for date ${selectedDate}`);--}}

{{--        // Update selected slots--}}
{{--        updateSelectedSlots();--}}
{{--    }--}}

{{--    function generateTimeSlots() {--}}
{{--        timeGrid.innerHTML = '';--}}
{{--        const selectedDate=dateInput.value;--}}

{{--        const timeSlots = [--}}
{{--            // Row 1--}}
{{--            '07:00', '08:00', '09:00',--}}
{{--            // Row 2--}}
{{--            '10:00', '11:00', '12:00',--}}
{{--            // Row 3--}}
{{--            '13:00', '14:00','15:00',--}}
{{--            //Row 4--}}
{{--            '16:00', '17:00', '18:00',--}}

{{--        ];--}}
{{--        let hasValidSlot=false;--}}
{{--        // Add all time slots to the grid--}}
{{--        timeSlots.forEach(time => {--}}
{{--            const slot = document.createElement('button');--}}
{{--            slot.type = 'button';--}}
{{--            slot.className = 'time-slot py-3 rounded-lg text-white font-medium bg-green-500 hover:bg-green-600 transition-colors';--}}
{{--            slot.dataset.time = time;--}}
{{--            slot.textContent = time;--}}

{{--            if(!isValidDate(selectedDate,time)){--}}

{{--                slot.disabled = true;--}}
{{--                slot.classList.remove('bg-green-500', 'hover:bg-green-600', 'transition-colors');--}}
{{--                slot.classList.add('bg-gray-300', 'cursor-not-allowed');--}}
{{--                slot.title = "Моля, изберете валидни дата и час за изпита. Те трябва да бъдат поне 48 часа след настоящия момент.";--}}
{{--                // formErrors.textContent="Не може да създавате изпити за минали дати или по-малко от 48 часа от сега."--}}
{{--                // formErrors.classList.remove('hidden');--}}
{{--            }--}}
{{--            else{--}}
{{--                hasValidSlot=true;--}}
{{--            }--}}

{{--            slot.addEventListener('click', function() {--}}
{{--                if (!slot.disabled) {--}}
{{--                    selectTimeSlot(slot);--}}
{{--                }--}}
{{--            });--}}

{{--            timeGrid.appendChild(slot);--}}
{{--        });--}}
{{--        if(hasValidSlot){--}}
{{--            formErrors.classList.add('hidden');--}}
{{--            modalSubmitButton.disabled=false;--}}
{{--            modalSubmitButton.classList.remove('bg-gray-300');--}}
{{--            modalSubmitButton.classList.add('hover:bg-blue-700','bg-blue-600');--}}
{{--        } else{--}}

{{--            formErrors.textContent="Не може да създавате изпити за минали дати или по-малко от 48 часа от сега."--}}
{{--            formErrors.classList.remove('hidden');--}}
{{--            modalSubmitButton.disabled=true;--}}
{{--            modalSubmitButton.classList.remove('hover:bg-blue-700','bg-blue-600');--}}
{{--            modalSubmitButton.classList.add('bg-gray-300');--}}

{{--        }--}}
{{--        // if(hasValidSlot){--}}
{{--        //     formErrors.classList.add('hidden');--}}
{{--        //     modalSubmitButton.disabled=false;--}}
{{--        //     modalSubmitButton.classList.remove('bg-gray-300');--}}
{{--        //     modalSubmitButton.classList.add(' hover:bg-blue-700','bg-blue-600 ');--}}
{{--        // }--}}
{{--        checkBookedSlots();--}}
{{--    }--}}

{{--    function selectTimeSlot(slot) {--}}
{{--        if(slot.disabled) return;--}}
{{--        // const timeValue = slot.dataset.time;--}}
{{--        //--}}
{{--        // // If slot is already selected, deselect it and all slots after it--}}
{{--        // if (selectedSlots.includes(timeValue)) {--}}
{{--        //     const index = selectedSlots.indexOf(timeValue);--}}
{{--        //     selectedSlots = selectedSlots.slice(0, index);--}}
{{--        // } else {--}}
{{--        //     // Sort time slots to find consecutive ones--}}
{{--        //     const allTimeSlots = Array.from(document.querySelectorAll('.time-slot:not([disabled])'))--}}
{{--        //         .map(s => s.dataset.time)--}}
{{--        //         .sort();--}}
{{--        //--}}
{{--        //     // If no slots selected yet, add this one--}}
{{--        //     if (selectedSlots.length === 0) {--}}
{{--        //         selectedSlots.push(timeValue);--}}
{{--        //     } else {--}}
{{--        //         // Get current slot index and the last selected slot index--}}
{{--        //         const currentSlotIndex = allTimeSlots.indexOf(timeValue);--}}
{{--        //         const lastSelectedSlot = selectedSlots[selectedSlots.length - 1];--}}
{{--        //         const lastSelectedIndex = allTimeSlots.indexOf(lastSelectedSlot);--}}
{{--        //--}}
{{--        //         // Check if this slot is consecutive to the last selected slot--}}
{{--        //         if (currentSlotIndex === lastSelectedIndex + 1) {--}}
{{--        //             console.log('AAA')--}}
{{--        //             // If consecutive, add to selection--}}
{{--        //             selectedSlots.push(timeValue);--}}
{{--        //         } else {--}}
{{--        //             // If not consecutive or earlier in the list, start a new selection--}}
{{--        //             selectedSlots = [timeValue];--}}
{{--        //             updateSelectedSlots();--}}
{{--        //         }--}}
{{--        //     }--}}
{{--        // }--}}
{{--        //--}}
{{--        // updateSelectedSlots();--}}
{{--        const timeValue = slot.dataset.time;--}}

{{--        const allTimeSlots = Array.from(document.querySelectorAll('.time-slot:not([disabled])'))--}}
{{--            .map(s => s.dataset.time)--}}
{{--            .sort();--}}

{{--        const currentSlotIndex = allTimeSlots.indexOf(timeValue);--}}

{{--        if (selectedSlots.includes(timeValue)) {--}}
{{--            const index = selectedSlots.indexOf(timeValue);--}}
{{--            selectedSlots = selectedSlots.slice(0, index);--}}
{{--        } else {--}}
{{--            if (selectedSlots.length === 0) {--}}

{{--                selectedSlots.push(timeValue);--}}
{{--            } else {--}}
{{--                const lastSelectedSlot = selectedSlots[selectedSlots.length - 1];--}}
{{--                const lastSelectedIndex = allTimeSlots.indexOf(lastSelectedSlot);--}}

{{--                // Проверка дали слотът е директно след последния--}}
{{--                if (currentSlotIndex === lastSelectedIndex + 1) {--}}
{{--                    selectedSlots.push(timeValue);--}}
{{--                } else {--}}
{{--                    // Ако не е последователен -> нулирай избора--}}
{{--                    selectedSlots = [timeValue];--}}
{{--                }--}}
{{--            }--}}
{{--        }--}}

{{--        updateSelectedSlots();--}}
{{--    }--}}

{{--    function updateSelectedSlots() {--}}


{{--        console.log(selectedSlots)--}}
{{--        // Update visual representation--}}
{{--        document.querySelectorAll('.time-slot').forEach(slot => {--}}
{{--            if (!slot.disabled) {--}}
{{--                if (selectedSlots.includes(slot.dataset.time)) {--}}
{{--                    slot.classList.remove('bg-green-500');--}}
{{--                    slot.classList.add('bg-blue-500');--}}
{{--                } else {--}}
{{--                    slot.classList.remove('bg-blue-500');--}}
{{--                    slot.classList.add('bg-green-500');--}}
{{--                }--}}
{{--            }--}}
{{--        });--}}

{{--        // // Update hidden inputs for form submission--}}
{{--        // if (selectedSlots.length > 0) {--}}
{{--        //     const selectedDate = dateInput.value;--}}
{{--        //--}}
{{--        //     // Sort slots to ensure correct order--}}
{{--        //     selectedSlots.sort();--}}
{{--        //--}}
{{--        //     // For the start time, use the first selected slot--}}
{{--        //     const firstSlot = selectedSlots[0];--}}
{{--        //     // Format date as YYYY-MM-DD HH:MM:SS for Laravel--}}
{{--        //     startTimeInput.value = `${selectedDate} ${firstSlot}:00`;--}}
{{--        //--}}
{{--        //     // For the end time, calculate the end time based on the duration--}}
{{--        //     // Assume each slot is 45 minutes long--}}
{{--        //     const lastSlot = selectedSlots[selectedSlots.length - 1];--}}
{{--        //--}}
{{--        //     // Parse the last slot time--}}
{{--        //     let [lastHours, lastMinutes] = lastSlot.split(':').map(Number);--}}
{{--        //--}}
{{--        //     // Add 45 minutes for the end time--}}
{{--        //     let endHours = lastHours + Math.floor((lastMinutes + 45) / 60);--}}
{{--        //     let endMinutes = (lastMinutes + 45) % 60;--}}
{{--        //--}}
{{--        //     // Format the end time with seconds for Laravel datetime format--}}
{{--        //     const endTime = `${String(endHours).padStart(2, '0')}:${String(endMinutes).padStart(2, '0')}:00`;--}}
{{--        //     endTimeInput.value = `${selectedDate} ${endTime}`;--}}
{{--        //--}}
{{--        //     console.log("Form will submit with:", {--}}
{{--        //         start_time: startTimeInput.value,--}}
{{--        //         end_time: endTimeInput.value--}}
{{--        //     });--}}
{{--        // }--}}

{{--        // //Other one--}}
{{--        if (selectedSlots.length > 0) {--}}
{{--            const selectedDate = dateInput.value;--}}
{{--            const firstSlot = selectedSlots[0];--}}

{{--            // Set the breaks with max operator, so we can avoid negative numbers when we don't pick slot--}}
{{--            const totalMinutes =calculateExamDuration(selectedSlots);--}}

{{--            const startDateTime = new Date(`${selectedDate}T${firstSlot}:00`);--}}
{{--            const endDateTime = new Date(startDateTime.getTime() + totalMinutes * 60000  );--}}

{{--            // Форматиране на времето--}}
{{--            const formatTime = (date) => {--}}
{{--                return [--}}
{{--                    date.getFullYear(),--}}
{{--                    (date.getMonth() + 1).toString().padStart(2, '0'),--}}
{{--                    date.getDate().toString().padStart(2, '0')--}}
{{--                ].join('-') + ' ' + [--}}
{{--                    date.getHours().toString().padStart(2, '0'),--}}
{{--                    date.getMinutes().toString().padStart(2, '0'),--}}
{{--                    '00'--}}
{{--                ].join(':');--}}
{{--            };--}}

{{--            startTimeInput.value = formatTime(startDateTime);--}}
{{--            endTimeInput.value = formatTime(endDateTime);--}}

{{--            console.log("Times:", startTimeInput.value, endTimeInput.value);--}}

{{--        }--}}
{{--        else {--}}
{{--            startTimeInput.value = '';--}}
{{--            endTimeInput.value = '';--}}
{{--        }--}}
{{--    }--}}
{{--    function resetExamForm() {--}}
{{--        document.getElementById('modalTitle').textContent = 'Създаване на нов изпит';--}}
{{--        examForm.action = examForm.dataset.createUrl;--}}
{{--        formMethod.value = 'POST';--}}
{{--        examForm.reset();--}}

{{--        document.querySelector('[name="subject_id"]').disabled = false;--}}
{{--        document.querySelector('[name="exam_type"]').disabled = false;--}}

{{--        selectedSlots = [];--}}
{{--        generateTimeSlots();--}}
{{--        fetchBookedSlots();--}}
{{--    }--}}

{{--    function openEditModal(examId) {--}}
{{--        document.getElementById('modalTitle').textContent = 'Редактиране на изпит';--}}
{{--        examForm.action = examForm.dataset.updateUrl.replace(':examId', examId);--}}
{{--        formMethod.value = 'PUT';--}}

{{--        fetch(`/teacher/exam/${examId}/edit-data`)--}}
{{--            .then(res => res.json())--}}
{{--            .then(data => {--}}
{{--                document.querySelector('[name="subject_id"]').value = data.subject_id;--}}
{{--                document.querySelector('[name="exam_type"]').value = data.exam_type;--}}
{{--                document.querySelector('[name="max_students"]').value = data.max_students;--}}
{{--                document.querySelector('[name="hall_id"]').value = data.hall_id;--}}
{{--                document.getElementById('exam_date').value = data.start_time.substring(0, 10);--}}

{{--                document.querySelector('[name="subject_id"]').disabled = true;--}}
{{--                document.querySelector('[name="exam_type"]').disabled = true;--}}

{{--                generateTimeSlots();--}}
{{--                fetchBookedSlots();--}}
{{--            });--}}
{{--    }--}}
{{--    examForm.dataset.createUrl=examForm.action;--}}
{{--    examForm.dataset.updateUrl = "{{ route('exams.update', ['exam' => ':examId']) }}";--}}

{{--    window.resetExamForm=resetExamForm;--}}
{{--    window.openEditModel=openEditModal;--}}
{{--});--}}
{{--</script>--}}
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>

    /*#sidebar {*/
    /*    width: 288px;*/
    /*    left: -288px;*/
    /*    box-shadow: 8px 0 15px -3px rgba(0, 0, 0, 0.1);*/
    /*}*/
    /*#menuContainer {*/
    /*    transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);*/
    /*    left: 1rem;*/
    /*}*/
    header {
        margin-top: 5.5rem; /* Оптимизирано отместване за мобилен режим */
    }
    .bg-green-50, .bg-red-50{
        transition: opacity 0.3s ease;
        position: relative; /* Задължително за позициониране на бутона */
    }
</style>

</body>
</html>
