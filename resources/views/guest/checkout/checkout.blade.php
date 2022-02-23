@extends('layouts.app')

@section('content')
    <div class="container mt-5 py-5">

        <form class="row" action="{{ route('store') }}" id="payment-form" method="post">
            @csrf

            <div class="col-8">

                <div class="card">

                    <div class="card-header">{{ __('Pagamento') }}</div>

                    <div class="card-body">


                        {{-- Nome --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome*</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Inserisci il tuo nome" aria-describedby="nameHelper"
                                value="{{ old('name') }}" required minlength="3" maxlength="255">

                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Cognome --}}
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Cognome*</label>
                            <input type="text" name="last_name" id="last_name"
                                class="form-control @error('last_name') is-invalid @enderror"
                                placeholder="Inserisci il tuo nome" aria-describedby="last_nameHelper"
                                value="{{ old('last_name') }}" required minlength="3" maxlength="255">

                            @error('last_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Telefono --}}
                        <div class="mb-3">
                            <label for="phone" class="form-label">Numero di telefono*</label>
                            <input type="tel" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror" minlength="8" maxlength="20"
                                placeholder="Telefono del ristorante ..." aria-describedby="phoneHelper"
                                value="{{ old('phone') }}">

                            @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email*</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Indirizzo del ristorante..." aria-describedby="emailHelper"
                                value="{{ old('email') }}" required minlength="3" maxlength="255">

                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Indirizzo --}}
                        <div class="mb-3">
                            <label for="address" class="form-label">Indirizzo*</label>
                            <input type="text" name="address" id="address"
                                class="form-control @error('address') is-invalid @enderror"
                                placeholder="Indirizzo del ristorante..." aria-describedby="addressHelper"
                                value="{{ old('address') }}" required minlength="3" maxlength="255">

                            @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Note --}}
                        <div class="mb-3">
                            <label for="notes" class="form-label">Note</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" name="notes"
                                placeholder="Inserisci la descrizione del ristorante" id="notes"
                                rows="5">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campi Obbligatori --}}
                        <div class="form-group row mb-2">
                            <div class="col-md-4 col-form-label text-md-right">
                                * {{ __('Campi Obbligatori') }}
                            </div>
                        </div>

                        {{-- Pagamento --}}
                        <div class="mb-3">

                            <div id="dropin-container"></div>
                            <input id="nonce" name="payment_method_nonce" type="hidden" />
                            <button id="submit-button">Procedi al pagamento</button>

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-4">
                <order-cart></order-cart>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="https://js.braintreegateway.com/web/dropin/1.33.0/js/dropin.js"></script>
    <script type="module">
        var form = document.querySelector('#payment-form');
        var button = document.querySelector('#submit-button');
        //var client_token = "sandbox_fwg98qpr_3xb8zby2rfx6jzmb";
        var client_token = "{{ $token }}";
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
                event.preventDefault();
                instance.requestPaymentMethod(function(err, payload) {
                    if (err) {
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
