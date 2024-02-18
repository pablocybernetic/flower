<!-- resources/views/search-results.blade.php -->


    <h2>Search Results for "{{ $query }}"</h2>

    @if(count($products) > 0)
        <ul>
            @foreach($products as $product)
                <li>{{ $product->name }} - {{ $product->description }}</li>
            @endforeach
        </ul>
    @else
        <p>No products found for "{{ $query }}"</p>
    @endif
