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
                    <a href="{{ route('content.create') }}" class="button is-primary">Add Content</a>
                </p>
            </div>
            <div class="level-right">
                {{ $content->links() }}
            </div>
        </div>
        <table class="table is-fullwidth">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($content as $c)
                <tr>
                    <td>{{ $c->title }}</td>
                    <td>{{ $c->type }}</td>
                    <td>
                        <form action="{{ route('content.destroy', $c) }}" method="post">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <p class="control has-addons is-hover-visible">
                                <a href="{{ route('content.edit', $c) }}" class="button">Edit</a>
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
