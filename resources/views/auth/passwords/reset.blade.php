@extends('layouts.main')

@section('body')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-6 is-offset-3">
                <h2 class="title is-2">Reset Password</h2>
                <form action="{{ route('password.request') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">

                    @if ($errors->has('email') or $errors->has('password'))
                        <div class="notification is-danger">E-mail address incorrect, passwords do not match, or reset link expired</div>
                    @endif
                    <div class="field">
                        <p class="control">
                            <input class="input is-large" name="email" type="email" placeholder="Email" value="{{ $email or old('email') }}" autofocus>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <input class="input is-large" name="password" type="password" placeholder="Password">
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <input class="input is-large" name="password_confirmation" type="password" placeholder="Confirm Password">
                        </p>
                    </div>
                    <div class="field">
                        <button class="button is-medium is-primary is-fullwidth" type="submit" v-is-loading="">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
