@component('mail::message')
@if($document->remainingHours==6)
    @if($user->role=='requester')
        #Hello {{$user->name}},
You only have 6 hours until your access to {{$document->document_title}} is revoked.<br>
    @elseif($user->role=='approver')
        #Hello {{$user->name}},
{{$user->requester->name}} has only 6 hours remaining until their access to {{$document->document_title}} is revoked.<br>
    @endif
@elseif($document->remainingHours==12)
    @if($user->role=='requester')
        #Hello {{$user->name}},
You only have 12 hours until your access to {{$document->document_title}} is revoked.<br>
    @elseif($user->role=='approver')
        #Hello {{$user->name}},
{{$user->requester->name}} has only 12 hours remaining until their access to {{$document->document_title}} is revoked.<br>
    @endif
@endif
Thanks,<br>
{{ config('app.name') }}
@endcomponent
