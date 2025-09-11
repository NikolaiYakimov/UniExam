{{--<!DOCTYPE html>--}}
{{--<html lang="bg">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Управление на потребители</title>--}}
{{--    <script src="https://cdn.tailwindcss.com"></script>--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">--}}
{{--</head>--}}
{{--<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">--}}
{{--<!-- Header -->--}}
{{--@include('partials.header')--}}

{{--<div class="page-layout">--}}
{{--    <!-- Sidebar -->--}}
{{--    @include('partials.sidebar')--}}

{{--    <!-- Основно съдържание -->--}}
{{--    <div id="mainContent" class="ml-0 lg:ml-0 p-4 lg:p-8 transition-all duration-300">--}}
{{--        <!-- Page Header -->--}}
{{--        <div class="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">--}}
{{--            <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">--}}
{{--                <div>--}}
{{--                    <h1 class="text-2xl font-bold text-gray-800">Управление на потребители</h1>--}}
{{--                    <p class="text-sm text-gray-500 mt-1">Добавяне, редактиране и премахване на потребители</p>--}}
{{--                </div>--}}
{{--                <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-1 px-4 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-700 transition-colors">--}}
{{--                    <i class="fas fa-plus"></i>--}}
{{--                    Добави потребител--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        --}}{{-- Alerts --}}
{{--        @include('partials.alerts')--}}

{{--        <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">--}}
{{--            <div class="overflow-x-auto">--}}
{{--                <table class="min-w-full divide-y divide-gray-200">--}}
{{--                    <thead class="bg-gray-50">--}}
{{--                    <tr>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Име</th>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Имейл</th>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Телефон</th>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Роля</th>--}}
{{--                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Действия</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody class="bg-white divide-y divide-gray-200">--}}
{{--                    @foreach($users as $user)--}}
{{--                        <tr>--}}
{{--                            <td class="px-6 py-4 whitespace-nowrap">--}}
{{--                                <div class="text-sm font-medium text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</div>--}}
{{--                                <div class="text-sm text-gray-500">{{ $user->username }}</div>--}}
{{--                            </td>--}}
{{--                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">--}}
{{--                                {{ $user->email }}--}}
{{--                            </td>--}}
{{--                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">--}}
{{--                                {{ $user->phone }}--}}
{{--                            </td>--}}
{{--                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">--}}
{{--                                {{ $user->role }}--}}
{{--                            </td>--}}
{{--                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">--}}
{{--                                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">--}}
{{--                                    <i class="fas fa-edit"></i> Редактирай--}}
{{--                                </a>--}}
{{--                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Сигурни ли сте, че искате да изтриете този потребител?')">--}}
{{--                                        <i class="fas fa-trash"></i> Изтрий--}}
{{--                                    </button>--}}
{{--                                </form>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<script src="{{ asset('js/menuFunctions.js') }}" defer></script>--}}
{{--<script src="{{ asset('js/alertClosingFunctions.js') }}" defer></script>--}}
{{--</body>--}}
{{--</html>--}}
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление на потребители</title>
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
                    <h1 class="text-2xl font-bold text-gray-800">Управление на потребители</h1>
                    <p class="text-sm text-gray-500 mt-1">Добавяне, редактиране и премахване на потребители</p>
                </div>
                <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-1 px-4 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-700 transition-colors">
                    <i class="fas fa-plus"></i>
                    Добави потребител
                </a>
            </div>
        </div>

        {{-- Alerts --}}
        @include('partials.alerts')

        <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Име</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Имейл</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Телефон</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Роля</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Действия</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</div>
                                <div class="text-sm text-gray-500">{{ $user->username }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->phone }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->role }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    <i class="fas fa-edit"></i> Редактирай
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Сигурни ли сте, че искате да изтриете този потребител?')">
                                        <i class="fas fa-trash"></i> Изтрий
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/menuFunctions.js') }}" defer></script>
<script src="{{ asset('js/alertClosingFunctions.js') }}" defer></script>
</body>
</html>
