<div class="columns">
    <div class="column is-half">
        <label class="label is-required">Title</label>
        <p class="control {{ $errors->has('title') ? 'has-icon has-icon-right' : '' }}">
            <input
                @blur="titleToSlug($event, 'slug')"
                class="input {{ $errors->has('title') ? 'is-danger' : '' }}"
                name="title"
                type="text"
                value="{{ old('title', $content->title) }}"
            >
            @if ($errors->has('title'))
                <span class="icon is-small">
                    <i class="fa fa-warning"></i>
                </span>
                <span class="help is-danger">{{ $errors->first('title') }}</span>
            @endif
        </p>
    </div>
    <div class="column is-half">
        <label class="label is-required">URL Slug</label>
        <p class="control {{ $errors->has('slug') ? 'has-icon has-icon-right' : '' }}">
            <input
                class="input {{ $errors->has('slug') ? 'is-danger' : '' }}"
                id="slug"
                name="slug"
                type="text"
                value="{{ old('slug', $content->slug) }}"
            >
            @if ($errors->has('slug'))
                <span class="icon is-small">
                    <i class="fa fa-warning"></i>
                </span>
                <span class="help is-danger">{{ $errors->first('slug') }}</span>
            @endif
        </p>
    </div>
</div>
<div class="columns">
    <div class="column">
        <div class="control">
            <label class="label is-required">Content Type</label>
            <label class="radio">
                <input type="radio" name="type" value="news" {{ old('type', $content->type) === 'news' ? 'checked' : '' }}>
                News
            </label>
            <label class="radio">
                <input type="radio" name="type" value="newsletter" {{ old('type', $content->type) === 'newsletter' ? 'checked' : '' }}>
                Newsletter
            </label>
            <label class="radio">
                <input type="radio" name="type" value="page" {{ old('type', $content->type) === 'page' ? 'checked' : '' }}>
                Page
            </label>
        </div>
        @if ($errors->has('type'))
            <span class="help is-danger">{{ $errors->first('type') }}</span>
        @endif
    </div>
</div>
<div class="columns">
    <div class="column is-half">
        @include('partials.dateInput', ['name' => 'posted_at', 'label' => 'Date Posted', 'value' => $content->posted_at])
    </div>
</div>
<div class="columns">
    <div class="column">
        @include('partials.textareaInput', ['name' => 'body', 'label' => 'Content', 'value' => $content->body, 'required' => true])
    </div>
</div>
