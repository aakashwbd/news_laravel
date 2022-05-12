<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">
        <div class="row">
            
            <div class="col-md-8 content-title">
                <span class="title">Manage User</span>

                <a class="create-button" href="<?php echo e(url('admin/user/create')); ?>">
                    <span class="iconify" data-icon="bi:plus-circle-fill"></span>Add User
                </a>
                <div class="title-line"></div>
            </div>
            

            
            <div class="col-md-4 text-right">
                <form action="<?php echo e(url('/admin/user/filter')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="input-group content-search">
                        <button class="input-group-text search" id="addon-wrapping">
                            <span class="iconify" data-icon="bx:bx-search"></span>
                        </button>
                        <input name="fil_search" type="text" class="form-control search" placeholder="Search" aria-label="fil_search">
                    </div>
                </form>
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
                    <th scope="col" class="text-center">IMAGE</th>
                    <th scope="col" class="text-center">NAME</th>
                    <th scope="col" class="text-center">PHONE NO</th>
                    <th scope="col" class="text-center">EMAIL</th>
                    <th scope="col" class="text-center">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php $sl = 1; ?>
                <?php if(!$target->isEmpty()): ?>
                    <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th class="text-center" scope="row"><?php echo e($sl++); ?></th>
                            <td class="text-center table-image">
                                <?php if(!empty($data->image)): ?>
                                    <img src="<?php echo e(URL::to('/')); ?>/uploads/user/<?php echo e($data->image); ?>"
                                        alt="<?php echo e($data->name); ?>" title="<?php echo e($data->name); ?>" />
                                <?php else: ?>
                                    <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt="" />
                                <?php endif; ?>
                            </td>
                            <td class="text-center"><?php echo e($data->name); ?></td>
                            <td class="text-center"><?php echo e($data->phone); ?></td>
                            <td class="text-center"><?php echo e($data->email); ?></td>
                            <td class="table-actions text-center">
                                    <a href="<?php echo e(URL::to('admin/user/' . $data->id . '/edit')); ?>">EDIT</a>
                                    <button onclick="deleteItem('<?php echo e(URL::to('admin/user/' . $data->id)); ?>')" title="Delete" id="news">
                                        <span class="iconify" data-icon="ant-design:delete-filled"></span>
                                        Delete
                                    </button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
    


<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script type="text/javascript">

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tausif/Desktop/rupom/mainProject/news_app/resources/views/user/index.blade.php ENDPATH**/ ?>