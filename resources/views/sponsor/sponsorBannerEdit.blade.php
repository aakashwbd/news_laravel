<div class="modal-content">
    <div class="modal-title">
        <h4>Edit Sponsor Banner</h4>
    </div>
    <form id="sponsorBannerEditForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{ $target->id }}">

        <div class="form-group margin-top-40">
            <input name="title" type="text" class="form-control create-form" id="title" placeholder=" Banner Title" value="{{ $target->title }}">
        </div>

        <div class="form-group margin-top-40">
            <input type="text" name="url" class="form-control create-form" id="url" placeholder="Banner URL" value="{{ $target->url }}">
        </div>

        <div class="file-upload-edit">
            <div class="image-upload-wrap-edit">
                <input value="" name="image" class="file-upload-input-edit" type='file' onchange="readURLEdit(this);" accept="image/*" />
                <div class="drag-text-edit text-center">
                    <span class="iconify" data-icon="bx:bx-image-alt"></span> <br>
                    <span>Upload Image Or Drag Here</span>
                </div>
            </div>
            <div class="file-upload-content-edit">
                <img class="file-upload-image-edit" src="{{ URL::to('/') }}/uploads/sponsor/{{ $target->image }}" alt="{{ $target->title }}" />
                <div class="image-title-wrap-edit">
                    <button type="button" onclick="removeUploadEdit()" class="remove-image-edit">
                        <span class="iconify" data-icon="akar-icons:cross"></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="actions margin-top-40">
            <button class="submit" type="submit" id="editSponsorBanner">Update Banner</button>
            <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
