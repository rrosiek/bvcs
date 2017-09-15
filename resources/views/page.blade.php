@extends('layouts.main')

@section('body')

<section class="section">
    <div class="container">
        <h2 class="title is-2">{{ $content->title }}</h2>
        <hr>

        @if (!$content->type === 'page' && $content->posted_at)
            <h5 class="subtitle is-5">{{ $content->posted_at->format('F jS, Y') }}</h5>
        @endif

        <div class="content">
            @parsedown($content->body)
        </div>
    </div>
</section>

@endsection
