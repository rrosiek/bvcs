@component('mail::layout')

@slot('header')
@component('mail::header', ['url' => config('app.url')])
<div style="text-align:center">
<div style="padding: 20px 0">
<img src="{{ config('app.url') }}/images/bvcs-logo-b.png" alt="Logo">
</div>
<div>{{ $newsletter->title }}</div>
</div>
@endcomponent
@endslot

@isset($intro)
@component('mail::panel')
{{ $intro }}
@endcomponent
@endisset

@component('mail::button', ['url' => route('pdf', ['slug' => $newsletter->slug])])
View as PDF
@endcomponent

{!! $newsletter->body !!}

@slot('footer')
@component('mail::footer')
&copy; {{ date('Y') }} {{ config('app.name') }}.
@endcomponent
@endslot

@endcomponent
