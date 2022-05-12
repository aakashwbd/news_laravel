<div class="row margin-top-40" id="subCategory{{ $subCategory->id }}">

    <input type="hidden" name="sub_category_id[{{ $subCategory->name }}]" value="{{ $subCategory->id }}">

    <div class="col-md-6 bold video-setting-content-name">
        <button type="button" class="remove-category-settings" data-id="{{ $subCategory->id }}"
            title="Remove this sub category">-</button> &nbsp;
        <input type="hidden" name="name[]" value="{{ $subCategory->name }}">
        <span>{{ $subCategory->name }}</span>
    </div>
    <div class="col-md-2 video-setting-content-vertical">
        <div class="form-check form-switch">
            <label class="form-check-label" for="verticalImg{{ $subCategory->id }}">VERTICAL IMAGE</label>
            <input class="form-check-input vertical-image vertical-image-{{ $subCategory->id }}"
                data-class="{{ $subCategory->id }}" name="vertical_image[{{ $subCategory->name }}]" type="checkbox"
                id="verticalImg{{ $subCategory->id }}" checked>

        </div>
    </div>
    <div class="col-md-2 video-setting-content-horizontal">
        <div class="form-check form-switch">
            <label class="form-check-label" for="horizontalImg{{ $subCategory->id }}">HORIZONTAL IMAGE</label>
            <input class="form-check-input horizontal-image horizontal-image-{{ $subCategory->id }}"
                data-class="{{ $subCategory->id }}" name="horizontal_image[{{ $subCategory->name }}]" type="checkbox"
                id="horizontalImg{{ $subCategory->id }}">
        </div>
    </div>
    <div class="col-md-2 video-setting-content-number text-center">
        <input type="number" name="video_number[{{ $subCategory->name }}]">
    </div>
</div>
