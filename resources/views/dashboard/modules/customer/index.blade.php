@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title', 'Customer List')

{{-- custom stylesheet --}}
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard/modules/customer.css') }}">
@endsection

{{-- breadcrumb links --}}
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard</a>
    </li>
@endsection

@section('content')
{{-- BEGIN:: Customer List --}}
<div class="customer-content-wrapper">
    <table class="table customer-table-listing-wrapper">
        <thead>
            <tr>
                <th>#No</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Discount</th>
                <th>Point</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $key => $customer)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ ucwords($customer->name) }}</td>
                    <td>{{ strlen($customer->contact) < 9 ? '---' : $customer->contact }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ floatval($customer->discount) }}%</td>
                    <td>{{ $customer->point }} pt</td>
                    <td> {{-- action dropdown menu --}}
                        <img type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="{{ asset('img/dashboard/logo/action.png') }}" alt="action icon">
                        {{-- dropdown menu --}}
                        <div class="dropdown-menu dropdown-menu-left">
                            {{-- edit --}}
                            @can('edit customer')
                            <div class="action-edit-wrapper">
                                <a class="dropdown-item" href="{{ url("dashboard/customers/$customer->id/edit") }}">Edit</a>
                            </div>
                            @endcan
                            {{-- delete --}}
                            @can('delete customer')
                                <div class="action-delete-wrapper">
                                    <form action="{{ route('customer-delete', ['id' => $customer->id]) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="customer-delete-btn dropdown-item">
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
    {{-- create new customer --}}
    @can('create customer')
    <div class="create-customer-link-wrapper">
        <a href="{{ route('customer-add') }}" class="btn btn-sm btn-outline-success">
            Create New Customer
        </a>
    </div>
    @endcan
</div>
{{-- END:: Customer List --}}
@endsection

{{-- customer script --}}
@section('script')
    <script src="{{ asset('js/dashboard/modules/customer.js') }}"></script>
    <script>
        $(document).ready(function(){
            validListCustomer();
        });
    </script>
@endsection