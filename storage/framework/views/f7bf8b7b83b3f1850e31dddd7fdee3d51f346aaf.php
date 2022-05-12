<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">
        <div class="row">
            
            <div class="col-md-8 content-title">
                <span class="title">Notification</span>
                <div class="title-line"></div>
            </div>
            
            
            <div class="col-md-4 text-right">
                

                <a href="<?php echo e(url('/admin/notification')); ?>" class="btn btn-outline-dark btn-sm"><span class="iconify"
                        data-icon="akar-icons:arrow-back-thick"></span>&nbsp; Back Notification</a>

            </div>
            

        </div>
    </div>
    

    
    <div class="row margin-top-40 create-body content-details">

        <?php
    $ses_msg = Session::has('success');
    if (!empty($ses_msg)) {
        ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <p><i class="fa fa-bell-o fa-fw"></i> <?php echo Session::get('success'); ?></p>
        </div>
        <?php
    }//
    $ses_msg = Session::has('error');
    if (!empty($ses_msg)) {
        ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <p><i class="fa fa-bell-o fa-fw"></i> <?php echo Session::get('error'); ?></p>
        </div>
        <?php
    }// ?>

        
        <div class="col-md-6 for-mobile" id="showMobileNotification">
        </div>
        

        
        
        

    </div>
    


<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script type="text/javascript">
        $(document).ready(function() {

            $.ajax({
                url: "<?php echo e(URL::to('admin/notification/manage-notification/get-mobile-data')); ?>",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    notification_type: 'mobile'
                },
                success: function(res) {
                    $("#showMobileNotification").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {}
            }); //ajax

            $.ajax({
                url: "<?php echo e(URL::to('admin/notification/manage-notification/get-web-data')); ?>",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    notification_type: 'web'
                },
                success: function(res) {
                    $("#showWebNotification").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {}
            }); //ajax
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tausif/Desktop/rupom/mainProject/news_app/resources/views/notification/manageNotification.blade.php ENDPATH**/ ?>