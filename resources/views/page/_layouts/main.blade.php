<!DOCTYPE html>
<html lang="en">
  <head>
    @include('page._partials.head')
   
    
  </head>
  <body>
    <header>
      @include('page._partials.navbar')
      @yield('header')
     
    </header>

    <main class="mt-5" tabindex="0">
      @yield('content')
    </main>

    @include('page._partials.footer')
    @include('page._partials.script')
  </body>
</html>
