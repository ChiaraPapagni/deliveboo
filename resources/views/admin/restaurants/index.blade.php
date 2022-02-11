<div>
    <h1>Restaurants</h1>
    <a href="{{ route('admin.restaurants.create') }}" role="button">
        Create Restaurants
    </a>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Website</th>
            <th>Phone Number</th>
            <th>Actions</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($restaurants as $restaurant)
            <tr>
                <td>{{ $restaurant->id }}</td>
                <td>{{ $restaurant->name }}</td>
                <td>{{ $restaurant->website }}</td>
                <td>{{ $restaurant->phone }}</td>
                <td>
                    <a href="{{ route('admin.restaurants.show', $restaurant->id) }}">
                        Show
                    </a>
                    <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}">
                        Edit
                    </a>
                    <form action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
