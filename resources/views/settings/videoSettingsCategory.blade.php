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
            <div class="title-line display-none"></div>
        </div>
        <div class="col-md-2  content-title">
            <span class="sub-title">
                <a href="/video-settings-category" class="title-btn">Category</a>
            </span>
            <div class="title-line"></div>
        </div>
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

        <div class="offset-md-1 col-md-3 margin-top-10">
            <div class="form-group">
                <select id="categoryId" name="category_id" class="form-control create-form settings-drop-down">
                    <option value=" 0">Select Category</option>
                    @foreach ($categoryList as $id => $name)
                        <option class="" value="{{ $id }}">
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div id="showSettingsCategory">
        </div>

    </form>
    {{-- End::Content Body --}}



@stop
@push('custom-js')
    <script type="text/javascript">
        $(document).on("change", "#categoryId", function(e) {
            e.preventDefault();
            var category = $("#categoryId").val();
            // alert(category);

            $.ajax({
                url: "{{ URL::to('video-settings-category/get-settings-category') }}",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    category_id: category,
                },
                success: function(res) {
                    $("#showSettingsCategory").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {}
            });
        });

        $(document).on("change", "#subCategoryVS", function(e) {
            e.preventDefault();
            var subCategory = $("#subCategoryVS").val();
            var id = 'op' + subCategory;

            $("#" + id).addClass("display-none");

            $.ajax({
                url: "{{ URL::to('video-settings-category/get-sub-category-content') }}",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    sub_category_id: subCategory,
                },
                success: function(res) {
                    $("#showSubCategoryContent").append(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {}
            });
        });

        $(document).on("click", ".remove-category-settings", function(e) {
            e.preventDefault();
            var dataId = $(this).attr("data-id");
            var id = 'op' + dataId;
            $("#" + id).removeClass("display-none");
            $("#subCategory" + dataId).remove();

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
