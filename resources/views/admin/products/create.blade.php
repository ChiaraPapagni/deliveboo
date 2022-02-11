<h1>Create a new Product</h1>

<form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    {{-- Nome prodotto --}}
    <div class="mb-3">
        <label for="name" class="form-label">Nome Piatto</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
            placeholder="Your dish name here..." aria-describedby="nameHelper" value="{{ old('name') }}">

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Immagine --}}
    <div class="mb-3">
        <label for="product_image" class="form-label">Immagine</label>
        <input type="file" name="product_image" id="product_image" accept="image/*" placeholder="https://"
            aria-describedby="product_imageHelper" class="form-control @error('product_image') is-invalid @enderror" />
        @error('product_image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Prezzo --}}
    <div class="mb-3">
        <label for="price" class="form-label">Prezzo</label>
        <input type="number" min="0.00" max="10000.00" step="0.01" name="price" id="price"
            class="form-control @error('price') is-invalid @enderror" aria-describedby="priceHelper"
            value="{{ old('price') }}">

        @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Ingredienti --}}
    <div class="mb-3">
        <label for="ingredients" class="form-label">Ingredienti</label>
        <textarea class="form-control @error('ingredients') is-invalid @enderror" name="ingredients" id="ingredients"
            rows="5">{{ old('ingredients') }}</textarea>
        @error('ingredients')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Visibile --}}
    <div class="mb-3">
        <label for="visible" class="form-label">Non mostrare il piatto nel menu</label>
        <input class="check" type="radio" name="visible" value="0">
        @error('visible')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-dark">Save</button>
</form>
