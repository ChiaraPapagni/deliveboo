@extends('layouts.admin')

@section('content')
    <div class="container mt-5 pt-5">
        <h1>Create a new Restaurant</h1>

        <form action="{{ route('admin.restaurants.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- Nome ristorante --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome Ristorante</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Your restaurant name here..." aria-describedby="nameHelper" value="{{ old('name') }}"
                    required min="3" max="255">

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
                <label for="vat" class="form-label">Partita IVA</label>
                <input type="text" name="vat" id="vat" class="form-control @error('vat') is-invalid @enderror" required
                    placeholder="Your restaurant vat here..." aria-describedby="vatHelper" value="{{ old('vat') }}">

                @error('vat')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Indirizzo --}}
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                    placeholder="Your restaurant address here..." aria-describedby="addressHelper"
                    value="{{ old('address') }}" required min="3" max="255">

                @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Sito web --}}
            <div class="mb-3">
                <label for="website" class="form-label">Sito web</label>
                <input type="text" name="website" id="website" class="form-control @error('website') is-invalid @enderror"
                    placeholder="Your restaurant website here..." aria-describedby="websiteHelper"
                    value="{{ old('website') }}">

                @error('website')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Telefono --}}
            <div class="mb-3">
                <label for="phone" class="form-label">Numero di telefono</label>
                <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" min="8"
                    max="20" placeholder="Your restaurant phone here..." aria-describedby="phoneHelper"
                    value="{{ old('phone') }}">

                @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Categorie --}}
            <div class="mb-3">
                <label for="categories" class="form-label">Seleziona categoria</label>
                @foreach ($categories as $category)
                    <input name="categories[]" type="checkbox" value="{{ $category->id }}"
                        {{ in_array($category->id, old('category', [])) ? 'checked=checked' : '' }}>
                    <label>
                        {{ $category->name }}
                    </label>
                @endforeach
            </div>

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
