{{--@props([--}}
{{--    'title'=>'Заглавие',--}}
{{--    'subtitle'=>'',--}}
{{--    'button'=>[]--}}
{{--])--}}


{{--<header class="bg-white/90 backdrop-blur-md shadow-sm py-6 mb-8 rounded-xl border border-gray-100 lg:mt-0 mt-20">--}}
{{--    <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4 lg:ml-0">--}}
{{--        <div>--}}
{{--            <h1 class="text-2xl font-bold text-gray-800">{{ $title}}</h1>--}}
{{--            @if($subtitle)--}}
{{--                <p class="text-sm text-gray-500 mt-1">{{ $subtitle }}</p>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--        @if(!empty($button))--}}
{{--            <a href="{{ $button['route'] }}" class="inline-flex items-center gap-1 px-4 py-3 bg-green-500 text-white rounded-lg shadow hover:bg-green-700 transition-colors">--}}
{{--                <i class="{{ $button['icon'] }}"></i>--}}
{{--                {{ $button['text'] }}--}}
{{--            </a>--}}
{{--        @endif--}}
{{--    </div>--}}
{{--</header>--}}

{{--<header id="siteHeader" class="bg-white border-b border-gray-200 sticky top-0 z-30">--}}
{{--    <div class="container-fluid py-1 flex items-center gap-3 px-4 relative">--}}
{{--        <a class="navbar-brand m-4 text-xl font-semibold text-indigo-700">--}}
{{--            <i class="fas fa-graduation-cap"></i>--}}
{{--            UNI Portal--}}
{{--        </a>--}}

{{--        <div class="header-nav ms-10">--}}
{{--            <a class="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">--}}
{{--                <i class="fa fa-home me-2 text-gray-500"></i>Начало--}}
{{--            </a>--}}
{{--            <a class="nav-link flex items-center text-indigo-700 bg-indigo-50" href="{{ route('exams') }}">--}}
{{--                <i class="fa fa-file-pen me-2 text-indigo-600"></i>Достъпни изпити--}}
{{--            </a>--}}
{{--            <a class="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="{{route('my_exams')}}">--}}
{{--                <i class="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити--}}
{{--            </a>--}}
{{--            <a class="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">--}}
{{--                <i class="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити--}}
{{--            </a>--}}
{{--            <a class="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">--}}
{{--                <i class="fa fa-wallet me-2 text-gray-500"></i>Плащания--}}
{{--            </a>--}}
{{--            <a class="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="{{route('profile')}}">--}}
{{--                <i class="fas fa-user me-2 text-gray-500"></i>Моят профил--}}
{{--            </a>--}}
{{--        </div>--}}

{{--        <div class="d-flex align-items-center gap-3 ms-auto profile-section">--}}
{{--            <button class="mobile-nav-toggle" id="mobileNavToggle">--}}
{{--                <i class="fas fa-bars"></i>--}}
{{--            </button>--}}

{{--            @auth--}}
{{--                <div class="relative">--}}
{{--                    <button class="dropdown-toggle btn btn-outline-primary flex items-center gap-2 px-3 py-1.5 border border-indigo-300 rounded-full text-indigo-700 hover:bg-indigo-50">--}}
{{--                        <i class="fa fa-user-circle"></i> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}--}}
{{--                    </button>--}}
{{--                    <ul class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50 hidden">--}}
{{--                        <li><a class="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('profile') }}">Моят профил</a></li>--}}
{{--                        <li><hr class="dropdown-divider my-2 border-gray-200"></li>--}}
{{--                        <li>--}}
{{--                            <form method="post" action="{{ route('logout') }}">@csrf--}}
{{--                                <button class="dropdown-item text-danger block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100" type="submit">Изход</button>--}}
{{--                            </form>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            @else--}}
{{--                <div class="ms-auto ms-md-2">--}}
{{--                    <a class="btn btn-outline-primary" href="{{ route('login') }}">Вход</a>--}}
{{--                </div>--}}
{{--            @endauth--}}
{{--        </div>--}}

{{--        <div class="mobile-nav-dropdown" id="mobileNavDropdown">--}}
{{--            <a class="nav-link flex items-center text-gray-700" href="#">--}}
{{--                <i class="fa fa-home me-2 text-gray-500"></i>Начало--}}
{{--            </a>--}}
{{--            <a class="nav-link flex items-center text-indigo-700 bg-indigo-50" href="{{ route('exams') }}">--}}
{{--                <i class="fa fa-file-pen me-2 text-indigo-600"></i>Достъпни изпити--}}
{{--            </a>--}}
{{--            <a class="nav-link flex items-center text-gray-700" href="{{route('my_exams')}}">--}}
{{--                <i class="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити--}}
{{--            </a>--}}
{{--            <a class="nav-link flex items-center text-gray-700" href="#">--}}
{{--                <i class="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити--}}
{{--            </a>--}}
{{--            <a class="nav-link flex items-center text-gray-700" href="#">--}}
{{--                <i class="fa fa-wallet me-2 text-gray-500"></i>Плащания--}}
{{--            </a>--}}
{{--            <a class="nav-link flex items-center text-gray-700" href="{{route('profile')}}">--}}
{{--                <i class="fas fa-user me-2 text-gray-500"></i>Моят профил--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</header>--}}

{{--<script>--}}
{{--    // JavaScript за header функционалност--}}
{{--    document.addEventListener('DOMContentLoaded', function () {--}}
{{--        const header = document.getElementById('siteHeader');--}}
{{--        function setHeaderHeightVar(){--}}
{{--            const h = header.getBoundingClientRect().height;--}}
{{--            document.documentElement.style.setProperty('--header-h', h + 'px');--}}
{{--        }--}}
{{--        setHeaderHeightVar();--}}
{{--        window.addEventListener('resize', setHeaderHeightVar);--}}

{{--        // Dropdown за профил бутона--}}
{{--        const dropdownToggle = document.querySelector('.dropdown-toggle');--}}
{{--        const dropdownMenu = document.querySelector('.dropdown-menu');--}}

{{--        if (dropdownToggle && dropdownMenu) {--}}
{{--            dropdownToggle.addEventListener('click', function(e) {--}}
{{--                e.stopPropagation();--}}
{{--                dropdownMenu.classList.toggle('hidden');--}}
{{--            });--}}
{{--            document.addEventListener('click', function() {--}}
{{--                dropdownMenu.classList.add('hidden');--}}
{{--            });--}}
{{--            dropdownMenu.addEventListener('click', function(e) {--}}
{{--                e.stopPropagation();--}}
{{--            });--}}
{{--        }--}}

{{--        // Мобилно навигационно меню--}}
{{--        const mobileNavToggle = document.getElementById('mobileNavToggle');--}}
{{--        const mobileNavDropdown = document.getElementById('mobileNavDropdown');--}}

{{--        if (mobileNavToggle && mobileNavDropdown) {--}}
{{--            mobileNavToggle.addEventListener('click', function(e) {--}}
{{--                e.stopPropagation();--}}
{{--                mobileNavDropdown.classList.toggle('show');--}}
{{--            });--}}

{{--            document.addEventListener('click', function(e) {--}}
{{--                if (!mobileNavDropdown.contains(e.target) && !mobileNavToggle.contains(e.target)) {--}}
{{--                    mobileNavDropdown.classList.remove('show');--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}
<header id="siteHeader" class="bg-white border-b border-gray-200 sticky top-0 z-30">
    <div class="container-fluid py-1 flex items-center gap-3 px-4 relative">
        <a class="navbar-brand m-4 text-xl font-semibold text-indigo-700">
            <i class="fas fa-graduation-cap"></i>
            UNI Portal
        </a>

        <div class="header-nav ms-10">
            <a class="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">
                <i class="fa fa-home me-2 text-gray-500"></i>Начало
            </a>
            <a class="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="{{ route('exams') }}">
                <i class="fa fa-file-pen me-2 text-gray-500"></i>Достъпни изпити
            </a>
            @if(Auth::user()->role==='teacher')
            <a class="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="{{ route('conducted_exams') }}">
                <i class="fa fa-calendar me-2 text-gray-500"></i>Изминали изпити
            </a>
            @else
                <a class="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="{{ route('my_exams') }}">
                    <i class="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
                </a>
            @endif
            <a class="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">
                <i class="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
            </a>
            <a class="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">
                <i class="fa fa-wallet me-2 text-gray-500"></i>Плащания
            </a>
            <a class="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="{{ route('profile') }}">
                <i class="fas fa-user me-2 text-gray-500"></i>Моят профил
            </a>
        </div>

        <div class="d-flex align-items-center gap-3 ms-auto profile-section">
            <button class="mobile-nav-toggle" id="mobileNavToggle">
                <i class="fas fa-bars"></i>
            </button>

            @auth
                <div class="relative">
                    <button class="dropdown-toggle btn btn-outline-primary flex items-center gap-2 px-3 py-1.5 border border-indigo-300 rounded-full text-indigo-700 hover:bg-indigo-50">
                        <i class="fa fa-user-circle"></i> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    </button>
                    <ul class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50 hidden">
                        <li><a class="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('profile') }}">Моят профил</a></li>
                        <li><hr class="dropdown-divider my-2 border-gray-200"></li>
                        <li>
                            <form method="post" action="{{ route('logout') }}">@csrf
                                <button class="dropdown-item text-danger block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100" type="submit">Изход</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <div class="ms-auto ms-md-2">
                    <a class="btn btn-outline-primary" href="{{ route('login') }}">Вход</a>
                </div>
            @endauth
        </div>

        <div class="mobile-nav-dropdown" id="mobileNavDropdown">
            <a class="nav-link flex items-center text-gray-700" href="#">
                <i class="fa fa-home me-2 text-gray-500"></i>Начало
            </a>
            <a class="nav-link flex items-center text-gray-700" href="{{ route('exams') }}">
                <i class="fa fa-file-pen me-2 text-gray-500"></i>Достъпни изпити
            </a>
            <a class="nav-link flex items-center text-gray-700" href="{{ route('my_exams') }}">
                <i class="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
            </a>
            <a class="nav-link flex items-center text-gray-700" href="#">
                <i class="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
            </a>
            <a class="nav-link flex items-center text-gray-700" href="#">
                <i class="fa fa-wallet me-2 text-gray-500"></i>Плащания
            </a>
            <a class="nav-link flex items-center text-gray-700" href="{{ route('profile') }}">
                <i class="fas fa-user me-2 text-gray-500"></i>Моят профил
            </a>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const header = document.getElementById('siteHeader');

        function setHeaderHeightVar() {
            const h = header.getBoundingClientRect().height;
            document.documentElement.style.setProperty('--header-h', h + 'px');
        }

        setHeaderHeightVar();
        window.addEventListener('resize', setHeaderHeightVar);

        // Dropdown за профил бутона
        const dropdownToggle = document.querySelector('.dropdown-toggle');
        const dropdownMenu = document.querySelector('.dropdown-menu');

        if (dropdownToggle && dropdownMenu) {
            dropdownToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', function() {
                dropdownMenu.classList.add('hidden');
            });

            dropdownMenu.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }

        // Мобилно навигационно меню
        const mobileNavToggle = document.getElementById('mobileNavToggle');
        const mobileNavDropdown = document.getElementById('mobileNavDropdown');

        if (mobileNavToggle && mobileNavDropdown) {
            mobileNavToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                mobileNavDropdown.classList.add('show');
            });

            document.addEventListener('click', function(e) {
                if (!mobileNavDropdown.contains(e.target) && !mobileNavToggle.contains(e.target)) {
                    // e.stopPropagation();

                    mobileNavDropdown.classList.remove('show');
                }
            });
        }
    });
</script>
