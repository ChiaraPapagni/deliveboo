<div class="nav">
    <input type="checkbox" id="nav-check">

    {{-- <div class="nav-header">
    <div class="nav-title">
      JoGeek
    </div>
  </div> --}}

    <div class="nav-btn">
        <label for="nav-check">
            <span></span>
            <span></span>
            <span></span>
        </label>
    </div>

    <div class="container-lg container-fluid nav-links d-flex justify-content-between w-100">

        <div class="left-side-links">
            <a href="//github.io/jo_geek" target="_blank">Ristoranti</a>
            <a href="http://stackoverflow.com/users/4084003/" target="_blank">La cucina che vorrei</a>
        </div>


        <div class="container-link" style="display: flex;">
            @guest


                <a href="{{ route('login') }}"> {{ __('Login') }} </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif

            @else
                <a class="" href="#">
                    {{ Auth::user()->name }}
                </a>

                {{-- <a class="" href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a> --}}

                <a class="dropdown-item logout" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">{{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            @endguest
        </div>

    </div>
</div>
