<div class="modal-content">
    <div class="modal-title">
        <h4>Edit Top Feature</h4>
    </div>
    <form id="topFeatureEditForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{ $target->top_features_id }}">

        <div class="form-group margin-top-40">
            <select name="video_id" id="videoId" class="form-control create-form">
                <option value="0">Select Video</option>
                @foreach ($videoList as $id => $name)
                    <?php
                    $selected = '';
                    if ($id == $target->video_id) {
                        $selected = 'selected';
                    }
                    ?>
                    <option value="{{ $id }}" {{ $selected }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div id="preview">
            @if (!empty($target->thumbnail))
                <img src="{{ URL::to('/') }}/uploads/video/thumbnail/{{ $target->thumbnail }}"
                    alt="{{ $target->title }}" title="{{ $target->title }}" />
            @else
                <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" />
            @endif

        </div>

        <div class="actions margin-top-40">
            <button class="submit" type="submit" id="editTopFeature">Edit Top Feature</button>
            <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
