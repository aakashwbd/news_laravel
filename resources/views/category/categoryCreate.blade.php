<div class="modal-content">
    <div class="modal-title">
        <h4>Add Category</h4>
    </div>
    <form id="categoryCreateForm" method="POST" enctype="multipart/form-data">
        <div class="form-group margin-top-40">
            <input name="name" type="text" class="form-control create-form" id="name" placeholder="Category Name">
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
            <button class="submit" type="submit" id="createCategory">Add Category</button>
            <button type="button" class="cancel" data-bs-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
