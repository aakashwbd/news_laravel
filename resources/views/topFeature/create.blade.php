<div class="modal-content">
    <div class="modal-title">
        <h4>Add Top Feature</h4>
    </div>
    <form id="topFeatureCreateForm" method="POST" enctype="multipart/form-data">

        <div class="form-group margin-top-40">
            <select name="video_id" id="videoId" class="form-control create-form">
                <option value="0" selected>Select Video</option>
                @foreach($videoList as $id=>$name)
                <option value="{{$id}}">{{$name}}</option>
                @endforeach  
            </select>
        </div>
        <div id="preview" class="display-none"></div>

        <div class="actions margin-top-40">
            <button class="submit" type="submit" id="createTopFeature">Add Top Feature</button>
            <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
