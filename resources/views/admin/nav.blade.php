<div class="tabs is-centered">
    <ul>
        <li class="{{ starts_with(Route::currentRouteName(), 'content') ? 'is-active' : '' }}">
            <a href="{{ route('content.index') }}">Content</a>
        </li>
        <li class="{{ starts_with(Route::currentRouteName(), 'events') ? 'is-active' : '' }}">
            <a href="{{ route('events.index') }}">Events</a>
        </li>
        <li>
            <a href="{{ route('logout') }}">Logout</a>
        </li>
    </ul>
</div>