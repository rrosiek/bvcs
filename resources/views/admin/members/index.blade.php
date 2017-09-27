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
                    <a href="{{ route('members.create') }}" class="button is-primary">Add Member</a>
                </p>
                <p class="level-item">
                    <a href="{{ route('mail.create') }}" class="button is-primary">E-mail Members</a>
                </p>
            </div>
            <div class="level-right">
                {{ $members->links() }}
            </div>
        </div>
        <table class="table is-fullwidth">
            <thead>
                <tr>
                    <th>E-mail</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Subscribed</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $m)
                <tr>
                    <td>{{ $m->email }}</td>
                    <td>{{ $m->last_name }}</td>
                    <td>{{ $m->first_name }}</td>
                    <td>
                        @if ($m->subscribed)
                            <span class="tag is-success">Yes</span>
                        @else
                            <span class="tag is-dark">No</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('members.destroy', $m) }}" method="post">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <p class="control has-addons is-hover-visible">
                                <a href="{{ route('members.edit', $m) }}" class="button">Edit</a>
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
