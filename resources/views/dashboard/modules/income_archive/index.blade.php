@extends('dashboard.layout.app')

{{-- page title --}}
@section('dashboard_page_title', 'Income Tracking List')

{{-- custom stylesheet --}}
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard/modules/income_archive.css') }}">
@endsection

{{-- breadcrumb links --}}
@section('dashboard_breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ url('/dashboard') }}" class="breadcrumb-link">Dashboard</a>
    </li>
@endsection

@section('content')
{{-- BEGIN:: Income Archive --}}
<div class="income-archive-content-wrapper">
    <div class="form-row justify-content-end">
        <div class="form-group input-group-sm d-flex align-items-center">
            <p class="my-0 mr-3">Search</p>
            <input class="form-control input-sm" type="text" name="income-search-box" id="income-search-box">
        </div>
    </div>
    <table class="table income-archive-table-listing-wrapper">
        {{-- table head --}}
        <thead>
            <tr>
                <th>#No</th>
                <th>System Open Date</th>
                <th>System Close Date</th>
                <th>System Open By</th>
                <th>Total Order Made</th>
                <th>Total Net Income</th>
                <th>Action</th>
            </tr>
        </thead>
        {{-- table body --}}
        <tbody>
            @foreach ($incomeArchives as $key => $incomeArchive)                        
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $incomeArchive->start_date }}</td>
                <td>{{ $incomeArchive->end_date }}</td>
                <td>{{ ucwords($incomeArchive->staff) }}</td>
                <td>{{ $incomeArchive->total_order_made }} Orders</td>
                <td>$ {{ $incomeArchive->total_net_income }}</td>
                {{-- action dropdown menu --}}
                <td>
                    <img type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="{{ asset('img/dashboard/logo/action.png') }}" alt="action icon">
                    {{-- dropdown items --}}
                    <div class="dropdown-menu dropdown-menu-left">
                        {{-- detail --}}
                        <div class="action-edit-wrapper">
                            <a class="dropdown-item" href="{{ route('income-archive-detail', ['id' => $incomeArchive->id]) }}">Detail</a>
                        </div>
                        {{-- delete --}}
                        <div class="action-delete-wrapper">
                            <form action="{{ route('income-archive-delete', ['id' => $incomeArchive->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button class="income-archive-delete-btn dropdown-item">
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
</div>
{{-- END:: Income Archive --}}
@endsection

{{-- custom script --}}
@section('script')
    <script src="{{ asset('js/dashboard/modules/income_archive.js') }}"></script>
    <script>
        $(document).ready(function(){
            validListIncomeArchive();
        });
    </script>
@endsection