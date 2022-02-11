<h1>Restaurant: {{ $restaurant->name }}</h1>

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

<a href="{{ route('admin.restaurants.index') }}" role="button">
    Back
</a>
