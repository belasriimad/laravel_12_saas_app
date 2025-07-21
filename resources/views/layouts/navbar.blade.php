<ul class="nav nav-underline justify-content-center">
    @auth
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('qrcodes.index') ? 'active' : '' }}" aria-current="page" href="{{ route('qrcodes.index') }}">
                <i class="fas fa-home"></i> Home
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.profile') }}">
                <i class="fas fa-user"></i> {{ auth()->user()->name }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"
                onclick="document.getElementById('logoutForm').submit()"
                href="#">
                <i class="fas fa-sign-out"></i> Logout
            </a>
            <form action="{{ route('logout') }}" id="logoutForm" method="POST">
                @csrf
            </form>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark disabled" href="#">
                <i class="fas fa-qrcode fa-xl"></i> ({{ auth()->user()->number_of_qrcodes }})
            </a>
        </li>
    @endauth
    @guest
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">
                <i class="fas fa-home"></i> Home
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.register') ? 'active' : '' }}" href="{{ route('user.register') }}">
                <i class="fas fa-user-plus"></i> Register
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
                <i class="fas fa-sign-in"></i> Login
            </a>
        </li>
    @endguest
</ul>