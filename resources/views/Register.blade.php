<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login Page</title>
</head>

<body>
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <form method="POST" action="/register/store">
            @csrf
            <div class="form-row">
                <div class="form-group" style="width: 100%">
                    <label for="inputAddress">Nama Lengkap</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="Tono" name="name" value="{{ old('name') }}">
                </div>
                @error('name')
                    <p>{{ $message }}</p>
                @enderror

                <div class="form-group col-md-6" style="width: 100%">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email" value="{{ old('email') }}">
                </div>
                @error('email')
                    <p>{{ $message }}</p>
                @enderror

                <div class="form-group col-md-6" style="width: 100%">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password">
                </div>
                @error('password')
                    <p>{{ $message }}</p>
                @enderror

                <div class="form-group" style="width: 100%">
                    <label for="inputAddress">No. Telp</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="08" name="phone" value="{{ old('phone') }}">
                </div>
                @error('phone')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <p>Already have an account ? <a href="/login">Login</a></p>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</body>
</html>