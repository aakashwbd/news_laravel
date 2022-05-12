<div class="modal-content">
    <div class="modal-title">
        <h4>Edit Category</h4>
    </div>
    <form id="categoryEditForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{ $target->id }}">
        <div class="form-group margin-top-40">
            <input name="name" type="text" class="form-control create-form" id="name" placeholder="Category Name" value="{{ $target->name }}">
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
                <img class="file-upload-image-edit" src="{{$target->image }}" alt="{{ $target->name }}" />
                <div class="image-title-wrap-edit">
                    <button type="button" onclick="removeUploadEdit()" class="remove-image-edit">
                        <span class="iconify" data-icon="akar-icons:cross"></span>
                    </button>
                </div>
            </div>
        </div>

        {{-- <div class="file-upload">
            <div class="image-upload-wrap">
                <input type="hidden" name="image" id="imageUrl">
                <input id="image" class="file-upload-input file-uploader" type='file' onchange="readURLEdit(this);"
                    accept="image/*" />
                <div class="drag-text text-center">
                    <span class="iconify" data-icon="teenyicons:user-square-outline"></span> <br>
                    <span>Upload Image Or Drag Here</span>
                </div>
            </div>
           <div class="file-upload-content-edit">
                <img class="file-upload-image-edit" src="{{$target->image }}" alt="{{ $target->name }}" />
                <div class="image-title-wrap-edit">
                    <button type="button" onclick="removeUploadEdit()" class="remove-image-edit">
                        <span class="iconify" data-icon="akar-icons:cross"></span>
                    </button>
                </div>
            </div>
        </div> --}}

        <div class="actions margin-top-40">
            <button class="submit" type="submit" id="editCategory">Update Category</button>
            <button type="button" class="cancel" data-bs-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
