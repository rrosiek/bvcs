@extends('layouts.main')

@section('body')

<section class="section">
    <div class="container">

        <h2 class="title is-2">Upcoming Events</h2>

        <div class="tile is-ancestor">
        @foreach ($events as $e)
            <div class="tile is-parent">
                <article class="tile is-child notification">
                    <h4 class="title is-4 has-text-primary">{{ $e['title'] }}</h4>
                    @if ($e['allDay'])
                        <h5 class="subtitle is-5">{{ $e['start']->format('F jS') }}</h5>
                    @else
                        <h5 class="subtitle is-5">{{ $e['start']->format('F jS, g:ia') }}</h5>
                    @endif
                    <p>{{ $e['detail'] }}</p>
                </article>
            </div>
        @endforeach
        </div>

        <h2 class="title is-2">Latest News</h2>

        {{ $news->links() }}

        @foreach ($news as $n)
            <hr>
            <h3 class="title is-3">{{ $n->title }}</h3>
            @if ($n->posted_at)
                <h5 class="subtitle is-5">{{ $n->posted_at->format('F jS, Y') }}</h5>
            @else
                <h5 class="subtitle is-5">{{ $n->created_at->format('F jS, Y') }}</h5>
            @endif
            <div class="content">
                @parsedown($n->body)
            </div>
        @endforeach

        {{ $news->links() }}
    </div>
</section>

@endsection
