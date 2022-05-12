
<div class="modal-content">
    <div class="modal-title">
        <h4>Add Sponsor Video</h4>
    </div>
    <form id="sponsorVideoCreateForm" method="POST" enctype="multipart/form-data">
        <div class="form-group margin-top-40">
            <input type="text" name="title" class="form-control create-form" id="title" placeholder="Banner title">
        </div>
        <div class="form-group margin-top-40">
            <input type="text" name="url" class="form-control create-form" id="url" placeholder="Banner URL">
        </div>

        <div class="form-group margin-top-40">
            <select name="video_id" id="videoType" class="form-control create-form">
                <option value="0" selected>Select Video</option>
                @foreach($videoList as $id=>$name)
                <option value="{{$id}}">{{$name}}</option>
                @endforeach  
            </select>
        </div>

        <div class="file-upload">
            <div class="image-upload-wrap">
                <input name="image" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                <div class="drag-text text-center">
                    <span class="iconify" data-icon="bx:bx-image-alt"></span> <br>
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
            <button class="submit" type="submit" id="createSponsorVideo">Add Sponsor Video</button>
            <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
        </div>
    </form>
</div>
