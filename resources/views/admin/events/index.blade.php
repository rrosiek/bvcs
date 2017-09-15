@extends('layouts.main')

@section('body')

@include('admin.nav')
<section class="section">
    <div class="container">
        <h2 class="title is-2">{{ $title }}</h2>
        @include('partials.notify')
        <div class="level">
            <div class="level-left">
                <p class="level-item">
                    <a href="{{ route('events.create') }}" class="button is-primary">Add Event</a>
                </p>
            </div>
            <div class="level-right">
                {{ $events->links() }}
            </div>
        </div>
        <table class="table is-fullwidth">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Details</th>
                    <th>Recurrence</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $e)
                <tr>
                    <td>{{ $e->title }}</td>
                    <td>{{ $e->detail }}</td>
                    <td>{{ $e->frequency }}</td>
                    <td>
                        <form action="{{ route('events.destroy', $e) }}" method="post">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <p class="control has-addons is-hover-visible">
                                <a href="{{ route('events.edit', $e) }}" class="button">Edit</a>
                                <button class="button" type="submit">Delete</button>
                            </p>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection
