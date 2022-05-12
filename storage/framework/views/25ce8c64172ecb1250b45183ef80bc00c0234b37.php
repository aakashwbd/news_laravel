<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">
        <div class="row">
            
            <div class="col-md-6 col-sm-12 col-12 content-title">
                <span class="title">Manage Video</span>
                <div class="title-line"></div>
                <!-- Button trigger modal -->
            </div>
            

            
            <div class="col-md-3 col-sm-6 col-6 text-right">
                <form action="<?php echo e(url('admin/video/news/filter')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="input-group content-search">
                        <button class="input-group-text search" id="addon-wrapping">
                            <span class="iconify" data-icon="bx:bx-search"></span>
                        </button>
                        <input name="fil_search" type="text" class="form-control search" placeholder="Search"
                               aria-label="fil_search">
                    </div>
                </form>
            </div>
            <div class="col-md-3 col-sm-6 col-6">

                <a href="<?php echo e(url('admin/video/news/create')); ?>">
                    <button type="button" class="custombtn" data-toggle="modal" data-target="#createModal"
                            id="categoryCreate">
                        &nbsp; <span class="iconify" data-icon="akar-icons:circle-plus-fill"
                                     style="color: white;"></span>Add Video News
                    </button>
                </a>

            </div>
            
        </div>
    </div>
    

     <?php
    $ses_msg = Session::has('msg');
    if (!empty($ses_msg)) {
    ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <p><i class="fa fa-bell-o fa-fw"></i> <?php echo Session::get('msg'); ?></p>
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

                        <div class="col-md-4 single-content margin-top-40">
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
                              <?php if($data->id == $data2->video_id): ?>
                              <?php echo e($data2->total); ?>

                              <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endif; ?>
                                  ">
                            <span class="iconify" data-icon="ant-design:eye-filled"
                                  style="color: red;cursor: pointer;"></span>

                        <a href="<?php echo e(url('admin/video/news/edit', $data->id)); ?>" class="button">

                            <span class="iconify" data-icon="ant-design:edit-filled"></span>
                            Edit
                        </a>



                        
                        <button onclick="deleteItem('<?php echo e(URL::to('admin/video/news/' . $data->id)); ?>')" title="Delete"
                                id="news">
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

    





    
    <div class="modal fade tabindex=" role="dialog" aria-hidden="true" id="createModal">
        <div class="modal-dialog modal-lg">
            <div id="showCreateModal"></div>
        </div>
    </div>


    


<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script>
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
            var url = "<?php echo e(URL::to('admin/video/manage-videoApproval')); ?>"
            approval(url, id, properties, options)

        });

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#categorySelect').select2();
            $('#categorySelect').select2({
                placeholder: 'Select Category'
            });
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


        ClassicEditor.create(document.querySelector("#description"))
            .then((editor) => {
                faqEditor = editor;
                console.log(faqEditor);
            })

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tausif/Desktop/rupom/mainProject/news_app/resources/views/video/index.blade.php ENDPATH**/ ?>