@extends('pos.layout.app')

{{-- BEGIN:: Pos --}}
@section('content')
<div class="main-pos-container">
    {{-- pos order sidebar --}}
    @include('pos.partials.order_sidebar')

    {{-- pos content --}}
    <div class="pos-content-wrapper">
        <p>Main Pos Page</p>
    </div>
</div>
@endsection
{{-- END:: Pos --}}
