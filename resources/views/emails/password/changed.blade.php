{{--<x-mail::message>--}}
{{--# Introduction--}}

{{--The body of your message.--}}

{{--<x-mail::button :url="''">--}}
{{--Button Text--}}
{{--</x-mail::button>--}}

{{--Thanks,<br>--}}
{{--{{ config('app.name') }}--}}
{{--</x-mail::message>--}}
@extends('email-base')

@section('title', 'Промяна - ' . config('app.name'))

@section('content')
    <div class="greeting">
        <h2>Уведомление за промяна</h2>
        <p>Това е уведомление, че е настъпила промяна във вашия акаунт.</p>
    </div>

    <div class="additional-info">
        <div class="info-title">Допълнителна информация:</div>
        <p>Моля, свържете се с администратор, ако имате въпроси относно тази промяна.</p>
    </div>

    <p style="font-size:14px; color:#7b8a9a; margin-top:20px;">
        Това съобщение е генерирано автоматично от системата.
    </p>
@endsection
