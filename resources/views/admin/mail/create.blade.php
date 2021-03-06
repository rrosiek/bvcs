@extends('layouts.main')

@section('body')

<section class="section">
    <div class="container">
        <h2 class="title is-2">{{ $title }}</h2>
        <p>This will send and email to <strong>all</strong> members that are subscribed.<br><br></p>
        @include('partials.notify')
        <form action="{{ route('mail.store') }}" method="post">
            {{ csrf_field() }}

            <div class="columns">
                <div class="column is-half">
                    @include('partials.textInput', ['name' => 'subject', 'label' => 'Subject', 'value' => old('subject', 'BVCS: '), 'required' => true])
                </div>
            </div>
            <div class="columns">
                <div class="column is-half">
                    <label class="label">From Address</label>
                    <p class="control">
                        <input class="input" name="from" type="text" value="{{ env('MAIL_FROM_ADDRESS') }}" disabled>
                    </p>
                </div>
            </div>
            <div class="columns">
                <div class="column is-half">
                    <label class="label">Reply Address</label>
                    <p class="control">
                        <input class="input" name="replyTo" type="text" value="{{ auth()->user()->email }}" disabled>
                    </p>
                </div>
            </div>
            <div class="columns">
                <div class="column is-half">
                    @include('partials.textareaInput', ['name' => 'message', 'label' => 'Message', 'value' => old('message')])
                    <p class="help">The text above is Markdown compatible.</p>
                </div>
            </div>

            <a class="button" href="{{ route('members.index') }}">Cancel</a>
            <button class="button is-primary" type="submit" v-is-loading="">SEND E-MAIL</button>
        </form>
    </div>
</section>

@endsection
