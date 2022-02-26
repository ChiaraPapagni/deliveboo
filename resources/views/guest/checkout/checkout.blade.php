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
        <div id="loading">
            <span class="circle circle-1"></span>
            <span class="circle circle-2"></span>
            <span class="circle circle-3"></span>
            <span class="circle circle-4"></span>
            <span class="circle circle-5"></span>
            <span class="circle circle-6"></span>
            <span class="circle circle-7"></span>
            <span class="circle circle-8"></span>
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
                //loading.className = 'active';
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

        .active {
            z-index: 5;
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
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

        .circle {
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
        }

    </style>
@endsection
