@component('mail::message')
# Introduction

Email Address  -  {{$email->email}}


Message
{{$email->message}}


{{--@component('mail::button', ['url' => 'http://restaurant2.brainfors.am'])--}}
{{--Our Website Link--}}
{{--@endcomponent--}}


Message From  -  {{$email->name}}
@endcomponent







