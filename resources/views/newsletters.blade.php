@extends('layouts.main')

@section('body')

<section class="section">
    <div class="container">
        <h2 class="title is-2">{{ $title }}</h2>

        <table class="table is-fullwidth">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Released</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($newsletters as $n)
                <tr>
                    <td><strong>{{ $n->title }}</strong></td>
                    <td>{{ $n->posted_at->format('F jS, Y') }}</td>
                    <td>
                        <a class="button" href="/{{ $n->slug }}">View</a>
                        <a class="button" href="/{{ $n->slug }}/pdf">PDF</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection
