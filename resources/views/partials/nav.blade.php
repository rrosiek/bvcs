<header class="nav">
    <div class="container">
        <span @click="mobileNav = !mobileNav" :class="{ 'is-active': mobileNav }" class="nav-toggle">
            <span></span>
            <span></span>
            <span></span>
        </span>
        <div :class="{ 'is-active': mobileNav }" class="nav-right nav-menu">
            <a
                class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'home') ? 'is-active' : '' }}"
                href="{{ route('home') }}"
            >
                HOME
            </a>
            <a
                class="nav-item {{ array_search('membership', Route::current()->parameters) ? 'is-active' : '' }}"
                href="/membership"
            >
                MEMBERSHIP
            </a>
            <a
                class="nav-item"
                href="{{ route('newsletter') }}"
            >
                NEWSLETTER
            </a>
            <a
                class="nav-item"
                href="{{ route('calendar') }}"
            >
                CALENDAR
            </a>
            <a
                class="nav-item {{ array_search('contact', Route::current()->parameters) ? 'is-active' : '' }}"
                href="/contact"
            >
                CONTACT
            </a>
        </div>
    </div>
</header>
