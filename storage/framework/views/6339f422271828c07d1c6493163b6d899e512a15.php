<?php if(session('success')): ?>
<div class="alert alert-success alert-block" style="margin-top: 20px;">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong><?php echo e(session('success')); ?></strong>
</div>
<?php endif; ?>

<?php if(session('status')): ?>
<div class="alert alert-success alert-block" style="margin-top: 20px;">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong><?php echo e(session('status')); ?></strong>
</div>
<?php endif; ?>
  
<?php if(session('error')): ?>
<div class="alert alert-danger alert-block" style="margin-top: 20px;">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong><?php echo e(session('error')); ?></strong>
</div>
<?php endif; ?>

<?php if(session('not_verified')): ?>
<div class="alert alert-danger alert-block" style="margin-top: 20px;">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>You need to verify your email address</strong>
</div>
<?php endif; ?>
   
<?php if(session('warning')): ?>
<div class="alert alert-warning alert-block" style="margin-top: 20px;">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong><?php echo e(session('warning')); ?></strong>
</div>
<?php endif; ?>
   
<?php if(session('info')): ?>
<div class="alert alert-info alert-block" style="margin-top: 20px;">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong><?php echo e($message); ?></strong>
</div>
<?php endif; ?>
  
<?php /**PATH C:\xampp\htdocs\coffee_pos\resources\views/flashmessage/index.blade.php ENDPATH**/ ?>