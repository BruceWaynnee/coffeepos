
<div class="dashboard-header">
    <nav class="navbar navbar-expand-md navbar-light fixed-top" style="background-color: white;">
        
        <div>
            <div class="navbar-brand pr-0" style="display: flex; width: 90px; overflow: hidden;"><img style="width: 100%;" src="<?php echo e(asset('img/dashboard/logo/coffee_logo.png')); ?>" alt="System Icon"></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <ul class="navbar-nav ml-auto navbar-right-top">
                
                <li class="nav-item dropdown notification">
                    
                    <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                        <img src="<?php echo e(asset('img/dashboard/icons/bell.png')); ?>" alt="">
                        <span class="indicator"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                        <li>
                            <div class="notification-title"> Notification</div>
                            <div class="notification-list">
                                
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
                <?php if(auth()->guard()->check()): ?>
                
                <li class="nav-item d-flex">
                    <div class="my-auto px-3">
                        
                        <img style="width: 16px; vertical-align: text-bottom;"
                        src="<?php echo e(asset('icon/account.png')); ?>" alt="user icon">
                        <span class="text-gray" style="font-size: 16px;"><?php echo e(Auth::user()->name); ?></span>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('logout')); ?>" class="nav-link" style="color:#515151;" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <?php echo e(__('Logout')); ?>

                    </a>
                </li>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                    <?php echo csrf_field(); ?>
                </form>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</div>

<?php /**PATH C:\xampp\htdocs\coffee_pos\resources\views/dashboard/partials/navbar.blade.php ENDPATH**/ ?>