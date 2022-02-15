{{-- Questa è la nav con ristorante --}}
@if (Auth::user()->has_restaurant)
    <div class="nav">

        <a href="{{ route('homepage') }}">ho il ristorante</a>


        <div class="logo">
        </div>

        <div class="container-lg container-fluid nav-links d-flex justify-content-between w-100">


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


                    <a class="dropdown-item logout" href="{{ route('logout') }}"
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

@else

    {{-- Questa è la nav per l'utente senza ristoranti --}}

    <div class="nav HasNot block">

        <a href="">non ho un ristorante</a>


        <div class="logo">
        </div>

        <div class="container-lg container-fluid nav-links d-flex justify-content-between w-100">
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
@endif
