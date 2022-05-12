@extends('layouts.default.master')
@section('data_count')
    {{-- Start:: content heading --}}
    <div class="content-heading">
        <div class="row">
            {{-- title --}}
            <div class="col-md-8 content-title">
                <span class="title">Video Settings</span>
                <div class="title-line"></div>
            </div>
            {{-- title --}}
        </div>
    </div>
    {{-- End:: content heading --}}

    {{-- Start::Content Body --}}

    <div class="row content-bottom-heading margin-top-20">
        <div class="col-md-1 content-title">
            <span class="title">
                <a href="/video-settings" class="title-btn ">Home</a>
            </span>
            <div class="title-line"></div>
        </div>
        <div class="col-md-2">
            <span class="sub-title">
                <a href="/video-settings-category" class="title-btn">Category</a>
            </span>
            <div class="title-line sub-category-title-line display-none"></div>
        </div>


        {{-- <div class="col-md-12">
            <span>Home</span> &nbsp;&nbsp;&nbsp;&nbsp; <span>Category</span>
        </div>
        <div class="col-md-12 content-bottom-underline">
            <div class="row">
                <div class="underline underline-active"></div>
                <div class="underline"></div>
            </div>
        </div> --}}
    </div>



    <?php
$ses_msg = Session::has('success');
if (!empty($ses_msg)) {
    ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <p><i class="fa fa-bell-o fa-fw"></i> <?php echo Session::get('success'); ?></p>
    </div>
    <?php
}// 
$ses_msg = Session::has('error');
if (!empty($ses_msg)) {
    ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <p><i class="fa fa-bell-o fa-fw"></i> <?php echo Session::get('error'); ?></p>
    </div>
    <?php
}// ?>


    <form id="videoSettingsForm" method="POST" enctype="multipart/form-data"
        action="{{ URL::to('video-settings/update') }}">
        @csrf
        <input type="hidden" name="show_page" value="home">


        <div class="video-setting-content margin-top-20">
            {{-- top featured content --}}
            @if (!$target->isEmpty())
                @foreach ($target as $data)
                    @if ($data->name == 'top featured')
                        <div class="row margin-top-40">
                            <div class="col-md-6 bold video-setting-content-name"><span>TOP FEATURED</span></div>
                            <input type="hidden" name="name[]" value="top featured">
                            <div class="col-md-2 video-setting-content-vertical">
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                                    <input class="form-check-input vertical-image vertical-image-featured"
                                        data-class="featured" name="vertical_image[top featured]" type="checkbox"
                                        id="verticalImg" {!! $data->vertical_image == 'on' ? 'checked' : '' !!}>
                                </div>
                            </div>
                            <div class="col-md-2 video-setting-content-horizontal">
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                                    <input class="form-check-input horizontal-image horizontal-image-featured"
                                        data-class="featured"" name=" horizontal_image[top featured]" type="checkbox"
                                        id="horizontalImg" {!! $data->horizontal_image == 'on' ? 'checked' : '' !!}>
                                </div>
                            </div>
                            <div class="col-md-2 video-setting-content-number text-center">
                                <input type="number" name="video_number[top featured]" value="{{ $data->video_number }}">
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="row margin-top-40">
                    <div class="col-md-6 bold video-setting-content-name">
                        <input type="hidden" name="name[]" value="top featured">
                        <span>TOP FEATURED</span>
                    </div>
                    <div class="col-md-2 video-setting-content-vertical">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                            <input class="form-check-input vertical-image vertical-image-featured"
                                data-class="featured" name="vertical_image[top featured]" type="checkbox"
                                id="verticalImg" checked>
                        </div>
                    </div>
                    <div class="col-md-2 video-setting-content-horizontal">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                            <input class="form-check-input horizontal-image horizontal-image-featured"
                                data-class="featured" name="horizontal_image[top featured]" type="checkbox"
                                id="horizontalImg">
                        </div>
                    </div>
                    <div class="col-md-2 video-setting-content-number text-center">
                        <input type="number" name="video_number[top featured]">
                    </div>
                </div>
            @endif
            {{-- top featured content --}}



            {{-- trending now content --}}
            @if (!$target->isEmpty())
                @foreach ($target as $data)
                    @if ($data->name == 'trending now')
                        <div class="row margin-top-40">
                            <div class="col-md-6 bold video-setting-content-name"><span>TRENDING NOW</span></div>
                            <input type="hidden" name="name[]" value="trending now">
                            <div class="col-md-2 video-setting-content-vertical">
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                                    <input class="form-check-input vertical-image vertical-image-trending"
                                        data-class="trending" name="vertical_image[trending now]" type="checkbox"
                                        id="verticalImg" {!! $data->vertical_image == 'on' ? 'checked' : '' !!}>
                                </div>
                            </div>
                            <div class="col-md-2 video-setting-content-horizontal">
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                                    <input class="form-check-input horizontal-image horizontal-image-trending"
                                        data-class="trending"" name=" horizontal_image[trending now]" type="checkbox"
                                        id="horizontalImg" {!! $data->horizontal_image == 'on' ? 'checked' : '' !!}>
                                </div>
                            </div>
                            <div class="col-md-2 video-setting-content-number text-center">
                                <input type="number" name="video_number[trending now]" value="{{ $data->video_number }}">
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="row margin-top-40">
                    <div class="col-md-6 bold video-setting-content-name">
                        <input type="hidden" name="name[]" value="trending now">
                        <span>TRENDING NOW</span>
                    </div>
                    <div class="col-md-2 video-setting-content-vertical">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                            <input class="form-check-input vertical-image vertical-image-trending"
                                data-class="trending" name="vertical_image[trending now]" type="checkbox"
                                id="verticalImg" checked>
                        </div>
                    </div>
                    <div class="col-md-2 video-setting-content-horizontal">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                            <input class="form-check-input horizontal-image horizontal-image-trending"
                                data-class="trending" name="horizontal_image[trending now]" type="checkbox"
                                id="horizontalImg">
                        </div>
                    </div>
                    <div class="col-md-2 video-setting-content-number text-center">
                        <input type="number" name="video_number[trending now]">
                    </div>
                </div>
            @endif
            {{-- trending now content --}}


            {{-- just addes content --}}
            @if (!$target->isEmpty())
                @foreach ($target as $data)
                    @if ($data->name == 'just added')
                        <div class="row margin-top-40">
                            <div class="col-md-6 bold video-setting-content-name"><span>JUST ADDED</span></div>
                            <input type="hidden" name="name[]" value="just added">
                            <div class="col-md-2 video-setting-content-vertical">
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                                    <input class="form-check-input vertical-image vertical-image-just"
                                        data-class="just" name="vertical_image[just added]" type="checkbox"
                                        id="verticalImg" {!! $data->vertical_image == 'on' ? 'checked' : '' !!}>
                                </div>
                            </div>
                            <div class="col-md-2 video-setting-content-horizontal">
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                                    <input class="form-check-input horizontal-image horizontal-image-just"
                                        data-class="just" name="horizontal_image[just added]" type="checkbox"
                                        id="horizontalImg" {!! $data->horizontal_image == 'on' ? 'checked' : '' !!}>
                                </div>
                            </div>
                            <div class="col-md-2 video-setting-content-number text-center">
                                <input type="number" name="video_number[just added]" value="{{ $data->video_number }}">
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="row margin-top-40">
                    <div class="col-md-6 bold video-setting-content-name">
                        <input type="hidden" name="name[]" value="just added">
                        <span>JUST ADDED</span>
                    </div>
                    <div class="col-md-2 video-setting-content-vertical">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                            <input class="form-check-input vertical-image vertical-image-just" data-class="just"
                                name="vertical_image[just added]" type="checkbox" id="verticalImg" checked>
                        </div>
                    </div>
                    <div class="col-md-2 video-setting-content-horizontal">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                            <input class="form-check-input horizontal-image horizontal-image-just"
                                data-class="just" name="horizontal_image[just added]" type="checkbox"
                                id="horizontalImg">
                        </div>
                    </div>
                    <div class="col-md-2 video-setting-content-number text-center">
                        <input type="number" name="video_number[just added]">
                    </div>
                </div>
            @endif
            {{-- just addes content --}}


            {{-- popular content --}}
            @if (!$target->isEmpty())
                @foreach ($target as $data)
                    @if ($data->name == 'popular')
                        <div class="row margin-top-40">
                            <div class="col-md-6 bold video-setting-content-name"><span>POPULAR</span></div>
                            <input type="hidden" name="name[]" value="popular">
                            <div class="col-md-2 video-setting-content-vertical">
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                                    <input class="form-check-input vertical-image vertical-image-popular"
                                        data-class="popular" name="vertical_image[popular]" type="checkbox"
                                        id="verticalImg" {!! $data->vertical_image == 'on' ? 'checked' : '' !!}>
                                </div>
                            </div>
                            <div class="col-md-2 video-setting-content-horizontal">
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                                    <input class="form-check-input horizontal-image horizontal-image-popular"
                                        data-class="popular" name="horizontal_image[popular]" type="checkbox"
                                        id="horizontalImg" {!! $data->horizontal_image == 'on' ? 'checked' : '' !!}>
                                </div>
                            </div>
                            <div class="col-md-2 video-setting-content-number text-center">
                                <input type="number" name="video_number[popular]" value="{{ $data->video_number }}">
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="row margin-top-40">
                    <div class="col-md-6 bold video-setting-content-name">
                        <input type="hidden" name="name[]" value="popular">
                        <span>POPULAR</span>
                    </div>
                    <div class="col-md-2 video-setting-content-vertical">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                            <input class="form-check-input vertical-image vertical-image-popular"
                                data-class="popular" name="vertical_image[popular]" type="checkbox" id="verticalImg"
                                checked>
                        </div>
                    </div>
                    <div class="col-md-2 video-setting-content-horizontal">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                            <input class="form-check-input horizontal-image horizontal-image-popular"
                                data-class="popular" name="horizontal_image[popular]" type="checkbox"
                                id="horizontalImg">
                        </div>
                    </div>
                    <div class="col-md-2 video-setting-content-number text-center">
                        <input type="number" name="video_number[popular]">
                    </div>
                </div>
            @endif
            {{-- popular content --}}


            {{-- dont miss content --}}
            @if (!$target->isEmpty())
                @foreach ($target as $data)
                    @if ($data->name == 'dont miss')
                        <div class="row margin-top-40">
                            <div class="col-md-6 bold video-setting-content-name"><span>DON'T MISS</span></div>
                            <input type="hidden" name="name[]" value="dont miss">
                            <div class="col-md-2 video-setting-content-vertical">
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                                    <input class="form-check-input vertical-image vertical-image-miss"
                                        data-class="miss" name="vertical_image[dont miss]" type="checkbox"
                                        id="verticalImg" {!! $data->vertical_image == 'on' ? 'checked' : '' !!}>
                                </div>
                            </div>
                            <div class="col-md-2 video-setting-content-horizontal">
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                                    <input class="form-check-input horizontal-image horizontal-image-miss"
                                        data-class="miss" name="horizontal_image[dont miss]" type="checkbox"
                                        id="horizontalImg" {!! $data->horizontal_image == 'on' ? 'checked' : '' !!}>
                                </div>
                            </div>
                            <div class="col-md-2 video-setting-content-number text-center">
                                <input type="number" name="video_number[dont miss]" value="{{ $data->video_number }}">
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="row margin-top-40">
                    <div class="col-md-6 bold video-setting-content-name">
                        <input type="hidden" name="name[]" value="dont miss">
                        <span>DON'T MISS</span>
                    </div>
                    <div class="col-md-2 video-setting-content-vertical">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                            <input class="form-check-input vertical-image vertical-image-miss" data-class="miss"
                                name="vertical_image[dont miss]" type="checkbox" id="verticalImg" checked>
                        </div>
                    </div>
                    <div class="col-md-2 video-setting-content-horizontal">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                            <input class="form-check-input horizontal-image horizontal-image-miss"
                                data-class="miss" name="horizontal_image[dont miss]" type="checkbox"
                                id="horizontalImg">
                        </div>
                    </div>
                    <div class="col-md-2 video-setting-content-number text-center">
                        <input type="number" name="video_number[dont miss]">
                    </div>
                </div>
            @endif
            {{-- dont miss content --}}

            <div class="offset-md-1 col-md-3 margin-top-10">
                <div class="form-group">
                    <select id="categoryVS" class="form-control create-form settings-drop-down">
                        <option value=" 0">Select Category</option>
                        @foreach ($categoryList as $id => $name)
                            <?php $class = ''; ?>

                            @if (!$target->isEmpty())
                                @foreach ($target as $data)
                                    @if ($data->category_id == $id)
                                        <?php $class = 'display-none'; ?>
                                    @endif
                                @endforeach
                            @endif

                            <option id="op{{ $id }}" class="{{ $class }}" value="{{ $id }}">
                                {{ $name }}
                            </option>

                        @endforeach
                    </select>
                </div>
            </div>

            <div id="showCategoryContent">

                @if (!$target->isEmpty())
                    @foreach ($target as $data)
                        @if ($data->category_id != '0')
                            <div class="row margin-top-40" id="category{{ $data->category_id }}">

                                <input type="hidden" name="category_id[{{ $data->name }}]"
                                    value="{{ $data->category_id }}">

                                <div class="col-md-6 bold video-setting-content-name">
                                    <button type="button" class="remove-category-settings"
                                        data-id="{{ $data->category_id }}" title="Remove this category">-</button> &nbsp;
                                    <span>{{ $data->name }}</span>
                                </div>
                                <input type="hidden" name="name[]" value="{{ $data->name }}">

                                <div class="col-md-2 video-setting-content-vertical">
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                                        <input
                                            class="form-check-input vertical-image vertical-image-{{ $data->category_id }}"
                                            data-class="{{ $data->category_id }}"
                                            name="vertical_image[{{ $data->name }}]" type="checkbox" id="verticalImg"
                                            {!! $data->vertical_image == 'on' ? 'checked' : '' !!}>
                                    </div>
                                </div>

                                <div class="col-md-2 video-setting-content-horizontal">
                                    <div class="form-check form-switch">
                                        <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                                        <input
                                            class="form-check-input horizontal-image horizontal-image-{{ $data->category_id }}"
                                            data-class="{{ $data->category_id }}"
                                            name="horizontal_image[{{ $data->name }}]" type="checkbox" id="horizontalImg"
                                            {!! $data->horizontal_image == 'on' ? 'checked' : '' !!}>
                                    </div>
                                </div>

                                <div class="col-md-2 video-setting-content-number text-center">
                                    <input type="number" name="video_number[{{ $data->name }}]"
                                        value="{{ $data->video_number }}">
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif

            </div>

            <div class="col-md-12 actions margin-top-40">
                <button type="submit" class="submit">Update</button>
                <a href="/video-settings">Cancel</a>
            </div>

        </div>
    </form>
    {{-- End::Content Body --}}



@stop
@push('custom-js')
    <script type="text/javascript">
        $(document).on("change", "#categoryVS", function(e) {
            e.preventDefault();
            var category = $("#categoryVS").val();
            var id = 'op' + category;

            $("#" + id).addClass("display-none");

            $.ajax({
                url: "{{ URL::to('video-settings/get-category-content') }}",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    category_id: category,
                },
                success: function(res) {
                    $("#showCategoryContent").append(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {}
            });
        });

        $(document).on("click", ".remove-category-settings", function(e) {
            e.preventDefault();
            var dataId = $(this).attr("data-id");
            var id = 'op' + dataId;
            $("#" + id).removeClass("display-none");
            $("#category" + dataId).remove();

        });

        $(document).on("change", ".vertical-image", function(e) {
            e.preventDefault();
            var dataClass = $(this).attr("data-class");

            var target = 'horizontal-image-' + dataClass;
            if (this.checked == true) {
                $('.' + target).prop('checked', false);
            }
            if (this.checked == false) {
                $('.' + target).prop('checked', true);
            }

        });

        $(document).on("change", ".horizontal-image", function(e) {
            e.preventDefault();
            var dataClass = $(this).attr("data-class");

            var target = 'vertical-image-' + dataClass;
            if (this.checked == true) {
                $('.' + target).prop('checked', false);
            }
            if (this.checked == false) {
                $('.' + target).prop('checked', true);
            }

        });
    </script>
@endpush
