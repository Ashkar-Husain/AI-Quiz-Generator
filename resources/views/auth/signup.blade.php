<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign-up</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
        }

        .container {
            width: 350px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 12px;
        }

        label {
            display: block;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
        }

        .btn {
            width: 100%;
            padding: 8px;
            background: blue;
            color: white;
            border: none;
        }

        .login-link {
            margin-top: 10px;
            font-size: 14px;
        }
    </style>

</head>

<body>

    <div class="container">
        @if ($errors->any())
            <div style="color:red">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <h2>Create Account</h2>

        <form action="{{ route('signup.post') }}" method="POST">

            @csrf

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="name" placeholder="Enter username">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter password">
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="Confirm password">
            </div>

            <button type="submit" class="btn">Sign Up</button>

            <p class="login-link">
                Already signup?
                <a href="/login">Login</a>
            </p>

        </form>


    </div>

</body>

</html>
