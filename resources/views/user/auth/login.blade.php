@extends('user._layouts.auth')
@section('title', 'Login')
@section('css')
    <style>
      .text-danger{
        color: #dc3545;
        font-size: 11px;
      }
    </style>
@endsection
@section('content')
<div class="container">
  @if (session()->has('success'))
  <div class="alert alert-success" id="alert">
    {{ session()->get('success') }}
  </div>
  @endif
  <div class="login">
    <form action="{{ route('user.authenticate') }}" method="POST">
      @csrf
      <h1>Get started.</h1>
      <hr />
      <label for="">Email</label>
      <input type="text" placeholder="example@gmail.com" name="email"/>
      @error('email')
          <div class="text-danger">*{{ $message }}</div>
      @enderror
      <label for="">Password</label>
      <input type="password" placeholder="password" name="password"/>
      <button type="submit">Sign In</button>

      <div class="signin">
        <p>Don't have an account? <br>
          <a href="{{ route('user.register') }}" title="page sign up" class="sign-icon"> Sign up</a></p>
      </div>
    </form>
  </div>
</div>
@endsection

@section('script')
<script>
  function closeAlert() {
      let alert = document.getElementById('alert');
      alert.style.display = 'none';
  }

  setTimeout(closeAlert, 5000);
</script>
@endsection