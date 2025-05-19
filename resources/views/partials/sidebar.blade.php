<!-- Toggle button -->
<div class="lg:hidden fixed top-6 z-[100]" id="menuContainer">
    <button id="menuToggle" class="p-3.5 bg-indigo-50/80 backdrop-blur-sm rounded-xl shadow-lg hover:shadow-xl transition-all
           ring-1 ring-indigo-100 flex items-center justify-center ml-4">
        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>
</div>
{{--Navigation sidebar--}}
<aside id="sidebar" class="fixed left-[-100%] lg:left-0 top-0 h-screen w-72 lg:w-80 bg-white shadow-2xl p-6 border-r border-gray-100 transition-all duration-300 lg:translate-x-0 z-50">
    <div class="flex flex-col h-full">
        <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-4 border-b border-gray-100 flex items-center">

            <div class="w-10 h-10 rounded-lg  flex items-center justify-center mr-3 overflow-hidden ">
                <img src="{{ asset('images/tu-image.png') }}" alt="Лого" class="w-full h-full object-cover " loading="lazy">
            </div>
            Студентски профил
        </h2>

        <div class="space-y-5 flex-1">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-primary-100 flex items-center justify-center">
                    <i class="fas fa-user text-xl text-primary-600"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-900">{{ Auth::user()->first_name }} {{ Auth::user()->second_name }} {{ Auth::user()->last_name }}</p>
                    <p class="text-sm text-gray-500 mt-1">№: <span class="font-mono">{{ Auth::user()->faculty_number }}</span></p>
                </div>
            </div>

            <div class="space-y-3.5 mt-4">
                <div>
                    @if(Auth::user()->role==='student')
                    <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Специалност</p>
                    <p class="font-medium text-gray-800">{{ Auth::user()->student->major }}</p>
                    @elseif(Auth::user()->role==='teacher')
                        <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Факултет</p>
                        <p class="font-medium text-gray-800">{{ Auth::user()->teacher->faculty }}</p>
                    @endif

                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Потребителско име</p>
                    <p class="font-medium text-gray-800">{{ Auth::user()->username }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Майл</p>
                    <p class="font-medium text-gray-800">{{ Auth::user()->email }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Телефонен номер</p>
                    <p class="font-medium text-gray-800">{{ Auth::user()->phone }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Статус</p>
                    <p class="font-medium text-green-600 flex items-center gap-1.5">
                        <i class="fas fa-check-circle"></i>Активен
                    </p>
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-gray-100">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Изход от системата</span>
                </button>
            </form>
        </div>
    </div>
</aside>
