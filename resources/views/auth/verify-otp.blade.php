<h2>Verify OTP</h2>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p style="color:red">{{ $error }}</p>
    @endforeach
@endif

<form action="{{ route('verify.otp.post') }}" method="POST">
    @csrf

    <input type="hidden" name="email" value="{{ request('email') }}">

    <label>Enter OTP</label>
    <input type="text" name="otp" placeholder="6 digit OTP">

    <button type="submit">Verify</button>
</form>
