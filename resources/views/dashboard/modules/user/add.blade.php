@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title', 'User Add')

{{-- custom stylesheet --}}
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard/modules/user.css') }}">
@endsection

{{-- breadcrumb links --}}
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard / </a>
        <a href="{{ route('user-list') }}" class="breadcrumb-link">User</a>
    </li>
@endsection

@section('content')
{{-- BEGIN:: User Add --}}
<div class="add-user-content-wrapper">
    <form id="user-form" action="{{url('dashboard/users/create')}}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- general information --}}
        <div class="general-info-wrapper">
            <p>General Information</p>
            <div class="form-row">
                {{-- username --}}
                <div class="form-group col-md-4">
                    <label for="username">Username</label>
                    <input type="text" minlength="2" maxlength="30" class="form-control" name="username" id="username" required>
                    <small class="text-warning" data-toggle="tooltip" data-placement="right" title="name accept only alphanumeric without whitespace" > [ Username Name ? ]</small>
                </div>
                {{-- roles --}}
                <div class="form-group col-md-4">
                    <label for="role">Choose Roles</label>
                    <select class="custom-select" name="role" id="role" required>
                        @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                {{-- firstname --}}
                <div class="form-group col-md-4">
                    <label for="firstname">Firstname</label>
                    <input type="text" minlength="2" maxlength="30" class="form-control" name="firstname" id="firstname" required>
                    <small class="text-warning" data-toggle="tooltip" data-placement="right" title="firstname accept only alphabet" > [ Firstname ? ]</small>
                </div>
                {{-- lastname --}}
                <div class="form-group col-md-4">
                    <label for="lastname">Lastname</label>
                    <input type="text" minlength="2" maxlength="30" class="form-control" name="lastname" id="lastname" required>
                    <small class="text-warning" data-toggle="tooltip" data-placement="right" title="lastname accept only alphabet" > [ Lastname ? ]</small>
                </div>
            </div>
            <div class="form-row">
                {{-- email --}}
                <div class="form-group col-md-4">
                    <label for="email">Email</label>
                    <input type="email" minlength="6" maxlength="30" class="form-control" name="email" id="email" required>
                    <small class="text-warning" data-toggle="tooltip" data-placement="right" title="Email format (xx.xx-xx@xxx.xx)" > [ Email ? ]</small>
                </div>
                {{-- password --}}
                <div class="form-group col-md-4">
                    <label for="password">Password</label>
                    <input type="password" minlength="6" maxlength="15" class="form-control" name="password" id="password" required>
                    <label for="password">Show Password: </label>
                    <input type="checkbox" onclick="showPassword()">
                </div>
            </div>
        </div>

        {{-- add & reset button --}}
        <div class="sales-btn-wrapper form-row">
            <input type="submit" class="btn btn-sm btn-outline-info mr-2" value="Register User">
            <button id="user-reset-btn" class="btn btn-sm btn-outline-danger cursor-pointer">Reset Fields</button>
        </div>
    </form>
</div>
{{-- END:: User Add --}}
@endsection

{{-- custom script --}}
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
    <script src="{{ asset('js/dashboard/modules/user.js') }}"></script>
    <script>
        $(document).ready(function(){
            validAddnEditUser('add');            
        })
    </script>    
@endsection
