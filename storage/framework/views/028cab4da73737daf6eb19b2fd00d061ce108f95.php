<?php $__env->startSection('data_count'); ?>
    
    
    <img src="<?php echo e(asset('img/Hello.png')); ?>" alt="Hello">
    <h4 class="margin-top-20">
        <span class="bold">Welcome</span> <span class="bold red">Onboard</span>
    </h4>
    <div class=" margin-top-20">
        <span class="red">User Overview</span>
        <div class="line margin-top-10"></div>
    </div>
    
    <div class="row">
        <div class="col-md-12 col-sm-12 col-12 margin-top-20">
            
            <div class="menu-carts margin-top-20">
                <div class="row">
                    
                    <div class="col-md-3 col-sm-6 cart">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="bold"><?php echo e($totalCategory ?? '0'); ?></h4>
                                <span class="cart-title">Category</span>
                            </div>
                            <div class="col-md-3">
                                <span class="iconify" data-icon="ic:outline-category"></span>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-3 col-sm-6 cart">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="bold"><?php echo e($totalNews ?? '0'); ?></h4>
                                <span class="cart-title">News</span>
                            </div>
                            <div class="col-md-3">
                              <span class="iconify" data-icon="emojione:rolled-up-newspaper"></span>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-3 col-sm-6 cart">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="bold"><?php echo e($totalApprovalNews ?? '0'); ?></h4>
                                <span class="cart-title">News Approval</span>
                            </div>
                            <div class="col-md-3">
                              <span class="iconify" data-icon="fluent:news-28-filled"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 cart">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="bold"><?php echo e($totalVideo ?? '0'); ?></h4>
                                <span class="cart-title">Total Video</span>
                            </div>
                            <div class="col-md-3">
                                <span class="iconify" data-icon="ic:baseline-video-library"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 cart">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="bold"><?php echo e($totalUser ?? '0'); ?></h4>
                                <span class="cart-title">Total User</span>
                            </div>
                            <div class="col-md-3">
                                <span class="iconify" data-icon="ph:users-four"></span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            

            
            
            

            
            <div class="visitors-count margin-top-10">
                <img src="<?php echo e(asset('img/graph.png')); ?>" alt="" style="width: 85%">
            </div>
            

        </div>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script type="text/javascript">
        $(function() {
            $(document).on("click", ".right-day-button", function() {
                $(".right-cart-top-month").removeClass('right-cart-top-active');
                $(".right-cart-top-week").removeClass('right-cart-top-active');
                $(".right-cart-top-day").addClass('right-cart-top-active');

                $(".day-view").removeClass('display-none');
                $(".week-view").addClass('display-none');
                $(".month-view").addClass('display-none');
            });
            $(document).on("click", ".right-week-button", function() {
                $(".right-cart-top-day").removeClass('right-cart-top-active');
                $(".right-cart-top-month").removeClass('right-cart-top-active');
                $(".right-cart-top-week").addClass('right-cart-top-active');

                $(".day-view").addClass('display-none');
                $(".week-view").removeClass('display-none');
                $(".month-view").addClass('display-none');
            });
            $(document).on("click", ".right-month-button", function() {
                $(".right-cart-top-day").removeClass('right-cart-top-active');
                $(".right-cart-top-week").removeClass('right-cart-top-active');
                $(".right-cart-top-month").addClass('right-cart-top-active');

                $(".day-view").addClass('display-none');
                $(".week-view").addClass('display-none');
                $(".month-view").removeClass('display-none');
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tausif/Desktop/rupom/mainProject/news_app/resources/views/dashboard.blade.php ENDPATH**/ ?>