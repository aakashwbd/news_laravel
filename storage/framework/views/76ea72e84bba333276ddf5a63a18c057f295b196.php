<?php $__env->startSection('data_count'); ?>

<div class="modal-content mb-5">
    <div class="modal-title">
        <h4>Add News</h4>
    </div>
    <form id="editVideoNewsform" method="POST" enctype="multipart/form-data">
         <input type="hidden" name="id" value="<?php echo e($target->id); ?>">
        <div class="form-group margin-top-40">
            <label for="news_type">News Type</label>
            <select name="news_type" id="news_type" class="form-control create-form">
                <option <?php if($target->news_type == "youtube"): ?> ? selected :  <?php endif; ?> value="youtube">Youtube</option>
                <option <?php if($target->news_type == "dailymotion"): ?> ? selected :  <?php endif; ?> value="dailymotion">DailyMotion</option>
                <option <?php if($target->news_type == "vimeo"): ?> ? selected :  <?php endif; ?> value="vimeo">Vimeo</option>
                <option <?php if($target->news_type == "m3u8"): ?> ? selected :  <?php endif; ?> value="m3u8">M3u8</option>
                <option <?php if($target->news_type == "mp4"): ?> ? selected :  <?php endif; ?> value="mp4">Mp4</option>
            </select>
            
        </div>

           <div class="form-group">
            <label for="title">video Url</label>
            <input class="form-control create-form" name="video_link" rows="0" placeholder="Write Here Title" value="<?php echo e($target->video_link); ?>">
            <span class="text-danger"></span>
        </div>

        <div class="form-group">
            <label for="title">News Title</label>
            <input class="form-control create-form" id="title" name="title" rows="0" placeholder="Write Here Title" value="<?php echo e($target->title); ?>">
            <span class="text-danger"></span>
        </div>

        <div class="form-group">
            <label for="description">News Description</label>
            <textarea class="form-control create-form" id="description" name="description" rows="10"
                placeholder="Write Here Description"  style="height:220px;"><?php echo e($target->description); ?></textarea>
            <span class="text-danger"></span>
            
        </div>
          <div class="file-upload-edit">
            <div class="image-upload-wrap-edit">
                 <input type="hidden" name="imageEdit" id="imageUrl">
                <input value="" name="image" class="file-upload-input-edit file-uploader" type='file' onchange="readURLEdit(this);" accept="image/*" />
                <div class="drag-text-edit text-center">
                    <span class="iconify" data-icon="bx:bx-image-alt"></span> <br>
                    <span>Upload Image Or Drag Here</span>
                </div>
            </div>
            <div class="file-upload-content-edit">
                <img class="file-upload-image-edit" src="<?php echo e($target->image); ?>" alt="<?php echo e($target->name); ?>" />
                <div class="image-title-wrap-edit">
                    <button type="button" onclick="removeUploadEdit()" class="remove-image-edit">
                        <span class="iconify" data-icon="akar-icons:cross"></span>
                    </button>
                </div>
            </div>
        </div>




        


        <div class="actions margin-top-40">
            <button class="submit" type="submit" id="editVideoNews">Update News</button>
            <a href="<?php echo e(url('admin/video')); ?>">Cancel</a>
        </div>
    </form>

</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
<script>



  $(function () {
        // category update
        $(document).on("click", "#editVideoNews", function (e) {
            e.preventDefault();
            var formData = new FormData($('#editVideoNewsform')[0]);
            formData.append('description', $('.ck-content').text());
            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            var url = "<?php echo e(URL::to('admin/video/news/update')); ?>"
            itemStore(formData,options,url)
        });


     $(document).on("change", ".file-uploader", function(e) {
            e.preventDefault();
            var file = e.target.files[0];
            let formData = new FormData()
            formData.append('file', file);
            formData.append('folder', 'video');
            var showurl = window.origin + '/admin/video/file-upload';
            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            fileUploader(formData,options,showurl)

        });
    });
    //privecy text editor


    ClassicEditor.create(document.querySelector("#description"))
        .then((editor) => {
            faqEditor = editor;
            console.log(faqEditor);
        })
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tausif/Desktop/rupom/mainProject/news_app/resources/views/video/edit.blade.php ENDPATH**/ ?>