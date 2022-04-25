@component('mail::message')
# Hi, {{ $data['studentName'] }}

{{ $data['message'] }}

Have a nice day,<br>
{{ config('app.name') }}
@endcomponent
