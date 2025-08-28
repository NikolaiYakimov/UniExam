
{{--    <!DOCTYPE html>--}}
{{--<html lang="bg">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>{{ $title ?? 'Достъпни изпити' }}</title>--}}

{{--    <!-- Tailwind CSS -->--}}
{{--    <script src="https://cdn.tailwindcss.com"></script>--}}

{{--    <!-- Font Awesome -->--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">--}}

{{--    <!-- Google Fonts -->--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">--}}

{{--    <!-- Stripe -->--}}
{{--    <script src="https://js.stripe.com/v3/"></script>--}}

{{--    <style>--}}
{{--        :root{--}}
{{--            --sb-w: 20rem;--}}
{{--            --header-h: 64px;--}}
{{--        }--}}

{{--        body{--}}
{{--            background:#f8f9fa;--}}
{{--            font-family:'Inter',sans-serif;--}}
{{--        }--}}

{{--        .nav-link.active, .list-group-item.active{--}}
{{--            background:rgba(79,70,229,.08)!important;--}}
{{--            font-weight:600;--}}
{{--            color:#4f46e5!important;--}}
{{--        }--}}




{{--        .header-nav {--}}
{{--            display: flex;--}}
{{--            gap: .5rem;--}}
{{--            padding: .5rem 1rem;--}}
{{--            background: white;--}}
{{--            overflow-x: auto;--}}
{{--            white-space: nowrap;--}}
{{--        }--}}

{{--        .header-nav .nav-link {--}}
{{--            padding: .5rem 1rem;--}}
{{--            border-radius: .375rem;--}}
{{--            transition: .2s;--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--        }--}}

{{--        /* -------- Sidebar -------- */--}}

{{--        #sidebar{--}}
{{--            position: sticky;--}}
{{--            top: 0;--}}
{{--            height: 100dvh;--}}
{{--            width: var(--sb-w);--}}
{{--            background: #fff;--}}
{{--            padding: 1.5rem;--}}
{{--            border-right: 1px solid #e5e7eb;--}}
{{--            overflow-y: auto;--}}
{{--        }--}}

{{--        /* Мобилни: скриваме sidebar */--}}
{{--        @media (max-width: 1538px){--}}
{{--            #sidebar{--}}
{{--                display: none;--}}
{{--            }--}}

{{--            .header-nav {--}}
{{--                display: none;--}}
{{--            }--}}

{{--        }--}}


{{--        @media (min-width: 1538px){--}}
{{--            #sidebar{--}}
{{--                display: block;--}}
{{--            }--}}

{{--            .header-nav {--}}
{{--                display: flex;--}}
{{--            }--}}




{{--        }--}}


{{--        .page-layout{--}}
{{--        }--}}

{{--        @media (min-width: 1538px){--}}
{{--            .page-layout{--}}
{{--                display: grid;--}}
{{--                grid-template-columns: var(--sb-w) 1fr;--}}
{{--                gap: 0;--}}
{{--                min-height: calc(100dvh - var(--header-h));--}}
{{--            }--}}
{{--        }--}}


{{--        .mobile-nav-dropdown {--}}
{{--            display: none;--}}
{{--            position: absolute;--}}
{{--            top: 100%;--}}
{{--            right: 0;--}}
{{--            width: 280px;--}}
{{--            background: white;--}}
{{--            box-shadow: 0 10px 25px rgba(0,0,0,0.15);--}}
{{--            border-radius: 8px;--}}
{{--            z-index: 50;--}}
{{--            padding: 0.75rem;--}}
{{--            margin-top: 0.5rem;--}}
{{--            border: 1px solid #e5e7eb;--}}
{{--        }--}}

{{--        .mobile-nav-dropdown.show {--}}
{{--            display: block;--}}
{{--        }--}}

{{--        .mobile-nav-dropdown .nav-link {--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            padding: 0.75rem 1rem;--}}
{{--            border-radius: 6px;--}}
{{--            color: #374151;--}}
{{--            transition: all 0.2s ease;--}}
{{--            margin-bottom: 0.25rem;--}}
{{--        }--}}

{{--        .mobile-nav-dropdown .nav-link:hover {--}}
{{--            background-color: #f3f4f6;--}}
{{--        }--}}

{{--        .mobile-nav-dropdown .nav-link.active {--}}
{{--            background-color: #eef2ff;--}}
{{--            color: #4f46e5;--}}
{{--        }--}}

{{--        .mobile-nav-dropdown .nav-link i {--}}
{{--            width: 20px;--}}
{{--            margin-right: 0.75rem;--}}
{{--        }--}}

{{--        .mobile-nav-toggle {--}}
{{--            display: none;--}}
{{--            align-items: center;--}}
{{--            justify-content: center;--}}
{{--            width: 42px;--}}
{{--            height: 42px;--}}
{{--            border-radius: 8px;--}}
{{--            background: #f1f5f9;--}}
{{--            border: 1px solid #e2e8f0;--}}
{{--            color: #4f46e5;--}}
{{--            font-size: 1.25rem;--}}
{{--            cursor: pointer;--}}
{{--            margin-left: 0.75rem;--}}
{{--            transition: all 0.2s ease;--}}
{{--        }--}}

{{--        .mobile-nav-toggle:hover {--}}
{{--            background-color: #e0e7ff;--}}
{{--        }--}}


{{--        @media (max-width: 1538px) {--}}
{{--            .mobile-nav-toggle {--}}
{{--                display: flex;--}}
{{--            }--}}

{{--            .profile-section {--}}
{{--                display: flex;--}}
{{--                align-items: center;--}}
{{--            }--}}
{{--        }--}}


{{--        @media (max-width: 767px) {--}}
{{--            header .container-fluid {--}}
{{--                padding-left: 1rem;--}}
{{--                padding-right: 1rem;--}}
{{--            }--}}

{{--            .navbar-brand {--}}
{{--                font-size: 1.1rem;--}}
{{--            }--}}

{{--            .mobile-nav-dropdown {--}}
{{--                width: 250px;--}}
{{--                right: 0.5rem;--}}
{{--            }--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}

{{--<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">--}}

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


{{--<div class="page-layout">--}}


{{--    <aside id="sidebar">--}}
{{--        <div class="flex flex-col h-full">--}}
{{--            <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-4 border-b border-gray-100 flex items-center">--}}
{{--                <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 overflow-hidden">--}}
{{--                    <img src="{{ asset('images/tu-image.png') }}" alt="Лого" class="w-full h-full object-cover" loading="lazy">--}}
{{--                </div>--}}
{{--                @if(Auth::user()->role==='student')--}}
{{--                    Студентски профил--}}
{{--                @elseif(Auth::user()->role==='teacher')--}}
{{--                    Преподавателски профил--}}
{{--                @endif--}}
{{--            </h2>--}}

{{--            <div class="space-y-5 flex-1">--}}
{{--                <div class="flex items-center gap-4">--}}
{{--                    <div class="w-14 h-14 rounded-full bg-primary-100 flex items-center justify-center">--}}
{{--                        <i class="fas fa-user text-xl text-primary-600"></i>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <p class="font-medium text-gray-900">--}}
{{--                            @if(Auth::user()->role==='teacher')--}}
{{--                                {{$teacher->title}}--}}
{{--                            @endif--}}
{{--                            {{ Auth::user()->first_name }} {{ Auth::user()->second_name }} {{ Auth::user()->last_name }}--}}
{{--                        </p>--}}
{{--                        @if(Auth::user()->role==='student')--}}
{{--                            <p class="text-sm text-gray-500 mt-1">№: <span class="font-mono">{{ Auth::user()->student->faculty_number }}</span></p>--}}
{{--                        @else--}}
{{--                            <p class="text-sm text-gray-500 mt-1">--}}
{{--                                <i class="fas fa-clipboard-list text-gray-400"></i>--}}
{{--                                {{ $teacher->exams_count }} активни изпита--}}
{{--                            </p>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="space-y-3.5 mt-4">--}}
{{--                    @if(Auth::user()->role==='student')--}}
{{--                        <div>--}}
{{--                            <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Специалност/Факултет</p>--}}
{{--                            <p class="font-medium text-gray-800">{{ Auth::user()->student->specialty->name }} / {{Auth::user()->student->faculty->name}}</p>--}}
{{--                        </div>--}}
{{--                    @elseif(Auth::user()->role==='teacher')--}}
{{--                        <div>--}}
{{--                            <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Факултет</p>--}}
{{--                            <p class="font-medium text-gray-800">{{ Auth::user()->teacher->faculty }}</p>--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    <div>--}}
{{--                        <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Потребителско име</p>--}}
{{--                        <p class="font-medium text-gray-800">{{ Auth::user()->username }}</p>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Майл</p>--}}
{{--                        <p class="font-medium text-gray-800">{{ Auth::user()->email }}</p>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Телефонен номер</p>--}}
{{--                        <p class="font-medium text-gray-800">{{ Auth::user()->phone }}</p>--}}
{{--                    </div>--}}

{{--                    @if(Auth::user()->role==='student')--}}
{{--                        <div>--}}
{{--                            <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Статус</p>--}}
{{--                            @if(Auth::user()->student->semester<8)--}}
{{--                                <p class="font-medium text-green-600 flex items-center gap-1.5">--}}
{{--                                    <i class="fas fa-check-circle"></i>Активен--}}
{{--                                </p>--}}
{{--                            @else--}}
{{--                                <p class="font-medium text-red-600 flex items-center gap-1.5">--}}
{{--                                    <i class="fas fa-times-circle"></i>Неактивен--}}
{{--                                </p>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="pt-4 border-t border-gray-100">--}}
{{--                <form action="{{ route('logout') }}" method="POST">--}}
{{--                    @csrf--}}
{{--                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">--}}
{{--                        <i class="fas fa-sign-out-alt"></i>--}}
{{--                        <span>Изход от системата</span>--}}
{{--                    </button>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </aside>--}}

{{--    <main class="p-4 lg:p-6">--}}
{{--        <div class="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">--}}
{{--            <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">--}}
{{--                <div>--}}
{{--                    <h1 class="text-2xl font-bold text-gray-800">Достъпни изпити</h1>--}}
{{--                    <p class="text-sm text-gray-500 mt-1">Преглед и записване за предстоящи изпити</p>--}}
{{--                </div>--}}
{{--                <a href="{{ route('my_exams') }}" class="inline-flex items-center gap-1 px-4 py-2.5 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors">--}}
{{--                    <i class="fas fa-list-alt"></i>--}}
{{--                    Моите изпити--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}


{{--        @include('partials.alerts')--}}


{{--        @if($exams->isEmpty())--}}
{{--            <div class="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">--}}
{{--                <i class="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>--}}
{{--                <h3 class="text-lg font-medium text-gray-700 mb-2">Няма налични изпити</h3>--}}
{{--                <p class="text-gray-500">В момента няма изпити за записване. Моля, проверете по-късно.</p>--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">--}}
{{--                @foreach ($exams as $exam)--}}
{{--                    <div class="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-indigo-100 hover:-translate-y-0.5">--}}
{{--                        <div class="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">--}}
{{--                            <h2 class="text-lg font-semibold text-gray-900 leading-tight">--}}
{{--                                {{ $exam->subject->subject_name }}--}}
{{--                            </h2>--}}
{{--                            <div class="flex flex-wrap gap-2">--}}
{{--                  <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">--}}
{{--                    {{ $exam->exam_type }}--}}
{{--                  </span>--}}
{{--                                <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $exam->remainingSlots() > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">--}}
{{--                    {{ $exam->remainingSlots() > 0 ? $exam->remainingSlots().' Свободни места' : 'Няма места' }}--}}
{{--                  </span>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="space-y-3 mb-5">--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-chalkboard-teacher w-5 text-gray-400"></i>--}}
{{--                                <span>Преподавател: <span class="font-medium text-gray-800">{{ $exam->teacher->user->first_name }} {{ $exam->teacher->user->last_name }}</span></span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-calendar-alt w-5 text-gray-400"></i>--}}
{{--                                <span>Дата: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y ') }}</span></span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-clock w-5 text-gray-400"></i>--}}
{{--                                <span>Продължителност: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format(' H:i') }} - {{ \Carbon\Carbon::parse($exam->end_time)->format(' H:i') }}</span></span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-university w-5 text-gray-400"></i>--}}
{{--                                <span>Зала: <span class="font-medium text-gray-800">{{ $exam->hall->name }}</span></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        @if($exam->exam_type === 'ликвидация' || $exam->subject->semester < Auth::user()->student->semester)--}}
{{--                            <button type="button"--}}
{{--                                    class="w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 payment-btn--}}
{{--                        {{ $exam->remainingSlots() <= 0 ? 'bg-gray-300 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' }}"--}}
{{--                                    {{ $exam->remainingSlots() <= 0 ? 'disabled' : '' }}--}}
{{--                                    data-exam-id="{{ $exam->id }}"--}}
{{--                                    data-subject="{{ $exam->subject->subject_name }}"--}}
{{--                                    data-price="{{ $exam->price }}">--}}
{{--                                <i class="fas fa-credit-card mr-2"></i> Плати и се запиши--}}
{{--                            </button>--}}
{{--                        @else--}}
{{--                            <form method="POST" action="{{ route('student.exam.register', $exam) }}">--}}
{{--                                @csrf--}}
{{--                                <button type="submit"--}}
{{--                                        class="w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200--}}
{{--                          {{ $exam->remainingSlots() <= 0 ? 'bg-gray-300 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' }}"--}}
{{--                                    {{ $exam->remainingSlots() <= 0 ? 'disabled' : '' }}>--}}
{{--                                    <i class="fas fa-edit mr-2"></i> Запиши се--}}
{{--                                </button>--}}
{{--                            </form>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </main>--}}
{{--</div>--}}


{{--<script>--}}
{{--    document.addEventListener('DOMContentLoaded', function () {--}}

{{--        const header = document.getElementById('siteHeader');--}}
{{--        function setHeaderHeightVar(){--}}
{{--            const h = header.getBoundingClientRect().height;--}}
{{--            document.documentElement.style.setProperty('--header-h', h + 'px');--}}
{{--        }--}}
{{--        setHeaderHeightVar();--}}
{{--        window.addEventListener('resize', setHeaderHeightVar);--}}

{{--        // 2) Dropdown за профил бутона--}}
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

{{--        // 3) Мобилно навигационно меню--}}
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

{{--        // 4) Stripe Embedded Checkout--}}
{{--        const stripe = Stripe("{{ config('services.stripe.key') }}");--}}
{{--        let checkout;--}}

{{--        const paymentButtons = document.querySelectorAll('.payment-btn');--}}
{{--        const paymentModal = document.getElementById('paymentModal');--}}
{{--        const closeModal = document.getElementById('closeModal');--}}

{{--        paymentButtons.forEach(button => {--}}
{{--            button.addEventListener('click', async function() {--}}
{{--                const examId = this.dataset.examId;--}}
{{--                try {--}}
{{--                    const url = "{{route('payment.handle',['exam'=>'__examId__'])}}".replace('__examId__', examId);--}}
{{--                    const response = await fetch(url, {--}}
{{--                        method: 'POST',--}}
{{--                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': "{{ csrf_token() }}" },--}}
{{--                        body: JSON.stringify({ exam_id: examId })--}}
{{--                    });--}}

{{--                    const { clientSecret } = await response.json();--}}
{{--                    stripe.initEmbeddedCheckout({ clientSecret }).then((checkoutInstance) => {--}}
{{--                        checkout = checkoutInstance;--}}
{{--                        if (paymentModal) paymentModal.classList.remove('hidden');--}}
{{--                        const mountPoint = document.getElementById('checkout');--}}
{{--                        if (mountPoint) checkout.mount('#checkout');--}}
{{--                    });--}}
{{--                } catch (error) {--}}
{{--                    console.error('Грешка:', error);--}}
{{--                    alert('Възникна грешка при инициализиране на плащането');--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}

{{--        if (closeModal && paymentModal) {--}}
{{--            closeModal.addEventListener('click', () => {--}}
{{--                paymentModal.classList.add('hidden');--}}
{{--                if (checkout) checkout.unmount();--}}
{{--            });--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}
{{--</body>--}}
{{--</html>--}}
    <!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Достъпни изпити' }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Stripe -->
    <script src="https://js.stripe.com/v3/"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">

@include('partials.header')

<div class="page-layout">
    @include('partials.sidebar')

    <main class="p-4 lg:p-6">
        <div class="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Достъпни изпити</h1>
                    <p class="text-sm text-gray-500 mt-1">Преглед и записване за предстоящи изпити</p>
                </div>

            </div>
        </div>

        @include('partials.alerts')

        @if($exams->isEmpty())
            <div class="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
                <i class="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700 mb-2">Няма налични изпити</h3>
                <p class="text-gray-500">В момента няма изпити за записване. Моля, проверете по-късно.</p>
            </div>
        @else
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">
                @foreach ($exams as $exam)
                    <div class="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-indigo-100 hover:-translate-y-0.5">
                        <div class="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">
                            <h2 class="text-lg font-semibold text-gray-900 leading-tight">
                                {{ $exam->subject->subject_name }}
                            </h2>
                            <div class="flex flex-wrap gap-2">
                  <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                    {{ $exam->exam_type }}
                  </span>
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $exam->remainingSlots() > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $exam->remainingSlots() > 0 ? $exam->remainingSlots().' Свободни места' : 'Няма места' }}
                  </span>
                            </div>
                        </div>

                        <div class="space-y-3 mb-5">
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-chalkboard-teacher w-5 text-gray-400"></i>
                                <span>Преподавател: <span class="font-medium text-gray-800">{{ $exam->teacher->user->first_name }} {{ $exam->teacher->user->last_name }}</span></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-calendar-alt w-5 text-gray-400"></i>
                                <span>Дата: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y ') }}</span></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-clock w-5 text-gray-400"></i>
                                <span>Продължителност: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format(' H:i') }} - {{ \Carbon\Carbon::parse($exam->end_time)->format(' H:i') }}</span></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-university w-5 text-gray-400"></i>
                                <span>Зала: <span class="font-medium text-gray-800">{{ $exam->hall->name }}</span></span>
                            </div>
                        </div>

                        @if($exam->exam_type === 'ликвидация' || $exam->subject->semester < Auth::user()->student->semester)
                            <button type="button"
                                    class="w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 payment-btn
                        {{ $exam->remainingSlots() <= 0 ? 'bg-gray-300 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' }}"
                                    {{ $exam->remainingSlots() <= 0 ? 'disabled' : '' }}
                                    data-exam-id="{{ $exam->id }}"
                                    data-subject="{{ $exam->subject->subject_name }}"
                                    data-price="{{ $exam->price }}">
                                <i class="fas fa-credit-card mr-2"></i> Плати и се запиши
                            </button>
                        @else
                            <form method="POST" action="{{ route('student.exam.register', $exam) }}">
                                @csrf
                                <button type="submit"
                                        class="w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200
                          {{ $exam->remainingSlots() <= 0 ? 'bg-gray-300 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' }}"
                                    {{ $exam->remainingSlots() <= 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-edit mr-2"></i> Запиши се
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </main>
</div>
<div id="paymentModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-auto p-6 relative">
            <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
            <!-- Контейнер за Embedded Checkout -->
            <div class="w-full overflow-x-auto">
                <div id="checkout" class="min-w-[400px] h-[800px]"></div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const stripe = Stripe("{{ config('services.stripe.key') }}");
            let checkout;

            const paymentButtons = document.querySelectorAll('.payment-btn');
            const paymentModal = document.getElementById('paymentModal');
            const subjectSpan = document.getElementById('modalSubject');
            const priceSpan = document.getElementById('modalPrice');
            const closeModal = document.getElementById('closeModal');

            paymentButtons.forEach(button => {
                button.addEventListener('click', async function () {
                    const examId = this.dataset.examId;
                    // subjectSpan.textContent = this.dataset.subject;
                    // priceSpan.textContent = this.dataset.price;

                    try {

                        const url="{{route('payment.handle',['exam'=>'__examId__'])}}".replace('__examId__',examId)
                        // Заявка за създаване на checkout сесия
                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            },
                            body: JSON.stringify({ exam_id: examId })
                        });

                        const { clientSecret } = await response.json();
                        // Инициализиране на Embedded Checkout
                        stripe.initEmbeddedCheckout({
                            clientSecret
                        }).then((checkout)=>{
                            console.log('Hello')
                            paymentModal.classList.remove('hidden');
                            checkout.mount('#checkout');
                        })

                        // Показване на модала
                        paymentModal.classList.remove('hidden');
                        //


                        // Обработка на събития
                        // checkout.on('complete', () => {
                        //     paymentModal.classList.add('hidden');
                        //     window.location.reload();
                        // });
                        //
                        // checkout.on('close', () => {
                        //     paymentModal.classList.add('hidden');
                        // });

                    } catch (error) {
                        console.error('Грешка:', error);
                        alert('Възникна грешка при инициализиране на плащането');
                    }
                });
            });

            closeModal.addEventListener('click', () => {
                paymentModal.classList.add('hidden');
                if (checkout) checkout.unmount();
            });

    });
</script>
<script src="{{asset('js/menuFunctions.js')}}"></script>
<script src="{{asset('js/alertClosingFunctions.js')}}"></script>
</body>
</html>
