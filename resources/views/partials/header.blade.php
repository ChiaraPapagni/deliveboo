{{-- Questa è la nav per l'utente con ristoranti --}}

<div class="nav Has block">
    <input type="checkbox" id="nav-check">

    <div class="logo">
    </div>

    <div class="container-lg container-fluid nav-links d-flex justify-content-between w-100">

        <div>
            <a href="//github.io/jo_geek" target="_blank">pagina (link inutili)</a>
            <a href="http://stackoverflow.com/users/4084003/" target="_blank"> utente (link inutili)</a>
        </div>


        <div>
            @guest


                <a href="{{ route('login') }}"> {{ __('Login') }} </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif

            @else
                <span class="" href="#">
                    {{ Auth::user()->name }}
                </span>

                <a class="" href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a>

                <a class="" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">{{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            @endguest
        </div>

    </div>

</div>
