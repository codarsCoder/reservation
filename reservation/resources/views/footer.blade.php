<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-body-secondary">&copy; 2024 Company, Inc</p>

        <a href="/"
            class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap" />
            </svg>
        </a>

        <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item">
                <a class="nav-link @if (Route::currentRouteName() == 'home') active @endif" aria-current="page"
                    href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Route::currentRouteName() == 'create.event.page') active @endif" aria-current="page"
                    href="{{ route('create.event.page') }}">Create Event</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Route::currentRouteName() == 'events.page' || Route::currentRouteName() == 'join.event') active @endif" aria-current="page"
                    href="{{ route('events.page') }}">Join To Event</a>
            </li>
        </ul>
    </footer>
</div>
