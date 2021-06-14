@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title', 'User List')

{{-- custom stylesheet --}}
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard/modules/user.css') }}">
@endsection

{{-- breadcrumb links --}}
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard</a>
    </li>
@endsection

@section('content')
{{-- BEGIN:: User --}}
<div class="user-content-wrapper">
    <table class="table User-table-listing-wrapper">
        {{-- table head --}}
        <thead>
            <tr>
                <th>#ID</th>
                <th>Username</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Role</th>
                <th>Email</th>
                <th>Register Date</th>
                <th>Action</th>
            </tr>
        </thead>
        {{-- table body --}}
        <tbody>
            @foreach ($users as $key => $user)                        
            <tr>
                <td>{{$key+1}}</td>
                <td>{{ $user->username }}</td>
                <td>{{ ucwords($user->firstname) }}</td>
                <td>{{ ucwords($user->lastname) }}</td>
                <td>Admin</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at}}</td>
                {{-- action dropdown menu --}}
                <td>
                    <img type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="{{ asset('img/dashboard/logo/action.png') }}" alt="action icon">
                    {{-- dropdown items --}}
                    <div class="dropdown-menu dropdown-menu-left">
                        {{-- edit --}}
                        <div class="action-edit-wrapper">
                            <a class="dropdown-item" href="{{url("dashboard/users/$user->id/edit")}}">Edit</a>
                        </div>
                        {{-- delete --}}
                        <div class="action-delete-wrapper">
                            <form action="{{ route('user-delete', ['id' => $user->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="user-delete-btn dropdown-item">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- create new User --}}
    <div class="create-User-link-wrapper">
        <a href="{{ route('user-add') }}" class="btn btn-sm btn-outline-success">
            Create New User
        </a>
    </div>
</div>
{{-- END:: User --}}
@endsection

{{-- custom script --}}
@section('script')
    <script src="{{ asset('js/dashboard/modules/user.js') }}"></script>
    <script>
        $(document).ready(function(){
            validListUser();
        });
    </script>    
@endsection
