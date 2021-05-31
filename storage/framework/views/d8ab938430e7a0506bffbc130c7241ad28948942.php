<?php $__env->startSection('dashboard_page_title', 'Product Edit'); ?>


<?php $__env->startSection('stylesheet'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard/modules/product.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('dashboard_breadcrumb'); ?>
    <li class="breadcrumb-item" aria-current="page">
        <a href="<?php echo e(url('/dashboard')); ?>" class="breadcrumb-link">Dashboard / </a>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="edit-product-content-wrapper">
    <form id="product-form" action="<?php echo e(route('product-update', ['id' => $product->id])); ?>" method="POST" enctype="multipart/form-data">
        <?php echo method_field('patch'); ?>
        <?php echo csrf_field(); ?>
        <div class="general-info-wrapper">
            
                <p class="font-weight-bold">General Information</p>
                <hr>
                <div class="form-row"> 
                    
                    <div class="form-group col-md-4">
                        <label>Product Image (250 x 300)</label>
                        <div class="product-image-preview-wrapper" style="text-align: center; border: 1px solid rgb(110, 110, 110);">
                            <?php if($product->image != null): ?>
                                <img style="width: 150px; height: 200px;" id="product-image-preview" src="<?php echo e(asset('storage/'.$product->image)); ?>" alt="product image">
                            <?php else: ?>
                                <img style="width: 150px; height: 200px;" id="product-image-preview" src="<?php echo e(asset('img/product/default-img.png')); ?>" alt="product image">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="form-row"> 
                    
                    <div class="form-group col-md-4">
                        <div class="product-image-wrapper">
                            <div class="product-image-upload form-control">
                                <input type="file" name="image-file" id="image-file" accept="image/x-png,image/gif,image/jpeg" hidden>
                                <p id="image-name-text"></p>
                                <p id="browse-btn">Browse</p>
                            </div>
                        </div>
                    </div>   
                </div>    
                <div class="form-row">
                    
                    <div class="form-group col-md-4">
                        <label for="name">Product Name</label>
                        <input class="form-control" value="<?php echo e($product->name); ?>" type="text" minlength="2" maxlength="20" name="name" id="name" required>
                        <small class="text-warning" data-toggle="tooltip" data-placement="right" title="name accept only alphanumeric and whitspace only" > [ Product Name ? ]</small>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="category">Category</label>
                        <select class="custom-select" name="category" id="category" required>
                            <option selected hidden value="<?php echo e($product->category->id); ?>"><?php echo e($product->category->name); ?></option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"><?php echo e(ucwords($category->name)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>                
                </div>
                <div class="form-row">
                    
                    <div class="form-group col-md-8">
                        <label for="description">Product Description</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="5"><?php echo e($product->description); ?></textarea>
                    </div>
                </div>
            
            <div class="product-btn-wrapper form-row">
                <input type="submit" class="btn btn-sm btn-outline-success mr-2" value="Update Product">
                <a class="btn btn-sm btn-outline-danger" href="<?php echo e(route('category-products-list', ['categoryId' => $product->category->id])); ?>">Cancel</a>
            </div>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('js/dashboard/modules/product.js')); ?>"></script>
    <script>
        $(document).ready(function(){
            validAddnEditProduct('edit');
        })
    </script>    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\coffee_pos\resources\views/dashboard/modules/product/edit.blade.php ENDPATH**/ ?>