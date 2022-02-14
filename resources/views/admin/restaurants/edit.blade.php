@extends('layouts.admin')

@section('content')
    <div class="container mt-5 pt-5">
        <h1>Update Restaurant: {{ $restaurant->name }}</h1>

        <form action="{{ route('admin.restaurants.update', $restaurant->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Nome ristorante --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nome Ristorante</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Your restaurant name here..." aria-describedby="nameHelper"
                    value="{{ $restaurant->name }}" required min="3" max="255">

                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Immagine --}}
            <div class="mb-3">
                <div class="row">
                    <div class="col-4">
                        <img src="{{ asset('storage/' . $restaurant->restaurant_image) }}"
                            alt="{{ $restaurant->name }}" />
                    </div>
                    <div class="col">
                        <label for="restaurant_image" class="form-label">Modifica immagine</label>
                        <input type="file" name="restaurant_image" id="restaurant_image" aria-describedby="imageHelper"
                            accept="images/*" class="form-control @error('restaurant_image') is_invalid @enderror" />
                        <small id="restaurant_imageHelper" class="text-muted">
                            Add your restaurant image here. [Max 500kb]
                        </small>
                    </div>
                </div>
                @error('restaurant_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Partita iva --}}
            <div class="mb-3">
                <label for="vat" class="form-label">Partita IVA</label>
                <input type="text" name="vat" id="vat" class="form-control @error('vat') is-invalid @enderror" require
                    placeholder="Your restaurant vat here..." aria-describedby="vatHelper" value="{{ $restaurant->vat }}"
                    min="11" max="11">

                @error('vat')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Indirizzo --}}
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                    placeholder="Your restaurant address here..." aria-describedby="addressHelper" required min="3"
                    max="255" value="{{ $restaurant->address }}">

                @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Sito web --}}
            <div class="mb-3">
                <label for="website" class="form-label">Sito web</label>
                <input type="text" name="website" id="website" class="form-control @error('website') is-invalid @enderror"
                    placeholder="Your restaurant website here..." aria-describedby="websiteHelper"
                    value="{{ $restaurant->website }}">

                @error('website')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Numero di telefono --}}
            <div class="mb-3">
                <label for="phone" class="form-label">Numero di telefono</label>
                <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" min="8"
                    max="20" placeholder="Your restaurant phone here..." aria-describedby="phoneHelper"
                    value="{{ $restaurant->phone }}">

                @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Categorie --}}
            <div class="mb-3">
                <label for="categories" class="form-label">Seleziona categoria</label>
                @foreach ($categories as $category)
                    <input name="categories[]" type="checkbox" value="{{ $category->id }}"
                        {{ $restaurant->categories->contains($category) ? 'checked=checked' : '' }}>
                    <label>
                        {{ $category->name }}
                    </label>
                @endforeach
                @error('categories')
                    <div class="alert alert-dange">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Descrizione --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                    id="description" rows="5">{{ $restaurant->description }}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-dark">Save</button>
        </form>
    </div>
@endsection
