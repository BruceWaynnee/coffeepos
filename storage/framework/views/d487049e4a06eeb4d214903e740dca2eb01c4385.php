<?php $__env->startSection('dashboard_page_title', 'Category List'); ?>


<?php $__env->startSection('stylesheet'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard/modules/category.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('dashboard_breadcrumb'); ?>
    <li class="breadcrumb-item" aria-current="page">
        <a href="<?php echo e(url('/dashboard')); ?>" class="breadcrumb-link">Dashboard</a>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="category-content-wrapper">
    <table class="table category-table-listing-wrapper">
        
        <thead>
            <tr>
                <th>Category N°</th>
                <th>Category Name</th>
                <th>Date Creation</th>
                <th>Action</th>
            </tr>
        </thead>
        
        <tbody>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                        
            <tr>
                <td><?php echo e($key+1); ?></td>
                <td><?php echo e(ucwords($category->name)); ?></td>
                <td><?php echo e($category->created_at); ?></td>
                
                <td>
                    <img type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="<?php echo e(asset('img/dashboard/logo/action.png')); ?>" alt="action icon">
                    
                    <div class="dropdown-menu dropdown-menu-left">
                        
                        <div class="action-edit-wrapper">
                            <a class="dropdown-item" href="<?php echo e(url("dashboard/categories/$category->id/edit")); ?>">Edit</a>
                        </div>
                        
                        <div class="action-delete-wrapper">
                            <form action="<?php echo e(route('category-delete', ['id' => $category->id])); ?>" method="POST">
                                <?php echo method_field('delete'); ?>
                                <?php echo csrf_field(); ?>
                                <button class="category-delete-btn dropdown-item">
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
    
    <div class="create-category-link-wrapper">
        <a href="<?php echo e(route('category-add')); ?>" class="btn btn-sm btn-outline-success">
            Add New Category
        </a>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('js/dashboard/modules/category.js')); ?>"></script>
    <script>
        $(document).ready(function(){
            validListCategory();
        });
    </script>    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\coffee_pos\resources\views/dashboard/modules/category/index.blade.php ENDPATH**/ ?>