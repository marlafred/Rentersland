<?php $__env->startSection('title', 'Apply'); ?>
<?php $__env->startSection('body'); ?>
<style>
#newsletter{margin-top:0;}
</style>
<!-- Breadcrumb Heading -->
<div class="breadcrumb">
    <div class="data">
        <h1>Page Not Found</h1>
        <ul>
            <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
            <li><a href="<?php echo e(route('listings')); ?>">Listings</a></li>
        </ul>
    </div>
</div>
<!-- /Breadcrumb Heading -->

<div class="col-sm-12 clmn">
<div class="overlay-box text-center">
   <h3><strong>Oops! We couldn't find that page.</strong></h3>
<p>In the meantime, maybe try the following?</p>
<a href="<?php echo e(route('listings')); ?>" class="btn btn-clrd">Find an Apartment</a>
<a href="<?php echo e(route('ceate.listing')); ?>" class="btn btn-white">Post your Rental</a>
<br><br><br>
<img src="<?php echo e(asset('extra-images/slide-1.jpg')); ?>" alt="" class="img-responsive" />
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>