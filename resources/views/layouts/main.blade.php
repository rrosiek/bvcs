<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Boston Valley Conservation Society :: {{ $title or 'Boston, NY' }}</title>

        <link href="/css/app.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>

        <div id="app">
            <section class="hero is-primary">
                <div class="hero-head">
                    @include('partials.nav')
                </div>
                <div class="hero-body">
                    <div class="container">
                        <img src="/images/bvcs-logo-text.png">
                    </div>
                </div>
            </section>

            @yield('body')

            @include('partials.footer')

        </div>

    </body>

    <script src="/js/app.js"></script>
</html>
