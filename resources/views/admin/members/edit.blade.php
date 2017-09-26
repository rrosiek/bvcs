@extends('layouts.main')

@section('body')

<section class="section">
    <div class="container">
        <h2 class="title is-2">{{ $title }}</h2>
        @include('partials.notify')
        <form action="{{ route('members.update', $member) }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            @include('admin.members.form')

            <a class="button" href="{{ route('members.index') }}">Cancel</a>
            <button class="button is-primary" type="submit" v-is-loading="">SAVE</button>
        </form>
    </div>
</section>

@endsection
