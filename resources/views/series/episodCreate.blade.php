<div class="modal-content">
    <div class="modal-title">
        <h4>Add Episode</h4>
    </div>
    <form id="episodCreateForm" method="POST" enctype="multipart/form-data">

        <div class="form-group margin-top-40">
            <select name="series_id" id="seriesType" class="form-control create-form">
                <option value="0" selected>Select Series</option>
                @foreach($seriesList as $id=>$name)
                <option value="{{$id}}">{{$name}}</option>
                @endforeach  
            </select>
        </div>

        <div class="form-group margin-top-40" id="seasonSelect">
            <select name="season_id" id="seasonType" class="form-control create-form">
                <option value="0" selected>Select Season</option> 
            </select>
        </div>

        <div class="form-group margin-top-40">
            <input name="name" type="text" class="form-control create-form" id="name" placeholder="Episode Name">
        </div>

        <div class="form-group margin-top-40">
            <input name="number" type="text" class="form-control create-form" id="number" placeholder="e1">
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
            <button class="submit" type="submit" id="createEpisod">Add Episode</button>
            <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
