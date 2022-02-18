@extends('layouts.admin')

@section('content')
    <div class="container mt-5 pt-5 pb-4">
        <h1 class="text-capitalize">
            crea il tuo ristorante!
        </h1>

        <form action="{{ route('admin.restaurants.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- Nome ristorante --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome Ristorante*</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Inserisci il nome del Tuo Ristorante" aria-describedby="nameHelper"
                    value="{{ old('name') }}" required minlength="3" maxlength="255">

                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Immagine --}}
            <div class="mb-3">
                <label for="restaurant_image" class="form-label">Immagine</label>
                <input type="file" name="restaurant_image" id="restaurant_image" accept="image/*" placeholder="https://"
                    aria-describedby="restaurant_imageHelper"
                    class="form-control @error('restaurant_image') is-invalid @enderror" />
                @error('restaurant_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Partita iva --}}
            <div class="mb-3">
                <label for="vat" class="form-label">Partita IVA*</label>
                <input type="text" name="vat" id="vat" class="form-control @error('vat') is-invalid @enderror" required
                    placeholder="Inserisci il numero di Partita Iva (11 caratteri)" aria-describedby="vatHelper"
                    value="{{ old('vat') }}" minlength="11" maxlength="11">

                @error('vat')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Indirizzo --}}
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo*</label>
                <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                    placeholder="Inserisci l'indirizzo del Tuo Ristorante" aria-describedby="addressHelper"
                    value="{{ old('address') }}" required minlength="3" maxlength="255">

                @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Sito web --}}
            <div class="mb-3">
                <label for="website" class="form-label">Sito web</label>
                <input type="text" name="website" id="website" class="form-control @error('website') is-invalid @enderror"
                    placeholder="Inserisci il Tuo Sito Web" aria-describedby="websiteHelper" value="{{ old('website') }}">

                @error('website')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Telefono --}}
            <div class="mb-3">
                <label for="phone" class="form-label">Numero di telefono</label>
                <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                    minlength="8" maxlength="20" placeholder="Inserisci il numero di telefono del Tuo Ristorante"
                    aria-describedby="phoneHelper" value="{{ old('phone') }}">

                @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Categorie --}}
            <div class="mb-3">
                <label for="categories" class="form-label">Seleziona categoria*</label>
                <select class="form-control @error('categories') is_invalid @enderror" name="categories[]" id="categories"
                    required multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>


            {{-- OLD CATEGORY FOR DEBUG PURPOSES --}}
            {{-- @foreach ($categories as $category)
                    <input name="categories[]" type="checkbox" value="{{ $category->id }}"
                        {{ in_array($category->id, old('category', [])) ? 'checked=checked' : '' }}>
                    <label>
                        {{ $category->name }}
                    </label>
                @endforeach --}}

            {{-- Descrizione --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                    id="description" rows="5">{{ old('description') }}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-dark">Save</button>
        </form>
    </div>
@endsection
