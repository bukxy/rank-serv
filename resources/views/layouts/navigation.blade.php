<header class="p-3 mb-3 border-bottom">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="{{route('index')}}" class="nav-link px-2 link-secondary">Home</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">Premium</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">FAQ</a></li>
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link px-2 link-dark" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 link-dark" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link px-2 link-dark" href="{{ route('add-server') }}">{{ __('Add Server') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 link-dark" href="{{ route('my-account') }}">{{ __('Account') }}</a>
                </li>
                @if(Auth::user()->role == "admin")
                    <li>
                        <a class="nav-link px-2 link-dark" href="{{ route('back.dashboard') }}">{{ __('Admin') }}</a>
                    </li>
                @endif
            @endguest
        </ul>
    </div>
</header>
