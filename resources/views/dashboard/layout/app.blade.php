<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- CSRF TOKEN --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- icon --}}
    <link rel="shortcut icon" href="{{asset('icon/')}}" />

    {{-- title --}}
    <title>
        @section('title','Coffee Dashboard')
    </title>

    {{-- stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.min.css') }}">
    @yield('stylesheet')

</head>

<body>
    <div class="dashboard-main-wrapper">
        {{-- navbar & sidebar --}}
        @include('dashboard.partials.navbar')
        @include('dashboard.partials.sidebar')
        
        {{-- wrapper --}}
        <section class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content">
                    {{-- tittle & breadcrumb --}}
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header m-0">
                                <div class="page-breadcrumb">
                                    {{-- title --}}
                                    <small>{{ env('APP_NAME') }}</small>
                                    {{-- page title --}}
                                    <h2 class="text-dark font-weight-bold">
                                        @yield('dashboard_page_title')
                                    </h2>
                                    <div class="page-breadcrumb-heading-wrapper d-flex justify-content-between align-items-center pb-1">
                                        <div class="page-breadcrumb-heading-input-wrapper">
                                            <ul style="list-style-type: none; font-size: 12px; letter-spacing: .5px; padding-left: 1em;">
                                                @yield('dashboard_breadcrumb')
                                            </ul>
                                        </div>
                                    </div>
                                    {{-- breadcrumb --}}
                                    <nav aria-label="breadcrumb py-4">
                                        <ol>
                                            @yield('breadcrumb') {{-- bread crumbs // path --}}
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- flash message --}}
                    @include('flashmessage.index')
                    {{-- Dashboard Content --}}
                    @yield('content')

                </div>
            </div>
        </section>
    </div>
</body>


{{-- custom script --}}
<script src="{{asset('js/dashboard/global_functions.js')}}"></script>
<script src="{{asset('js/dashboard/dashboard.min.js')}}"></script>

@yield('script')
