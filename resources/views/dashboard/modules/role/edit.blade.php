@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title', 'Role Edit')

{{-- custom stylesheet --}}
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard/modules/role.css') }}">
@endsection

{{-- breadcrumb links --}}
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard / </a>
        <a href="{{ route('role-list') }}" class="breadcrumb-link">Role</a>
    </li>
@endsection

@section('content')
{{-- BEGIN:: Role Edit --}}
<div class="edit-role-content-wrapper">
    <form id="role-form" action="{{ route('role-update', ['id' => $role->id]) }}" method="POST" enctype="multipart/form-data">
        @method('patch')
        @csrf
        {{-- general information --}}
        <div class="general-info-wrapper">
            <p>General Information</p>
            <div class="form-row">
                {{-- role name --}}
                <div class="form-group col-md-4">
                    <label for="name">Role Name</label>
                    <input type="text" value="{{$role->name}}" minlength="2" maxlength="30" class="form-control" name="name" id="name" required>
                    <small class="text-warning" data-toggle="tooltip" data-placement="right" title="name accept only alphanumeric without whitespace" > [ Role Name ? ]</small>
                </div>
                {{-- permission --}}
                <div class="form-group col-md-4">
                    <label for="role">Give Permissions</label>
                    <input type="hidden" id="role-permissions" name="role-permissions" value="{{$permissionIdsArr}}">
                    <select class="form-control selectpicker" name="permissions[]" multiple data-live-search="true" data-dropup-auto="false">
                        @foreach ($permissions as $permission)
                        <option value="{{$permission->id}}" >{{$permission->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        {{-- update & back button --}}
        <div class="sales-btn-wrapper form-row mt-4">
            <input type="submit" class="btn btn-sm btn-outline-info mr-2" value="Update Role">
            <a class="btn btn-sm btn-outline-danger" href="{{ route('role-list') }}">Cancel</a>
        </div>
    </form>
</div>
{{-- END:: Role Edit --}}
@endsection

{{-- custom script --}}
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
    <script src="{{ asset('js/dashboard/modules/role.js') }}"></script>
    <script>
        $(document).ready(function(){
            validAddnEditRole();
            autoSelectPermissionsOfCurrentRole();
        })
    </script>    
@endsection
