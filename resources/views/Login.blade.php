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
        <form action="/login/store" method="POST">
            @csrf
            <div class="form-row" >
                <div class="form-group col-md-6" style="width: 80%">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email">
                    @error('email')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-md-6" style="width: 80%">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password">
                    @error('password')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                @error('login_error')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <p>Don't have account ? <a href="/register">Register</a></p>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>