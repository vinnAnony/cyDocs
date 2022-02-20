@component('mail::message')
@if($user->role=='requester')
    #Hello {{$user->name}},
Your request to access {{$document->document_title}} has been successfully sent.<br>
Kindly Await approval.<br>
@elseif($user->role=='approver')
    #Hello {{$user->name}},
{{$user->requester->name}} has sent a request to access {{$document->document_title}}<br>
Kindly login to the CyDocs portal to approve the file access request.
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
