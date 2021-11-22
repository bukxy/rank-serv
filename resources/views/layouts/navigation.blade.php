<header class="p-3 mb-3 border-bottom">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">Premium</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">FAQ</a></li>
        </ul>

        <form class="col-6 w-75 mb-3 mb-lg-0 me-lg-5">
            <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>

        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('add-server') }}">{{ __('Add Server') }}</a>
                </li>
                <div class="dropdown">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownMenuUser" data-toggle="dropdown">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small dropdown-menu-right" aria-labelledby="dropdownMenuUser">
                        <li><a class="dropdown-item" href="{{ route('my-account') }}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('my-servers') }}">My Server(s)</a></li>
                        <li><a class="dropdown-item" href="{{ route('my-settings') }}">Settings</a></li>
                        @if(Auth::user()->role == "admin")
                        <li><a class="dropdown-item" href="{{ route('back.dashboard') }}">Dashboard</a></li>
                        @endif
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item" href="#">{{ __('Logout') }}</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endguest
        </ul>
    </div>
</header>
