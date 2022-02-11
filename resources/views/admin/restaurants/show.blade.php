<h1>Restaurant: {{ $restaurant->name }}</h1>

<h2>ID: {{ $restaurant->id }}</h2>
<h3>{{ $restaurant->name }}</h3>
<h5>{{ $restaurant->website }} - {{ $restaurant->phone }}</h5>
<p>{{ $restaurant->description }}</p>
<p>
    @forelse($restaurant->categories as $category)
        {{ $category->name }}
    @empty
        <span>Nessuna Categoria</span>
    @endforelse
</p>

<h4>Menu</h4>
<a href="{{ route('admin.product.create', ['restaurant'=>$restaurant->id]) }}" role="button">
    Aggiungi un piatto
</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Ingredients</th>
            <th>Price</th>
            <th>Actions</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($restaurant->products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->ingredients }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product->id) }}">
                        Edit
                    </a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('admin.restaurants.index') }}" role="button">
    Back
</a>
