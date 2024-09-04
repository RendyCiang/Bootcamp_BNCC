<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/Home.css">
    <title>Home Page</title>
</head>
<body>
    <x-navbar />

    <div class="container mt-4">
        <!-- Products Section -->
        <h1 class="mb-4">Products</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/product_images/' . $product->photo) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5>{{ $product->name }}</h5>
                            <p>Category: {{ $product->category->name }}</p>
                            <p>Price: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p>Quantity: {{ $product->quantity }}</p>
                            @auth
                                @if(Auth::user()->role == 'admin')
                                    <a href="/products/{{ $product->id }}/edit" class="btn btn-primary">Edit</a>
                                    <form action="/products/{{ $product->id }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                @endif
                            @endauth
                            <form action="/cart/add" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="number" name="quantity" min="1" value="1" required style="width: 50px;">
                                <button type="submit" class="btn btn-success">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @auth
            @if(Auth::user()->role == 'admin')
                <h1 class="mb-4">Categories</h1>
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5>{{ $category->name }}</h5>
                                    <a href="/categories/{{ $category->id }}/edit" class="btn btn-primary">Edit</a>
                                    <form action="/categories/{{ $category->id }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endauth
    </div>
</body>
</html>
