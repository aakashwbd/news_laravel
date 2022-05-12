<?php $__env->startSection('data_count'); ?>

<div class="modal-content mb-5">
    <div class="modal-title">
        <h4>Edit News</h4>
    </div>
    <form id="editNewsform" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo e($target->id); ?>">
        <div class="form-group margin-top-40" id="newsType">
            <label for="news_type">News Type</label>
            <select name="news_type" id="news_type" class="form-control create-form">
                <option <?php if($target->news_type == "image"): ?> ? selected : <?php endif; ?> value="image">Image</option>
                <option <?php if($target->news_type == "video"): ?> ? selected : <?php endif; ?> value="video">Video</option>
            </select>
            
        </div>
        <?php if($target->video_link): ?>
        <div class="form-group margin-top-40" id="video_type">
            <label for="video_type">Video Type</label>
            <select name="video_type" id="video_type" class="form-control create-form">
                <option <?php if($target->video_type == "youtube"): ?> ? selected :  <?php endif; ?> value="youtube">Youtube</option>
                <option <?php if($target->video_type == "dailymotion"): ?> ? selected :  <?php endif; ?> value="dailymotion">DailyMotion</option>
                <option <?php if($target->video_type == "vimeo"): ?> ? selected :  <?php endif; ?> value="vimeo">Vimeo</option>
                <option <?php if($target->video_type == "m3u8"): ?> ? selected :  <?php endif; ?> value="m3u8">M3u8</option>
                <option <?php if($target->video_type == "mp4"): ?> ? selected :  <?php endif; ?> value="mp4">Mp4</option>
            </select>
            
        </div>

        <div class="form-group" id="link">
            <label for="image" class="mt-3">YouTube Video URL:</label><br>
            <input type="text" name="video_link" class="form-control create-form" id="video_link"
                value="<?php echo e($target->video_link); ?>">
            <span class="text-danger"></span>
        </div>
        <?php endif; ?>
        <div class="form-group margin-top-40">
            <span id="chips" class="example"></span>
        </div>
        <div class="col-md-6 margin-top-10">
            <div class="form-group">
                <label for="categorySelect">Category</label>
                <select name="category_id[]" multiple="multiple" id="categorySelect" class="form-control create-form">

                         <?php if(!empty($categoryList)): ?>
                            <?php $__currentLoopData = $categoryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $checked = '';
                                if (in_array($id, $prevCategory)) {
                                    $checked = 'selected';
                                }
                                ?>
                                <option value="<?php echo e($id); ?>" <?php echo e($checked); ?>><?php echo e($name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="form-group margin-top-40" style="position: relative">
            <label for="news_type">Select Category Type</label>
            <i class="fas fa-sort-down"></i>
            <select name="category_type" id="category_type" class="form-control create-form">
                <option <?php if($target->catgegory_type == "non-feature"): ?> ? selected : <?php endif; ?> value="non-feature">Non-feature</option>
                <option <?php if($target->category_type == "feature"): ?> ? selected : <?php endif; ?> value="feature">Feature</option>
            </select>
            
        </div>
        <div class="form-group">
            <label for="title">News Title</label>
            <input class="form-control create-form" id="title" name="title" rows="0" placeholder="Write Here Title"
                value="<?php echo e($target->title); ?>">
            <span class="text-danger"></span>
        </div>

        <div class="form-group">
            <label for="description">News Description</label>
            <textarea class="form-control create-form" id="content" name="description" rows="10"
                placeholder="Write Here Description" style="height:220px;"><?php echo e($target->description); ?></textarea>
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
            <button class="submit" type="submit" id="editNews">Update News</button>
            <a href="/admin/news">Cancel</a>
        </div>
    </form>

</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
<script>
    ClassicEditor.create(document.querySelector('#content'))
    .catch(error => {
            console.error(error);
        });
</script>
<script>

    $(document).on("change", "#news_type", function (e) {
        // alert($(this).val());
        if ($(this).val() == "video") {
            $('#newsType').after(`
            <div class="form-group margin-top-40" style="position: relative" id="video_type">
                <label for="news_type">Select Video Type</label>
                <i class="fas fa-sort-down"></i>
                <select name="video_type" id="video_type" class="form-control create-form">
                    <option value="youtube">Youtube</option>
                    <option value="dailymotion">Dailymotion</option>
                    <option value="vimeo">Vimeo</option>
                    <option value="m3u8">M3u8</option>
                    <option value="mp4">Mp4</option>
                </select>
            </div>
            `)
            $("#video_type").after(`
              <div class="form-group" id="link">
            <label for="image" class="mt-3">Video URL:</label><br>
            <input type="text" name="video_link"  class="form-control create-form" id="video_link">
            <span class="text-danger"></span>
        </div>
            `)
        } else if ($(this).val() == "image") {
            $("#link").empty();
            $("#video_type").empty();
        }

    })


    $(document).ready(function () {
        $('#categorySelect').select2();
        $('#categorySelect').select2({
            placeholder: 'Select Category'
        });
    });

    $(function () {

        //category save



        // category update
        $(document).on("click", "#editNews", function (e) {
            e.preventDefault();
            var formData = new FormData($('#editNewsform')[0]);
            formData.append('description', $('.ck-content').text());
            // console.log($('.ck-content').text())

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            var url = "<?php echo e(URL::to('admin/news/update')); ?>"
            itemStore(formData,options,url)

        });



        $(document).on("change", ".file-uploader", function(e) {
            e.preventDefault();
            var file = e.target.files[0];
            let formData = new FormData()
            formData.append('file', file);
            formData.append('folder', 'news');
            var showurl = window.origin + '/admin/news/file-upload';
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


    // ClassicEditor.create(document.querySelector("#description"))
    //     .then((editor) => {
    //         faqEditor = editor;
    //         console.log(faqEditor);
    //     })

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tausif/Desktop/rupom/mainProject/news_app/resources/views/news/newsEdit.blade.php ENDPATH**/ ?>