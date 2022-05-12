<?php $__env->startSection('data_count'); ?>

<div class="modal-content mb-5">
    <div class="modal-title">
        <h4>Add News</h4>
    </div>
    <form id="newsCreateForm" method="POST" enctype="multipart/form-data" action="">
        <?php echo csrf_field(); ?>
        <div class="form-group margin-top-40" style="position: relative" id="newsType">
            <label for="news_type">Select News Type</label>
            <i class="fas fa-sort-down"></i>
            <select name="news_type" id="news_type" class="form-control create-form">
                <option value="image">Image</option>
                <option value="video">Video</option>
            </select>
            
        </div>
        <div class="form-group margin-top-40">
            <span id="chips" class="example" ></span>

        </div>
         <div class="col-md-6 col-lg-12 margin-top-10" style="position: relative">
            <div class="form-group">
                 <label for="categorySelect">Select Category</label>
                <i class="fas fa-sort-down"></i>
                <select name="category_id[]" multiple="multiple" id="categorySelect" class="form-control create-form">
                    <?php if(!empty($categoryList)): ?>
                        <?php $__currentLoopData = $categoryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="form-group margin-top-40" style="position: relative">
            <label for="news_type">Select Category Type</label>
            <i class="fas fa-sort-down"></i>
            <select name="category_type" id="category_type" class="form-control create-form">
                <option value="non-feature">Non-feature</option>
                <option value="feature">Feature</option>
            </select>
            
        </div>

        <div class="form-group">
            <label for="title">News Title</label>
            <input class="form-control create-form" id="title" name="title" rows="0" placeholder="Write Here Title">
            <span class="text-danger"></span>
        </div>

        <div class="form-group">
            <label for="description">News Description</label>
            
                <textarea class="form-control create-form" id="content" name="description" rows="10"
                        placeholder="Write Here Description"></textarea>
            <span class="text-danger"></span>
            
        </div>


        <div class="file-upload" id="videoLink">
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
            <button class="submit" type="submit" id="createNews">Add News</button>
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


     $(document).ready(function() {
        $('#categorySelect').select2();
        $('#categorySelect').select2({
            placeholder: 'Select Category'
        });
    });

        //terms text editor
        ClassicEditor
            .create(document.querySelector('#terms'))
            .catch(error => {
                console.error(error);
            });

  $(function () {
        //category save
        $(document).on("click", "#createNews", function (e) {
            e.preventDefault();
            // alert($('#description').val());
            var formData = new FormData($('#newsCreateForm')[0]);
            formData.append('description', $('.ck-content').text());

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            var url = "<?php echo e(URL::to('admin/news/store')); ?>"
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
    //ck text editor


    // ClassicEditor.create(document.querySelector("#description"))
    //     .then((editor) => {
    //         faqEditor = editor;
    //         console.log(faqEditor);
    //     })

//  let descriptionEditor;
//   ClassicEditor.create(document.querySelector('#content'))
//     .catch(error => {
//             console.error(error);
//         });


</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/projectx/Desktop/Dev-Project/news_app/resources/views/news/newsCreate.blade.php ENDPATH**/ ?>