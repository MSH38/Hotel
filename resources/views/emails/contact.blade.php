<x-mail::message>
Contact from {{ $name }}
{{ $message }}

<x-mail::button :url="'http://Delux/home'">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
