@extends('layouts.main')

@section('body')

<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-6 is-offset-3">
                <h2 class="title is-2">Forgot Password</h2>
                @if (session('status'))
                    <div class="notification is-success">{{ session('status') }}</div>
                @endif

                <form action="{{ route('password.email') }}" method="post">
                    {{ csrf_field() }}

                    @if ($errors->has('email') or $errors->has('password'))
                        <div class="notification is-danger">E-mail incorrect or could not be found.</div>
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
                        <button class="button is-medium is-primary is-fullwidth" type="submit" v-is-loading="">Send Password Reset Link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
