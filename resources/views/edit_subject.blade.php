<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактиране на дисциплина</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">
<!-- Header -->
@include('partials.header')

<div class="page-layout">
    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Основно съдържание -->
    <div id="mainContent" class="ml-0 lg:ml-0 p-4 lg:p-8 transition-all duration-300">
        <!-- Page Header -->
        <div class="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Редактиране на дисциплина</h1>
                    <p class="text-sm text-gray-500 mt-1">Променете информацията за дисциплината</p>
                </div>
                <a href="{{ route('admin.subjects.uni_subjects') }}" class="inline-flex items-center gap-1 px-4 py-3 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-700 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                    Назад към списъка
                </a>
            </div>
        </div>

        {{-- Alerts --}}
        @include('partials.alerts')

        <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm max-w-3xl">
            <form action="{{ route('admin.subjects.update', $subject->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div>
                        <label for="subject_name" class="block text-sm font-medium text-gray-700 mb-1">Име на дисциплина *</label>
                        <input type="text" name="subject_name" id="subject_name" value="{{ old('subject_name', $subject->subject_name) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Описание</label>
                        <textarea name="description" id="description" rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">{{ old('description', $subject->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="semester" class="block text-sm font-medium text-gray-700 mb-1">Семестър *</label>
                            <select name="semester" id="semester" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                                @for($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" {{ $subject->semester == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Цена (лв.) *</label>
                            <input type="number" step="0.01" min="0" name="price" id="price" value="{{ old('price', $subject->price) }}" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Специалности</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 max-h-60 overflow-y-auto p-2 border border-gray-200 rounded-md">
                            @foreach($specialties as $specialty)
                                <div class="flex items-center">
                                    <input type="checkbox" name="specialties[]" value="{{ $specialty->id }}" id="specialty_{{ $specialty->id }}"
                                           {{ in_array($specialty->id, $selectedSpecialties) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="specialty_{{ $specialty->id }}" class="ml-2 text-sm text-gray-700">{{ $specialty->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="{{ route('admin.subjects.uni_subjects') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            Отказ
                        </a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Запази промените
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/menuFunctions.js') }}" defer></script>
<script src="{{ asset('js/alertClosingFunctions.js') }}" defer></script>
</body>
</html>
