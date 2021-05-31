<?php $__env->startSection('dashboard_page_title'); ?>
    Add Product Variant Of [ <?php echo e(ucwords($product->name)); ?> ] 
<?php $__env->stopSection(); ?>


<?php $__env->startSection('stylesheet'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard/modules/product_variant.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('dashboard_breadcrumb'); ?>
    <li class="breadcrumb-item" aria-current="page">
        <a href="<?php echo e(url('/dashboard')); ?>" class="breadcrumb-link">Dashboard / </a>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="add-product-variant-content-wrapper">
    <form id="product-variant-form" action="<?php echo e(url('dashboard/productvariants/create')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        
        <div class="general-info-wrapper">
            <p class="font-weight-bold">General Information</p>
            <hr>
            
            <div class="form-row">
                
                <div class="form-group col-md-4">
                    <label for="name">From Product</label>
                    <input class="form-control" value="<?php echo e(ucwords($product->name)); ?>" type="text" minlength="2" maxlength="20" name="name" id="name" disabled>
                </div>
            </div>
            
            <div class="form-row">
                
                <div class="form-group col-md-4">
                    <label for="pv-name">Product Variant Name (preview)</label>
                    <small id="pv-name" class="form-control text-success">
                        <span id="pv-product-name">-</span>
                        <span id="pv-type-name">-</span>
                        <span id="pv-size-name">-</span>
                    </small>
                </div>
            </div>
            
            <div class="form-row">
                
                <div class="form-group col-md-4">
                    <label for="type">Type</label>
                    <select class="custom-select" name="type" id="type">
                        <option selected hidden value=''>Choose Type</option>
                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type->id); ?>"><?php echo e(ucwords($type->name)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>                
            </div>
            
            <div class="form-row">
                
                <div class="form-group col-md-4">
                    <label for="size">Size</label>
                    <select class="custom-select" name="size" id="size">
                        <option selected hidden value=''>Choose Size</option>
                        <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($size->id); ?>"><?php echo e(ucwords($size->name)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                
                <div class="form-group col-md-4">
                    <label for="price">Price ($)</label>
                    <input type="number" class="form-control" min="0.00" step="0.01" name="price" id="price">
                </div>                
            </div>
            
            <div class="form-row">
                
                <div class="form-group col-md-8">
                    <label for="description">Product Description</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="5" disabled><?php echo e($product->description); ?></textarea>
                </div>
            </div>
            
            <div class="form-row my-2">
                <div class="form-group col-md-8 text-right">
                    <input id="add-variant-btn" type="button" class="btn btn-sm btn-outline-success mr-2" value="Add Variant">
                </div>
            </div>            
            <hr>
            
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="hidden" name="product" value="<?php echo e($product->id); ?>">
                    <input type="hidden" id="json-productvariants" value="<?php echo e($productVariants); ?>">
                    <label for="list-product-variant-thead" style="font-size: 20px;">List Of Product Variants</label>
                    <table id="list-product-variant-thead" class="table product-variant-table-listing-wrapper">
                        
                        <thead>
                            <tr>
                                <th>Product Variant Name</th>
                                <th>Type</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="list-product-variant-tbody">
                            
                        </tbody>
                    </table>  
                </div>
            </div>
            
            <div class="product-btn-wrapper form-row">
                <input type="submit" class="btn btn-sm btn-outline-success mr-2" value="Create Product Variant">
            </div>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('js/dashboard/modules/product_variant.js')); ?>"></script>
    <script>
        $(document).ready(function(){
            validAddnEditProductVariant('add');
        })
    </script>    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\coffee_pos\resources\views/dashboard/modules/product_variant/add.blade.php ENDPATH**/ ?>