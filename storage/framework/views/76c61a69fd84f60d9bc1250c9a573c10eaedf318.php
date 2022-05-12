<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">

        <div class="row">
            
            <div class="col-md-2 content-title">
                <span class="title">Video Comment</span>
                <div class="title-line"></div>
            </div>
            <div class="col-md-2 content-title">
                <span class="title"><a href="<?php echo e(url('admin/comment/news')); ?>">News Comment</a></span>


            </div>
            
            
            
            
        </div>
    </div>
    

    
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
    <div class="row margin-top-40 content-details">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col" class="text-center">SERIAL</th>
                    <th scope="col" class="text-center">VIDEO TITLE</th>
                    <th scope="col" class="text-center">USER NAME</th>
                    <th scope="col" class="text-center">COMMENT TEXT</th>
                    <th scope="col" class="text-center">ENABLE/DISABLE</th>
                    <th scope="col" class="text-center">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php $sl = 1; ?>
                <?php if(!$target->isEmpty()): ?>
                    <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th class="text-center" scope="row"><?php echo e($sl++); ?></th>
                            <td class="text-center"><?php echo e($data->video); ?></td>
                            <td class="text-center"><?php echo e($data->user); ?></td>
                            <td class="text-center"><?php echo e($data->comment); ?></td>
                            <td class="text-center">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="<?php echo e($data->comment_id); ?>"
                                        id="commentHideShow<?php echo e($data->comment_id); ?>" tabindex="0" <?php echo $data->comments_status == 'active' ? 'checked' : ''; ?>>
                                    <label class="onoffswitch-label" for="commentHideShow<?php echo e($data->comment_id); ?>">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </td>
                            <td class="table-actions text-center">
                                    <button onclick="deleteItem('<?php echo e(URL::to('admin/comment/' . $data->comment_id)); ?>')" title="Delete" id="news">
                                        <span class="iconify" data-icon="ant-design:delete-filled"></span>
                                        Delete
                                    </button>
                            </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                </tr>
            </tbody>
        </table>

    </div>
    


<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>

    <script type="text/javascript">
        $(document).on("change", ".onoffswitch-checkbox", function(e) {
            e.preventDefault();
            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            var id = $(this).data('id');

            if ($(this).prop('checked')) {
                var properties = 'active'
            } else {
                var properties = 'inactive'
            }
            $.ajax({
                url: "<?php echo e(URL::to('admin/comment/status')); ?>",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    status: properties,
                },
                success: function(res) {
                    toastr.success('Status Update successfully', res, options);
                    // setTimeout(location.reload.bind(location), 0);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {}
            }); //ajax
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tausif/Desktop/rupom/mainProject/news_app/resources/views/comment/index.blade.php ENDPATH**/ ?>