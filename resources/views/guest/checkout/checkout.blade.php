@extends('layouts.app')

@section('content')
    <div class="position-relative">
        <div class="container mt-5 py-5">

            <form class="row mt-5" action="{{ route('store') }}" id="payment-form" method="post">
                @csrf

                <div class="col-8">

                    <div class="card shadow border-0">
                        <div class="card-body">
                            {{-- Nome --}}
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="name" class="form-label">Nome*</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Mario"
                                        aria-describedby="nameHelper" value="{{ old('name') }}" required minlength="3"
                                        maxlength="255">

                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Cognome --}}
                                <div class="col mb-3">
                                    <label for="last_name" class="form-label">Cognome*</label>
                                    <input type="text" name="last_name" id="last_name"
                                        class="form-control @error('last_name') is-invalid @enderror" placeholder="Rossi"
                                        aria-describedby="last_nameHelper" value="{{ old('last_name') }}" required
                                        minlength="3" maxlength="255">

                                    @error('last_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                {{-- Telefono --}}
                                <div class="col mb-3">
                                    <label for="phone" class="form-label">Numero di telefono*</label>
                                    <input type="tel" name="phone" id="phone"
                                        class="form-control @error('phone') is-invalid @enderror" minlength="8"
                                        maxlength="20" placeholder="" aria-describedby="phoneHelper"
                                        value="{{ old('phone') }}">

                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="col mb-3">
                                    <label for="email" class="form-label">Email*</label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="mario@rossi.it" aria-describedby="emailHelper"
                                        value="{{ old('email') }}" required minlength="3" maxlength="255">

                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Indirizzo --}}
                            <div class="mb-3">
                                <label for="address" class="form-label">Indirizzo*</label>
                                <input type="text" name="address" id="address"
                                    class="form-control @error('address') is-invalid @enderror"
                                    placeholder="Via Giuseppe Garibaldi" aria-describedby="addressHelper"
                                    value="{{ old('address') }}" required minlength="3" maxlength="255">

                                @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Note --}}
                            <div class="mb-0">
                                <label for="notes" class="form-label">Note</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" name="notes"
                                    placeholder="" id="notes" rows="5">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Campi Obbligatori --}}
                            <div class="form-group row">
                                <div class="col-md-4 col-form-label text-md-right">
                                    * {{ __('Campi Obbligatori') }}
                                </div>
                            </div>

                            {{-- Pagamento --}}
                            <div class="mb-4">
                                <div id="dropin-container"></div>
                                <input id="nonce" name="payment_method_nonce" type="hidden" />
                                <button id="submit-button" class="btn btn-warning text-dark rounded-0 w-100 mt-4">Procedi al
                                    pagamento</button>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <order-cart></order-cart>
                </div>
            </form>
        </div>
        {{-- <img src="{{ asset('../img/loading.gif') }}"> --}}

        {{-- Loading --}}
        {{-- <div id="loading">
            <span class="circle circle-1"></span>
            <span class="circle circle-2"></span>
            <span class="circle circle-3"></span>
            <span class="circle circle-4"></span>
            <span class="circle circle-5"></span>
            <span class="circle circle-6"></span>
            <span class="circle circle-7"></span>
            <span class="circle circle-8"></span> 
        </div> --}}

        <div id="loading" class="cooking">
            <div id="area">
                <div id="sides">
                    <div id="pan"></div>
                    <div id="handle"></div>
                </div>
                <div id="pancake">
                    <div id="pastry"></div>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('script')
    <script src="https://js.braintreegateway.com/web/dropin/1.33.0/js/dropin.js"></script>

    <script type="module">
        var form = document.querySelector('#payment-form');
        var button = document.querySelector('#submit-button');
        var client_token = "{{ $token }}";

        var loading = document.getElementById('loading');
        loading.className = 'not-active';

        braintree.dropin.create({
            authorization: client_token,
            selector: '#dropin-container',
            /* paypal: {
                flow: 'vault'
            } */
        }, function(createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            }
            button.addEventListener('click', function(event) {
                loading.className = 'active-loading';
                event.preventDefault();
                instance.requestPaymentMethod(function(err, payload) {
                    if (err) {
                        loading.className = 'not-active';
                        console.log('Request Payment Method Error', err);
                        return;
                    }
                    document.querySelector('input[name="payment_method_nonce"]').value =
                        payload
                        .nonce;
                    form.submit();
                });
            });
        });
    </script>
@endsection

@section('personalCss')
    <style lang="scss" scoped>
        .braintree-sheet {
            border: 1px solid #ced4da;
        }

        .braintree-sheet__header {
            align-items: center;
            border-bottom: 1px solid #ced4da;
        }

        .braintree-sheet__content--form {
            display: flex;
            justify-content: space-between;
        }

        .braintree-form__field-group.braintree-hidden {
            display: none
        }

        .not-active {
            display: none;
        }

        .active-loading {
            z-index: 5;
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #99999955;
        }

        .cooking {
            position: relative;
            margin: 0 auto;
            top: 0;
            width: 75vh;
            height: 75vh;
            overflow: hidden;
        }

        #area {
            position: absolute;
            width: 10%;
            height: 20%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: transparent;
            transform-origin: 15% 60%;
            animation: flip 2.1s ease-in-out infinite;
        }

        #sides {
            position: absolute;
            width: 100%;
            height: 100%;
            transform-origin: 15% 60%;
            animation: switchSide 2.1s ease-in-out infinite;
        }

        #handle {
            position: absolute;
            bottom: 18%;
            right: 80%;
            width: 35%;
            height: 20%;
            background-color: transparent;
            border-top: 1vh solid #333;
            border-left: 1vh solid transparent;
            border-radius: 100%;
            transform: rotate(20deg) rotateX(0deg) scale(1.3, .9);
        }

        #pan {
            position: absolute;
            bottom: 20%;
            right: 30%;
            width: 50%;
            height: 8%;
            background-color: #333;
            border-radius: 0 0 1.4em 1.4em;
            transform-origin: -15% 0;
        }

        #pancake {
            position: absolute;
            top: 24%;
            width: 100%;
            height: 100%;
            transform: rotateX(85deg);
            animation: jump 2.1s ease-in-out infinite;
        }

        #pastry {
            position: absolute;
            bottom: 26%;
            right: 37%;
            width: 40%;
            height: 45%;
            background-color: #333;
            box-shadow: 0 0 3px 0 #333;
            border-radius: 100%;
            transform-origin: -20% 0;
            animation: fly 2.1s ease-in-out infinite;
        }

        @keyframes jump {
            0% {
                top: 24%;
                transform: rotateX(85deg);
            }

            25% {
                top: 10%;
                transform: rotateX(0deg);
            }

            50% {
                top: 30%;
                transform: rotateX(85deg);
            }

            75% {
                transform: rotateX(0deg);
            }

            100% {
                transform: rotateX(85deg);
            }
        }

        @keyframes flip {
            0% {
                transform: rotate(0deg);
            }

            5% {
                transform: rotate(-27deg);
            }

            30%,
            50% {
                transform: rotate(0deg);
            }

            55% {
                transform: rotate(27deg);
            }

            83.3% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }

        @keyframes switchSide {
            0% {
                transform: rotateY(0deg);
            }

            50% {
                transform: rotateY(180deg);
            }

            100% {
                transform: rotateY(0deg);
            }
        }

        @keyframes fly {
            0% {
                bottom: 26%;
                transform: rotate(0deg);
            }

            10% {
                bottom: 40%;
            }

            50% {
                bottom: 26%;
                transform: rotate(-190deg);
            }

            80% {
                bottom: 40%;
            }

            100% {
                bottom: 26%;
                transform: rotate(0deg);
            }
        }

        @keyframes bubble {
            0% {
                transform: scale(.15, .15);
                top: 80%;
                opacity: 0;
            }

            50% {
                transform: scale(1.1, 1.1);
                opacity: 1;
            }

            100% {
                transform: scale(.33, .33);
                top: 60%;
                opacity: 0;
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1, 1);
                opacity: .25;
            }

            50% {
                transform: scale(1.2, 1);
                opacity: 1;
            }

            100% {
                transform: scale(1, 1);
                opacity: .25;
            }
        }

        /* .circle {
                position: fixed;
                top: 50%;
                left: 50%;
                display: inline-block;
                width: 15px;
                height: 15px;
                background-color: #fcdc29;
                border-radius: 50%;
                animation: loading 1.5s cubic-bezier(.8, .5, .2, 1.4) infinite;
                transform-origin: bottom center;
                position: relative;
            }

            @keyframes loading {
                0% {
                    transform: translateY(0px);
                    background-color: #fcdc29;
                }

                50% {
                    transform: translateY(50px);
                    background-color: #ef584a;
                }

                100% {
                    transform: translateY(0px);
                    background-color: #fcdc29;
                }
            }

            .circle-1 {
                animation-delay: 0.1s;
            }

            .circle-2 {
                animation-delay: 0.2s;
            }

            .circle-3 {
                animation-delay: 0.3s;
            }

            .circle-4 {
                animation-delay: 0.4s;
            }

            .circle-5 {
                animation-delay: 0.5s;
            }

            .circle-6 {
                animation-delay: 0.6s;
            }

            .circle-7 {
                animation-delay: 0.7s;
            }

            .circle-8 {
                animation-delay: 0.8s;
            } */

    </style>
@endsection
