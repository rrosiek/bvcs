<div class="tabs is-centered">
    <ul>
        <li class="{{ Str::starts_with(Route::currentRouteName(), 'content') ? 'is-active' : '' }}">
            <a href="{{ route('content.index') }}">Content</a>
        </li>
        <li class="{{ Str::starts_with(Route::currentRouteName(), 'members') ? 'is-active' : '' }}">
            <a href="{{ route('members.index') }}">Members</a>
        </li>
        <li class="{{ Str::starts_with(Route::currentRouteName(), 'events') ? 'is-active' : '' }}">
            <a href="{{ route('events.index') }}">Events</a>
        </li>
        <li>
            <a
                href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-frm').submit();"
            >
                Logout
            </a>
        </li>
    </ul>
</div>

<form action="{{ route('logout') }}" id="logout-frm" method="post" style="display: none;">
    {{ csrf_field() }}
</form>
