<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading">Pages </div>
    <div class="list-group list-group-flush">
        @guest
        {{-- <a href="{{ route('login') }}" class="list-group-item list-group-item-action bg-light">{{ __('Login') }}</a>
        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="list-group-item list-group-item-action bg-light">{{ __('Register') }}</a> --}}
        {{-- @endif --}}
        @else
        <a href="/home" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <a href="{{ route('admin.users.records',Auth::user()) }}" class="list-group-item list-group-item-action bg-light">View Your Records</a>
        @can('Manage-users')
        <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action bg-light">User Managment</a>
        <a href="{{ route('machines.index') }}" class="list-group-item list-group-item-action bg-light">View Machines</a>
        <a href="{{ route('rooms.index') }}" class="list-group-item list-group-item-action bg-light">View Rooms</a>
        <a href="{{ route('cards.index') }}" class="list-group-item list-group-item-action bg-light">View Cards</a>
        @endcan
        @endguest
    </div>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

{{--
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">

    <ul class="c-sidebar-nav">

        @guest
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('login') }}">
                {{ __('Login') }}
            </a>
        </li>

        @if (Route::has('register'))
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('register') }}">
                {{ __('Register') }}
            </a>
        </li>
        @endif
        @else
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/home">
                Dashboard
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                Logout

            </a>
        </li>
        @can('Manage-users')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('admin.users.index') }}">
                User Management

            </a>
        </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('admin.users.records',Auth::user()) }}">
                View Your Records
            </a>
        </li>
        @can('Manage-users')
        <li class="c-sidebar-nav-item">

            <a class="c-sidebar-nav-link" href="{{ route('machines.index') }}">
                View Machines
            </a>

        </li>
        @endcan
        @can('Manage-users')
        <li class="c-sidebar-nav-item">

            <a class="c-sidebar-nav-link" href="{{ route('cards.index') }}">
                View Cards
            </a>

        </li>
        @endcan
        @can('Manage-users')
        <li class="c-sidebar-nav-item">

            <a class="c-sidebar-nav-link" href="{{ route('rooms.index') }}">
                View Rooms
            </a>

        </li>
        @endcan
        @endguest
    </ul>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form> --}}
