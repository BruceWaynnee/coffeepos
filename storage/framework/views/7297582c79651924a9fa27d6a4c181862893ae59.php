<?php $__env->startSection('dashboard_page_title', 'Type List'); ?>


<?php $__env->startSection('stylesheet'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard/modules/type.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('dashboard_breadcrumb'); ?>
    <li class="breadcrumb-item" aria-current="page">
        <a href="<?php echo e(url('/dashboard')); ?>" class="breadcrumb-link">Dashboard</a>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="type-content-wrapper">
    <table class="table type-table-listing-wrapper">
        
        <thead>
            <tr>
                <th>Type N°</th>
                <th>Type Name</th>
                <th>Date Creation</th>
                <th>Action</th>
            </tr>
        </thead>
        
        <tbody>
            <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                        
            <tr>
                <td><?php echo e($key+1); ?></td>
                <td><?php echo e(ucwords($type->name)); ?></td>
                <td><?php echo e($type->created_at); ?></td>
                
                <td>
                    <img type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="<?php echo e(asset('img/dashboard/logo/action.png')); ?>" alt="action icon">
                    
                    <div class="dropdown-menu dropdown-menu-left">
                        
                        <div class="action-edit-wrapper">
                            <a class="dropdown-item" href="<?php echo e(url("dashboard/types/$type->id/edit")); ?>">Edit</a>
                        </div>
                        
                        <div class="action-delete-wrapper">
                            <form action="<?php echo e(route('type-delete', ['id' => $type->id])); ?>" method="POST">
                                <?php echo method_field('delete'); ?>
                                <?php echo csrf_field(); ?>
                                <button class="type-delete-btn dropdown-item">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    
    <div class="create-type-link-wrapper">
        <a href="<?php echo e(route('type-add')); ?>" class="btn btn-sm btn-outline-success">
            Add New Type
        </a>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('js/dashboard/modules/type.js')); ?>"></script>
    <script>
        $(document).ready(function(){
            validListType();
        });
    </script>    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\coffee_pos\resources\views/dashboard/modules/type/index.blade.php ENDPATH**/ ?>