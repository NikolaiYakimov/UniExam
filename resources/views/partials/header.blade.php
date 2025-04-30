@props([
    'title'=>'Заглавие',
    'subtitle'=>'',
    'button'=>[]
])


<header class="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100 lg:mt-0 mt-20">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4 lg:ml-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">{{ $title}}</h1>
            @if($subtitle)
                <p class="text-sm text-gray-500 mt-1">{{ $subtitle }}</p>
            @endif
        </div>
        @if(!empty($button))
            <a href="{{ $button['route'] }}" class="inline-flex items-center gap-1 px-4 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-700 transition-colors">
                <i class="{{ $button['icon'] }}"></i>
                {{ $button['text'] }}
            </a>
        @endif
    </div>
</header>
