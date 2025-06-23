<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
@if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800 flex items-start gap-3 relative">
        <div class="mt-0.5 flex-shrink-0">
            <i class="fas fa-check-circle text-green-500"></i>
        </div>
        <div>
            <p id class="font-medium">Успешно!</p>
            <p>{{ session('success') }}</p>

        </div>
        <button type="button" class="absolute top-3 right-3 text-green-500 hover:text-green-700">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-800 flex items-start gap-3 relative">
        <div class="mt-0.5 flex-shrink-0">
            <i class="fas fa-exclamation-circle text-red-500"></i>
        </div>
        <div>
            <p class="font-medium">Грешка!</p>
            <p>{{ session('error') }}</p>
        </div>
        <button type="button" class="absolute top-3 right-3 text-red-500 hover:text-red-700 ">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif
