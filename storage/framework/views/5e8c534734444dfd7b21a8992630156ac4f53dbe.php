<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">
        <div class="row">
            
            <div class="col-md-6 col-sm-12 col-12 content-title">
                <span class="title">Manage Categories</span>
                <div class="title-line"></div>
                <!-- Button trigger modal -->
            </div>
            

            
            <div class="col-md-3 col-sm-6 col-6 text-right">
                <form action="<?php echo e(url('/admin/category/filter')); ?>" method="POST" enctype="multipart/form-data">
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
                <button type="button" class="custombtn d-flex align-items-center" data-bs-toggle="modal"
                        data-bs-target="#createModal" id="categoryCreate">
                    <span class="iconify me-2" data-icon="akar-icons:circle-plus-fill" style="color: white;"></span>
                    <span>Add Category</span>
                </button>
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
    <div class="main-content-body mb-5" id="mainContentBody">
        
        <div class="row">
            <?php if(!$target->isEmpty()): ?>
                <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">

                        <h6 class="fw-bold my-4 content_title"><?php echo e($data->name); ?></h6>
                        <div class="card border-0 p-3 ">
                            <?php if(!empty($data->image)): ?>
                                <img class="card-img-top" src="<?php echo e($data->image); ?>" alt="<?php echo e($data->name); ?>"
                                     title="<?php echo e($data->name); ?>"/>
                            <?php else: ?>
                                <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt=""/>
                            <?php endif; ?>

                                <div class="more_menu dropdown" data-bs-toggle="dropdown" role="button">
                                    <i class="bi bi-three-dots-vertical more_menu_icon"></i>
                                </div>

                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                    <li
                                        class="dropdown-item cursor-pointer"
                                        data-bs-toggle="modal"
                                        data-bs-target="#createModal"
                                        id="categoryEditBtn"
                                        data-id="<?php echo e($data->id); ?>"
                                    >
                                        Edit
                                    </li>
                                    <li
                                        class="dropdown-item cursor-pointer"
                                        onclick="deleteItem('<?php echo e(URL::to('admin/category/' . $data->id . '/Category')); ?>')"
                                    >
                                        Delete
                                    </li>
                                    <li class="dropdown-item">
                                        Active
                                    </li>
                                </ul>

                            <div class="card-body px-0 pb-0">
                                <div class="d-flex align-items-center">
                                    <h3 class="count-value mb-0">52</h3>
                                    <span class="count-title fw-normal ms-5">News in this category</span>
                                </div>
                            </div>
                        </div>
                    </div>





































                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="col-md-6">
                    <h5 class="alert alert-warning">Category Not Found.....</h5>
                </div>
            <?php endif; ?>

        </div>
        
    </div>

    

    
    <div class="modal fade" tabindex=" -1" role="dialog" aria-hidden="true" id="createModal">
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
            var url = "<?php echo e(URL::to('admin/category/manage-category')); ?>"
            approval(url, id, properties, options)

        });

    </script>
    <script type="text/javascript">
        $(function () {


            //category create Modal
            $(document).on("click", "#categoryCreate", function (e) {
                e.preventDefault();
                $.ajax({
                    url: "<?php echo e(URL::to('admin/category/category-create')); ?>",
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        $("#showCreateModal").html(res.html);
                    },
                    error: function (jqXhr, ajaxOptions, thrownError) {
                    }
                }); //ajax
            });

            //category save
            $(document).on("click", "#createCategory", function (e) {
                e.preventDefault();
                var formData = new FormData($('#categoryCreateForm')[0]);
                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                var url = "<?php echo e(URL::to('admin/category/category-store')); ?>"
                itemStore(formData, options, url)
            });

            //category edit Modal
            $(document).on("click", "#categoryEditBtn", function (e) {
                e.preventDefault();
                var id = $(this).attr("data-id");

                $.ajax({
                    url: "<?php echo e(URL::to('admin/category/edit')); ?>",
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        $("#showCreateModal").html(res.html);
                    },
                    error: function (jqXhr, ajaxOptions, thrownError) {
                    }
                }); //ajax
            });

            // category update
            $(document).on("click", "#editCategory", function (e) {
                e.preventDefault();
                var formData = new FormData($('#categoryEditForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                var url = "<?php echo e(URL::to('admin/category/update')); ?>";
                itemStore(formData, options, url)

            });

            $(document).on("change", ".file-uploader", function (e) {
                e.preventDefault();
                var file = e.target.files[0];
                let formData = new FormData()
                formData.append('file', file);
                formData.append('folder', 'category');
                var showurl = window.origin + '/admin/category/file-upload';
                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                fileUploader(formData, options, showurl)

            });


        });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/projectx/Desktop/Dev-Project/news_app/resources/views/category/categoryIndex.blade.php ENDPATH**/ ?>