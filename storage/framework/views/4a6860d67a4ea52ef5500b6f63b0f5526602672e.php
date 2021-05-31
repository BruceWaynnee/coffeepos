<?php $__env->startSection('dashboard_page_title'); ?>
    <?php echo e(ucwords($category->name)); ?> Product
<?php $__env->stopSection(); ?>


<?php $__env->startSection('stylesheet'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard/modules/product.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('dashboard_breadcrumb'); ?>
    <li class="breadcrumb-item" aria-current="page">
        <a href="<?php echo e(url('/dashboard')); ?>" class="breadcrumb-link">Dashboard</a>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="product-content-wrapper">
    <table class="table product-table-listing-wrapper">
        
        <thead>
            <tr>
                <th>Product N°</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Date Creation</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        
        <tbody>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                        
            <tr>
                <td><?php echo e($key+1); ?></td>
                <td><?php echo e(ucwords($product->name)); ?></td>
                <td><?php echo e(ucwords($product->description)); ?></td>
                <td><?php echo e($product->created_at); ?></td>
                <td> 
                    <?php if($product->image != null): ?>
                        <img style="width: 80px; max-height: 130px;" src="<?php echo e(asset('storage/'.$product->image)); ?>" alt="product image">
                    <?php else: ?>
                        <img style="width: 80px; max-height: 130px;" src="<?php echo e(asset('img/product/default-img.png')); ?>" alt="product image">
                    <?php endif; ?> 
                </td>
                <td> 
                    <img type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="<?php echo e(asset('img/dashboard/logo/action.png')); ?>" alt="action icon">
                    
                    <div class="dropdown-menu dropdown-menu-left">
                        
                        <div class="action-edit-wrapper">
                            <a class="dropdown-item" href="<?php echo e(url("dashboard/products/$product->id/edit")); ?>">Edit</a>
                        </div>
                        
                        <div class="action-delete-wrapper">
                            <form action="<?php echo e(route('product-delete', ['id' => $product->id])); ?>" method="POST">
                                <?php echo method_field('delete'); ?>
                                <?php echo csrf_field(); ?>
                                <button class="product-delete-btn dropdown-item">
                                    Delete
                                </button>
                            </form>
                        </div>
                        
                        <div class="action-edit-wrapper">
                            <a class="dropdown-item" href="<?php echo e(route('product-productvariants-list', ['productId' => $product->id])); ?>">View Variants</a>
                        </div>                        
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div class="pagination-link-wrapper d-flex justify-content-center">
        <?php echo e($products->links()); ?>

    </div>
    
    <div class="create-product-link-wrapper">
        <a href="<?php echo e(route('product-add')); ?>" class="btn btn-sm btn-outline-success">
            Add New Product
        </a>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('js/dashboard/modules/product.js')); ?>"></script>
    <script>
        $(document).ready(function(){
            validListProduct();
        });
    </script>    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\coffee_pos\resources\views/dashboard/modules/product/index.blade.php ENDPATH**/ ?>