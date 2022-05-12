<div class="modal-content">
    <div class="modal-title">
        <h4>Add Notification</h4>
    </div>
    <form id="notificationCreateForm" method="POST" enctype="multipart/form-data">
        <div class="form-group margin-top-40">
            <input type="text" name="title" class="form-control create-form" id="title" placeholder="Notification title">
        </div>
        <div class="form-group margin-top-40">
            <input type="text" name="description" class="form-control create-form" id="description" placeholder="Notification description">
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
                    <button type="button" onclick="removeUpload()" class="remove-image"><span class="iconify" data-icon="akar-icons:cross"></span></button>
                </div>
            </div>
        </div>

        <div class="form-group margin-top-40">
            <select name="video_id" id="videoId" class="form-control create-form">
                <option selected disabled>Select News</option>
                @if (!empty($videoList))
                @foreach($videoList as $id=>$name)
                <option value="{{$id}}">{{$name}}</option>
                @endforeach
                @endif
            </select>
        </div>
        {{-- <div class="form-group margin-top-40">
            <select name="tv_channel_id" id="tvId" class="form-control create-form">
                <option value="0">Select Video News</option>
                @if (!empty($tvList))
                @foreach($tvList as $id=>$name)
                <option value="{{$id}}">{{$name}}</option>
                @endforeach
                @endif
            </select>
        </div> --}}
        <div class="form-group margin-top-40">
            <input name="external_link" type="text" class="form-control create-form" id="externalurl" placeholder="External link">
        </div>

        <div class="actions margin-top-40">
            <button class="submit" type="submit" id="createNotification">Add Notification</button>
            <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
        </div>
    </form>
</div>
