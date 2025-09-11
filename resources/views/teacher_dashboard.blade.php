{{--    <!DOCTYPE html>--}}
{{--<html lang="bg">--}}
{{--@include('partials.head')--}}
{{--<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}
{{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}


{{--<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden" x-data="{ showModal: false }">--}}
{{--@include('partials.sidebar')--}}

{{--<div class="ml-0 lg:ml-80 p-4 lg:p-8 transition-all duration-300">--}}
{{--    @include('partials.header',[--}}
{{--        'title'=>"Управление на изпити",--}}
{{--        'subtitle'=>'Преглед на предстоящи изпити и възможност за добавяне',--}}
{{--        'button'=>[--}}
{{--            'route'=>route('conducted_exams'),--}}
{{--            'text'=>' Изминали изпити',--}}
{{--            'icon' =>'fa-duotone fa-solid fa-folder-open'--}}
{{--        ]--}}
{{--    ])--}}

{{--    <main>--}}
{{--        @include('partials.alerts')--}}



{{--        @if($exams->isEmpty())--}}
{{--            <div class="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">--}}
{{--                <i class="fas fa-calendar-plus text-4xl text-gray-300 mb-4"></i>--}}
{{--                <h3 class="text-lg font-medium text-gray-700 mb-2">Няма създадени изпити</h3>--}}
{{--                <button @click="showModal = true" class="mt-4 bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition-colors">--}}
{{--                    Нов изпит--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">--}}
{{--                @foreach($exams as $exam)--}}
{{--                    <div class="flex flex-col bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px] ">--}}
{{--                        <div class="flex justify-between items-start gap-2 mb-3">--}}
{{--                            <h2 class="text-lg font-semibold text-gray-900">--}}
{{--                                {{ $exam->subject->subject_name }}--}}
{{--                                <span class="block text-sm font-normal text-gray-500 mt-1">--}}
{{--                                    {{ $exam->subject->description }}--}}
{{--                                </span>--}}
{{--                            </h2>--}}
{{--                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">--}}
{{--                                {{ $exam->exam_type }}--}}
{{--                            </span>--}}
{{--                        </div>--}}

{{--                        <div class="space-y-3 mb-5">--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-calendar-alt w-5 text-gray-400"></i>--}}
{{--                                <span>Дата: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y') }}</span></span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-clock w-5 text-gray-400"></i>--}}
{{--                                <span>Час: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($exam->end_time)->format('H:i') }}</span></span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-university w-5 text-gray-400"></i>--}}
{{--                                <span>Зала: <span class="font-medium text-gray-800">{{ $exam->hall->name }}</span></span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-users w-5 text-gray-400"></i>--}}
{{--                                <span class="font-medium {{ $exam->remainingSlots() > 0 ? 'text-green-700' : 'text-red-700' }}">--}}
{{--                                    {{ $exam->remainingSlots() }}/{{ $exam->max_students }} места--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <form method="POST" action="{{ route('student.exam.register', $exam) }} "  class ="mt-auto">--}}
{{--                            @csrf--}}
{{--                            <button type="submit"--}}
{{--                                    data-exam-date="{{ $exam->start_time }}"--}}
{{--                                    class="edit-exam-btn w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 bg-blue-600 hover:bg-blue-700">--}}
{{--                                <i class="fa-solid fa-file-pen"></i> Редактирай изпит--}}
{{--                            </button>--}}
{{--                        </form>--}}

{{--                        <button @click=" showModal=true; openEditModal(@json($exam->id))"--}}
{{--                        <button @click="openEditModal({{$exam->id}});showModal=true "--}}
{{--                                class=" mt-auto edit-exam-btn w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 bg-blue-600 hover:bg-blue-700"--}}
{{--                                data-exam-date="{{$exam->start_time}}">--}}
{{--                            <i class="fa-solid fa-file-pen"></i> Редактирай изпит--}}
{{--                        </button>--}}

{{--                    </div>--}}
{{--                @endforeach--}}

{{--                <div class="flex items-center justify-center">--}}
{{--                    <button @click=" resetExamForm(); showModal = true" class="w-16 h-16 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white shadow-xl flex items-center justify-center transition-all duration-300 hover:rotate-90">--}}
{{--                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>--}}
{{--                        </svg>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--        @endif--}}
{{--    </main>--}}
{{--</div>--}}
{{--<html lang="bg">--}}
{{--@include('partials.head')--}}
{{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

{{--<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden" x-data="{ showModal: false }">--}}
{{--@include('partials.header')--}}

{{--<div class="page-layout">--}}
{{--    @include('partials.sidebar')--}}

{{--    <main class="p-4 lg:p-6">--}}
{{--        <div class="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">--}}
{{--            <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">--}}
{{--                <div>--}}
{{--                    <h1 class="text-2xl font-bold text-gray-800">Управление на изпити</h1>--}}
{{--                    <p class="text-sm text-gray-500 mt-1">Преглед на предстоящи изпити и възможност за добавяне</p>--}}
{{--                </div>--}}
{{--                <a href="{{ route('conducted_exams') }}" class="inline-flex items-center gap-1 px-4 py-2.5 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors">--}}
{{--                    <i class="fa-duotone fa-solid fa-folder-open"></i>--}}
{{--                    Изминали изпити--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        @include('partials.alerts')--}}

{{--        @if($exams->isEmpty())--}}
{{--            <div class="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">--}}
{{--                <i class="fas fa-calendar-plus text-4xl text-gray-300 mb-4"></i>--}}
{{--                <h3 class="text-lg font-medium text-gray-700 mb-2">Няма създадени изпити</h3>--}}
{{--                <button @click="showModal = true" class="mt-4 bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition-colors">--}}
{{--                    Нов изпит--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">--}}
{{--                @foreach($exams as $exam)--}}
{{--                    <div class="flex flex-col bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px]">--}}
{{--                        <!-- Съдържание на картата за изпит -->--}}
{{--                        <div class="flex justify-between items-start gap-2 mb-3">--}}
{{--                            <h2 class="text-lg font-semibold text-gray-900">--}}
{{--                                {{ $exam->subject->subject_name }}--}}
{{--                                <span class="block text-sm font-normal text-gray-500 mt-1">--}}
{{--                                        {{ $exam->subject->description }}--}}
{{--                                    </span>--}}
{{--                            </h2>--}}
{{--                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">--}}
{{--                                    {{ $exam->exam_type }}--}}
{{--                                </span>--}}
{{--                        </div>--}}

{{--                        <div class="space-y-3 mb-5">--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-calendar-alt w-5 text-gray-400"></i>--}}
{{--                                <span>Дата: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y') }}</span></span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-clock w-5 text-gray-400"></i>--}}
{{--                                <span>Час: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($exam->end_time)->format('H:i') }}</span></span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-university w-5 text-gray-400"></i>--}}
{{--                                <span>Зала: <span class="font-medium text-gray-800">{{ $exam->hall->name }}</span></span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-users w-5 text-gray-400"></i>--}}
{{--                                <span class="font-medium {{ $exam->remainingSlots() > 0 ? 'text-green-700' : 'text-red-700' }}">--}}
{{--                                        {{ $exam->remainingSlots() }}/{{ $exam->max_students+ceil($exam->max_students*0.1)}} места--}}
{{--                                    </span>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <button @click="openEditModal({{$exam->id}});showModal=true"--}}
{{--                                class="mt-auto edit-exam-btn w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 bg-blue-600 hover:bg-blue-700"--}}
{{--                                data-exam-date="{{$exam->start_time}}">--}}
{{--                            <i class="fa-solid fa-file-pen"></i> Редактирай изпит--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                @endforeach--}}

{{--                <div class="flex items-center justify-center">--}}
{{--                    <button @click=" resetExamForm(); showModal = true" class="w-16 h-16 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white shadow-xl flex items-center justify-center transition-all duration-300 hover:rotate-90">--}}
{{--                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>--}}
{{--                        </svg>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </main>--}}
{{--</div>--}}
{{--<!-- Create Exam Modal -->--}}
{{--<div x-cloak x-show="showModal " x-transition.opacity class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">--}}
{{--<div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">--}}
{{--    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 mx-4" @click.outside="showModal = false">--}}
{{--        <h3 class="text-xl font-bold text-gray-900 mb-4" id="modalTitle">Създаване на нов изпит</h3>--}}

{{--        <form method="POST" action="{{ route('exams.store') }}" id="examForm">--}}
{{--            @csrf--}}
{{--            <div class="space-y-4">--}}
{{--                <div>--}}
{{--                    <input type="hidden" name="_method" id="formMethod" value="POST">--}}

{{--                    <label class="block text-sm font-medium text-gray-700 mb-2">Дисциплина</label>--}}
{{--                    <select name="subject_id" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">--}}
{{--                        @foreach($subjects as $subject)--}}
{{--                            <option value="{{ $subject->id }}">{{ $subject->subject_name }} (Сем. {{ $subject->semester }})</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}

{{--                <div class="grid grid-cols-2 gap-4">--}}
{{--                    <div>--}}
{{--                        <label class="block text-sm font-medium text-gray-700 mb-2">Тип изпит</label>--}}
{{--                        <select name="exam_type" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">--}}
{{--                            <option value="редовен">Редовен</option>--}}
{{--                            <option value="поправителен">Поправителен</option>--}}
{{--                            <option value="ликвидация">Ликвидация</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <label class="block text-sm font-medium text-gray-700 mb-2">Макс. студенти</label>--}}
{{--                        <input type="number" name="max_students" required min="1" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    <label class="block text-sm font-medium text-gray-700 mb-2">Изпитна зала</label>--}}
{{--                    <select name="hall_id" id="hall_id" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">--}}
{{--                        @foreach($halls as $hall)--}}
{{--                            <option value="{{ $hall->id }}">{{ $hall->name }} ({{ $hall->capacity }} места)</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    <label class="block text-sm font-medium text-gray-700 mb-2">Дата</label>--}}
{{--                    <input type="date" id="exam_date" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    <label class="block text-sm font-medium text-gray-700 mb-2">Изберете свободни часове</label>--}}
{{--                    <div class="mt-2">--}}
{{--                        <h4 class="text-center font-medium mb-2">Стая <span id="selected_room">---</span></h4>--}}
{{--                        <div id="time_slots_grid" class="grid grid-cols-3 gap-2">--}}
{{--                            <!-- Time slots will be generated here -->--}}
{{--                            <div id="loadingIndicator" class="text-center py-4 hidden">--}}
{{--                                <i class="fas fa-spinner fa-spin text-blue-500"></i>--}}
{{--                                <span class="ml-2 text-gray-600">Зареждане на слотове...</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <input type="hidden" name="start_time" id="start_time" required>--}}
{{--                <input type="hidden" name="end_time" id="end_time" required>--}}

{{--                <div id="formErrors" class="text-red-600 font-medium hidden"></div>--}}

{{--                <div class="flex justify-end gap-3 mt-6">--}}
{{--                    <button type="button" @click="showModal = false" class="px-5 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors">--}}
{{--                        Отказ--}}
{{--                    </button>--}}
{{--                    <button type="submit" id="submitBtn" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">--}}
{{--                        Създай--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<script src="{{ asset('js/menuFunctions.js') }}" defer></script>--}}
{{--<script src="{{ asset('js/alertClosingFunctions.js')}}" defer></script>--}}
{{--<script>--}}
{{--    document.addEventListener('DOMContentLoaded', function() {--}}

{{--        // Define and initialize  DOM elements--}}
{{--        const hallSelect = document.getElementById('hall_id');--}}
{{--        const dateInput = document.getElementById('exam_date');--}}
{{--        const timeGrid = document.getElementById('time_slots_grid');--}}
{{--        const selectedRoomDisplay = document.getElementById('selected_room');--}}
{{--        const startTimeInput = document.getElementById('start_time');--}}
{{--        const endTimeInput = document.getElementById('end_time');--}}
{{--        const examForm = document.getElementById('examForm');--}}
{{--        const formErrors = document.getElementById('formErrors');--}}
{{--        const modalSubmitButton = document.getElementById('submitBtn');--}}
{{--        const formMethod = document.getElementById('formMethod');--}}
{{--        const loadingIndicator = document.getElementById('loadingIndicator');--}}


{{--        let selectedSlots = [];--}}
{{--        let bookedSlots = [];--}}

{{--        // Инициализация на основни стойности--}}
{{--        const today = new Date();--}}
{{--        dateInput.value = today.toISOString().split('T')[0];--}}
{{--        // updateRoomDisplay();--}}

{{--        // Обработчик за подаване на формата--}}
{{--        examForm.addEventListener('submit', function(e) {--}}
{{--            if (!startTimeInput.value || !endTimeInput.value) {--}}
{{--                e.preventDefault();--}}
{{--                showFormError('Моля, изберете период за изпита от времевата мрежа.');--}}
{{--                return false;--}}
{{--            }--}}

{{--            if (selectedSlots.length === 0) {--}}
{{--                e.preventDefault();--}}
{{--                showFormError('Моля, изберете поне един времеви слот.');--}}
{{--                return false;--}}
{{--            }--}}

{{--            return true;--}}
{{--        });--}}

{{--        // Event Listeners--}}
{{--        hallSelect.addEventListener('change', function() {--}}
{{--            updateRoomDisplay();--}}
{{--                fetchBookedSlots();--}}

{{--        });--}}

{{--        dateInput.addEventListener('change', function() {--}}

{{--                generateTimeSlots();--}}
{{--                fetchBookedSlots();--}}

{{--        });--}}

{{--        // Помощни функции--}}
{{--        function showFormError(message) {--}}
{{--            formErrors.textContent = message;--}}
{{--            formErrors.classList.remove('hidden');--}}
{{--            setTimeout(() => {--}}
{{--                formErrors.classList.add('hidden');--}}
{{--            }, 5000);--}}
{{--        }--}}

{{--        function updateRoomDisplay() {--}}
{{--            if (hallSelect.selectedIndex >= 0) {--}}
{{--                const selectedRoom = hallSelect.options[hallSelect.selectedIndex].text;--}}
{{--                selectedRoomDisplay.textContent = selectedRoom;--}}
{{--            }--}}
{{--        }--}}

{{--        function isPastDate(dateString) {--}}
{{--            const today = new Date();--}}
{{--            today.setHours(0, 0, 0, 0);--}}
{{--            return new Date(dateString) < today;--}}
{{--        }--}}

{{--        function isWithin48Hours(examDate) {--}}
{{--            const now = new Date();--}}
{{--            const hourDifference = Math.abs(examDate - now) / (1000 * 60 * 60);--}}
{{--            return hourDifference < 48;--}}
{{--        }--}}

{{--        function isValidDate(date, time = '00:00') {--}}
{{--            const examDate = new Date(`${date}T${time}`);--}}
{{--            return !isPastDate(date) && !isWithin48Hours(examDate);--}}
{{--        }--}}

{{--        function calculateExamDuration(slots) {--}}
{{--            return (slots.length * 45) + (Math.max(slots.length - 1, 0) * 15);--}}
{{--        }--}}

{{--        function generateTimeSlots() {--}}
{{--            if (!timeGrid) return;--}}

{{--            timeGrid.innerHTML = '';--}}
{{--            const selectedDate = dateInput.value;--}}
{{--            const timeSlots = [--}}
{{--                '07:00', '08:00', '09:00', '10:00', '11:00', '12:00',--}}
{{--                '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'--}}
{{--            ];--}}

{{--            let hasValidSlot = false;--}}

{{--            timeSlots.forEach(time => {--}}
{{--                const slot = document.createElement('button');--}}
{{--                slot.type = 'button';--}}
{{--                slot.className = 'time-slot py-3 rounded-lg text-white font-medium bg-green-500 hover:bg-green-600 transition-colors';--}}
{{--                slot.dataset.time = time;--}}
{{--                slot.textContent = time;--}}

{{--                if (!isValidDate(selectedDate, time)) {--}}
{{--                    slot.disabled = true;--}}
{{--                    slot.classList.replace('bg-green-500', 'bg-gray-300');--}}
{{--                    slot.classList.add('cursor-not-allowed')--}}
{{--                    slot.classList.remove('hover:bg-green-600');--}}
{{--                    slot.title = "Моля, изберете валидни дата и час за изпита.";--}}
{{--                } else {--}}
{{--                    hasValidSlot = true;--}}
{{--                    slot.addEventListener('click', () => selectTimeSlot(slot));--}}
{{--                }--}}

{{--                timeGrid.appendChild(slot);--}}
{{--            });--}}

{{--            updateFormState(hasValidSlot);--}}
{{--            checkBookedSlots();--}}
{{--        }--}}

{{--        function updateFormState(hasValidSlot) {--}}
{{--            if (!formErrors || !modalSubmitButton) return;--}}

{{--            if (hasValidSlot) {--}}
{{--                formErrors.classList.add('hidden');--}}
{{--                modalSubmitButton.disabled = false;--}}
{{--                modalSubmitButton.classList.remove('bg-gray-300');--}}
{{--                modalSubmitButton.classList.add('bg-blue-600', 'hover:bg-blue-700');--}}
{{--            } else {--}}
{{--                formErrors.textContent = "Не може да създавате изпити за минали дати или по-малко от 48 часа от сега.";--}}
{{--                formErrors.classList.remove('hidden');--}}
{{--                modalSubmitButton.disabled = true;--}}
{{--                modalSubmitButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');--}}
{{--                modalSubmitButton.classList.add('bg-gray-300');--}}
{{--            }--}}
{{--        }--}}

{{--        // Функция за избор на слот--}}
{{--        function selectTimeSlot(slot) {--}}
{{--            if (slot.disabled) return;--}}

{{--            const timeValue = slot.dataset.time;--}}
{{--            const allSlots = Array.from(document.querySelectorAll('.time-slot:not([disabled])'))--}}
{{--                .map(s => s.dataset.time)--}}
{{--                .sort();--}}

{{--            const currentIndex = allSlots.indexOf(timeValue);--}}

{{--            if (selectedSlots.includes(timeValue)) {--}}
{{--                const index = selectedSlots.indexOf(timeValue);--}}
{{--                selectedSlots = selectedSlots.slice(0, index);--}}
{{--            } else {--}}
{{--                if (selectedSlots.length === 0) {--}}
{{--                    selectedSlots.push(timeValue);--}}
{{--                } else {--}}
{{--                    const lastSlot = selectedSlots[selectedSlots.length - 1];--}}
{{--                    const lastIndex = allSlots.indexOf(lastSlot);--}}

{{--                    if (currentIndex === lastIndex + 1) {--}}
{{--                        selectedSlots.push(timeValue);--}}
{{--                    } else {--}}
{{--                        selectedSlots = [timeValue];--}}
{{--                    }--}}
{{--                }--}}
{{--            }--}}

{{--            updateSelectedSlots();--}}
{{--        }--}}

{{--        function updateSelectedSlots() {--}}
{{--            document.querySelectorAll('.time-slot').forEach(slot => {--}}
{{--                if (!slot.disabled) {--}}
{{--                    if (selectedSlots.includes(slot.dataset.time)) {--}}
{{--                        slot.classList.replace('bg-green-500', 'bg-blue-500');--}}
{{--                    } else {--}}
{{--                        slot.classList.replace('bg-blue-500', 'bg-green-500');--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}

{{--            if (selectedSlots.length > 0) {--}}
{{--                const selectedDate = dateInput.value;--}}
{{--                const firstSlot = selectedSlots[0];--}}
{{--                const totalMinutes = calculateExamDuration(selectedSlots);--}}

{{--                const startDateTime = new Date(`${selectedDate}T${firstSlot}:00`);--}}
{{--                const endDateTime = new Date(startDateTime.getTime() + totalMinutes * 60000);--}}

{{--                startTimeInput.value = formatDateTime(startDateTime);--}}
{{--                endTimeInput.value = formatDateTime(endDateTime);--}}
{{--            } else {--}}
{{--                startTimeInput.value = '';--}}
{{--                endTimeInput.value = '';--}}
{{--            }--}}
{{--        }--}}

{{--        function formatDateTime(date) {--}}
{{--            return [--}}
{{--                date.getFullYear(),--}}
{{--                String(date.getMonth() + 1).padStart(2, '0'),--}}
{{--                String(date.getDate()).padStart(2, '0')--}}
{{--            ].join('-') + ' ' + [--}}
{{--                String(date.getHours()).padStart(2, '0'),--}}
{{--                String(date.getMinutes()).padStart(2, '0'),--}}
{{--                '00'--}}
{{--            ].join(':');--}}
{{--        }--}}

{{--        // Функция за зареждане на заетите слотове--}}
{{--        async function fetchBookedSlots(excludeExamId=null) {--}}
{{--            const selectedDate = dateInput.value;--}}
{{--            const selectedHallId = hallSelect.value;--}}

{{--            if (!selectedDate || !selectedHallId) return;--}}

{{--            // Показване на индикатор за зареждане--}}
{{--            if (loadingIndicator) loadingIndicator.classList.remove('hidden');--}}

{{--            try {--}}

{{--                const url = `{{ route('exams.booked-slots') }}?date=${encodeURIComponent(selectedDate)}&hall_id=${encodeURIComponent(selectedHallId)}${excludeExamId ? `&exclude_exam_id=${excludeExamId}`:''}`;--}}

{{--                const response = await fetch(url);--}}

{{--                if (!response.ok) throw new Error('Грешка при зареждане');--}}

{{--                const data = await response.json();--}}
{{--                bookedSlots = data.bookedSlots || [];--}}
{{--                checkBookedSlots();--}}
{{--            } catch (error) {--}}
{{--                console.error('Грешка при зареждане на заетите слотове:', error);--}}
{{--                showFormError('Възникна проблем при зареждането на заетите часове');--}}
{{--            } finally {--}}
{{--                if (loadingIndicator) loadingIndicator.classList.add('hidden');--}}
{{--            }--}}
{{--        }--}}

{{--        function checkBookedSlots() {--}}
{{--            const selectedDate = dateInput.value;--}}

{{--            document.querySelectorAll('.time-slot').forEach(slot => {--}}
{{--                if (!slot.disabled) {--}}
{{--                    slot.classList.replace('bg-red-500', 'bg-green-500');--}}
{{--                    slot.disabled = false;--}}
{{--                }--}}
{{--            });--}}

{{--            if (!Array.isArray(bookedSlots)) return;--}}

{{--            bookedSlots.forEach(booking => {--}}
{{--                try {--}}
{{--                    if (!booking.start || !booking.end) return;--}}

{{--                    const bookingDate = booking.start.split('T')[0];--}}
{{--                    if (bookingDate !== selectedDate) return;--}}

{{--                    const startTime = booking.start.split('T')[1].substring(0, 5);--}}
{{--                    const endTime = booking.end.split('T')[1].substring(0, 5);--}}

{{--                    document.querySelectorAll('.time-slot').forEach(slot => {--}}
{{--                        const slotTime = slot.dataset.time;--}}
{{--                        if (slotTime >= startTime && slotTime < endTime) {--}}
{{--                            slot.classList.replace('bg-green-500', 'bg-red-500');--}}
{{--                            slot.disabled = true;--}}
{{--                        }--}}
{{--                    });--}}
{{--                } catch (error) {--}}
{{--                    console.error('Грешка при обработка на слот:', error);--}}
{{--                }--}}
{{--            });--}}

{{--            updateSelectedSlots();--}}
{{--        }--}}

{{--        // Функции за управление на модала--}}
{{--        window.resetExamForm = function() {--}}
{{--            document.getElementById('modalTitle').textContent = 'Създаване на нов изпит';--}}
{{--            document.getElementById('submitBtn').textContent="Създай";--}}

{{--            examForm.action = "{{ route('exams.store') }}";--}}
{{--            formMethod.value = 'POST';--}}
{{--            examForm.reset();--}}

{{--            document.querySelector('[name="subject_id"]').disabled = false;--}}
{{--            document.querySelector('[name="exam_type"]').disabled = false;--}}

{{--            // Задаване на днешна дата--}}
{{--            dateInput.value = today.toISOString().split('T')[0];--}}
{{--            updateRoomDisplay();--}}

{{--            selectedSlots = [];--}}
{{--            generateTimeSlots();--}}
{{--            fetchBookedSlots();--}}
{{--        };--}}

{{--        window.openEditModal = function(examId) {--}}
{{--            document.getElementById('modalTitle').textContent = 'Редактиране на изпит';--}}
{{--            document.getElementById('submitBtn').textContent="Редактирай";--}}
{{--            const baseUrl = "{{ route('exams.update', ['examId' => ':idExam']) }}";--}}

{{--            examForm.action = baseUrl.replace(':idExam',examId);--}}
{{--            formMethod.value = 'PUT';--}}

{{--            fetch(`/teacher/exam/${examId}/edit-data`)--}}
{{--                .then(res => res.json())--}}
{{--                .then(data => {--}}
{{--                    console.log(data)--}}
{{--                    document.querySelector('[name="subject_id"]').value = data.subject_id;--}}
{{--                    document.querySelector('[name="exam_type"]').value = data.exam_type;--}}
{{--                    document.querySelector('[name="max_students"]').value = data.max_students;--}}
{{--                    document.querySelector('[name="hall_id"]').value = data.hall_id;--}}
{{--                    dateInput.value = data.start_time.substring(0, 10);--}}

{{--                    document.querySelector('[name="subject_id"]').readonly = true;--}}
{{--                    document.querySelector('[name="exam_type"]').readonly = true;--}}

{{--                    updateRoomDisplay();--}}
{{--                    generateTimeSlots();--}}
{{--                    fetchBookedSlots(examId);--}}
{{--                })--}}
{{--                .catch(error => {--}}
{{--                    console.error('Грешка при зареждане на данните за изпит:', error);--}}
{{--                    showFormError('Грешка при зареждане на данните за изпит');--}}
{{--                });--}}
{{--        };--}}

{{--        // Деактивиране на бутони за редактиране на изпити, които започват след по-малко от 48 часа--}}
{{--        document.querySelectorAll('.edit-exam-btn').forEach(button => {--}}
{{--            const examDateString = button.getAttribute('data-exam-date');--}}
{{--            const examDate = new Date(examDateString);--}}
{{--            const hoursDifference = (examDate - new Date()) / (1000 * 60 * 60);--}}

{{--            if (hoursDifference < 48) {--}}
{{--                button.disabled = true;--}}
{{--                button.classList.replace('bg-blue-600', 'bg-gray-300');--}}
{{--                button.classList.add('cursor-not-allowed');--}}
{{--                button.classList.remove('hover:bg-blue-700');--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}

{{--<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}

{{--<style>--}}

{{--    /*#sidebar {*/--}}
{{--    /*    width: 288px;*/--}}
{{--    /*    left: -288px;*/--}}
{{--    /*    box-shadow: 8px 0 15px -3px rgba(0, 0, 0, 0.1);*/--}}
{{--    /*}*/--}}
{{--    /*#menuContainer {*/--}}
{{--    /*    transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);*/--}}
{{--    /*    left: 1rem;*/--}}
{{--    /*}*/--}}
{{--    /*header {*/--}}
{{--    /*    margin-top: 5.5rem; !* Оптимизирано отместване за мобилен режим *!*/--}}
{{--    /*}*/--}}
{{--    .bg-green-50, .bg-red-50{--}}
{{--        transition: opacity 0.3s ease;--}}
{{--        position: relative; /* Задължително за позициониране на бутона */--}}
{{--    }--}}
{{--</style>--}}

{{--</body>--}}
{{--</html>--}}
{{--<html lang="bg">--}}
{{--@include('partials.head')--}}
{{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

{{--<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden" x-data="{ showModal: false }">--}}
{{--@include('partials.header')--}}

{{--<div class="page-layout">--}}
{{--    @include('partials.sidebar')--}}

{{--    <main class="p-4 lg:p-6 relative z-0">--}}
{{--        <div class="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">--}}
{{--            <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">--}}
{{--                <div>--}}
{{--                    <h1 class="text-2xl font-bold text-gray-800">Управление на изпити</h1>--}}
{{--                    <p class="text-sm text-gray-500 mt-1">Преглед на предстоящи изпити и възможност за добавяне</p>--}}
{{--                </div>--}}
{{--                <a href="{{ route('conducted_exams') }}" class="inline-flex items-center gap-1 px-4 py-2.5 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors">--}}
{{--                    <i class="fa-duotone fa-solid fa-folder-open"></i>--}}
{{--                    Изминали изпити--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        @include('partials.alerts')--}}

{{--        @if($exams->isEmpty())--}}
{{--            <div class="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">--}}
{{--                <i class="fas fa-calendar-plus text-4xl text-gray-300 mb-4"></i>--}}
{{--                <h3 class="text-lg font-medium text-gray-700 mb-2">Няма създадени изпити</h3>--}}
{{--                <button @click="showModal = true" class="mt-4 bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition-colors">--}}
{{--                    Нов изпит--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">--}}
{{--                @foreach($exams as $exam)--}}
{{--                    <div class="flex flex-col bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px]">--}}
{{--                        <!-- Съдържание на картата за изпит -->--}}
{{--                        <div class="flex justify-between items-start gap-2 mb-3">--}}
{{--                            <h2 class="text-lg font-semibold text-gray-900">--}}
{{--                                {{ $exam->subject->subject_name }}--}}
{{--                                <span class="block text-sm font-normal text-gray-500 mt-1">--}}
{{--                                        {{ $exam->subject->description }}--}}
{{--                                    </span>--}}
{{--                            </h2>--}}
{{--                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">--}}
{{--                                    {{ $exam->exam_type }}--}}
{{--                                </span>--}}
{{--                        </div>--}}

{{--                        <div class="space-y-3 mb-5">--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-calendar-alt w-5 text-gray-400"></i>--}}
{{--                                <span>Дата: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y') }}</span></span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-clock w-5 text-gray-400"></i>--}}
{{--                                <span>Час: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($exam->end_time)->format('H:i') }}</span></span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-university w-5 text-gray-400"></i>--}}
{{--                                <span>Зала: <span class="font-medium text-gray-800">{{ $exam->hall->name }}</span></span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-users w-5 text-gray-400"></i>--}}
{{--                                <span class="font-medium {{ $exam->remainingSlots() > 0 ? 'text-green-700' : 'text-red-700' }}">--}}
{{--                                        {{ $exam->remainingSlots() }}/{{  $exam->max_students+ceil($exam->max_students*0.1) }} места--}}
{{--                                    </span>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <button @click="openEditModal({{$exam->id}});showModal=true"--}}
{{--                                class="mt-auto edit-exam-btn w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 bg-blue-600 hover:bg-blue-700"--}}
{{--                                data-exam-date="{{$exam->start_time}}">--}}
{{--                            <i class="fa-solid fa-file-pen"></i> Редактирай изпит--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                @endforeach--}}

{{--                <div class="flex items-center justify-center">--}}
{{--                    <button @click=" resetExamForm(); showModal = true" class="w-16 h-16 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white shadow-xl flex items-center justify-center transition-all duration-300 hover:rotate-90">--}}
{{--                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>--}}
{{--                        </svg>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </main>--}}
{{--</div>--}}

{{--<!-- Create Exam Modal -->--}}
{{--<div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">--}}
{{--    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 mx-4 relative z-50" @click.outside="showModal = false">--}}
{{--        <h3 class="text-xl font-bold text-gray-900 mb-4" id="modalTitle">Създаване на нов изпит</h3>--}}

{{--        <form method="POST" action="{{ route('exams.store') }}" id="examForm">--}}
{{--            @csrf--}}
{{--            <div class="space-y-4">--}}
{{--                <div>--}}
{{--                    <input type="hidden" name="_method" id="formMethod" value="POST">--}}

{{--                    <label class="block text-sm font-medium text-gray-700 mb-2">Дисциплина</label>--}}
{{--                    <select name="subject_id" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">--}}
{{--                        @foreach($subjects as $subject)--}}
{{--                            <option value="{{ $subject->id }}">{{ $subject->subject_name }} (Сем. {{ $subject->semester }})</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}

{{--                <div class="grid grid-cols-2 gap-4">--}}
{{--                    <div>--}}
{{--                        <label class="block text-sm font-medium text-gray-700 mb-2">Тип изпит</label>--}}
{{--                        <select name="exam_type" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">--}}
{{--                            <option value="редовен">Редовен</option>--}}
{{--                            <option value="поправителен">Поправителен</option>--}}
{{--                            <option value="ликвидация">Ликвидация</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <label class="block text-sm font-medium text-gray-700 mb-2">Макс. студенти</label>--}}
{{--                        <input type="number" name="max_students" required min="1" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    <label class="block text-sm font-medium text-gray-700 mb-2">Изпитна зала</label>--}}
{{--                    <select name="hall_id" id="hall_id" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">--}}
{{--                        @foreach($halls as $hall)--}}
{{--                            <option value="{{ $hall->id }}">{{ $hall->name }} ({{ $hall->capacity }} места)</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    <label class="block text-sm font-medium text-gray-700 mb-2">Дата</label>--}}
{{--                    <input type="date" id="exam_date" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">--}}
{{--                </div>--}}

{{--                <div>--}}
{{--                    <label class="block text-sm font-medium text-gray-700 mb-2">Изберете свободни часове</label>--}}
{{--                    <div class="mt-2">--}}
{{--                        <h4 class="text-center font-medium mb-2">Стая <span id="selected_room">---</span></h4>--}}
{{--                        <div id="time_slots_grid" class="grid grid-cols-3 gap-2">--}}
{{--                            <!-- Time slots will be generated here -->--}}
{{--                            <div id="loadingIndicator" class="text-center py-4 hidden">--}}
{{--                                <i class="fas fa-spinner fa-spin text-blue-500"></i>--}}
{{--                                <span class="ml-2 text-gray-600">Зареждане на слотове...</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <input type="hidden" name="start_time" id="start_time" required>--}}
{{--                <input type="hidden" name="end_time" id="end_time" required>--}}

{{--                <div id="formErrors" class="text-red-600 font-medium hidden"></div>--}}

{{--                <div class="flex justify-end gap-3 mt-6">--}}
{{--                    <button type="button" @click="showModal = false" class="px-5 py-2.5 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors">--}}
{{--                        Отказ--}}
{{--                    </button>--}}
{{--                    <button type="submit" id="submitBtn" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">--}}
{{--                        Създай--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<script src="{{ asset('js/menuFunctions.js') }}" defer></script>--}}
{{--<script src="{{ asset('js/alertClosingFunctions.js')}}" defer></script>--}}
{{--<script>--}}
{{--    document.addEventListener('DOMContentLoaded', function() {--}}

{{--        // Define and initialize  DOM elements--}}
{{--        const hallSelect = document.getElementById('hall_id');--}}
{{--        const dateInput = document.getElementById('exam_date');--}}
{{--        const timeGrid = document.getElementById('time_slots_grid');--}}
{{--        const selectedRoomDisplay = document.getElementById('selected_room');--}}
{{--        const startTimeInput = document.getElementById('start_time');--}}
{{--        const endTimeInput = document.getElementById('end_time');--}}
{{--        const examForm = document.getElementById('examForm');--}}
{{--        const formErrors = document.getElementById('formErrors');--}}
{{--        const modalSubmitButton = document.getElementById('submitBtn');--}}
{{--        const formMethod = document.getElementById('formMethod');--}}
{{--        const loadingIndicator = document.getElementById('loadingIndicator');--}}


{{--        let selectedSlots = [];--}}
{{--        let bookedSlots = [];--}}

{{--        // Инициализация на основни стойности--}}
{{--        const today = new Date();--}}
{{--        dateInput.value = today.toISOString().split('T')[0];--}}
{{--        // updateRoomDisplay();--}}

{{--        // Обработчик за подаване на формата--}}
{{--        examForm.addEventListener('submit', function(e) {--}}
{{--            if (!startTimeInput.value || !endTimeInput.value) {--}}
{{--                e.preventDefault();--}}
{{--                showFormError('Моля, изберете период за изпита от времевата мрежа.');--}}
{{--                return false;--}}
{{--            }--}}

{{--            if (selectedSlots.length === 0) {--}}
{{--                e.preventDefault();--}}
{{--                showFormError('Моля, изберете поне един времеви слот.');--}}
{{--                return false;--}}
{{--            }--}}

{{--            return true;--}}
{{--        });--}}

{{--        // Event Listeners--}}
{{--        hallSelect.addEventListener('change', function() {--}}
{{--            updateRoomDisplay();--}}
{{--            fetchBookedSlots();--}}

{{--        });--}}

{{--        dateInput.addEventListener('change', function() {--}}

{{--            generateTimeSlots();--}}
{{--            fetchBookedSlots();--}}

{{--        });--}}

{{--        // Помощни функции--}}
{{--        function showFormError(message) {--}}
{{--            formErrors.textContent = message;--}}
{{--            formErrors.classList.remove('hidden');--}}
{{--            setTimeout(() => {--}}
{{--                formErrors.classList.add('hidden');--}}
{{--            }, 5000);--}}
{{--        }--}}

{{--        function updateRoomDisplay() {--}}
{{--            if (hallSelect.selectedIndex >= 0) {--}}
{{--                const selectedRoom = hallSelect.options[hallSelect.selectedIndex].text;--}}
{{--                selectedRoomDisplay.textContent = selectedRoom;--}}
{{--            }--}}
{{--        }--}}

{{--        function isPastDate(dateString) {--}}
{{--            const today = new Date();--}}
{{--            today.setHours(0, 0, 0, 0);--}}
{{--            return new Date(dateString) < today;--}}
{{--        }--}}

{{--        function isWithin48Hours(examDate) {--}}
{{--            const now = new Date();--}}
{{--            const hourDifference = Math.abs(examDate - now) / (1000 * 60 * 60);--}}
{{--            return hourDifference < 48;--}}
{{--        }--}}

{{--        function isValidDate(date, time = '00:00') {--}}
{{--            const examDate = new Date(`${date}T${time}`);--}}
{{--            return !isPastDate(date) && !isWithin48Hours(examDate);--}}
{{--        }--}}

{{--        function calculateExamDuration(slots) {--}}
{{--            return (slots.length * 45) + (Math.max(slots.length - 1, 0) * 15);--}}
{{--        }--}}

{{--        function generateTimeSlots() {--}}
{{--            if (!timeGrid) return;--}}

{{--            timeGrid.innerHTML = '';--}}
{{--            const selectedDate = dateInput.value;--}}
{{--            const timeSlots = [--}}
{{--                '07:00', '08:00', '09:00', '10:00', '11:00', '12:00',--}}
{{--                '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'--}}
{{--            ];--}}

{{--            let hasValidSlot = false;--}}

{{--            timeSlots.forEach(time => {--}}
{{--                const slot = document.createElement('button');--}}
{{--                slot.type = 'button';--}}
{{--                slot.className = 'time-slot py-3 rounded-lg text-white font-medium bg-green-500 hover:bg-green-600 transition-colors';--}}
{{--                slot.dataset.time = time;--}}
{{--                slot.textContent = time;--}}

{{--                if (!isValidDate(selectedDate, time)) {--}}
{{--                    slot.disabled = true;--}}
{{--                    slot.classList.replace('bg-green-500', 'bg-gray-300');--}}
{{--                    slot.classList.add('cursor-not-allowed')--}}
{{--                    slot.classList.remove('hover:bg-green-600');--}}
{{--                    slot.title = "Моля, изберете валидни дата и час за изпита.";--}}
{{--                } else {--}}
{{--                    hasValidSlot = true;--}}
{{--                    slot.addEventListener('click', () => selectTimeSlot(slot));--}}
{{--                }--}}

{{--                timeGrid.appendChild(slot);--}}
{{--            });--}}

{{--            updateFormState(hasValidSlot);--}}
{{--            checkBookedSlots();--}}
{{--        }--}}

{{--        function updateFormState(hasValidSlot) {--}}
{{--            if (!formErrors || !modalSubmitButton) return;--}}

{{--            if (hasValidSlot) {--}}
{{--                formErrors.classList.add('hidden');--}}
{{--                modalSubmitButton.disabled = false;--}}
{{--                modalSubmitButton.classList.remove('bg-gray-300');--}}
{{--                modalSubmitButton.classList.add('bg-blue-600', 'hover:bg-blue-700');--}}
{{--            } else {--}}
{{--                formErrors.textContent = "Не може да създавате изпити за минали дати или по-малко от 48 часа от сега.";--}}
{{--                formErrors.classList.remove('hidden');--}}
{{--                modalSubmitButton.disabled = true;--}}
{{--                modalSubmitButton.classList.remove('bg-blue-600', 'hover:bg-blue-700');--}}
{{--                modalSubmitButton.classList.add('bg-gray-300');--}}
{{--            }--}}
{{--        }--}}

{{--        // Функция за избор на слот--}}
{{--        function selectTimeSlot(slot) {--}}
{{--            if (slot.disabled) return;--}}

{{--            const timeValue = slot.dataset.time;--}}
{{--            const allSlots = Array.from(document.querySelectorAll('.time-slot:not([disabled])'))--}}
{{--                .map(s => s.dataset.time)--}}
{{--                .sort();--}}

{{--            const currentIndex = allSlots.indexOf(timeValue);--}}

{{--            if (selectedSlots.includes(timeValue)) {--}}
{{--                const index = selectedSlots.indexOf(timeValue);--}}
{{--                selectedSlots = selectedSlots.slice(0, index);--}}
{{--            } else {--}}
{{--                if (selectedSlots.length === 0) {--}}
{{--                    selectedSlots.push(timeValue);--}}
{{--                } else {--}}
{{--                    const lastSlot = selectedSlots[selectedSlots.length - 1];--}}
{{--                    const lastIndex = allSlots.indexOf(lastSlot);--}}

{{--                    if (currentIndex === lastIndex + 1) {--}}
{{--                        selectedSlots.push(timeValue);--}}
{{--                    } else {--}}
{{--                        selectedSlots = [timeValue];--}}
{{--                    }--}}
{{--                }--}}
{{--            }--}}

{{--            updateSelectedSlots();--}}
{{--        }--}}

{{--        function updateSelectedSlots() {--}}
{{--            document.querySelectorAll('.time-slot').forEach(slot => {--}}
{{--                if (!slot.disabled) {--}}
{{--                    if (selectedSlots.includes(slot.dataset.time)) {--}}
{{--                        slot.classList.replace('bg-green-500', 'bg-blue-500');--}}
{{--                    } else {--}}
{{--                        slot.classList.replace('bg-blue-500', 'bg-green-500');--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}

{{--            if (selectedSlots.length > 0) {--}}
{{--                const selectedDate = dateInput.value;--}}
{{--                const firstSlot = selectedSlots[0];--}}
{{--                const totalMinutes = calculateExamDuration(selectedSlots);--}}

{{--                const startDateTime = new Date(`${selectedDate}T${firstSlot}:00`);--}}
{{--                const endDateTime = new Date(startDateTime.getTime() + totalMinutes * 60000);--}}

{{--                startTimeInput.value = formatDateTime(startDateTime);--}}
{{--                endTimeInput.value = formatDateTime(endDateTime);--}}
{{--            } else {--}}
{{--                startTimeInput.value = '';--}}
{{--                endTimeInput.value = '';--}}
{{--            }--}}
{{--        }--}}

{{--        function formatDateTime(date) {--}}
{{--            return [--}}
{{--                date.getFullYear(),--}}
{{--                String(date.getMonth() + 1).padStart(2, '0'),--}}
{{--                String(date.getDate()).padStart(2, '0')--}}
{{--            ].join('-') + ' ' + [--}}
{{--                String(date.getHours()).padStart(2, '0'),--}}
{{--                String(date.getMinutes()).padStart(2, '0'),--}}
{{--                '00'--}}
{{--            ].join(':');--}}
{{--        }--}}

{{--        // Функция за зареждане на заетите слотове--}}
{{--        async function fetchBookedSlots(excludeExamId=null) {--}}
{{--            const selectedDate = dateInput.value;--}}
{{--            const selectedHallId = hallSelect.value;--}}

{{--            if (!selectedDate || !selectedHallId) return;--}}

{{--            // Показване на индикатор за зареждане--}}
{{--            if (loadingIndicator) loadingIndicator.classList.remove('hidden');--}}

{{--            try {--}}

{{--                const url = `{{ route('exams.booked-slots') }}?date=${encodeURIComponent(selectedDate)}&hall_id=${encodeURIComponent(selectedHallId)}${excludeExamId ? `&exclude_exam_id=${excludeExamId}`:''}`;--}}

{{--                const response = await fetch(url);--}}

{{--                if (!response.ok) throw new Error('Грешка при зареждане');--}}

{{--                const data = await response.json();--}}
{{--                bookedSlots = data.bookedSlots || [];--}}
{{--                checkBookedSlots();--}}
{{--            } catch (error) {--}}
{{--                console.error('Грешка при зареждане на заетите слотове:', error);--}}
{{--                showFormError('Възникна проблем при зареждането на заетите часове');--}}
{{--            } finally {--}}
{{--                if (loadingIndicator) loadingIndicator.classList.add('hidden');--}}
{{--            }--}}
{{--        }--}}

{{--        function checkBookedSlots() {--}}
{{--            const selectedDate = dateInput.value;--}}

{{--            document.querySelectorAll('.time-slot').forEach(slot => {--}}
{{--                if (!slot.disabled) {--}}
{{--                    slot.classList.replace('bg-red-500', 'bg-green-500');--}}
{{--                    slot.disabled = false;--}}
{{--                }--}}
{{--            });--}}

{{--            if (!Array.isArray(bookedSlots)) return;--}}

{{--            bookedSlots.forEach(booking => {--}}
{{--                try {--}}
{{--                    if (!booking.start || !booking.end) return;--}}

{{--                    const bookingDate = booking.start.split('T')[0];--}}
{{--                    if (bookingDate !== selectedDate) return;--}}

{{--                    const startTime = booking.start.split('T')[1].substring(0, 5);--}}
{{--                    const endTime = booking.end.split('T')[1].substring(0, 5);--}}

{{--                    document.querySelectorAll('.time-slot').forEach(slot => {--}}
{{--                        const slotTime = slot.dataset.time;--}}
{{--                        if (slotTime >= startTime && slotTime < endTime) {--}}
{{--                            slot.classList.replace('bg-green-500', 'bg-red-500');--}}
{{--                            slot.disabled = true;--}}
{{--                        }--}}
{{--                    });--}}
{{--                } catch (error) {--}}
{{--                    console.error('Грешка при обработка на слот:', error);--}}
{{--                }--}}
{{--            });--}}

{{--            updateSelectedSlots();--}}
{{--        }--}}

{{--        // Функции за управление на модала--}}
{{--        window.resetExamForm = function() {--}}
{{--            document.getElementById('modalTitle').textContent = 'Създаване на нов изпит';--}}
{{--            document.getElementById('submitBtn').textContent="Създай";--}}

{{--            examForm.action = "{{ route('exams.store') }}";--}}
{{--            formMethod.value = 'POST';--}}
{{--            examForm.reset();--}}

{{--            document.querySelector('[name="subject_id"]').disabled = false;--}}
{{--            document.querySelector('[name="exam_type"]').disabled = false;--}}

{{--            // Задаване на днешна дата--}}
{{--            dateInput.value = today.toISOString().split('T')[0];--}}
{{--            updateRoomDisplay();--}}

{{--            selectedSlots = [];--}}
{{--            generateTimeSlots();--}}
{{--            fetchBookedSlots();--}}
{{--        };--}}

{{--        window.openEditModal = function(examId) {--}}
{{--            document.getElementById('modalTitle').textContent = 'Редактиране на изпит';--}}
{{--            document.getElementById('submitBtn').textContent="Редактирай";--}}
{{--            const baseUrl = "{{ route('exams.update', ['examId' => ':idExam']) }}";--}}

{{--            examForm.action = baseUrl.replace(':idExam',examId);--}}
{{--            formMethod.value = 'PUT';--}}

{{--            fetch(`/teacher/exam/${examId}/edit-data`)--}}
{{--                .then(res => res.json())--}}
{{--                .then(data => {--}}
{{--                    console.log(data)--}}
{{--                    document.querySelector('[name="subject_id"]').value = data.subject_id;--}}
{{--                    document.querySelector('[name="exam_type"]').value = data.exam_type;--}}
{{--                    document.querySelector('[name="max_students"]').value = data.max_students;--}}
{{--                    document.querySelector('[name="hall_id"]').value = data.hall_id;--}}
{{--                    dateInput.value = data.start_time.substring(0, 10);--}}

{{--                    document.querySelector('[name="subject_id"]').readonly = true;--}}
{{--                    document.querySelector('[name="exam_type"]').readonly = true;--}}

{{--                    updateRoomDisplay();--}}
{{--                    generateTimeSlots();--}}
{{--                    fetchBookedSlots(examId);--}}
{{--                })--}}
{{--                .catch(error => {--}}
{{--                    console.error('Грешка при зареждане на данните за изпит:', error);--}}
{{--                    showFormError('Грешка при зареждане на данните за изпит');--}}
{{--                });--}}
{{--        };--}}

{{--        // Деактивиране на бутони за редактиране на изпити, които започват след по-малко от 48 часа--}}
{{--        document.querySelectorAll('.edit-exam-btn').forEach(button => {--}}
{{--            const examDateString = button.getAttribute('data-exam-date');--}}
{{--            const examDate = new Date(examDateString);--}}
{{--            const hoursDifference = (examDate - new Date()) / (1000 * 60 * 60);--}}

{{--            if (hoursDifference < 48) {--}}
{{--                button.disabled = true;--}}
{{--                button.classList.replace('bg-blue-600', 'bg-gray-300');--}}
{{--                button.classList.add('cursor-not-allowed');--}}
{{--                button.classList.remove('hover:bg-blue-700');--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}

{{--<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}

{{--<style>--}}
{{--    .bg-green-50, .bg-red-50{--}}
{{--        transition: opacity 0.3s ease;--}}
{{--        position: relative; /* Задължително за позициониране на бутона */--}}
{{--    }--}}
{{--</style>--}}

{{--</body>--}}
{{--</html>--}}
<html lang="bg">
@include('partials.head')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden" x-data="{ showModal: false }">
@include('partials.header')

<div class="page-layout">
    @include('partials.sidebar')

    <main class="p-4 lg:p-6 relative z-0">
        <div class="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Управление на изпити</h1>
                    <p class="text-sm text-gray-500 mt-1">Преглед на предстоящи изпити и възможност за добавяне</p>
                </div>
                <a href="{{ route('conducted_exams') }}" class="inline-flex items-center gap-1 px-4 py-2.5 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors">
                    <i class="fa-duotone fa-solid fa-folder-open"></i>
                    Изминали изпити
                </a>
            </div>
        </div>

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
                    <div class="flex flex-col bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px]">
                        <!-- Съдържание на картата за изпит -->
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

                        <button @click="openEditModal({{$exam->id}});showModal=true"
                                class="mt-auto edit-exam-btn w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 bg-blue-600 hover:bg-blue-700"
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
            </div>
        @endif
    </main>
</div>

<!-- Create Exam Modal -->
<div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 mx-4 relative z-50" @click.outside="showModal = false">
        <h3 class="text-xl font-bold text-gray-900 mb-4" id="modalTitle">Създаване на нов изпит</h3>

        <form method="POST" action="{{ route('exams.store') }}" id="examForm">
            @csrf
            <div class="space-y-4">
                <div>
                    <input type="hidden" name="_method" id="formMethod" value="POST">

                    <label class="block text-sm font-medium text-gray-700 mb-2">Дисциплина</label>
                    <select name="subject_id" id="subject_id" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->subject_name }} (Сем. {{ $subject->semester }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Тип изпит</label>
                        <select name="exam_type" id="exam_type" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">
                            <option value="редовен">Редовен</option>
                            <option value="поправителен">Поправителен</option>
                            <option value="ликвидация">Ликвидация</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Макс. студенти</label>
                        <input type="number" name="max_students" id="max_students" required min="1" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 transition-all">
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
        const subjectSelect = document.getElementById('subject_id');
        const examTypeSelect = document.getElementById('exam_type');


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

            // Разблокиране на всички полета при създаване на нов изпит
            subjectSelect.disabled = false;
            examTypeSelect.disabled = false;
            document.getElementById('max_students').disabled = false;
            hallSelect.disabled = false;
            dateInput.disabled = false;

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

                    // Блокиране на дисциплина и тип изпит при редактиране
                    subjectSelect.disabled = true;
                    examTypeSelect.disabled = true;

                    // Оставяне на другите полета за редактиране
                    document.getElementById('max_students').disabled = false;
                    hallSelect.disabled = false;
                    dateInput.disabled = false;

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

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    .bg-green-50, .bg-red-50{
        transition: opacity 0.3s ease;
        position: relative; /* Задължително за позициониране на бутона */
    }

    /* Стил за забранени полета */
    select:disabled, input:disabled {
        background-color: #f3f4f6;
        color: #6b7280;
        cursor: not-allowed;
    }
</style>

</body>
</html>
