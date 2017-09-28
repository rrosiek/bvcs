<div class="columns">
    <div class="column">
        @include('partials.textInput', ['name' => 'first_name', 'label' => 'First Name', 'value' => $member->first_name, 'required' => true])
    </div>
    <div class="column">
        @include('partials.textInput', ['name' => 'last_name', 'label' => 'Last Name', 'value' => $member->last_name, 'required' => true])
    </div>
</div>
<div class="columns">
    <div class="column is-half">
        @include('partials.textInput', ['name' => 'email', 'label' => 'E-mail', 'value' => $member->email, 'required' => true])
    </div>
</div>
<div class="columns">
    <div class="column is-half">
        @include('partials.textInput', ['name' => 'address', 'label' => 'Address', 'value' => $member->address])
    </div>
</div>
<div class="columns">
    <div class="column is-half">
        @include('partials.checkboxInput', ['name' => 'subscribed', 'label' => 'Subscribed', 'value' => $member->subscribed])
    </div>
</div>
