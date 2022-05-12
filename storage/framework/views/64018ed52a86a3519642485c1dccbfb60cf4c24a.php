
<?php
$notificationNumber = \App\Models\Report::where('status', 'active')->where('view_status', 'pending')->count();
?>
<div class="top-header text-right margin-top-10">
    <ul>
        
        <li class="mt-0">
            <a href="/admin/report" class="">

                <span class="iconify" data-icon="clarity:notification-line" data-flip="horizontal"></span>
                <span class="notification-number">
                   <?php if($notificationNumber): ?>
                        <?php echo e($notificationNumber); ?>

                    <?php else: ?>
                    <?php echo e("0"); ?>

                       <?php endif; ?>
                </span>
            </a>
        </li>
        <li>
            <!-- Example single danger button -->
            <div class="btn-group">
                <button type="button" class="btn profile-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">

                    

                    <?php if(!empty(Auth::user()->image)): ?>
                        <img src="<?php echo e(URL::to('/')); ?>/uploads/user/<?php echo e(Auth::user()->image); ?>"
                            alt="<?php echo e(Auth::user()->name); ?>" class="header-user-img" />
                    <?php else: ?>
                        <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" class="header-user-img" />
                    <?php endif; ?>
                    <?php echo e(Auth::user()->name); ?>


                </button>
                <div class="dropdown-menu">
                    <a href="<?php echo e(url('admin/profile')); ?>"> <span class="iconify" data-icon="healthicons:ui-user-profile"></span> My Profile</a> <br>
                    <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                        <span class="iconify" data-icon="carbon:logout"></span>  Logout
                    </a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>


                </div>
            </div>
        </li>
    </ul>

</div>

<?php /**PATH /home/projectx/Desktop/Dev-Project/news_app/resources/views/layouts/default/topNavbar.blade.php ENDPATH**/ ?>