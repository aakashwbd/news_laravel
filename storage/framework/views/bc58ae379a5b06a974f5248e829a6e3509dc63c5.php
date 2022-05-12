<?php $__env->startSection('data_count'); ?>

<div class="modal-content mb-5">
    <div class="modal-title">
        <h4>Add Video News</h4>
    </div>
    <form id="vedioNewsForm" method="POST" enctype="multipart/form-data">
        <div class="form-group margin-top-40">
            <label for="description">News Type</label>
            <select name="news_type" id="news_type" class="form-control create-form">
                <option value="youtube">Youtube</option>
                <option value="dailymotion">Dailymotion</option>
                <option value="vimeo">Vimeo</option>
                <option value="m3u8">M3u8</option>
                <option value="mp4">Mp4</option>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Vedio Url </label>
            <input class="form-control create-form" name="video_link" rows="10" placeholder="Write Here Description">
            <span class="text-danger"></span>
        </div>
          <div class="form-group">
            <label for="description">Title</label>
            <input class="form-control create-form" name="title" placeholder="Write Here title">
            <span class="text-danger"></span>
        </div>
        <div class="form-group">
            <label for="description">News Description</label>
            <textarea class="form-control create-form" id="content"  name="description" rows="10"
                placeholder="Write Here Description" style="height:220px;"></textarea>
            <span class="text-danger"></span>
        </div>


       <div class="file-upload">
            <div class="image-upload-wrap">
                <input type="hidden" name="image" id="imageUrl">
                <input id="image" class="file-upload-input file-uploader" type='file' onchange="readURL(this);"
                    accept="image/*" />
                <div class="drag-text text-center">
                    <span class="iconify" data-icon="teenyicons:user-square-outline"></span> <br>
                    <span>Upload Image Or Drag Here</span>
                </div>
            </div>
            <div class="file-upload-content">
                <img class="file-upload-image" src="#" alt="your image" />
                <div class="image-title-wrap">
                    <button type="button" onclick="removeUpload()" class="remove-image">
                        <span class="iconify" data-icon="akar-icons:cross"></span>
                    </button>
                </div>
            </div>
        </div>

        


        <div class="actions margin-top-40">
            <button class="submit" type="submit" id="createvedioNews">Add News</button>

            <a href="/admin/video">Cancel</a>

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



    $(document).ready(function () {
        $('#categorySelect').select2();
        $('#categorySelect').select2({
            placeholder: 'Select Category'
        });
    });

    $(function () {


        //category save
        $(document).on("click", "#createvedioNews", function (e) {
            e.preventDefault();
            var formData = new FormData($('#vedioNewsForm')[0]);
            formData.append('description', $('.ck-content').text());
            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            var url = "<?php echo e(URL::to('admin/video/news/store')); ?>";
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


    // ClassicEditor.create(document.querySelector("#description"))
    //     .then((editor) => {
    //         faqEditor = editor;
    //         console.log(faqEditor);
    //     })

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/tausif/Desktop/rupom/mainProject/news_app/resources/views/video/create.blade.php ENDPATH**/ ?>