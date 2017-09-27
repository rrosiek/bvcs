@extends('layouts.main')

@section('body')

<section class="section">
    <div class="container">
        <h2 class="title is-2">{{ $title }}</h2>
        <p>This will send the following newsletter to <strong>all</strong> members that are subscribed.<br><br></p>
        @include('partials.notify')
        <form action="{{ route('mail.newsletter', ['id' => $newsletter->id]) }}" method="post">
            {{ csrf_field() }}

            <div class="columns">
                <div class="column is-half">
                    @include('partials.textInput', ['name' => 'subject', 'label' => 'Subject', 'value' => $newsletter->title, 'required' => true])
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
                    @include('partials.textareaInput', ['name' => 'intro', 'label' => 'Introduction', 'value' => old('intro')])
                    <p class="help">This text will be added just before the newsletter, if anything needs to be included in the email.</p>
                </div>
            </div>

            <a class="button" href="{{ route('content.index') }}">Cancel</a>
            <button class="button is-primary" type="submit" v-is-loading="">SEND NEWSLETTER</button>
        </form>
    </div>
</section>

@endsection
