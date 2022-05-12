<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">

        <div class="row">
            
            <div class="col-md-2 content-title">
                <span class="title"> News Report</span>
                <div class="title-line"></div>
            </div>
            <div class="col-md-2 content-title">

                <a href="<?php echo e(url('/admin/report')); ?>">Video News Report</a>


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
                    <th scope="col" class="text-center">NEWS TITLE</th>
                    <th scope="col" class="text-center">USER NAME</th>
                    
                    <th scope="col" class="text-center">ENABLE/DISABLE</th>
                    <th scope="col" class="text-center">STATUS</th>
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
                            
                            <td class="text-center">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="<?php echo e($data->report_id); ?>"
                                        id="reportHideShow<?php echo e($data->report_id); ?>" tabindex="0" <?php echo $data->reports_status == 'active' ? 'checked' : ''; ?>>
                                    <label class="onoffswitch-label" for="reportHideShow<?php echo e($data->report_id); ?>">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </td>
                            <td class="text-center view-<?php echo e($data->report_id); ?>"><?php echo e($data->view_status); ?></td>
                            <td class="table-actions text-center">
                                    <button type="button" data-id="<?php echo e($data->report_id); ?>" data-toggle="modal"
                                        data-target="#crateModal" id="reportShow" title="Delete">VIEW</button>
                                    <button onclick="deleteItem('<?php echo e(URL::to('admin/report/news' . $data->report_id)); ?>')" title="Delete" id="news">
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
    

    
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="crateModal">
        <div class="modal-dialog modal-lg">
            <div id="showCreateModal">

            </div>
        </div>
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
                url: "<?php echo e(URL::to('admin/report/news/status')); ?>",
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

        $(document).on("click", "#reportShow", function(e) {
            e.preventDefault();
            // return false;
            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            var id = $(this).data('id');
            $(`.view-${id}`).html('viewed')
            $.ajax({
                url: "<?php echo e(URL::to('admin/report/news/report-show')); ?>",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                },
                success: function(res) {
                    $("#showCreateModal").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {}
            }); //ajax
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tausif/Desktop/rupom/mainProject/news_app/resources/views/report/news/index.blade.php ENDPATH**/ ?>