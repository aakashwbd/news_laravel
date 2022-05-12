<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">
        <div class="row">
            
            <div class="col-md-8 content-title">
                <div class="row">
                    <div class="col-md-2">
                    <span class="title">
                        <a href="" class="title-btn red" id="">Manage News</a>
                    </span>
                        <div class="title-line category-title-line" id="categoryLine"></div>
                    </div>
                </div>

                <div class="row create-menus margin-top-40">
                </div>
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
    <div class="main-content-body" id="mainContentBody">
        
        <div class="row">
            <?php if(!$target->isEmpty()): ?>
                <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($viewData): ?>
                        <div class="col-md-4 col-sm-6 col-12 single-content margin-top-40">
                            <div class="single-content-wraper margin-top-20">
                                <?php if(!empty($data->image)): ?>
                                    <img src="<?php echo e($data->image); ?>" alt="<?php echo e($data->name); ?>"
                                         title="<?php echo e($data->name); ?>"/>
                                <?php else: ?>
                                    <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt=""/>
                                <?php endif; ?>
                                <div class="total-videos margin-top-20">
                                    <p class="cat-title"><?php echo e($data->title); ?></p>
                                    <label class="switch">
                                        <input id="approval" data-id="<?php echo e($data->id); ?>" type="checkbox"
                                               <?php if($data->status=="active"): ?> ? checked : <?php endif; ?>>
                                        <span class="slider round"></span>
                                    </label>
                                    
                                    
                                </div>

                                <div class="content-actions margin-top-20">

                        <span class="count" data-toggle="tooltip" data-placement="top"
                              title="
                   <?php $__currentLoopData = $viewData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if($data->id == $data2->news_id): ?>
                              <?php echo e($data2->total); ?>

                              <?php else: ?>
                              <?php echo e('0'); ?>

                              <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endif; ?>
                                  ">
                    <span class="iconify" data-icon="ant-design:eye-filled" style="color: red;cursor: pointer;"></span>
                </span>
                                    <a href="<?php echo e(url('admin/news/edit', $data->id)); ?>" class="button">
                                        <span class="iconify" data-icon="ant-design:edit-filled"></span>
                                        Edit
                                    </a>

                                    
                                    <button onclick="deleteItem('<?php echo e(URL::to('admin/news/' . $data->id)); ?>')"
                                            title="Delete" id="news">
                                        <span class="iconify" data-icon="ant-design:delete-filled"></span>
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

        </div>
        
    </div>

    





    
    <div class="modal fade tabindex=" -1" role="dialog" aria-hidden="true" id="createModal">
    <div class="modal-dialog modal-lg">
        <div id="showCreateModal"></div>
    </div>
    </div>


    


<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#categorySelect').select2();
            $('#categorySelect').select2({
                placeholder: 'Select Category'
            });
        });

        $(document).on("change", "#approval", function (e) {
            e.preventDefault();
            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            var id = $(this).data('id');
            // alert(id);
            if ($(this).prop('checked')) {
                var properties = 'active'
                // alert(properties)
            } else {
                var properties = 'inactive'
                //  alert(properties)
            }
            var url = "<?php echo e(URL::to('admin/news/manage-newsApproval')); ?>"
            approval(url,id,properties,options)
        });

            $(document).on("change", "#news_type", function (e) {
                // alert($(this).val());
                if ($(this).val() == "video") {
                    $("#image").after(`
              <div class="form-group" id="link">
            <label for="image" class="mt-3">YouTube Video URL:</label><br>
            <input type="text" name="news_link" class="form-control create-form" id="news_link">
            <span class="text-danger"></span>
        </div>
            `)
                } else if ($(this).val() == "image") {
                    $("#link").empty();
                }

            })


            //privecy text editor
            ClassicEditor.create(document.querySelector("#description"))
                .then((editor) => {
                    faqEditor = editor;
                    console.log(faqEditor);
                })

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/projectx/Desktop/Dev-Project/news_app/resources/views/news/newsApprove.blade.php ENDPATH**/ ?>