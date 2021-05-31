<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <link rel="shortcut icon" href="<?php echo e(asset('icon/')); ?>" />

    
    <title>
        <?php $__env->startSection('title','Coffee Dashboard'); ?>
    </title>

    
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard/dashboard.min.css')); ?>">
    <?php echo $__env->yieldContent('stylesheet'); ?>

</head>

<body>
    <div class="dashboard-main-wrapper">
        
        <?php echo $__env->make('dashboard.partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('dashboard.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        
        <section class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content">
                    
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header m-0">
                                <div class="page-breadcrumb">
                                    
                                    <small><?php echo e(env('APP_NAME')); ?></small>
                                    
                                    <h2 class="text-dark font-weight-bold">
                                        <?php echo $__env->yieldContent('dashboard_page_title'); ?>
                                    </h2>
                                    <div class="page-breadcrumb-heading-wrapper d-flex justify-content-between align-items-center pb-1">
                                        <div class="page-breadcrumb-heading-input-wrapper">
                                            <ul style="list-style-type: none; font-size: 12px; letter-spacing: .5px; padding-left: 1em;">
                                                <?php echo $__env->yieldContent('dashboard_breadcrumb'); ?>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <nav aria-label="breadcrumb py-4">
                                        <ol>
                                            <?php echo $__env->yieldContent('breadcrumb'); ?> 
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php echo $__env->make('flashmessage.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    
                    <?php echo $__env->yieldContent('content'); ?>

                </div>
            </div>
        </section>
    </div>
</body>



<script src="<?php echo e(asset('js/dashboard/global_functions.js')); ?>"></script>
<script src="<?php echo e(asset('js/dashboard/dashboard.min.js')); ?>"></script>

<?php echo $__env->yieldContent('script'); ?>
<?php /**PATH C:\xampp\htdocs\coffee_pos\resources\views/dashboard/layout/app.blade.php ENDPATH**/ ?>