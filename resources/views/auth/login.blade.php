@extends('layouts.main')

@section('body')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-6 is-offset-3">
                <h2 class="title is-2">Login</h2>
                <form action="{{ route('login') }}" method="post">
                    {{ csrf_field() }}

                    @if ($errors->has('email') or $errors->has('password'))
                        <div class="notification is-danger">E-mail or password incorrect</div>
                    @endif
                    <div class="field">
                        <p class="control has-icon">
                            <input class="input is-large" name="email" type="email" placeholder="Email" value="{{ old('email') }}" autofocus>
                            <span class="icon">
                                <i class="fa fa-envelope"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control has-icon">
                            <input class="input is-large" name="password" type="password" placeholder="Password">
                            <span class="icon">
                                <i class="fa fa-key"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="checkbox" for="remember">Remember Me</label>
                        </p>
                    </div>
                    <div class="field">
                        <button class="button is-medium is-primary is-fullwidth" type="submit" v-is-loading="">Login</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="columns">
            <div class="column is-3 is-offset-3">
                <a href="{{ route('password.request') }}">Forgot Your Password?</a>
            </div>
        </div>
    </div>
</div>

@endsection
