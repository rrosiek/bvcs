@extends('partials.admin')

@section('adminContent')

<ul class="nav nav-pills">
    <li role="presentation"><a href="/admin/news">News</a>
    <li role="presentation"><a href="/admin/events">Events</a>
    <li role="presentation" class="active"><a href="/admin/members">Members</a>
    <li role="presentation"><a href="/admin/email">E-Mail Members</a>
    <li role="presentation"><a href="/admin/password">Change Password</a>
</ul>

<br>

<h4 class="text-primary">Add Member</h4>

<div class="row">
    <form action="/admin/members" class="form-inline" method="post">
        {{ csrf_field() }}
        <div class="col-md-3">
            <div class="form-group">
                <label for="email">E-Mail</label>
                <input class="form-control" id="email" name="email" type="email">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input class="form-control" id="first_name" name="first_name" type="text">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input class="form-control" id="last_name" name="last_name" type="text">
            </div>
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary loading" type="submit">Add</button>
        </div>
    </form>
</div>

<hr>

<div class="text-center">
    {!! $members->links() !!}
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Email</th>
            <th>Active</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($members as $m)
        <form action="/admin/members/{{ $m->id }}" method="post">
            {{ csrf_field() }}
            <tr>
                <td><input class="form-control" name="last_name" type="text" value="{{ $m->last_name }}"></td>
                <td><input class="form-control" name="first_name" type="text" value="{{ $m->first_name }}"></td>
                <td><input class="form-control" name="email" type="text" value="{{ $m->email }}"></td>
                <td><input name="is_active" type="checkbox" {{ $m->is_active ? 'checked' : '' }}></td>
                <td><button class="btn btn-primary loading" type="submit">Update</button></td>
            </tr>
        </form>
        @endforeach
    </tbody>
</table>

@endsection
