@extends('partials.admin')

@section('adminContent')

<ul class="nav nav-pills">
    <li role="presentation"><a href="/admin/news">News</a>
    <li role="presentation"><a href="/admin/events">Events</a>
    <li role="presentation"><a href="/admin/members">Members</a>
    <li role="presentation" class="active"><a href="/admin/email">E-Mail Members</a>
    <li role="presentation"><a href="/admin/password">Change Password</a>
</ul>

<br>

<div class="alert alert-info">E-mails sent here will come "from" <strong>members@bostonvalleycs.com</strong>.</div>

<form action="/admin/email" enctype="multipart/form-data" method="post">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="replyTo">Reply To</label>
                <input class="form-control" id="replyTo" name="replyTo" type="email" value="{{ old('replyTo') }}">
                <p class="help-block">This email address will be used when the user hits 'Reply' on this email.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="subject">Subject</label>
                <input class="form-control" id="subject" name="subject" type="text" value="{{ old('subject') }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="attachments">Attachments (PDF, ZIP, and Office files only)</label>
                <input id="attachments" name="attachments[]" type="file" multiple>
                <p class="help-block">Attachment should not be more than 5MB in size.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <div class="form-group">
                <label for="body">Content</label>
                <textarea class="form-control" id="body" name="body">{{ old('body') }}</textarea>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary loading">Send Email</button>
</form>

@endsection
