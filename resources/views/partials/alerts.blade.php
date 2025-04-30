@if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800 flex items-start gap-3">
        <div class="mt-0.5 flex-shrink-0">
            <i class="fas fa-check-circle text-green-500"></i>
        </div>
        <div>
            <p class="font-medium">Успешно!</p>
            <p>{{ session('success') }}</p>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-800 flex items-start gap-3">
        <div class="mt-0.5 flex-shrink-0">
            <i class="fas fa-exclamation-circle text-red-500"></i>
        </div>
        <div>
            <p class="font-medium">Грешка!</p>
            <p>{{ session('error') }}</p>
        </div>
    </div>
@endif
