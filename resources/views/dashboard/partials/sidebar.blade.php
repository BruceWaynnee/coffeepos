{{-- BEGIN::Dashboard Sidebar --}}
<div class="nav-left-sidebar sidebar-dark">
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
        <div class="menu-list" style="overflow: hidden; width: auto; height: 90%; overflow-y:scroll;">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="d-xl-none d-lg-none text-white" href="javascript:void(0)">Dashboard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        {{-- dashboard --}}
                        <li class="nav-item ">
                            <a href="{{ url('dashboard') }}" class="nav-link">
                                <img class="mr-2" style="margin-left: -5px;" src="{{asset('img/dashboard/icons/clipboard.png')}}" alt="">
                                Dashboard
                            </a>
                        </li>
                        {{-- available modules --}}
                        {{-- attributes --}}
                        @if (Gate::check('view product-type') || Gate::check('view product-size'))
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" aria-expanded="false"
                                data-target="#attributes-dropdown" aria-controls="attributes-dropdown">
                                <img class="mr-3" src="{{asset('img/dashboard/icons/sidebar/')}}" alt="">
                                Attributes
                            </a>
                            <div id="attributes-dropdown" class="submenu collapse" style="">
                                <ul class="nav flex-column pl-3">
                                    {{-- type --}}
                                    @can('view product-type')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('type-list') }}">
                                            Product Type
                                        </a>
                                    </li>
                                    @endcan
                                    {{-- size --}}
                                    @can('view product-size')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('size-list') }}">
                                            Product Size
                                        </a>
                                    </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                        @endif
                        {{-- product --}}
                        @if (Gate::check('view product') || Gate::check('view product-product-variant'))
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" aria-expanded="false"
                                data-target="#product-dropdown" aria-controls="product-dropdown">
                                <img class="mr-3" src="{{asset('img/dashboard/icons/sidebar/')}}" alt="">
                                Product
                            </a>
                            <div id="product-dropdown" class="submenu collapse" style="">
                                <ul class="nav flex-column pl-3">                                    
                                    {{-- all products --}}
                                    @can('view product')
                                    <li class="nav-item">
                                        <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" aria-expanded="false"
                                            data-target="#products-dropdown" aria-controls="products-dropdown">
                                            All Products
                                        </a>   
                                        <div id="products-dropdown" class="submenu collapse" style="">
                                            <ul class="nav flex-column pl-3">
                                                @foreach ($categories as $category)
                                                <a class="nav-link" href="{{ route('category-products-list', ['categoryId' => $category->id]) }}">
                                                    {{ ucwords($category->name) }}
                                                </a>
                                                @endforeach
                                            </ul>
                                        </div>                 
                                    </li>
                                    @endcan
                                    {{-- create product --}}
                                    @can('create product')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('product-add') }}">Create New Product</a>
                                    </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                        @endif
                        {{-- orders --}}
                        @can('view order')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" aria-expanded="false"
                                data-target="#order-dropdown" aria-controls="order-dropdown">
                                <img class="mr-3" src="{{asset('img/dashboard/icons/sidebar/')}}" alt="">
                                Order
                            </a>
                            <div id="order-dropdown" class="submenu collapse" style="">
                                <ul class="nav flex-column pl-3">
                                    {{-- history --}}
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('order-list') }}">
                                            History
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endcan
                        {{-- settings --}}
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" aria-expanded="false"
                                data-target="#settings-dropdown" aria-controls="settings-dropdown">
                                <img class="mr-3" src="{{asset('img/dashboard/icons/sidebar/setting.png')}}" alt="">
                                System Settings
                            </a>
                            <div id="settings-dropdown" class="submenu collapse" style="">
                                <ul class="nav flex-column pl-3">
                                    {{-- currency --}}
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            Currency
                                        </a>
                                    </li>
                                    {{-- categories --}}
                                    @can('view category')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('category-list') }}">
                                            Category
                                        </a>
                                    </li>
                                    @endcan
                                    {{-- customer --}}
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            Customer
                                        </a>
                                    </li>
                                    {{-- sugar level --}}
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            Sugar Level
                                        </a>
                                    </li>                                    
                                    {{-- user --}}
                                    @can('view user')
                                    <li class="nav-item">
                                        <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" aria-expanded="false"
                                            data-target="#system-user-dropdown" aria-controls="system-user-dropdown">
                                            System Users
                                        </a>
                                        <div id="system-user-dropdown" class="submenu collapse" style="">
                                            <ul class="nav flex-column pl-3">
                                                {{-- user list --}}
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('user-list') }}">
                                                        User
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    @endcan
                                    {{--  --}}
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
        </div>
        <div class="slimScrollBar"
            style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 950px;">
        </div>
        <div class="slimScrollRail"
            style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
        </div>
    </div>
</div>
{{-- END::Dashboard Sidebar --}}
