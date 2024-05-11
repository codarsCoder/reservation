
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand text-primary" href="{{ route('home') }}"><h1>EVENTOR</h1></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link @if(Route::currentRouteName() == 'home') active @endif" aria-current="page" href="{{ route('home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(Route::currentRouteName() == 'create.event.page') active @endif" aria-current="page" href="{{ route('create.event.page') }}">Create Event</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if(Route::currentRouteName() == 'events.page' || Route::currentRouteName() == 'join.event') active @endif" aria-current="page" href="{{ route('events.page') }}">Join To Event</a>
          </li>
        </ul>
   <div class="d-flex gap-3 align-items-center">
    @if(Auth::check())
    <p class="mb-0">{{ Auth::user()->name }}</p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Logout</button>
    </form>
    @else
    <a href="{{ route('login') }}">Login</a>
@endif

   </div>
      </div>
    </div>
  </nav>
