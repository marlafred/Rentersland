<footer class="footer">
    <div class="container">
            <div class="row">
                    <div class="col-sm-3">
                            <h3 class="footer-heading">Company</h3>
                            <ul class="links">
                                <?php if(count($company) > 0): ?>
                                <?php $__currentLoopData = $company; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($nav->pages->label)): ?>
                                    <li><a href="<?php echo e(url('/')); ?>/<?php echo e($nav->pages->slug); ?>"><?php echo e($nav->pages->label); ?></a></li>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ul>
                    </div>
                    <div class="col-sm-3">
                            <h3 class="footer-heading">support</h3>
                            <ul class="links">
                                <?php if(count($support) > 0): ?>
                                <?php $__currentLoopData = $support; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($nav->pages->label)): ?>
                                <li><a href="<?php echo e(url('/')); ?>/<?php echo e($nav->pages->slug); ?>"><?php echo e($nav->pages->label); ?></a></li>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ul>
                    </div>
                    <div class="col-sm-3">
                            <h3 class="footer-heading">Short links</h3>
                            <ul class="links">
                                <?php if(count($short_links) > 0): ?>
                                <?php $__currentLoopData = $short_links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(isset($nav->pages->label)): ?>
                                    <li><a href="<?php echo e(url('/')); ?>/<?php echo e($nav->pages->slug); ?>"><?php echo e($nav->pages->label); ?></a></li>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ul>
                    </div>
                    <div class="col-sm-3">
                            <h3 class="footer-heading">get connected</h3>
                            <ul class="social">
                                <?php if(isset($setting->facebook) and $setting->facebook!=''): ?>
                                <li><a href="<?php echo e($setting->facebook); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <?php endif; ?>
                                <?php if(isset($setting->twitter) and $setting->twitter!=''): ?>
                                    <li><a href="<?php echo e($setting->twitter); ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <?php endif; ?>
                                <?php if(isset($setting->instagram) and $setting->instagram!=''): ?>
                                    <li><a href="<?php echo e($setting->instagram); ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <?php endif; ?>
                                <?php if(isset($setting->google_plus) and $setting->google_plus!=''): ?>
                                    <li><a href="<?php echo e($setting->google_plus); ?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                <?php endif; ?>
                            </ul>
                    </div>
            </div>
    </div>
</footer>

<input type="hidden" id="base_url" value="<?php echo e(url('/')); ?>">

<!------ Simple Popup ----------> 
<a href="javascript:void(0);" class="cd-popup-trigger" data-backdrop="static" data-keyboard="false" style="display:none;">View Pop-up</a>

<div class="cd-popup" role="alert">
	<div class="cd-popup-container">
		<p></p>
		<a href="#0" class="cd-popup-close img-replace">Close</a>
	</div> <!-- cd-popup-container -->
</div> <!-- cd-popup --> 