<!DOCTYPE html>
<html lang="bg">
@include('partials.head')
<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden">
@include('partials.sidebar')

<div class="ml-0 lg:ml-80 p-4 lg:p-8 transition-all duration-300">
    @include('partials.header', [
        'title' => "Детайли за изпит",
        'subtitle' => 'Въвеждане на оценки за студенти',
        'button' => [
            'route' => route('conducted_exams'),
            'text' => 'Обратно към изминали изпити',
            'icon' => 'fa-solid fa-arrow-left'
        ]
    ])

    <main>
        @include('partials.alerts')
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $exam->subject->subject_name }} - {{ $exam->exam_type }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600">
                <div>
                    <p><i class="fas fa-calendar-alt mr-2 text-gray-400"></i> Дата: <span class="font-medium">{{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y') }}</span></p>
                    <p><i class="fas fa-clock mr-2 text-gray-400"></i> Час: <span class="font-medium">{{ \Carbon\Carbon::parse($exam->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($exam->end_time)->format('H:i') }}</span></p>
                </div>
                <div>
                    <p><i class="fas fa-university mr-2 text-gray-400"></i> Зала: <span class="font-medium">{{ $exam->hall->name }}</span></p>
                    <p><i class="fas fa-users mr-2 text-gray-400"></i> Записани студенти: <span class="font-medium">{{ $exam->registrations->count() }}</span></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Списък със студенти</h3>

            <form action="{{ route('teacher.exam.grades.update', $exam->id) }}" method="POST">
                @csrf
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">№</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Факултетен №</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Име</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Оценка</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($exam->registrations as $index => $registration)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $registration->student->faculty_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $registration->student->user->first_name }}
                                    {{ $registration->student->user->last_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="number" name="grades[{{ $registration->id }}]"
                                           value="{{ $registration->grade }}"
                                           min="2" max="6" step="0.5"
                                           class="w-20 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                        Запази оценките
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>
<script src="{{asset('js/menuFunctions.js')}}" defer></script>
<script src="{{asset('js/alertClosingFunctions.js')}}" defer></script>
{{--@include('partials.footer')--}}
</body>
</html>
