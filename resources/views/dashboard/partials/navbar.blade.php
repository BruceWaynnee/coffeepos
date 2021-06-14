{{-- BEGIN:: Dashboard Navbar --}}
<div class="dashboard-header">
    <nav class="navbar navbar-expand-md navbar-light fixed-top" style="background-color: white;">
        {{-- system logo --}}
        <div>
            <div class="navbar-brand pr-0" style="display: flex; width: 90px; overflow: hidden;"><img style="width: 100%;" src="{{ asset('img/dashboard/logo/coffee_logo.png') }}" alt="System Icon"></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        {{-- dashboard menu navabar --}}
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {{-- navbar menu --}}
            <ul class="navbar-nav ml-auto navbar-right-top">
                {{-- notification block --}}
                <li class="nav-item dropdown notification">
                    {{-- notification bell logo --}}
                    <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{-- <i class="fas fa-fw fa-bell"></i>  --}}
                        <img src="{{asset('img/dashboard/icons/bell.png')}}" alt="">
                        <span class="indicator"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                        <li>
                            <div class="notification-title"> Notification</div>
                            <div class="notification-list">
                                {{-- example of when happen when click on notification icon
                                in the future this will replace with notification related to products --}}
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action active">
                                        <div class="notification-info">
                                            <div class="notification-list-user-img"><img src="" alt=""
                                                    class="avatar-xs rounded-circle"></div>
                                            <div class="notification-list-user-block"><span
                                                    class="notification-list-user-name">Jeremy
                                                    Rakestraw</span>accepted your invitation to join the team.
                                                <div class="notification-date">2 min ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="notification-info">
                                            <div class="notification-list-user-img"><img src="" alt=""
                                                    class="avatar-xs rounded-circle"></div>
                                            <div class="notification-list-user-block"><span
                                                    class="notification-list-user-name">John Deo</span>is now
                                                following you
                                                <div class="notification-date">2 days ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="list-footer"> <a href="#">View all notifications</a></div>
                        </li>
                    </ul>
                </li>
                @auth
                {{-- current login user block --}}
                <li class="nav-item d-flex">
                    <div class="my-auto px-3">
                        {{-- <img style="width: 16px; vertical-align: text-bottom;" src="{{ asset('icon/account.png') }}" alt="user icon"> --}}
                        <span class="text-gray" style="font-size: 16px;">{{ Auth::user()->username }}</span>
                    </div>
                </li>
                <li class="nav-item">
                    <!-- Authentication -->
                    <form id='logout-form' method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" > 
                            {{ __('Logout') }} 
                        </button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </nav>
</div>
{{-- END:: Dashboard Navbar --}}
