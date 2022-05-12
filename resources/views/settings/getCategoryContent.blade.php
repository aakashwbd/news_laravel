<div class="row margin-top-40" id="category{{ $category->id }}">

    <input type="hidden" name="category_id[{{ $category->name }}]" value="{{ $category->id }}">

    <div class="col-md-6 bold video-setting-content-name">
        <button type="button" class="remove-category-settings" data-id="{{ $category->id }}"
            title="Remove this category">-</button> &nbsp;
        <input type="hidden" name="name[]" value="{{ $category->name }}">
        <span>{{ $category->name }}</span>
    </div>
    <div class="col-md-2 video-setting-content-vertical">
        <div class="form-check form-switch">
            <label class="form-check-label" for="verticalImg{{ $category->id }}">VERTICAL IMAGE</label>
            <input class="form-check-input vertical-image vertical-image-{{ $category->id }}"
                data-class="{{ $category->id }}" name="vertical_image[{{ $category->name }}]" type="checkbox"
                id="verticalImg{{ $category->id }}" checked>

        </div>
    </div>
    <div class="col-md-2 video-setting-content-horizontal">
        <div class="form-check form-switch">
            <label class="form-check-label" for="horizontalImg{{ $category->id }}">HORIZONTAL IMAGE</label>
            <input class="form-check-input horizontal-image horizontal-image-{{ $category->id }}"
                data-class="{{ $category->id }}" name="horizontal_image[{{ $category->name }}]" type="checkbox"
                id="horizontalImg{{ $category->id }}">
        </div>
    </div>
    <div class="col-md-2 video-setting-content-number text-center">
        <input type="number" name="video_number[{{ $category->name }}]">
    </div>
</div>
