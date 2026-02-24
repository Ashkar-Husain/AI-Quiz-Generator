<h2>Forgot Password</h2>

@if (session('status'))
    <p style="color:green">{{ session('status') }}</p>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p style="color:red">{{ $error }}</p>
    @endforeach
@endif

<form action="{{ route('forgot.password.post') }}" method="POST">
    @csrf

    <label>Email</label>
    <input type="email" name="email" placeholder="Enter your email">

    <button type="submit">Send Mail</button>
</form>
