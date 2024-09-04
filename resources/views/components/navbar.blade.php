<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Navbar</title>
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="#">Home</a>
                        @auth
                            @if(Auth::user()->role == 'admin')
                                <a class="nav-link" href="/products/create">Create Product</a>
                                <a class="nav-link" href="/categories/create">Create Category</a>
                            @endif
                        @endauth
                        <a class="nav-link" href="/cart">Show Cart</a>
                        <a class="nav-link" href="/invoices">Show Invoices</a>
                    </div>
                    <div class="ms-auto">
                        @auth
                            <form action="/logout" method="post" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">Logout</button>
                            </form>
                        @else
                            <a href="/login" class="btn btn-outline-success">Login</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-oBqDVmMz4fnFOaKXsU53t4eBdqH2l5T7pvr0f6lvb5nU2F9z7iA3ik7qX9GzE9f8" crossorigin="anonymous"></script>
</body>
</html>
