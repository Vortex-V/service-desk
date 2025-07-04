@use(Illuminate\Support\Facades\Gate)

<x-layout.clean title="{{$title ?? null}}">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Service Desk') }}
                </a>
                <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav nav-underline me-auto">
                        @auth
                            @if(Gate::allows('admin'))
                                <x-bs.dropdown.nav-item>
                                    <x-slot:label>Админ панель</x-slot:label>
                                    <li><a class="dropdown-item" href="{{ route('users.index') }}">Пользователи</a></li>
                                    <li><a class="dropdown-item" href="{{ route('clients.index') }}">Клиенты</a></li>
                                </x-bs.dropdown.nav-item>
                            @endif
                            <x-bs.navbar.nav-item url="{{ route('home') }}">
                                @if(Gate::allows('admin'))
                                    Заявки
                                @else
                                    Мои заявки
                                @endif
                            </x-bs.navbar.nav-item>
                            @unless(Gate::allows('admin'))
                                <x-bs.navbar.nav-item url="{{ route('tickets.create') }}">
                                    Создать заявку
                                </x-bs.navbar.nav-item>
                            @endunless
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->fullName }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Выйти
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            {{ $slot }}
        </main>
    </div>
</x-layout.clean>
