<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $__env->yieldContent('title'); ?> | RentersLand</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/font-awesome.min.css')); ?>">
    <link href="<?php echo e(asset('css/bootstrap-datetimepicker.min.css')); ?>" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/jquery.mCustomScrollbar.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/jquery.fancybox.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/simple-popup.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/slick.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/slick-theme.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/dlmenu.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('style.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/icons.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/responsive.css')); ?>">
   
    
<!--</head>-->
<body>
<?php echo $__env->make('templates.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->yieldContent('body'); ?>

<?php echo $__env->make('templates.newsletter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('templates.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="bottom-bar"><?php echo e($setting->copyright); ?></div>
    <!-- Scripts -->
    <script type="text/javascript" src="<?php echo e(asset('js/jquery.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/jquery-migrate-1.2.1.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/custom.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/simple-popup.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/front.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/slick.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/jquery.dlmenu.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/jquery.mCustomScrollbar.concat.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/jquery.fancybox.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/bootstrap-datetimepicker.min.js')); ?>"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRioriKo2PIVw_tADDisMP_pGK-CHwWq8&libraries=places&region=GB"></script>
    
    <?php echo $__env->yieldContent('script'); ?>
    
</body>
</html>
