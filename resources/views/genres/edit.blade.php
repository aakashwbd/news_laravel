<div class="modal-content">
    <div class="modal-title">
        <h4>Edit Genre</h4>
    </div>
    <form id="genresEditForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{ $target->id }}">
        <div class="form-group margin-top-40">
            <input name="name" type="text" class="form-control create-form" id="name" placeholder="Genre Name" value="{{ $target->name }}">
        </div>

        <div class="file-upload-edit">
            <div class="image-upload-wrap-edit">
                <input value="" name="image" class="file-upload-input-edit" type='file' onchange="readURLEdit(this);" accept="image/*" />
                <div class="drag-text-edit text-center">
                    <span class="iconify" data-icon="bx:bx-image-alt"></span> <br>
                    <span>Upload Flag Or Drag Here</span>
                </div>
            </div>
            <div class="file-upload-content-edit">
                <img class="file-upload-image-edit" src="{{ URL::to('/') }}/uploads/genres/{{ $target->image }}" alt="your image" />
                <div class="image-title-wrap-edit">
                    <button type="button" onclick="removeUploadEdit()" class="remove-image-edit">
                        <span class="iconify" data-icon="akar-icons:cross"></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="actions margin-top-40">
            <button class="submit" type="submit" id="editGenres">Update Genre</button>
            <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>