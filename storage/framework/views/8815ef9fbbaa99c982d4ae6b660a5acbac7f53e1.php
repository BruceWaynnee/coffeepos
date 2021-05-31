
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
                        
                        <li class="nav-item ">
                            <a href="<?php echo e(url('dashboard')); ?>" class="nav-link">
                                <img class="mr-2" style="margin-left: -5px;" src="<?php echo e(asset('img/dashboard/icons/clipboard.png')); ?>" alt="">
                                Dashboard
                            </a>
                        </li>
                        
                        
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" aria-expanded="false"
                                data-target="#attributes-dropdown" aria-controls="attributes-dropdown">
                                <img class="mr-3" src="<?php echo e(asset('img/dashboard/icons/sidebar/')); ?>" alt="">
                                Attributes
                            </a>
                            <div id="attributes-dropdown" class="submenu collapse" style="">
                                <ul class="nav flex-column pl-3">
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo e(route('type-list')); ?>">
                                            Product Type
                                        </a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo e(route('size-list')); ?>">
                                            Product Size
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>                        
                        
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" aria-expanded="false"
                                data-target="#product-dropdown" aria-controls="product-dropdown">
                                <img class="mr-3" src="<?php echo e(asset('img/dashboard/icons/sidebar/')); ?>" alt="">
                                Product
                            </a>
                            <div id="product-dropdown" class="submenu collapse" style="">
                                <ul class="nav flex-column pl-3">                                    
                                    
                                    <li class="nav-item">
                                        <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" aria-expanded="false"
                                            data-target="#products-dropdown" aria-controls="products-dropdown">
                                            All Products
                                        </a>   
                                        <div id="products-dropdown" class="submenu collapse" style="">
                                            <ul class="nav flex-column pl-3">
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a class="nav-link" href="<?php echo e(route('category-products-list', ['categoryId' => $category->id])); ?>">
                                                    <?php echo e(ucwords($category->name)); ?>

                                                </a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>                 
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo e(route('product-add')); ?>">Create New Product</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" aria-expanded="false"
                                data-target="#invoice-dropdown" aria-controls="invoice-dropdown">
                                <img class="mr-3" src="<?php echo e(asset('img/dashboard/icons/sidebar/')); ?>" alt="">
                                Invoice
                            </a>
                            <div id="invoice-dropdown" class="submenu collapse" style="">
                                <ul class="nav flex-column pl-3">
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            History
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" aria-expanded="false"
                                data-target="#sales-dropdown" aria-controls="sales-dropdown">
                                <img class="mr-3" src="<?php echo e(asset('img/dashboard/icons/sidebar/')); ?>" alt="">
                                Sales
                            </a>
                            <div id="sales-dropdown" class="submenu collapse" style="">
                                <ul class="nav flex-column pl-3">
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            History
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" aria-expanded="false"
                                data-target="#settings-dropdown" aria-controls="settings-dropdown">
                                <img class="mr-3" src="<?php echo e(asset('img/dashboard/icons/sidebar/setting.png')); ?>" alt="">
                                System Settings
                            </a>
                            <div id="settings-dropdown" class="submenu collapse" style="">
                                <ul class="nav flex-column pl-3">
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            Currency
                                        </a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo e(route('category-list')); ?>">
                                            Category
                                        </a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            Customer
                                        </a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            Sugar Level
                                        </a>
                                    </li>                                    
                                    
                                    <li class="nav-item">
                                        <a class="nav-link collapsed" href="javascript:void(0)" data-toggle="collapse" aria-expanded="false"
                                            data-target="#system-user-dropdown" aria-controls="system-user-dropdown">
                                            System Users
                                        </a>
                                        <div id="system-user-dropdown" class="submenu collapse" style="">
                                            <ul class="nav flex-column pl-3">
                                                
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">
                                                        User
                                                    </a>
                                                </li>
                                                
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">
                                                        Staff
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </li>
                                    
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

<?php /**PATH C:\xampp\htdocs\coffee_pos\resources\views/dashboard/partials/sidebar.blade.php ENDPATH**/ ?>