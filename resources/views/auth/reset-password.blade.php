<h2>Set New Password</h2>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p style="color:red">{{ $error }}</p>
    @endforeach
@endif

<form action="{{ route('reset.password.post') }}" method="POST">
    @csrf

    <input type="hidden" name="email" value="{{ request('email') }}">

    <label>New Password</label>
    <input type="password" name="password">

    <label>Confirm Password</label>
    <input type="password" name="password_confirmation">

    <button type="submit">Update Password</button>
</form>
