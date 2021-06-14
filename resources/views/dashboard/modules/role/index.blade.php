@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title', 'Role List')

{{-- custom stylesheet --}}
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard/modules/role.css') }}">
@endsection

{{-- breadcrumb links --}}
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard</a>
    </li>
@endsection

@section('content')
{{-- BEGIN:: Role --}}
<div class="role-content-wrapper">
    <table class="table role-table-listing-wrapper">
        {{-- table head --}}
        <thead>
            <tr>
                <th>#ID</th>
                <th>Date Creation</th>
                <th>Role</th>
                <th>Permission</th>
                <th>Actions</th>
            </tr>
        </thead>
        {{-- table body --}}
        <tbody>
            @foreach ($roles as $key => $role)                        
            <tr>
                <td>{{$role->id}}</td>
                <td>{{$role->created_at}}</td>
                <td>{{ucwords($role->name)}}</td>
                <td>
                    <div class="dropdown show">
                        <button class="btn btn-outline-dark btn-sm dropdown-toggle" id="dropdown-permissions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Has Permissions
                        </button>
                        <div class="dropdown-menu" style="height: 200px; overflow: scroll; overflow-x: hidden;" aria-labelledby="dropdown-permissions">
                            @if ($role->permissions()->first() != null)
                                @foreach ($role->permissions->sortBy('name') as $permission)
                                <span class="dropdown-item" >{{$permission->name}}</span>
                                @endforeach
                            @else
                                <span class="dropdown-item" style="color: red;">This user has no permission</span>
                            @endif
                        </div>
                    </div>
                </td>
                {{-- action dropdown menu --}}
                <td>
                    <img type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="{{ asset('img/dashboard/logo/action.png') }}" alt="action icon">
                    {{-- dropdown items --}}
                    <div class="dropdown-menu dropdown-menu-left">
                        {{-- edit --}}
                        @can('edit role')
                        <div class="action-edit-wrapper">
                            <a class="dropdown-item" href="{{url("dashboard/roles/$role->id/edit")}}">Edit</a>
                        </div>
                        @endcan
                        {{-- delete --}}
                        @can('delete role')
                        <div class="action-delete-wrapper">
                            <form action="{{ route('role-delete', ['id' => $role->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="role-delete-btn dropdown-item">
                                    Delete
                                </button>
                            </form>
                        </div>
                        @endcan
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- create new role --}}
    @can('create role')
    <div class="create-role-link-wrapper">
        <a href="{{ route('role-add') }}" class="btn btn-sm btn-outline-success">
            Add New Role
        </a>
    </div>
    @endcan
</div>
{{-- END:: Role --}}
@endsection

{{-- custom script --}}
@section('script')
    <script src="{{ asset('js/dashboard/modules/role.js') }}"></script>
    <script>
        $(document).ready(function(){
            validListRole();
        });
    </script>    
@endsection
