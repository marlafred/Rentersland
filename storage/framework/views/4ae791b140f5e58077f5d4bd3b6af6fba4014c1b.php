<div class="container">
	<div class="logo-wrapper">
		
        <?php
        $logo_class = 'left';
        if($setting->logo_position=='center'){
            $logo_class = 'centered';
        }
        else if($setting->logo_position=='right'){
            $logo_class = 'right';
        }
        ?>

		<a href="<?php echo e(route('home')); ?>" class="logotop <?php echo e($logo_class); ?>">
			<?php if($setting->logo): ?>
				<img src="<?php echo e(asset('static/')); ?>/<?php echo e($setting->logo); ?>" alt="<?php echo e($setting->title); ?>"/>
			<?php else: ?>
				<img src="<?php echo e(asset('images/logo.png')); ?>" alt="<?php echo e($setting->title); ?>" />
			<?php endif; ?>
		</a>

		<?php if(Auth::guest()): ?>

			<a href="<?php echo e(route('tenant.register')); ?>" class="btn btn-red pull-right">apply now</a>

		<?php else: ?>
			<a href="<?php echo e(route('listings')); ?>" class="btn btn-red pull-right">apply now</a>
		<?php endif; ?>
	</div>
</div>
<!-- /Logo Area -->

<!-- Menu -->
<div class="main-menu">
	<div class="container">
		<i class="fa fa-chevron-circle-down dropdown-trigger"></i>
		<ul class="menu-links">
                    <?php if(count($navigation) > 0): ?>
                        <?php $__currentLoopData = $navigation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php if(isset($nav->pages->label)): ?>
                                <li><a href="<?php echo e(url('/')); ?>/<?php echo e($nav->pages->slug); ?>"><?php echo e($nav->pages->label); ?></a></li>
                            <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

		</ul>
		<ul class="right-links">
			<li>
				<?php if(Auth::guest()): ?>
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            <i class="fa fa-sign-in"></i> Login <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu acounts_affix" role="menu">
                                        <li>
                                            <a href="<?php echo e(route('renters.login')); ?>">
                                                <i class="fa fa-user"></i> Renter Login 
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(route('landlord.login')); ?>">
                                                <i class="fa fa-home"></i> Landlord/Owner Login 
                                            </a>

                                        </li>
                                    </ul>
				<?php else: ?>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            <i class="fa fa-user"></i> <?php echo e(Auth::user()->first_name); ?> <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                          
                                        <li>
                                            <?php if(Auth::user()->user_type=='Tenant'): ?>
                                                <a href="<?php echo e(route('listings')); ?>">
                                                        <i class="fa fa-building-o"></i> Apply Now
                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo e(route('ceate.listing')); ?>">
                                                        <i class="fa fa-building-o"></i> Create Listing
                                                </a>
                                            <?php endif; ?>

                                        </li>
                                        <li>
                                                <a href="<?php echo e(route('user.dashboard')); ?>">
                                                        <i class="fa fa-dashboard"></i> Dashboard

                                                </a>

                                        </li>
                                        <li>
                                                <a href="<?php echo e(route('user.logout')); ?>">
                                                        <i class="fa fa-sign-out"></i> Logout
                                                </a>
                                        </li>
                                    </ul>

				<?php endif; ?>

			</li>
		
		</ul>
	</div>
</div>
<!-- /Menu -->




























