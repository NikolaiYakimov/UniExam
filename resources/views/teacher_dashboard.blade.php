    <!DOCTYPE html>
<html lang="bg">
@include('partials.head')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

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

        <div class="prose max-w-none mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Преподавателски профил</h2>
            <div class="flex items-center gap-4 text-gray-600 mt-4">
                <div class="flex-1">
                    <h1 class="text-xl font-semibold text-gray-900 mb-2">
                        {{ $teacher->title }} {{ $teacher->user->first_name }} {{ $teacher->user->second_name }} {{ $teacher->user->last_name }}
                    </h1>
                    <div class="flex items-center gap-4 flex-wrap">
                            <span class="flex items-center gap-1.5">
                                <i class="fas fa-envelope text-gray-400"></i>
                                {{ $teacher->user->email }}
                            </span>
                        <span class="flex items-center gap-1.5">
                                <i class="fas fa-clipboard-list text-gray-400"></i>
                                {{ $teacher->exams_count }} активни изпита
                            </span>
                    </div>
                </div>
            </div>
        </div>

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
                        <form method="POST" action="{{ route('student.exam.register', $exam) }} "  class ="mt-auto">
                            @csrf
                            <button type="submit"
                                    data-exam-date="{{ $exam->start_time }}"
                                    class="edit-exam-btn w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 bg-blue-600 hover:bg-blue-700">
                                <i class="fa-solid fa-file-pen"></i> Редактирай изпит
                            </button>
                        </form>
                    </div>
                @endforeach

                <div class="flex items-center justify-center">
                    <button @click="showModal = true" class="w-16 h-16 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white shadow-xl flex items-center justify-center transition-all duration-300 hover:rotate-90">
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
<div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 mx-4" @click.outside="showModal = false">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Създаване на нов изпит</h3>

        <form method="POST" action="{{ route('exams.store') }}" id="examForm">
            @csrf
            <div class="space-y-4">
                <div>
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
document.addEventListener('DOMContentLoaded',function (){
   const editButtons=document.querySelectorAll('.edit-exam-btn');
   const currentDate=new Date();

   editButtons.forEach(button=>{
       const examDateString=button.getAttribute('data-exam-date');
       const examDate=new Date(examDateString);

       const examDifference=(examDate-currentDate)/(1000*60*60);
       if(examDifference<48){
           button.disabled=true;
           button.classList.remove('bg-blue-600', 'hover:bg-blue-700');
           button.classList.add('bg-gray-300', 'cursor-not-allowed');
       }
   })

});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const hallSelect = document.getElementById('hall_id');
    const dateInput = document.getElementById('exam_date');
    const timeGrid = document.getElementById('time_slots_grid');
    const selectedRoomDisplay = document.getElementById('selected_room');
    const startTimeInput = document.getElementById('start_time');
    const endTimeInput = document.getElementById('end_time');
    const examForm = document.getElementById('examForm');
    const formErrors = document.getElementById('formErrors');

    // Set default date to today
    const today = new Date();
    dateInput.value = today.toISOString().split('T')[0];

    // Store selected time slots
    let selectedSlots = [];
    let bookedSlots = @json($bookedSlots ?? []);

    // Form submission handling
    examForm.addEventListener('submit', function(e) {
        // Check if start and end time are set
        if (!startTimeInput.value || !endTimeInput.value) {
            e.preventDefault();
            alert('Моля, изберете период за изпита от времевата мрежа.');
            return false;
        }

        // Check if at least one time slot is selected
        if (selectedSlots.length === 0) {
            e.preventDefault();
            alert('Моля, изберете поне един времеви слот.');
            return false;
        }

        if (selectedSlots.length < 1) {
            e.preventDefault();
            alert('Изпитът трябва да е поне 45 минути.');
            return false;
        }

        return true;
    });

    // Initialize time slots when page loads
    updateRoomDisplay();
    generateTimeSlots();

    // Force fetch booked slots on initial load
    setTimeout(fetchBookedSlots, 300);

    // Re-fetch booked slots when tab becomes visible again
    document.addEventListener('visibilitychange', function() {
        if (document.visibilityState === 'visible') {
            console.log('Tab became visible, refreshing booked slots');
            fetchBookedSlots();
        }
    });

    // Update time slots when room or date changes
    hallSelect.addEventListener('change', function() {
        console.log('Hall changed, fetching new booked slots');
        updateRoomDisplay();
        fetchBookedSlots();
    });

    dateInput.addEventListener('change', function() {
        console.log('Date changed to:', dateInput.value, 'fetching new booked slots');
        generateTimeSlots();
        fetchBookedSlots();
    });

    // When the modal opens, refresh the booked slots
    if (typeof Alpine !== 'undefined') {
        document.addEventListener('alpine:initialized', function() {
            document.querySelectorAll('[x-data]').forEach(el => {
                if (el.getAttribute('x-data').includes('showModal')) {
                    el.__x.$watch('showModal', value => {
                        if (value === true) {
                            console.log('Modal opened, refreshing booked slots');
                            setTimeout(fetchBookedSlots, 100); // Small delay to ensure DOM is ready
                        }
                    });
                }
            });
        });
    }

    function isPastDate(dateString){
        const today= new Date();
        today.setHours(0,0,0,0);
        return new Date(dateString)<today;
    }
    function isWithin48Hours(selectedDate,time){
        const selectedDateTime=new Date(`${selectedDate}T${time}:00`);
        const now=new Date();
        const hourDifference=Math.abs(selectedDateTime-now)/(1000*60*60);
        return hourDifference<48;
    }


    function updateRoomDisplay() {
        const selectedRoom = hallSelect.options[hallSelect.selectedIndex].text;
        selectedRoomDisplay.textContent = selectedRoom;
    }

    function fetchBookedSlots() {
        const selectedDate = dateInput.value;
        const selectedHallId = hallSelect.value;

        console.log(`Fetching booked slots for date=${selectedDate}, hall_id=${selectedHallId}`);

        if (!selectedDate || !selectedHallId) {
            console.warn('Missing date or hall_id, cannot fetch booked slots');
            return;
        }

        // Show loading state
        document.querySelectorAll('.time-slot').forEach(slot => {
            slot.classList.add('opacity-50');
        });

        // Clear selected slots when date/room changes
        selectedSlots = [];
        startTimeInput.value = '';
        endTimeInput.value = '';

        // Construct the URL with the query parameters
        const url = `{{ route('exams.booked-slots') }}?date=${encodeURIComponent(selectedDate)}&hall_id=${encodeURIComponent(selectedHallId)}`;
        console.log('Fetching from URL:', url);

        // Fetch booked slots from the server for this specific date and hall
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    console.error('Server responded with error:', response.status);
                    throw new Error('Failed to fetch booked slots');
                }
                return response.json();
            })
            .then(data => {
                console.log('Fetched booked slots:', data.bookedSlots);
                bookedSlots = data.bookedSlots;
                checkBookedSlots();

                // Remove loading state
                document.querySelectorAll('.time-slot').forEach(slot => {
                    slot.classList.remove('opacity-50');
                });
            })
            .catch(error => {
                console.error('Error fetching booked slots:', error);

                // Remove loading state
                document.querySelectorAll('.time-slot').forEach(slot => {
                    slot.classList.remove('opacity-50');
                });

                // Show error message
                alert('Грешка при зареждане на заетите часове. Моля, опитайте отново.');
            });
    }

    function checkBookedSlots() {
        const selectedDate = dateInput.value;

        console.log('Checking booked slots for date:', selectedDate);
        console.log('Total booked slots in memory:', bookedSlots.length);

        // Reset all slots to available
        document.querySelectorAll('.time-slot').forEach(slot => {
            slot.classList.remove('bg-red-500', 'bg-green-500', 'bg-blue-500');
            slot.classList.add('bg-green-500');
            slot.disabled = false;
        });

        // Mark booked slots as unavailable
        let bookedCount = 0;

        if (!Array.isArray(bookedSlots)) {
            console.error('bookedSlots is not an array:', bookedSlots);
            return;
        }
        console.log(bookedCount)
        bookedSlots.forEach(booking => {
            try {
                if (!booking.start || !booking.end) {
                    console.warn('Invalid booking data:', booking);
                    return;
                }

                const bookingDate = booking.start.split('T')[0];

                if (bookingDate === selectedDate) {
                    const startTime = booking.start.split('T')[1].substring(0, 5);
                    const endTime = booking.end.split('T')[1].substring(0, 5);

                    console.log(`Found booked slot for current date: ${startTime} to ${endTime}`);
                    bookedCount++;

                    document.querySelectorAll('.time-slot').forEach(slot => {
                        const slotTime = slot.dataset.time;

                        // If slot time is between start and end of booking
                        if (slotTime >= startTime && slotTime < endTime) {
                            slot.classList.remove('bg-green-500');
                            slot.classList.add('bg-red-500');
                            slot.disabled = true;
                        }
                    });
                }
            } catch (error) {
                console.error('Error processing booking:', booking, error);
            }
        });

        console.log(`Marked ${bookedCount} slots as booked for date ${selectedDate}`);

        // Update selected slots
        updateSelectedSlots();
    }

    function generateTimeSlots() {
        timeGrid.innerHTML = '';
        const selectedDate=dateInput.value;

        if(isPastDate(selectedDate)){
            timeGrid.innerHTML='<div class="col-span-3 text-center py-4 text-red-600">Не можете да създавате изпити за минали дати!</div>';
            return;
        }


        const timeSlots = [
            // Row 1
            '07:00', '08:00', '09:00',
            // Row 2
            '10:00', '11:00', '12:00',
            // Row 3
            '13:00', '14:00','15:00',
            //Row 4
            '16:00', '17:00', '18:00',

        ];

        // Add all time slots to the grid
        timeSlots.forEach(time => {
            const slot = document.createElement('button');
            slot.type = 'button';
            slot.className = 'time-slot py-3 rounded-lg text-white font-medium bg-green-500 hover:bg-green-600 transition-colors';
            slot.dataset.time = time;
            slot.textContent = time;

            if(isWithin48Hours(selectedDate,time)){
                console.log('Greyyy');

                slot.classList.remove('bg-green-500', 'hover:bg-green-600', 'transition-colors');
                slot.classList.add('bg-gray-300', 'cursor-not-allowed');
                slot.title = "Моля, изберете валидни дата и час за изпита. Те трябва да бъдат поне 48 часа след настоящия момент.";
                slot.disabled = true;
            }
            console.log( 'HERE');
            console.log( slot);
            slot.addEventListener('click', function() {
                if (!slot.disabled) {
                    selectTimeSlot(slot);
                }
            });
            console.log( slot.disabled);
            timeGrid.appendChild(slot);
        });

        checkBookedSlots();
    }

    function selectTimeSlot(slot) {
        // const timeValue = slot.dataset.time;
        //
        // // If slot is already selected, deselect it and all slots after it
        // if (selectedSlots.includes(timeValue)) {
        //     const index = selectedSlots.indexOf(timeValue);
        //     selectedSlots = selectedSlots.slice(0, index);
        // } else {
        //     // Sort time slots to find consecutive ones
        //     const allTimeSlots = Array.from(document.querySelectorAll('.time-slot:not([disabled])'))
        //         .map(s => s.dataset.time)
        //         .sort();
        //
        //     // If no slots selected yet, add this one
        //     if (selectedSlots.length === 0) {
        //         selectedSlots.push(timeValue);
        //     } else {
        //         // Get current slot index and the last selected slot index
        //         const currentSlotIndex = allTimeSlots.indexOf(timeValue);
        //         const lastSelectedSlot = selectedSlots[selectedSlots.length - 1];
        //         const lastSelectedIndex = allTimeSlots.indexOf(lastSelectedSlot);
        //
        //         // Check if this slot is consecutive to the last selected slot
        //         if (currentSlotIndex === lastSelectedIndex + 1) {
        //             console.log('AAA')
        //             // If consecutive, add to selection
        //             selectedSlots.push(timeValue);
        //         } else {
        //             // If not consecutive or earlier in the list, start a new selection
        //             selectedSlots = [timeValue];
        //             updateSelectedSlots();
        //         }
        //     }
        // }
        //
        // updateSelectedSlots();
        const timeValue = slot.dataset.time;

        const allTimeSlots = Array.from(document.querySelectorAll('.time-slot:not([disabled])'))
            .map(s => s.dataset.time)
            .sort();

        const currentSlotIndex = allTimeSlots.indexOf(timeValue);

        if (selectedSlots.includes(timeValue)) {
            const index = selectedSlots.indexOf(timeValue);
            selectedSlots = selectedSlots.slice(0, index);
        } else {
            if (selectedSlots.length === 0) {

                selectedSlots.push(timeValue);
            } else {
                const lastSelectedSlot = selectedSlots[selectedSlots.length - 1];
                const lastSelectedIndex = allTimeSlots.indexOf(lastSelectedSlot);

                // Проверка дали слотът е директно след последния
                if (currentSlotIndex === lastSelectedIndex + 1) {
                    selectedSlots.push(timeValue);
                } else {
                    // Ако не е последователен -> нулирай избора
                    selectedSlots = [timeValue];
                }
            }
        }

        updateSelectedSlots();
    }

    function updateSelectedSlots() {
        console.log(selectedSlots)
        // Update visual representation
        document.querySelectorAll('.time-slot').forEach(slot => {
            if (!slot.disabled) {
                if (selectedSlots.includes(slot.dataset.time)) {
                    slot.classList.remove('bg-green-500');
                    slot.classList.add('bg-blue-500');
                } else {
                    slot.classList.remove('bg-blue-500');
                    slot.classList.add('bg-green-500');
                }
            }
        });

        // // Update hidden inputs for form submission
        // if (selectedSlots.length > 0) {
        //     const selectedDate = dateInput.value;
        //
        //     // Sort slots to ensure correct order
        //     selectedSlots.sort();
        //
        //     // For the start time, use the first selected slot
        //     const firstSlot = selectedSlots[0];
        //     // Format date as YYYY-MM-DD HH:MM:SS for Laravel
        //     startTimeInput.value = `${selectedDate} ${firstSlot}:00`;
        //
        //     // For the end time, calculate the end time based on the duration
        //     // Assume each slot is 45 minutes long
        //     const lastSlot = selectedSlots[selectedSlots.length - 1];
        //
        //     // Parse the last slot time
        //     let [lastHours, lastMinutes] = lastSlot.split(':').map(Number);
        //
        //     // Add 45 minutes for the end time
        //     let endHours = lastHours + Math.floor((lastMinutes + 45) / 60);
        //     let endMinutes = (lastMinutes + 45) % 60;
        //
        //     // Format the end time with seconds for Laravel datetime format
        //     const endTime = `${String(endHours).padStart(2, '0')}:${String(endMinutes).padStart(2, '0')}:00`;
        //     endTimeInput.value = `${selectedDate} ${endTime}`;
        //
        //     console.log("Form will submit with:", {
        //         start_time: startTimeInput.value,
        //         end_time: endTimeInput.value
        //     });
        // }

        // //Other one
        if (selectedSlots.length > 0) {
            const selectedDate = dateInput.value;
            const firstSlot = selectedSlots[0];

            // Set the breaks with max operator, so we can avoid negative numbers when we don't pick slot
            const totalMinutes = (selectedSlots.length * 45) +Math.max(selectedSlots.length-1)*15;

            const startDateTime = new Date(`${selectedDate}T${firstSlot}:00`);
            const endDateTime = new Date(startDateTime.getTime() + totalMinutes * 60000  );

            // Форматиране на времето
            const formatTime = (date) => {
                return [
                    date.getFullYear(),
                    (date.getMonth() + 1).toString().padStart(2, '0'),
                    date.getDate().toString().padStart(2, '0')
                ].join('-') + ' ' + [
                    date.getHours().toString().padStart(2, '0'),
                    date.getMinutes().toString().padStart(2, '0'),
                    '00'
                ].join(':');
            };

            startTimeInput.value = formatTime(startDateTime);
            endTimeInput.value = formatTime(endDateTime);

            console.log("Times:", startTimeInput.value, endTimeInput.value);
        }
        else {
            startTimeInput.value = '';
            endTimeInput.value = '';
        }
    }
});
</script>
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
