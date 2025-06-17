<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Плащане за изпит</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="container mx-auto p-4">
    <div class="bg-white rounded-lg shadow-md p-6 max-w-md mx-auto">
        <h2 class="text-xl font-semibold mb-4">Плащане за изпит</h2>
        <p class="mb-2">Предмет: {{ $exam->subject->subject_name }}</p>
        <p class="mb-4">Сума: <span class="font-bold">{{ $exam->price }}</span> лв.</p>

        <form action="{{ route('payment.handle', $exam) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-1">Име на картата</label>
                <input type="text" class="w-full p-2 border rounded-md" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">Номер на карта</label>
                <input type="text" class="w-full p-2 border rounded-md" required>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block mb-1">Валидност</label>
                    <input type="text" class="w-full p-2 border rounded-md" placeholder="MM/ГГ" required>
                </div>
                <div>
                    <label class="block mb-1">CVV</label>
                    <input type="text" class="w-full p-2 border rounded-md" required>
                </div>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">
                Потвърди плащането
            </button>
        </form>
    </div>
</div>
</body>
</html>
