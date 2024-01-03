<div class="login">
    <form wire:submit.prevent="register" method="POST">
      @csrf
      <h1>Get started.</h1>
      <hr />
      <label for="name">Name</label>
      <input type="text" placeholder="John Doe" name="name" wire:model='name'/>
      @error('name')
        <div class="text-danger">*{{ $message }}</div>
      @enderror

      <label for="Email">Email</label>
      <input type="text" placeholder="example@gmail.com" name="email" wire:model='email'/>
      @error('email')
        <div class="text-danger">*{{ $message }}</div>
      @enderror

      <label for="password">Password</label>
      <input type="password" placeholder="Min 8 Karakter" name="password" wire:model='password'/>
      @error('password')
        <div class="text-danger">*{{ $message }}</div>
      @enderror

      <button type="submit">Sign Up</button>

      <div class="signin">
        <p>Already have an account? <br>
          <a href="{{ route('user.login') }}" title="page sign in" class="sign-icon"> Sign in </a></p>
      </div>
    </form>
  </div>