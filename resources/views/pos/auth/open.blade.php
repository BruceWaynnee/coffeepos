<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    {{-- CSRF TOKEN --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- title --}}
    <title>Black & White System Open</title>

    {{-- bootstrap css --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    {{-- stylesheet --}}
    <style>
        body {
            height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            flex-flow: column wrap;
            justify-content: center;
        }

        #login .container #login-row #login-column #login-box {
            max-width: 600px;
            height: 410px;
            border: 1px solid #9C9C9C;
            background-color: white;
        }
        #login .container #login-row #login-column #login-box #login-form {
            padding: 20px;
        }
        #login .container #login-row #login-column #login-box #login-form #register-link {
            margin-top: -85px;
        }

    </style>

</head>
<body>
{{-- BEGIN:: Pos Login --}}
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    {{-- error flash message --}}
                    @if (session('error'))
                    <div class="alert alert-danger alert-block" style="margin-top: 20px;">
                        <button type="button" class="close" data-dismiss="alert">×</button>    
                        <strong>{{session('error')}}</strong>
                    </div>
                    @endif
                    <div id="login-box" class="col-md-12">      
                        {{-- login form wrapper --}}
                        <form id="login-form" class="form" action="{{ route('open-pos') }}" method="POST">
                            @csrf
                            <div class="text-center">
                                <img style="width: 100px" src="{{asset('img/dashboard/logo/coffee_logo.png')}}" alt="black white icon">
                                <p><u><i>POS</i> System</u></p>
                            </div>
                            <div class="form-group">
                                <label for="username">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                {{-- <label for="remember-me"><span>Remember me</span> <span><input id="remember" name="remember" type="checkbox"></span></label><br> --}}
                                <input type="submit" name="submit" class="btn btn-outline-success btn-md" value="Open System">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- END:: Pos Login --}}

</body>

</html>