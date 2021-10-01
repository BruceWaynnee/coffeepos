<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- CSRF TOKEN --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- icon --}}
    <link rel="shortcut ic  on" href="{{asset('icon/')}}" />

    {{-- title --}}
    <title>
        @section('title','Black & White Cofee POS')
    </title>

    {{-- stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/pos/pos.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.min.css') }}">
    @yield('stylesheet')

</head>

<body>
    <div class="pos-main-wrapper">
        @include('pos.partials.navbar')

        {{-- pos content --}}
        @yield('content')

    </div>
</body>

{{-- custom script --}}
<script src="{{asset('js/pos/pos.min.js')}}"></script>
<script src="{{asset('js/dashboard/dashboard.min.js')}}"></script>

@yield('script')
