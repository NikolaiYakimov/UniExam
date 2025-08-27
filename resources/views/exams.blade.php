
{{--<!DOCTYPE html>--}}
{{--<html lang="bg">--}}

{{--Head--}}
{{--@include('partials.head')--}}
{{--<style>--}}
{{--    :root {--}}
{{--        --sb-w: 280px;--}}
{{--    }--}}

{{--    body {--}}
{{--        background: #f8f9fa;--}}
{{--        font-family: 'Inter', sans-serif;--}}
{{--    }--}}

{{--    /* Grid layout за десктоп */--}}
{{--    @media (min-width: 992px) {--}}
{{--        .layout {--}}
{{--            display: grid;--}}
{{--            grid-template-columns: var(--sb-w) 1fr;--}}
{{--            min-height: 100vh;--}}
{{--        }--}}

{{--        .sidebar {--}}
{{--            position: sticky;--}}
{{--            top: 0;--}}
{{--            height: 100vh;--}}
{{--            overflow-y: auto;--}}
{{--        }--}}
{{--    }--}}

{{--    .nav-link.active, .list-group-item.active {--}}
{{--        background: rgba(79, 70, 229, 0.08) !important;--}}
{{--        font-weight: 600;--}}
{{--        color: #4f46e5 !important;--}}
{{--    }--}}

{{--    .nav-section-title {--}}
{{--        font-size: .75rem;--}}
{{--        text-transform: uppercase;--}}
{{--        letter-spacing:.04em;--}}
{{--        color:#6c757d;--}}
{{--        margin: 1rem 1rem .25rem;--}}
{{--    }--}}

{{--    .content-card {--}}
{{--        background: #fff;--}}
{{--        border: 1px solid #e5e7eb;--}}
{{--        border-radius: 0.5rem;--}}
{{--        padding: 1.25rem;--}}
{{--    }--}}

{{--    .btn-primary {--}}
{{--        background-color: #4f46e5;--}}
{{--        color: white;--}}
{{--    }--}}

{{--    .btn-primary:hover {--}}
{{--        background-color: #4338ca;--}}
{{--    }--}}
{{--</style>--}}

{{--<head>--}}
{{--    <script  src="https://js.stripe.com/v3/"></script>--}}
{{--</head>--}}

{{--<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen font-[Inter] overflow-x-hidden">--}}


{{--@include('partials.sidebar')--}}

{{--<div class="mb-6 bg-white border border-gray-100 rounded-xl shadow-sm p-2">--}}
{{--    <nav class="flex flex-wrap gap-2">--}}
{{--        <a href="{{ route('exams') }}"--}}
{{--           class="px-4 py-2 rounded-lg font-medium transition-colors duration-200--}}
{{--                  {{ Request::routeIs('exams') ? 'bg-blue-100 text-blue-700 border border-blue-200' : 'text-gray-600 hover:bg-gray-50' }}">--}}
{{--            <i class="fas fa-calendar-alt mr-2"></i> Достъпни изпити--}}
{{--        </a>--}}
{{--        <a href="{{ route('my_exams') }}"--}}
{{--           class="px-4 py-2 rounded-lg font-medium transition-colors duration-200--}}
{{--                  {{ Request::routeIs('my_exams') ? 'bg-blue-100 text-blue-700 border border-blue-200' : 'text-gray-600 hover:bg-gray-50' }}">--}}
{{--            <i class="fas fa-list-alt mr-2"></i> Моите изпити--}}
{{--        </a>--}}
{{--    </nav>--}}
{{--</div>--}}



{{--<div class="ml-0 lg:ml-80 p-4 lg:p-8 transition-all duration-300">--}}

{{--<!-- Тънък Header -->--}}
{{--<header class="bg-white border-b border-gray-200 sticky top-0 z-30">--}}
{{--    <div class="container-fluid py-2 flex items-center gap-2 px-4">--}}
{{--        <!-- Бутон за отваряне на offcanvas (мобилни) -->--}}
{{--        <button class="btn btn-outline-secondary lg:hidden" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">--}}
{{--            <i class="fa fa-bars"></i>--}}
{{--        </button>--}}

{{--        <a href="{{ route('dashboard') }}" class="navbar-brand m-0 text-xl font-semibold text-indigo-700">UNI Portal</a>--}}
{{--        <a  class="navbar-brand m-0 text-xl font-semibold text-indigo-700">UNI Portal</a>--}}
{{--        <form class="ms-auto hidden md:block" method="get">--}}
{{--            <input name="q" class="form-control rounded-full px-4 py-1 border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Търсене…" value="{{ request('q') }}">--}}
{{--        </form>--}}

{{--        @auth--}}
{{--            <div class="dropdown ms-2">--}}
{{--                <button class="btn btn-outline-primary dropdown-toggle flex items-center gap-2 px-3 py-1.5 border border-indigo-300 rounded-full text-indigo-700 hover:bg-indigo-50" data-bs-toggle="dropdown">--}}
{{--                    <i class="fa fa-user-circle"></i> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}--}}
{{--                </button>--}}
{{--                <ul class="dropdown-menu dropdown-menu-end absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50 hidden">--}}
{{--                    <li><a class="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('profile') }}">Моят профил</a></li>--}}
{{--                    <li><a class="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('profile.edit') }}">Редакция</a></li>--}}
{{--                    <li><a class="dropdown-item block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#">Смяна на парола</a></li>--}}
{{--                    <li><hr class="dropdown-divider my-2 border-gray-200"></li>--}}
{{--                    <li>--}}
{{--                        <form method="post" action="{{ route('logout') }}">@csrf--}}
{{--                            <button class="dropdown-item text-danger block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100" type="submit">Изход</button>--}}
{{--                        </form>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <div class="ms-auto ms-md-2">--}}
{{--                <a class="btn btn-outline-primary" href="{{ route('login') }}">Вход</a>--}}
{{--            </div>--}}
{{--        @endauth--}}
{{--    </div>--}}
{{--</header>--}}

{{--    <!-- Хедър -->--}}
{{--    @include('partials.header',[--}}
{{--             'title'=>"Достъпни изпити",--}}
{{--             'subtitle'=>'Преглед и записване за предстоящи изпити',--}}
{{--             'button'=>[--}}
{{--                        'route'=>route('my_exams'),--}}
{{--                        'text'=>'Моите изпити',--}}
{{--                        'icon' =>'fas fa-list-alt'--}}
{{--                       ]--}}
{{--            ])--}}

{{--    <!-- Основен content -->--}}
{{--<div class="layout">--}}
{{--    <!-- Sidebar (desktop) -->--}}
{{--    <aside class="sidebar bg-white border-r border-gray-200 hidden lg:block">--}}
{{--        <div class="p-4">--}}
{{--            <!-- Профилно резюме -->--}}
{{--            <div class="card mb-4 bg-gray-50 rounded-lg p-4">--}}
{{--                <div class="card-body py-3">--}}
{{--                    <div class="d-flex align-items-center gap-3">--}}
{{--                        <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">--}}
{{--                            <i class="fa fa-user-circle text-xl text-indigo-600"></i>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <div class="fw-semibold text-gray-900">--}}
{{--                                @if(Auth::user()->role==='teacher')--}}
{{--                                    {{$teacher->title}}--}}
{{--                                @endif--}}
{{--                                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}--}}
{{--                            </div>--}}
{{--                            <div class="text-muted small text-gray-600">{{ Auth::user()->email }}</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="d-grid gap-2 mt-3 grid-cols-2">--}}
{{--                        <a href="{{ route('profile') }}" class="btn btn-sm btn-light bg-white text-gray-700 border border-gray-300 rounded-md py-1.5 text-xs hover:bg-gray-50">Профил</a>--}}
{{--                        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-primary border border-indigo-300 text-indigo-700 rounded-md py-1.5 text-xs hover:bg-indigo-50">Редакция</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- Навигационни секции -->--}}
{{--            <div class="nav-section">--}}
{{--                <div class="nav-section-title">Основни</div>--}}
{{--                <ul class="nav flex-column space-y-1">--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link flex items-center py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100 {{ Request::routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">--}}
{{--                        <a class="nav-link flex items-center py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100 ">--}}
{{--                            <i class="fa fa-home me-2 text-gray-500"></i>Табло--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link flex items-center py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100 {{ Request::routeIs('exams') || Request::routeIs('my_exams') ? 'active' : '' }}" href="{{ route('exams') }}">--}}
{{--                            <i class="fa fa-file-pen me-2 text-gray-500"></i>Изпити--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link flex items-center py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100" href="#">--}}
{{--                            <i class="fa fa-calendar me-2 text-gray-500"></i>График--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link flex items-center py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100" href="#">--}}
{{--                            <i class="fa fa-wallet me-2 text-gray-500"></i>Плащания--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link flex items-center py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100" href="#">--}}
{{--                            <i class="fa fa-headset me-2 text-gray-500"></i>Поддръжка--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}

{{--            @if(Auth::user()->role === 'admin')--}}
{{--                <div class="nav-section mt-4">--}}
{{--                    <div class="nav-section-title">Администрация</div>--}}
{{--                    <div class="list-group list-group-flush space-y-1">--}}
{{--                        <!-- Подменю: Потребители -->--}}
{{--                        <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100" data-bs-toggle="collapse" href="#grp-users" role="button" aria-expanded="false" aria-controls="grp-users">--}}
{{--                            <span class="flex items-center">--}}
{{--                                <i class="fa fa-users me-2 text-gray-500"></i>Потребители--}}
{{--                            </span>--}}
{{--                            <i class="fa fa-chevron-down small text-gray-400"></i>--}}
{{--                        </a>--}}
{{--                        <div class="collapse" id="grp-users">--}}
{{--                            <a class="list-group-item list-group-item-action ps-5 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md" href="#">Списък</a>--}}
{{--                            <a class="list-group-item list-group-item-action ps-5 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md" href="#">Нов потребител</a>--}}
{{--                        </div>--}}

{{--                        <!-- Подменю: Аудитории -->--}}
{{--                        <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100" data-bs-toggle="collapse" href="#grp-rooms" role="button" aria-expanded="false" aria-controls="grp-rooms">--}}
{{--                            <span class="flex items-center">--}}
{{--                                <i class="fa fa-door-open me-2 text-gray-500"></i>Аудитории--}}
{{--                            </span>--}}
{{--                            <i class="fa fa-chevron-down small text-gray-400"></i>--}}
{{--                        </a>--}}
{{--                        <div class="collapse" id="grp-rooms">--}}
{{--                            <a class="list-group-item list-group-item-action ps-5 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md" href="#">Списък</a>--}}
{{--                            <a class="list-group-item list-group-item-action ps-5 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md" href="#">Нова аудитория</a>--}}
{{--                        </div>--}}

{{--                        <!-- Подменю: Настройки -->--}}
{{--                        <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100" data-bs-toggle="collapse" href="#grp-settings" role="button" aria-expanded="true" aria-controls="grp-settings">--}}
{{--                            <span class="flex items-center">--}}
{{--                                <i class="fa fa-gear me-2 text-gray-500"></i>Настройки--}}
{{--                            </span>--}}
{{--                            <i class="fa fa-chevron-down small text-gray-400"></i>--}}
{{--                        </a>--}}
{{--                        <div class="collapse show" id="grp-settings">--}}
{{--                            <a class="list-group-item list-group-item-action ps-5 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md" href="#">Общи</a>--}}
{{--                            <a class="list-group-item list-group-item-action ps-5 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md" href="#">Профил</a>--}}
{{--                            <a class="list-group-item list-group-item-action ps-5 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-md" href="#">Сигурност</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </aside>--}}
{{--    <main>--}}

{{--        --}}{{--Alerts--}}

{{--       @include('partials.alerts')--}}

{{--        @if($exams->isEmpty())--}}
{{--            <div class="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">--}}
{{--                <i class="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>--}}
{{--                <h3 class="text-lg font-medium text-gray-700 mb-2">Няма налични изпити</h3>--}}
{{--                <p class="text-gray-500">В момента няма изпити за записване. Моля, проверете по-късно.</p>--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">--}}
{{--                @foreach ($exams as $exam)--}}
{{--                    <div class="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-primary-100 hover:translate-y-[-2px]">--}}
{{--                        <div class="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">--}}
{{--                            <h2 class="text-lg font-semibold text-gray-900 leading-tight">--}}
{{--                                {{ $exam->subject->subject_name }}--}}
{{--                            </h2>--}}
{{--                            <div class="flex flex-wrap gap-2">--}}
{{--                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">--}}
{{--                                    {{ $exam->exam_type }}--}}
{{--                                </span>--}}
{{--                                <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $exam->remainingSlots() > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">--}}
{{--                                    {{ $exam->remainingSlots() > 0 ? $exam->remainingSlots().' Свободни места' : 'Няма места' }}--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="space-y-3 mb-5">--}}
{{--                            <div class="flex items-center gap-2 text-gray-600">--}}
{{--                                <i class="fas fa-chalkboard-teacher w-5 text-gray-400"></i>--}}
{{--                                <span>Преподавател: <span class="font-medium text-gray-800">{{ $exam->teacher->user->first_name }} {{ $exam->teacher->user->last_name }}</span></span>--}}
{{--                            </div>--}}
{{--                             <div class="flex items-center gap-2 text-gray-600">--}}
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
{{--                        @if($exam->exam_type === 'ликвидация' || $exam->subject->semester <Auth::user()->student->semester)--}}
{{--                        <button type="button"--}}
{{--                                class="w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200  payment-btn--}}
{{--                                 {{ $exam->remainingSlots() <= 0 ? 'bg-gray-300 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' }}"--}}
{{--                                {{ $exam->remainingSlots() <= 0 ? 'disabled' : '' }}--}}
{{--                                data-exam-id="{{ $exam->id }}"--}}
{{--                                data-subject="{{ $exam->subject->subject_name }}"--}}
{{--                                data-price="{{ $exam->price }}">--}}
{{--                            <i class="fas fa-credit-card mr-2"></i> Плати и се запиши--}}
{{--                        </button>--}}
{{--                        @else--}}
{{--                            <form method="POST" action="{{ route('student.exam.register', $exam) }}">--}}
{{--                            @csrf--}}
{{--                            <button type="submit"--}}
{{--                                    class="w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200--}}
{{--                                {{ $exam->remainingSlots() <= 0 ? 'bg-gray-300 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' }}"--}}
{{--                                {{ $exam->remainingSlots() <= 0 ? 'disabled' : '' }}>--}}
{{--                                <i class="fas fa-edit mr-2"></i> Запиши се--}}
{{--                            </button>--}}
{{--                            </form>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </main>--}}
{{--</div>--}}
{{--<div id="paymentModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">--}}
{{--    <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-auto p-6 relative">--}}
{{--        <button id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">--}}
{{--            <i class="fas fa-times"></i>--}}
{{--        </button>--}}
{{--+--}}
{{--        <!-- Контейнер за Embedded Checkout -->--}}
{{--        <div id="checkout"  style="width: 100%; height: 500px;"></div>--}}
{{--        <div class="w-full overflow-x-auto">--}}
{{--            <div id="checkout" class="min-w-[400px] h-[800px]"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


{{--<script src="{{asset('js/menuFunctions.js')}}"></script>--}}
{{--<script src="{{asset('js/alertClosingFunctions.js')}}"></script>--}}
{{--<script>--}}

{{--    document.addEventListener('DOMContentLoaded', function () {--}}
{{--        const stripe = Stripe("{{ config('services.stripe.key') }}");--}}
{{--        let checkout;--}}

{{--        const paymentButtons = document.querySelectorAll('.payment-btn');--}}
{{--        const paymentModal = document.getElementById('paymentModal');--}}
{{--        const subjectSpan = document.getElementById('modalSubject');--}}
{{--        const priceSpan = document.getElementById('modalPrice');--}}
{{--        const closeModal = document.getElementById('closeModal');--}}

{{--        paymentButtons.forEach(button => {--}}
{{--            button.addEventListener('click', async function () {--}}
{{--                const examId = this.dataset.examId;--}}
{{--                // subjectSpan.textContent = this.dataset.subject;--}}
{{--                // priceSpan.textContent = this.dataset.price;--}}

{{--                try {--}}

{{--                    const url="{{route('payment.handle',['exam'=>'__examId__'])}}".replace('__examId__',examId)--}}
{{--                    // Заявка за създаване на checkout сесия--}}
{{--                    const response = await fetch(url, {--}}
{{--                        method: 'POST',--}}
{{--                        headers: {--}}
{{--                            'Content-Type': 'application/json',--}}
{{--                            'X-CSRF-TOKEN': "{{ csrf_token() }}",--}}
{{--                        },--}}
{{--                        body: JSON.stringify({ exam_id: examId })--}}
{{--                    });--}}

{{--                    const { clientSecret } = await response.json();--}}
{{--                    // Инициализиране на Embedded Checkout--}}
{{--                    stripe.initEmbeddedCheckout({--}}
{{--                        clientSecret--}}
{{--                    }).then((checkout)=>{--}}
{{--                        console.log('Hello')--}}
{{--                        paymentModal.classList.remove('hidden');--}}
{{--                        checkout.mount('#checkout');--}}
{{--                    })--}}

{{--                    // Показване на модала--}}
{{--                    paymentModal.classList.remove('hidden');--}}
{{--                    //--}}


{{--                    // Обработка на събития--}}
{{--                    // checkout.on('complete', () => {--}}
{{--                    //     paymentModal.classList.add('hidden');--}}
{{--                    //     window.location.reload();--}}
{{--                    // });--}}
{{--                    //--}}
{{--                    // checkout.on('close', () => {--}}
{{--                    //     paymentModal.classList.add('hidden');--}}
{{--                    // });--}}

{{--                } catch (error) {--}}
{{--                    console.error('Грешка:', error);--}}
{{--                    alert('Възникна грешка при инициализиране на плащането');--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}

{{--        closeModal.addEventListener('click', () => {--}}
{{--            paymentModal.classList.add('hidden');--}}
{{--            if (checkout) checkout.unmount();--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
{{--</body>--}}
{{--<style>--}}
{{--    @media (max-width: 1023px) {--}}
{{--        #sidebar {--}}
{{--            width: 288px;--}}
{{--            left: -288px;--}}
{{--            box-shadow: 8px 0 15px -3px rgba(0, 0, 0, 0.1);--}}
{{--        }--}}
{{--        #menuContainer {--}}
{{--            transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);--}}
{{--            left: 1rem;--}}
{{--        }--}}
{{--        header {--}}
{{--            margin-top: 5.5rem;--}}
{{--        }--}}

{{--        .bg-green-50, .bg-red-50{--}}
{{--            transition: opacity 0.3s ease;--}}
{{--            position: relative;--}}
{{--        }--}}
{{--    }--}}
{{--</style>--}}
{{--</html>--}}
{{--/////////////////////////////////////--}}
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
{{--        :root {--}}
{{--            --sb-w: 280px;--}}
{{--        }--}}

{{--        body {--}}
{{--            background: #f8f9fa;--}}
{{--            font-family: 'Inter', sans-serif;--}}
{{--        }--}}

{{--        /* Grid layout за десктоп */--}}
{{--        @media (min-width: 992px) {--}}
{{--            .layout {--}}
{{--                display: grid;--}}
{{--                grid-template-columns: var(--sb-w) 1fr;--}}
{{--                min-height: 100vh;--}}
{{--            }--}}

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
{{--        :root {--}}
{{--            --sb-w: 280px;--}}
{{--        }--}}

{{--        body {--}}
{{--            background: #f8f9fa;--}}
{{--            font-family: 'Inter', sans-serif;--}}
{{--        }--}}

{{--        .nav-link.active, .list-group-item.active {--}}
{{--            background: rgba(79, 70, 229, 0.08) !important;--}}
{{--            font-weight: 600;--}}
{{--            color: #4f46e5 !important;--}}
{{--        }--}}

{{--        .offcanvas-backdrop {--}}
{{--            position: fixed;--}}
{{--            top: 0;--}}
{{--            left: 0;--}}
{{--            width: 100%;--}}
{{--            height: 100%;--}}
{{--            background-color: rgba(0, 0, 0, 0.5);--}}
{{--            z-index: 1040;--}}
{{--            display: none;--}}
{{--        }--}}
{{--        .offcanvas-backdrop.show {--}}
{{--            display: block;--}}
{{--        }--}}

{{--        .offcanvas {--}}
{{--            position: fixed;--}}
{{--            bottom: 0;--}}
{{--            left: 0;--}}
{{--            top: 0;--}}
{{--            z-index: 1050;--}}
{{--            width: 300px;--}}
{{--            background-color: white;--}}
{{--            transform: translateX(-100%);--}}
{{--            transition: transform 0.3s ease-in-out;--}}
{{--            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);--}}
{{--            overflow-y: auto;--}}
{{--        }--}}

{{--        .offcanvas.show {--}}
{{--            transform: translateX(0);--}}
{{--        }--}}

{{--        .offcanvas-header {--}}
{{--            padding: 1rem;--}}
{{--            border-bottom: 1px solid #e5e7eb;--}}
{{--            display: flex;--}}
{{--            justify-content: space-between;--}}
{{--            align-items: center;--}}
{{--        }--}}

{{--        .offcanvas-title {--}}
{{--            margin: 0;--}}
{{--            font-weight: 600;--}}
{{--            color: #374151;--}}
{{--        }--}}

{{--        .btn-close {--}}
{{--            background: none;--}}
{{--            border: none;--}}
{{--            font-size: 1.25rem;--}}
{{--            color: #6b7280;--}}
{{--            cursor: pointer;--}}
{{--        }--}}

{{--        .btn-close:hover {--}}
{{--            color: #374151;--}}
{{--        }--}}

{{--        .offcanvas-body {--}}
{{--            padding: 1rem;--}}
{{--        }--}}

{{--        .nav-section-title {--}}
{{--            font-size: .75rem;--}}
{{--            text-transform: uppercase;--}}
{{--            letter-spacing:.04em;--}}
{{--            color:#6c757d;--}}
{{--            margin: 1rem 1rem .25rem;--}}
{{--        }--}}

{{--        .content-card {--}}
{{--            background: #fff;--}}
{{--            border: 1px solid #e5e7eb;--}}
{{--            border-radius: 0.5rem;--}}
{{--            padding: 1.25rem;--}}
{{--        }--}}

{{--        .btn-primary {--}}
{{--            background-color: #4f46e5;--}}
{{--            color: white;--}}
{{--        }--}}

{{--        .btn-primary:hover {--}}
{{--            background-color: #4338ca;--}}
{{--        }--}}

{{--        /* Нов стил за хоризонталното меню в header */--}}
{{--        .header-nav {--}}
{{--            display: flex;--}}
{{--            gap: 0.5rem;--}}
{{--            padding: 0.5rem 1rem;--}}

{{--            background: white;--}}
{{--        }--}}

{{--        .header-nav .nav-link {--}}
{{--            padding: 0.5rem 1rem;--}}
{{--            border-radius: 0.375rem;--}}
{{--            transition: all 0.2s;--}}
{{--            white-space: nowrap;--}}
{{--        }--}}
{{--        .header-nav-brand {--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            color: white;--}}
{{--            font-weight: 600;--}}
{{--            font-size: 1.25rem;--}}
{{--            text-decoration: none;--}}
{{--        }--}}

{{--        .header-nav-brand i {--}}
{{--            margin-right: 0.5rem;--}}
{{--            font-size: 1.5rem;--}}
{{--        }--}}
{{--        #menuContainer {--}}
{{--            top: 1.5rem;--}}
{{--            left: 1rem;--}}
{{--            z-index: 100;--}}
{{--        }--}}

{{--        #sidebar {--}}
{{--            z-index: 90;--}}
{{--            box-shadow: 8px 0 15px -3px rgba(0, 0, 0, 0.1);--}}
{{--            overflow-y: auto;--}}
{{--        }--}}

{{--        @media (min-width: 1024px) {--}}
{{--            main {--}}
{{--                margin-left: 20rem; /* Отстъп за sidebar на desktop */--}}
{{--            }--}}

{{--            #menuContainer {--}}
{{--                display: none;--}}
{{--            }--}}

{{--            #sidebar {--}}
{{--                transform: translateX(0);--}}
{{--            }--}}
{{--        }--}}


{{--        @media (max-width: 1023px) {--}}
{{--            .header-nav {--}}
{{--                display: none;--}}
{{--            }--}}
{{--        }--}}

{{--    </style>--}}
{{--</head>--}}

{{--<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">--}}
{{--<!-- Тънък Header -->--}}
{{--<header class="bg-white border-b border-gray-200 sticky top-0 z-30">--}}
{{--    <div class="container-fluid py-2 flex items-center gap-2 px-4">--}}
{{--        <!-- Бутон за отваряне на offcanvas (мобилни) -->--}}
{{--        <button class="btn btn-outline-secondary lg:hidden" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">--}}
{{--            <i id="offcanvasToggle" class="fa fa-bars"></i>--}}
{{--        </button>--}}

{{--        <a class="navbar-brand m-0 text-xl font-semibold text-indigo-700">--}}
{{--            <i class="fas fa-graduation-cap"></i>--}}
{{--            UNI Portal--}}
{{--        </a>--}}

{{--        <!-- Навигация в header (десктоп) -->--}}
{{--        <div class="header-nav ms-3">--}}
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

{{--        <div class="d-flex align-items-center gap-3 ms-auto">--}}
{{--            @auth--}}
{{--                <div class="dropdown">--}}
{{--                    <button class="btn btn-outline-primary dropdown-toggle flex items-center gap-2 px-3 py-1.5 border border-indigo-300 rounded-full text-indigo-700 hover:bg-indigo-50" data-bs-toggle="dropdown">--}}
{{--                        <i class="fa fa-user-circle"></i> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}--}}
{{--                    </button>--}}
{{--                    <ul class="dropdown-menu dropdown-menu-end absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50 hidden">--}}
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
{{--    </div>--}}
{{--</header>--}}

{{--<main class="p-4 lg:p-6">--}}

{{--    <div class="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">--}}
{{--        <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">--}}
{{--            <div>--}}
{{--                <h1 class="text-2xl font-bold text-gray-800">Достъпни изпити</h1>--}}
{{--                <p class="text-sm text-gray-500 mt-1">Преглед и записване за предстоящи изпити</p>--}}
{{--            </div>--}}
{{--            <a href="{{ route('my_exams') }}" class="inline-flex items-center gap-1 px-4 py-2.5 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors">--}}
{{--                <i class="fas fa-list-alt"></i>--}}
{{--                Моите изпити--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <!-- Alerts -->--}}
{{--    @include('partials.alerts')--}}

{{--    <!-- Основен content -->--}}
{{--    @if($exams->isEmpty())--}}
{{--        <div class="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">--}}
{{--            <i class="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>--}}
{{--            <h3 class="text-lg font-medium text-gray-700 mb-2">Няма налични изпити</h3>--}}
{{--            <p class="text-gray-500">В момента няма изпити за записване. Моля, проверете по-късно.</p>--}}
{{--        </div>--}}
{{--    @else--}}
{{--        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">--}}
{{--            @foreach ($exams as $exam)--}}
{{--                <div class="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-indigo-100 hover:-translate-y-0.5">--}}
{{--                    <div class="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">--}}
{{--                        <h2 class="text-lg font-semibold text-gray-900 leading-tight">--}}
{{--                            {{ $exam->subject->subject_name }}--}}
{{--                        </h2>--}}
{{--                        <div class="flex flex-wrap gap-2">--}}
{{--                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">--}}
{{--                                    {{ $exam->exam_type }}--}}
{{--                                </span>--}}
{{--                            <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $exam->remainingSlots() > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">--}}
{{--                                    {{ $exam->remainingSlots() > 0 ? $exam->remainingSlots().' Свободни места' : 'Няма места' }}--}}
{{--                                </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="space-y-3 mb-5">--}}
{{--                        <div class="flex items-center gap-2 text-gray-600">--}}
{{--                            <i class="fas fa-chalkboard-teacher w-5 text-gray-400"></i>--}}
{{--                            <span>Преподавател: <span class="font-medium text-gray-800">{{ $exam->teacher->user->first_name }} {{ $exam->teacher->user->last_name }}</span></span>--}}
{{--                        </div>--}}
{{--                        <div class="flex items-center gap-2 text-gray-600">--}}
{{--                            <i class="fas fa-calendar-alt w-5 text-gray-400"></i>--}}
{{--                            <span>Дата: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y ') }}</span></span>--}}
{{--                        </div>--}}
{{--                        <div class="flex items-center gap-2 text-gray-600">--}}
{{--                            <i class="fas fa-clock w-5 text-gray-400"></i>--}}
{{--                            <span>Продължителност: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format(' H:i') }} - {{ \Carbon\Carbon::parse($exam->end_time)->format(' H:i') }}</span></span>--}}
{{--                        </div>--}}
{{--                        <div class="flex items-center gap-2 text-gray-600">--}}
{{--                            <i class="fas fa-university w-5 text-gray-400"></i>--}}
{{--                            <span>Зала: <span class="font-medium text-gray-800">{{ $exam->hall->name }}</span></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @if($exam->exam_type === 'ликвидация' || $exam->subject->semester < Auth::user()->student->semester)--}}
{{--                        <button type="button"--}}
{{--                                class="w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 payment-btn--}}
{{--                                {{ $exam->remainingSlots() <= 0 ? 'bg-gray-300 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' }}"--}}
{{--                                {{ $exam->remainingSlots() <= 0 ? 'disabled' : '' }}--}}
{{--                                data-exam-id="{{ $exam->id }}"--}}
{{--                                data-subject="{{ $exam->subject->subject_name }}"--}}
{{--                                data-price="{{ $exam->price }}">--}}
{{--                            <i class="fas fa-credit-card mr-2"></i> Плати и се запиши--}}
{{--                        </button>--}}
{{--                    @else--}}
{{--                        <form method="POST" action="{{ route('student.exam.register', $exam) }}">--}}
{{--                            @csrf--}}
{{--                            <button type="submit"--}}
{{--                                    class="w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200--}}
{{--                                {{ $exam->remainingSlots() <= 0 ? 'bg-gray-300 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' }}"--}}
{{--                                {{ $exam->remainingSlots() <= 0 ? 'disabled' : '' }}>--}}
{{--                                <i class="fas fa-edit mr-2"></i> Запиши се--}}
{{--                            </button>--}}
{{--                        </form>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    @endif--}}
{{--</main>--}}

{{--<!-- Offcanvas Backdrop -->--}}
{{--<div class="offcanvas-backdrop" id="offcanvasBackdrop"></div>--}}

{{--<!-- Offcanvas Sidebar (mobile/tablet) -->--}}
{{--<div class="offcanvas" id="mobileSidebar">--}}
{{--    <div class="offcanvas-header">--}}
{{--        <h5 class="offcanvas-title">Навигация</h5>--}}
{{--        <button type="button" class="btn-close" id="offcanvasClose">--}}
{{--            <i class="fas fa-times"></i>--}}
{{--        </button>--}}
{{--    </div>--}}
{{--    <div class="offcanvas-body">--}}
{{--        <!-- Същото съдържание като в десктоп Sidebar -->--}}
{{--        <div class="card mb-4 bg-indigo-50 rounded-lg p-4 border-0">--}}
{{--            <div class="card-body py-3">--}}
{{--                <div class="d-flex align-items-center gap-3">--}}
{{--                    <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center border border-indigo-200">--}}
{{--                        <i class="fa fa-user-circle text-2xl text-indigo-600"></i>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <div class="fw-semibold text-gray-900">--}}
{{--                            @if(Auth::user()->role==='teacher')--}}
{{--                                {{$teacher->title}}--}}
{{--                            @endif--}}
{{--                            {{ Auth::user()->first_name }} {{Auth::user()->second_name}} {{ Auth::user()->last_name }}--}}
{{--                        </div>--}}
{{--                        <div class="text-xs text-gray-500 mt-1">--}}
{{--                            Фак. №: {{ Auth::user()->student->faculty_number }}--}}
{{--                        </div>--}}
{{--                        <div class="text-xs text-gray-500">--}}
{{--                            Имейл: {{ Auth::user()->email }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="nav-section">--}}
{{--            <div class="nav-section-title">Основни</div>--}}
{{--            <ul class="nav flex-column space-y-1">--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link flex items-center py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100" href="#" data-bs-dismiss="offcanvas">--}}
{{--                        <i class="fa fa-home me-2 text-gray-500"></i>Табло--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link flex items-center py-2 px-3 rounded-md text-indigo-700 bg-indigo-50" href="{{ route('exams') }}" data-bs-dismiss="offcanvas">--}}
{{--                        <i class="fa fa-file-pen me-2 text-indigo-600"></i>Достъпни изпити--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link flex items-center py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100" href="{{route('my_exams')}}" data-bs-dismiss="offcanvas">--}}
{{--                        <i class="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link flex items-center py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100" href="#" data-bs-dismiss="offcanvas">--}}
{{--                        <i class="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link flex items-center py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100" href="#" data-bs-dismiss="offcanvas">--}}
{{--                        <i class="fa fa-wallet me-2 text-gray-500"></i>Плащания--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link flex items-center py-2 px-3 rounded-md text-gray-700 hover:bg-gray-100" href="{{route('profile')}}" data-bs-dismiss="offcanvas">--}}
{{--                        <i class="fas fa-user me-2 text-gray-500"></i>Моят профил--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<!-- JavaScript -->--}}
{{--<script>--}}
{{--    // Функционалност за dropdown менюто--}}
{{--    document.addEventListener('DOMContentLoaded', function() {--}}
{{--        // Елементи--}}
{{--        const offcanvas = document.getElementById('mobileSidebar');--}}
{{--        const backdrop = document.getElementById('offcanvasBackdrop');--}}
{{--        const offcanvasToggle = document.getElementById('offcanvasToggle');--}}
{{--        const offcanvasClose = document.getElementById('offcanvasClose');--}}

{{--        // Функция за отваряне на offcanvas--}}
{{--        function openOffcanvas() {--}}
{{--            offcanvas.classList.add('show');--}}
{{--            backdrop.classList.add('show');--}}
{{--            document.body.style.overflow = 'hidden';--}}
{{--        }--}}

{{--        // Функция за затваряне на offcanvas--}}
{{--        function closeOffcanvas() {--}}
{{--            offcanvas.classList.remove('show');--}}
{{--            backdrop.classList.remove('show');--}}
{{--            document.body.style.overflow = 'auto';--}}
{{--        }--}}

{{--        // Слушатели за събития--}}
{{--        offcanvasToggle.addEventListener('click', openOffcanvas);--}}
{{--        offcanvasClose.addEventListener('click', closeOffcanvas);--}}
{{--        backdrop.addEventListener('click', closeOffcanvas);--}}

{{--        // Затваряне с клавиша Escape--}}
{{--        document.addEventListener('keydown', (e) => {--}}
{{--            if (e.key === 'Escape') closeOffcanvas();--}}
{{--        });--}}

{{--        // Затваряне при клик на линкове в навигацията--}}
{{--        document.querySelectorAll('.offcanvas-body a').forEach(link => {--}}
{{--            link.addEventListener('click', closeOffcanvas);--}}
{{--        });--}}

{{--        // Dropdown функционалност--}}
{{--        const dropdownToggle = document.querySelector('.dropdown-toggle');--}}
{{--        const dropdownMenu = document.querySelector('.dropdown-menu');--}}

{{--        if (dropdownToggle) {--}}
{{--            dropdownToggle.addEventListener('click', function(e) {--}}
{{--                e.stopPropagation();--}}
{{--                dropdownMenu.classList.toggle('hidden');--}}
{{--            });--}}

{{--            // Затваряне на dropdown при клик извън него--}}
{{--            document.addEventListener('click', function() {--}}
{{--                dropdownMenu.classList.add('hidden');--}}
{{--            });--}}

{{--            dropdownMenu.addEventListener('click', function(e) {--}}
{{--                e.stopPropagation();--}}
{{--            });--}}
{{--        }--}}

{{--        // Stripe payment functionality--}}
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
{{--                        headers: {--}}
{{--                            'Content-Type': 'application/json',--}}
{{--                            'X-CSRF-TOKEN': "{{ csrf_token() }}",--}}
{{--                        },--}}
{{--                        body: JSON.stringify({ exam_id: examId })--}}
{{--                    });--}}

{{--                    const { clientSecret } = await response.json();--}}

{{--                    stripe.initEmbeddedCheckout({--}}
{{--                        clientSecret--}}
{{--                    }).then((checkoutInstance) => {--}}
{{--                        checkout = checkoutInstance;--}}
{{--                        paymentModal.classList.remove('hidden');--}}
{{--                        checkout.mount('#checkout');--}}
{{--                    });--}}

{{--                } catch (error) {--}}
{{--                    console.error('Грешка:', error);--}}
{{--                    alert('Възникна грешка при инициализиране на плащането');--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}

{{--        closeModal.addEventListener('click', () => {--}}
{{--            paymentModal.classList.add('hidden');--}}
{{--            if (checkout) checkout.unmount();--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
{{--</body>--}}
{{--</html>--}}
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
{{--        :root {--}}
{{--            --sb-w: 20rem;--}}
{{--            --header-h: 64px;--}}
{{--        }--}}

{{--        body {--}}
{{--            background: #f8f9fa;--}}
{{--            font-family: 'Inter', sans-serif;--}}
{{--        }--}}

{{--        .nav-link.active, .list-group-item.active {--}}
{{--            background: rgba(79, 70, 229, 0.08) !important;--}}
{{--            font-weight: 600;--}}
{{--            color: #4f46e5 !important;--}}
{{--        }--}}

{{--        .content-card {--}}
{{--            background: #fff;--}}
{{--            border: 1px solid #e5e7eb;--}}
{{--            border-radius: 0.5rem;--}}
{{--            padding: 1.25rem;--}}
{{--        }--}}

{{--        .btn-primary {--}}
{{--            background-color: #4f46e5;--}}
{{--            color: white;--}}
{{--        }--}}

{{--        .btn-primary:hover {--}}
{{--            background-color: #4338ca;--}}
{{--        }--}}

{{--        /* Нов стил за хоризонталното меню в header */--}}
{{--        .header-nav {--}}
{{--            display: flex;--}}
{{--            gap: 0.5rem;--}}
{{--            padding: 0.5rem 1rem;--}}
{{--            background: white;--}}
{{--            overflow-x: auto;--}}
{{--            white-space: nowrap;--}}
{{--        }--}}

{{--        .header-nav .nav-link {--}}
{{--            padding: 0.5rem 1rem;--}}
{{--            border-radius: 0.375rem;--}}
{{--            transition: all 0.2s;--}}
{{--        }--}}

{{--        .header-nav-brand {--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            color: white;--}}
{{--            font-weight: 600;--}}
{{--            font-size: 1.25rem;--}}
{{--            text-decoration: none;--}}
{{--        }--}}

{{--        .header-nav-brand i {--}}
{{--            margin-right: 0.5rem;--}}
{{--            font-size: 1.5rem;--}}
{{--        }--}}

{{--        /* Стилове за новия sidebar */--}}
{{--        #sidebar {--}}
{{--            position: fixed;--}}
{{--            left: -100%;--}}
{{--            top: 0;--}}
{{--            height: 100vh;--}}
{{--            width: 20rem;--}}
{{--            background: white;--}}
{{--            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);--}}
{{--            padding: 1.5rem;--}}
{{--            border-right: 1px solid #e5e7eb;--}}
{{--            transition: left 0.3s ease-in-out;--}}
{{--            z-index: 40;--}}
{{--            overflow-y: auto;--}}
{{--        }--}}

{{--        #sidebar.show {--}}
{{--            left: 0;--}}
{{--        }--}}

{{--        @media (min-width: 1024px) {--}}
{{--            #sidebar {--}}
{{--                left: 0;--}}
{{--                width: 20rem;--}}
{{--            }--}}

{{--            main, header {--}}
{{--                margin-left: 20rem;--}}
{{--            }--}}

{{--            #menuContainer {--}}
{{--                display: none;--}}
{{--            }--}}
{{--        }--}}

{{--        @media (max-width: 1023px) {--}}
{{--            .header-nav {--}}
{{--                display: none;--}}
{{--            }--}}

{{--            #menuContainer {--}}
{{--                display: block;--}}
{{--                position: fixed;--}}
{{--                top: 1.5rem;--}}
{{--                left: 1rem;--}}
{{--                z-index: 100;--}}
{{--            }--}}
{{--        }--}}

{{--        /* Стил за задния фон при отворен sidebar на мобилни */--}}
{{--        .sidebar-backdrop {--}}
{{--            display: none;--}}
{{--            position: fixed;--}}
{{--            top: 0;--}}
{{--            left: 0;--}}
{{--            width: 100%;--}}
{{--            height: 100%;--}}
{{--            background-color: rgba(0, 0, 0, 0.5);--}}
{{--            z-index: 30;--}}
{{--        }--}}

{{--        .sidebar-backdrop.show {--}}
{{--            display: block;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}

{{--<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">--}}
{{--<!-- Backdrop за мобилния sidebar -->--}}
{{--<div class="sidebar-backdrop" id="sidebarBackdrop"></div>--}}

{{--<!-- Toggle button за мобилни -->--}}
{{--<div class="lg:hidden fixed top-6 z-[100]" id="menuContainer">--}}
{{--    <button id="menuToggle" class="p-3.5 bg-indigo-50/80 backdrop-blur-sm rounded-xl shadow-lg hover:shadow-xl transition-all--}}
{{--               ring-1 ring-indigo-100 flex items-center justify-center ml-4">--}}
{{--        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>--}}
{{--        </svg>--}}
{{--    </button>--}}
{{--</div>--}}




{{--<!-- Тънък Header -->--}}
{{--<header class="bg-white border-b border-gray-200 sticky top-0 z-30">--}}
{{--    <div class="container-fluid py-2 flex items-center gap-2 px-4">--}}
{{--        <a class="navbar-brand m-0 text-xl font-semibold text-indigo-700">--}}
{{--            <i class="fas fa-graduation-cap"></i>--}}
{{--            UNI Portal--}}
{{--        </a>--}}

{{--        <!-- Навигация в header (десктоп) -->--}}
{{--        <div class="header-nav ms-3">--}}
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

{{--        <div class="d-flex align-items-center gap-3 ms-auto">--}}
{{--            @auth--}}
{{--                <div class="dropdown">--}}
{{--                    <button class="btn btn-outline-primary dropdown-toggle flex items-center gap-2 px-3 py-1.5 border border-indigo-300 rounded-full text-indigo-700 hover:bg-indigo-50" data-bs-toggle="dropdown">--}}
{{--                        <i class="fa fa-user-circle"></i> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}--}}
{{--                    </button>--}}
{{--                    <ul class="dropdown-menu dropdown-menu-end absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50 hidden">--}}
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
{{--    </div>--}}
{{--</header>--}}

{{--<aside id="sidebar">--}}
{{--    <div class="flex flex-col h-flex">--}}
{{--        <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-4 border-b border-gray-100 flex items-center">--}}
{{--            <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 overflow-hidden">--}}
{{--                <img src="{{ asset('images/tu-image.png') }}" alt="Лого" class="w-full h-full object-cover" loading="lazy">--}}
{{--            </div>--}}
{{--            @if(Auth::user()->role==='student')--}}
{{--                Студентски профил--}}
{{--            @elseif(Auth::user()->role==='teacher')--}}
{{--                Преподавателски профил--}}
{{--            @endif--}}

{{--            <!-- Close button за мобилни -->--}}
{{--            <button id="closeSidebar" class="lg:hidden ml-auto text-gray-500 hover:text-gray-700">--}}
{{--                <i class="fas fa-times"></i>--}}
{{--            </button>--}}
{{--        </h2>--}}

{{--        <div class="space-y-5 flex-1">--}}
{{--            <div class="flex items-center gap-4">--}}
{{--                <div class="w-14 h-14 rounded-full bg-primary-100 flex items-center justify-center">--}}
{{--                    <i class="fas fa-user text-xl text-primary-600"></i>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <p class="font-medium text-gray-900">--}}
{{--                        @if(Auth::user()->role==='teacher')--}}
{{--                            {{$teacher->title}}--}}
{{--                        @endif--}}
{{--                        {{ Auth::user()->first_name }} {{ Auth::user()->second_name }} {{ Auth::user()->last_name }}</p>--}}
{{--                    @if(Auth::user()->role==='student')--}}
{{--                        <p class="text-sm text-gray-500 mt-1">№: <span class="font-mono">{{ Auth::user()->student->faculty_number }}</span></p>--}}
{{--                    @else--}}
{{--                        <p class="text-sm text-gray-500 mt-1">--}}
{{--                            <i class="fas fa-clipboard-list text-gray-400"></i>--}}
{{--                            {{ $teacher->exams_count }} активни изпита--}}
{{--                        </p>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="space-y-3.5 mt-4">--}}
{{--                @if(Auth::user()->role==='student')--}}
{{--                    <div>--}}
{{--                        @if(Auth::user()->role==='student')--}}
{{--                            <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Специалност/Факултет</p>--}}
{{--                            <p class="font-medium text-gray-800">{{ Auth::user()->student->specialty->name }} / {{Auth::user()->student->faculty->name}}</p>--}}
{{--                        @elseif(Auth::user()->role==='teacher')--}}
{{--                            <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Факултет</p>--}}
{{--                            <p class="font-medium text-gray-800">{{ Auth::user()->teacher->faculty }}</p>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                @elseif(Auth::user()->role==='teacher')--}}
{{--                    <div>--}}
{{--                        <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Факултет</p>--}}
{{--                        <p class="font-medium text-gray-800">{{ Auth::user()->teacher->faculty }}</p>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <div>--}}
{{--                    <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Потребителско име</p>--}}
{{--                    <p class="font-medium text-gray-800">{{ Auth::user()->username }}</p>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Майл</p>--}}
{{--                    <p class="font-medium text-gray-800">{{ Auth::user()->email }}</p>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Телефонен номер</p>--}}
{{--                    <p class="font-medium text-gray-800">{{ Auth::user()->phone }}</p>--}}
{{--                </div>--}}
{{--                @if(Auth::user()->role==='student')--}}
{{--                    <div>--}}
{{--                        <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Статус</p>--}}
{{--                        @if(Auth::user()->student->semester<8)--}}
{{--                            <p class="font-medium text-green-600 flex items-center gap-1.5">--}}
{{--                                <i class="fas fa-check-circle"></i>Активен--}}
{{--                            </p>--}}
{{--                        @else--}}
{{--                            <p class="font-medium text-red-600 flex items-center gap-1.5">--}}
{{--                                <i class="fas fa-times-circle"></i>Неактивен--}}
{{--                            </p>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="pt-4 border-t border-gray-100">--}}
{{--            <form action="{{ route('logout') }}" method="POST">--}}
{{--                @csrf--}}
{{--                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">--}}
{{--                    <i class="fas fa-sign-out-alt"></i>--}}
{{--                    <span>Изход от системата</span>--}}
{{--                </button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</aside>--}}

{{--<main class="p-4 lg:p-6">--}}
{{--    <div class="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">--}}
{{--        <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">--}}
{{--            <div>--}}
{{--                <h1 class="text-2xl font-bold text-gray-800">Достъпни изпити</h1>--}}
{{--                <p class="text-sm text-gray-500 mt-1">Преглед и записване за предстоящи изпити</p>--}}
{{--            </div>--}}
{{--            <a href="{{ route('my_exams') }}" class="inline-flex items-center gap-1 px-4 py-2.5 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors">--}}
{{--                <i class="fas fa-list-alt"></i>--}}
{{--                Моите изпити--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <!-- Alerts -->--}}
{{--    @include('partials.alerts')--}}

{{--    <!-- Основен content -->--}}
{{--    @if($exams->isEmpty())--}}
{{--        <div class="text-center p-8 bg-white border border-gray-100 shadow-sm rounded-xl">--}}
{{--            <i class="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>--}}
{{--            <h3 class="text-lg font-medium text-gray-700 mb-2">Няма налични изпити</h3>--}}
{{--            <p class="text-gray-500">В момента няма изпити за записване. Моля, проверете по-късно.</p>--}}
{{--        </div>--}}
{{--    @else--}}
{{--        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3">--}}
{{--            @foreach ($exams as $exam)--}}
{{--                <div class="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 hover:shadow-md transition-all hover:border-indigo-100 hover:-translate-y-0.5">--}}
{{--                    <div class="flex flex-col sm:flex-row sm:justify-between items-start gap-2 mb-3">--}}
{{--                        <h2 class="text-lg font-semibold text-gray-900 leading-tight">--}}
{{--                            {{ $exam->subject->subject_name }}--}}
{{--                        </h2>--}}
{{--                        <div class="flex flex-wrap gap-2">--}}
{{--                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">--}}
{{--                                        {{ $exam->exam_type }}--}}
{{--                                    </span>--}}
{{--                            <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $exam->remainingSlots() > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">--}}
{{--                                        {{ $exam->remainingSlots() > 0 ? $exam->remainingSlots().' Свободни места' : 'Няма места' }}--}}
{{--                                    </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="space-y-3 mb-5">--}}
{{--                        <div class="flex items-center gap-2 text-gray-600">--}}
{{--                            <i class="fas fa-chalkboard-teacher w-5 text-gray-400"></i>--}}
{{--                            <span>Преподавател: <span class="font-medium text-gray-800">{{ $exam->teacher->user->first_name }} {{ $exam->teacher->user->last_name }}</span></span>--}}
{{--                        </div>--}}
{{--                        <div class="flex items-center gap-2 text-gray-600">--}}
{{--                            <i class="fas fa-calendar-alt w-5 text-gray-400"></i>--}}
{{--                            <span>Дата: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format('d.m.Y ') }}</span></span>--}}
{{--                        </div>--}}
{{--                        <div class="flex items-center gap-2 text-gray-600">--}}
{{--                            <i class="fas fa-clock w-5 text-gray-400"></i>--}}
{{--                            <span>Продължителност: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($exam->start_time)->format(' H:i') }} - {{ \Carbon\Carbon::parse($exam->end_time)->format(' H:i') }}</span></span>--}}
{{--                        </div>--}}
{{--                        <div class="flex items-center gap-2 text-gray-600">--}}
{{--                            <i class="fas fa-university w-5 text-gray-400"></i>--}}
{{--                            <span>Зала: <span class="font-medium text-gray-800">{{ $exam->hall->name }}</span></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @if($exam->exam_type === 'ликвидация' || $exam->subject->semester < Auth::user()->student->semester)--}}
{{--                        <button type="button"--}}
{{--                                class="w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200 payment-btn--}}
{{--                                    {{ $exam->remainingSlots() <= 0 ? 'bg-gray-300 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' }}"--}}
{{--                                {{ $exam->remainingSlots() <= 0 ? 'disabled' : '' }}--}}
{{--                                data-exam-id="{{ $exam->id }}"--}}
{{--                                data-subject="{{ $exam->subject->subject_name }}"--}}
{{--                                data-price="{{ $exam->price }}">--}}
{{--                            <i class="fas fa-credit-card mr-2"></i> Плати и се запиши--}}
{{--                        </button>--}}
{{--                    @else--}}
{{--                        <form method="POST" action="{{ route('student.exam.register', $exam) }}">--}}
{{--                            @csrf--}}
{{--                            <button type="submit"--}}
{{--                                    class="w-full px-4 py-2.5 rounded-xl text-white font-medium transition-colors duration-200--}}
{{--                                    {{ $exam->remainingSlots() <= 0 ? 'bg-gray-300 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' }}"--}}
{{--                                {{ $exam->remainingSlots() <= 0 ? 'disabled' : '' }}>--}}
{{--                                <i class="fas fa-edit mr-2"></i> Запиши се--}}
{{--                            </button>--}}
{{--                        </form>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    @endif--}}
{{--</main>--}}

{{--<!-- JavaScript -->--}}
{{--<script>--}}
{{--    document.addEventListener('DOMContentLoaded', function() {--}}
{{--        // Функционалност за sidebar--}}
{{--        const sidebar = document.getElementById('sidebar');--}}
{{--        const menuToggle = document.getElementById('menuToggle');--}}
{{--        const closeSidebar = document.getElementById('closeSidebar');--}}
{{--        const sidebarBackdrop = document.getElementById('sidebarBackdrop');--}}

{{--        function openSidebar() {--}}
{{--            sidebar.classList.add('show');--}}
{{--            sidebarBackdrop.classList.add('show');--}}
{{--            document.body.style.overflow = 'hidden';--}}
{{--        }--}}

{{--        function closeSidebarFunc() {--}}
{{--            sidebar.classList.remove('show');--}}
{{--            sidebarBackdrop.classList.remove('show');--}}
{{--            document.body.style.overflow = 'auto';--}}
{{--        }--}}

{{--        menuToggle.addEventListener('click', openSidebar);--}}
{{--        closeSidebar.addEventListener('click', closeSidebarFunc);--}}
{{--        sidebarBackdrop.addEventListener('click', closeSidebarFunc);--}}

{{--        // Затваряне с клавиша Escape--}}
{{--        document.addEventListener('keydown', (e) => {--}}
{{--            if (e.key === 'Escape') closeSidebarFunc();--}}
{{--        });--}}

{{--        // Dropdown функционалност--}}
{{--        const dropdownToggle = document.querySelector('.dropdown-toggle');--}}
{{--        const dropdownMenu = document.querySelector('.dropdown-menu');--}}

{{--        if (dropdownToggle) {--}}
{{--            dropdownToggle.addEventListener('click', function(e) {--}}
{{--                e.stopPropagation();--}}
{{--                dropdownMenu.classList.toggle('hidden');--}}
{{--            });--}}

{{--            // Затваряне на dropdown при клик извън него--}}
{{--            document.addEventListener('click', function() {--}}
{{--                dropdownMenu.classList.add('hidden');--}}
{{--            });--}}

{{--            dropdownMenu.addEventListener('click', function(e) {--}}
{{--                e.stopPropagation();--}}
{{--            });--}}
{{--        }--}}

{{--        // Stripe payment functionality--}}
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
{{--                        headers: {--}}
{{--                            'Content-Type': 'application/json',--}}
{{--                            'X-CSRF-TOKEN': "{{ csrf_token() }}",--}}
{{--                        },--}}
{{--                        body: JSON.stringify({ exam_id: examId })--}}
{{--                    });--}}

{{--                    const { clientSecret } = await response.json();--}}

{{--                    stripe.initEmbeddedCheckout({--}}
{{--                        clientSecret--}}
{{--                    }).then((checkoutInstance) => {--}}
{{--                        checkout = checkoutInstance;--}}
{{--                        paymentModal.classList.remove('hidden');--}}
{{--                        checkout.mount('#checkout');--}}
{{--                    });--}}

{{--                } catch (error) {--}}
{{--                    console.error('Грешка:', error);--}}
{{--                    alert('Възникна грешка при инициализиране на плащането');--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}

{{--        if (closeModal) {--}}
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

    <style>
        :root{
            --sb-w: 20rem;         /* ширина на sidebar на десктоп */
            --header-h: 64px;      /* ще се презапише динамично от JS */
        }

        body{
            background:#f8f9fa;
            font-family:'Inter',sans-serif;
        }

        .nav-link.active, .list-group-item.active{
            background:rgba(79,70,229,.08)!important;
            font-weight:600;
            color:#4f46e5!important;
        }

        .content-card{
            background:#fff;border:1px solid #e5e7eb;border-radius:.5rem;padding:1.25rem;
        }

        .btn-primary{background:#4f46e5;color:#fff}
        .btn-primary:hover{background:#4338ca}

        /* Header навигация (десктоп) */
        .header-nav{display:flex;gap:.5rem;padding:.5rem 1rem;background:white;overflow-x:auto;white-space:nowrap;}
        .header-nav .nav-link{padding:.5rem 1rem;border-radius:.375rem;transition:.2s}

        /* -------- Sidebar: винаги под header -------- */
        /* Мобилни: offcanvas, но започва под header */
        #sidebar{
            position: fixed;
            left: -100%;
            top: var(--header-h);
            height: calc(100dvh - var(--header-h));
            width: var(--sb-w);
            background: #fff;
            box-shadow: 2px 0 10px rgba(0,0,0,.1);
            padding: 1.5rem;
            border-right: 1px solid #e5e7eb;
            transition: left .3s ease-in-out;

            overflow-y: auto;
        }
        #sidebar.show{ left:0; }

        /* Десктоп: статичен layout под header (без fixed) */
        @media (min-width:1024px){
            #sidebar{
                position: sticky;
                top: 0; /* sticky вътре в layout контейнера, който вече е под header */
                height: calc(100dvh - 0px);
                left: 0;
                transform: none;
            }
            /* бутонът за меню не трябва да се показва */
            #menuContainer{ display:none; }
            /* header навигацията да се показва */
            .header-nav{ display:flex; }
        }

        /* Мобилни: скриваме header навигацията, показваме бургер бутона */
        @media (max-width:1023px){
            .header-nav{ display:none; }
            #menuContainer{
                display:block;
                position: fixed;
                top: calc(var(--header-h) - 48px); /* плаващ бутон малко под горния ръб */
                left: 1rem;
                z-index: 100;
            }
        }

        /* Backdrop за offcanvas на мобилни — започва под header */
        .sidebar-backdrop{
            display:none;
            position: fixed;
            top: var(--header-h);
            left:0;
            width:100%;
            height: calc(100dvh - var(--header-h));
            background: rgba(0,0,0,.5);
            z-index:30;
        }
        .sidebar-backdrop.show{ display:block; }

        /* Layout под header: grid на десктоп, нормален поток на мобилни */
        .page-layout{
            /* на мобилни е просто поток: първо sidebar (скрит/offcanvas), после main */
        }
        @media (min-width:1024px){
            .page-layout{
                display:grid;
                grid-template-columns: var(--sb-w) 1fr;
                gap: 0;
                min-height: calc(100dvh - var(--header-h));
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-indigo-50 to-blue-50 min-h-screen overflow-x-hidden">
<!-- Backdrop за мобилния sidebar -->
<div class="sidebar-backdrop" id="sidebarBackdrop"></div>

<!-- Бутон за мобилно меню -->
<div class="lg:hidden fixed z-[100]" id="menuContainer">
    <button id="menuToggle"
            class="p-3.5 bg-indigo-50/80 backdrop-blur-sm rounded-xl shadow-lg hover:shadow-xl transition-all ring-1 ring-indigo-100 flex items-center justify-center ml-4">
        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>
</div>

<!-- Тънък Header (стои най-отгоре) -->
<header id="siteHeader" class="bg-white border-b border-gray-200 sticky top-0 z-30">
    <div class="container-fluid py-2 flex items-center gap-2 px-4">
        <a class="navbar-brand m-0 text-xl font-semibold text-indigo-700">
            <i class="fas fa-graduation-cap"></i>
            UNI Portal
        </a>

        <!-- Навигация в header (десктоп) -->
        <div class="header-nav ms-3">
            <a class="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">
                <i class="fa fa-home me-2 text-gray-500"></i>Начало
            </a>
            <a class="nav-link flex items-center text-indigo-700 bg-indigo-50" href="{{ route('exams') }}">
                <i class="fa fa-file-pen me-2 text-indigo-600"></i>Достъпни изпити
            </a>
            <a class="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="{{route('my_exams')}}">
                <i class="fa fa-calendar me-2 text-gray-500"></i>Предстоящи изпити
            </a>
            <a class="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">
                <i class="fa fa-wallet me-2 text-gray-500"></i>Изминали изпити
            </a>
            <a class="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="#">
                <i class="fa fa-wallet me-2 text-gray-500"></i>Плащания
            </a>
            <a class="nav-link flex items-center text-gray-700 hover:bg-gray-100" href="{{route('profile')}}">
                <i class="fas fa-user me-2 text-gray-500"></i>Моят профил
            </a>
        </div>

        <div class="d-flex align-items-center gap-3 ms-auto">
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
    </div>
</header>

<!-- ВСИЧКО ПОД HEADER-А -->
<div class="page-layout">

    <!-- Sidebar: вече е под header; на десктоп е лявата колона; на мобилни е offcanvas -->
    <aside id="sidebar">
        <div class="flex flex-col h-full">
            <h2 class="text-xl font-semibold text-gray-900 mb-6 pb-4 border-b border-gray-100 flex items-center">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 overflow-hidden">
                    <img src="{{ asset('images/tu-image.png') }}" alt="Лого" class="w-full h-full object-cover" loading="lazy">
                </div>
                @if(Auth::user()->role==='student')
                    Студентски профил
                @elseif(Auth::user()->role==='teacher')
                    Преподавателски профил
                @endif

                <!-- Close button за мобилни -->
                <button id="closeSidebar" class="lg:hidden ml-auto text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </h2>

            <div class="space-y-5 flex-1">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-primary-100 flex items-center justify-center">
                        <i class="fas fa-user text-xl text-primary-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">
                            @if(Auth::user()->role==='teacher')
                                {{$teacher->title}}
                            @endif
                            {{ Auth::user()->first_name }} {{ Auth::user()->second_name }} {{ Auth::user()->last_name }}
                        </p>
                        @if(Auth::user()->role==='student')
                            <p class="text-sm text-gray-500 mt-1">№: <span class="font-mono">{{ Auth::user()->student->faculty_number }}</span></p>
                        @else
                            <p class="text-sm text-gray-500 mt-1">
                                <i class="fas fa-clipboard-list text-gray-400"></i>
                                {{ $teacher->exams_count }} активни изпита
                            </p>
                        @endif
                    </div>
                </div>

                <div class="space-y-3.5 mt-4">
                    @if(Auth::user()->role==='student')
                        <div>
                            <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Специалност/Факултет</p>
                            <p class="font-medium text-gray-800">{{ Auth::user()->student->specialty->name }} / {{Auth::user()->student->faculty->name}}</p>
                        </div>
                    @elseif(Auth::user()->role==='teacher')
                        <div>
                            <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Факултет</p>
                            <p class="font-medium text-gray-800">{{ Auth::user()->teacher->faculty }}</p>
                        </div>
                    @endif

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

                    @if(Auth::user()->role==='student')
                        <div>
                            <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wider">Статус</p>
                            @if(Auth::user()->student->semester<8)
                                <p class="font-medium text-green-600 flex items-center gap-1.5">
                                    <i class="fas fa-check-circle"></i>Активен
                                </p>
                            @else
                                <p class="font-medium text-red-600 flex items-center gap-1.5">
                                    <i class="fas fa-times-circle"></i>Неактивен
                                </p>
                            @endif
                        </div>
                    @endif
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

    <!-- Основно съдържание (втората колона на десктоп) -->
    <main class="p-4 lg:p-6">
        <div class="bg-white/90 backdrop-blur-md shadow-sm py-4 mb-6 rounded-xl border border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center px-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Достъпни изпити</h1>
                    <p class="text-sm text-gray-500 mt-1">Преглед и записване за предстоящи изпити</p>
                </div>
                <a href="{{ route('my_exams') }}" class="inline-flex items-center gap-1 px-4 py-2.5 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition-colors">
                    <i class="fas fa-list-alt"></i>
                    Моите изпити
                </a>
            </div>
        </div>

        <!-- Alerts -->
        @include('partials.alerts')

        <!-- Основен content -->
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

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1) Задаваме височината на header-а като CSS променлива,
        //    за да поставим sidebar и backdrop точно ПОД него.
        const header = document.getElementById('siteHeader');
        function setHeaderHeightVar(){
            const h = header.getBoundingClientRect().height;
            document.documentElement.style.setProperty('--header-h', h + 'px');
        }
        setHeaderHeightVar();
        window.addEventListener('resize', setHeaderHeightVar);

        // 2) Sidebar offcanvas (мобилни)
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.getElementById('menuToggle');
        const closeSidebar = document.getElementById('closeSidebar');
        const sidebarBackdrop = document.getElementById('sidebarBackdrop');

        function openSidebar(){
            sidebar.classList.add('show');
            sidebarBackdrop.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
        function closeSidebarFunc(){
            sidebar.classList.remove('show');
            sidebarBackdrop.classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        if(menuToggle) menuToggle.addEventListener('click', openSidebar);
        if(closeSidebar) closeSidebar.addEventListener('click', closeSidebarFunc);
        if(sidebarBackdrop) sidebarBackdrop.addEventListener('click', closeSidebarFunc);

        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeSidebarFunc(); });

        // 3) Dropdown за профил бутона
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

        // 4) Stripe Embedded Checkout
        const stripe = Stripe("{{ config('services.stripe.key') }}");
        let checkout;

        const paymentButtons = document.querySelectorAll('.payment-btn');
        const paymentModal = document.getElementById('paymentModal');
        const closeModal = document.getElementById('closeModal');

        paymentButtons.forEach(button => {
            button.addEventListener('click', async function() {
                const examId = this.dataset.examId;
                try {
                    const url = "{{route('payment.handle',['exam'=>'__examId__'])}}".replace('__examId__', examId);
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                        body: JSON.stringify({ exam_id: examId })
                    });

                    const { clientSecret } = await response.json();
                    stripe.initEmbeddedCheckout({ clientSecret }).then((checkoutInstance) => {
                        checkout = checkoutInstance;
                        if (paymentModal) paymentModal.classList.remove('hidden');
                        const mountPoint = document.getElementById('checkout');
                        if (mountPoint) checkout.mount('#checkout');
                    });
                } catch (error) {
                    console.error('Грешка:', error);
                    alert('Възникна грешка при инициализиране на плащането');
                }
            });
        });

        if (closeModal && paymentModal) {
            closeModal.addEventListener('click', () => {
                paymentModal.classList.add('hidden');
                if (checkout) checkout.unmount();
            });
        }
    });
</script>
</body>
</html>
