@component('mail::layout')

@slot('header')
@component('mail::header', ['url' => config('app.url')])
<div style="text-align:center">
<div style="padding: 20px 0">
<img src="{{ config('app.url') }}/images/bvcs-logo-b.png" alt="Logo">
</div>
<div>{{ $subjectForBody }}</div>
</div>
@endcomponent
@endslot

{!! $message !!}

@slot('footer')
@component('mail::footer')
&copy; {{ date('Y') }} {{ config('app.name') }}.
@endcomponent
@endslot

@endcomponent
