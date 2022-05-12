@extends('layouts.default.master')
@section('data_count')
{{-- Start:: content heading --}}

<div class="content-heading">
    <div class="row">
        {{-- title --}}
        <div class="col-md-6 col-sm-12 col-12 content-title">
         <span class="title">Manage news</span>
                <div class="title-line"></div>
            <!-- Button trigger modal -->
        </div>
        {{-- title --}}

        {{-- search --}}
        <div class="col-md-3 col-sm-6 col-6 text-right">
            <form action="{{url('/admin/news/filter')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="input-group content-search">
                    <button class="input-group-text search" id="addon-wrapping">
                        <span class="iconify" data-icon="bx:bx-search"></span>
                    </button>
                    <input name="fil_search" type="text" class="form-control search" placeholder="Search"
                        aria-label="fil_search">
                </div>
            </form>
        </div>
        <div class="col-md-3 col-sm-6 col-6">
            <a href="{{url('admin/news/create')}}">  <button type="button" class="custombtn" data-toggle="modal" data-target="#createModal" id="categoryCreate">

                    &nbsp; <span class="iconify" data-icon="akar-icons:circle-plus-fill" style="color: white;"></span>Add News
                </button></a>

        </div>
        {{-- search --}}
    </div>
</div>
{{-- End:: content heading --}}

{{-- Start::Content Body --}} <?php
$ses_msg = Session::has('msg');
if (!empty($ses_msg)) {
    ?>
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    <p><i class="fa fa-bell-o fa-fw"></i> <?php echo Session::get('msg'); ?></p>
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
<div class="main-content-body mb-5" id="mainContentBody">
    {{-- single content --}}
    <div class="row">
        @if (!$target->isEmpty())
        @foreach ($target as $data)
        @if ($viewData)

        <div class="col-md-4 col-sm-6 col-12 single-content margin-top-40">
            <div class="single-content-wraper margin-top-20">
                @if (!empty($data->image))
                <img src="{{ $data->image }}" alt="{{ $data->name }}"
                    title="{{ $data->name }}" />
                @else
                <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" />
                @endif

                    <div class="total-videos margin-top-20">
                        <p class="cat-title">{{ $data->title }}</p>
                        <div class="switch">
                            <label class="">
                                <input type="checkbox" @if($data->status=="active") ? checked : @endif>
                                <div class="slider round"></div>
                            </label>
                        </div>







                    </div>

                <div class="content-actions margin-top-20">
                        <span class="count" data-toggle="tooltip" data-placement="top" title="
                    @foreach ($viewData as $data2)
                     @if ($data->id == $data2->news_id)
                     {{$data2->total}}
                     @else
                     @endif
                     @endforeach
                    @endif
                    ">
                            <span class="iconify" data-icon="ant-design:eye-filled"
                                style="color: red;cursor: pointer;"></span>
                        </span>
                        <a href="{{ url('admin/news/edit', $data->id) }}" class="button">
                            <span class="iconify" data-icon="ant-design:edit-filled"></span>
                            Edit
                        </a>
                        {{-- <button class="delete tooltips" title="Delete" type="submit" data-placement="top" data-rel="tooltip" data-original-title="Delete"> --}}
                        <button onclick="deleteItem('{{ URL::to('admin/news/' . $data->id) }}')" title="Delete" id="news">
                            <span class="iconify" data-icon="ant-design:delete-filled"></span>
                            Delete
                        </button>

                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="col-md-6">
            <h5 class="alert alert-warning">News Not Found...</h5>
        </div>
        @endif

    </div>
    {{-- single content --}}
</div>

{{-- End::Content Body --}}





{{-- Start::Create pannel --}}
<div class="modal fade tabindex=" -1" role="dialog" aria-hidden="true" id="createModal">
    <div class="modal-dialog modal-lg">
        <div id="showCreateModal"></div>
    </div>
</div>


{{-- End::Create pannel --}}


@stop
@push('custom-js')
<script type="text/javascript">
    $(document).ready(function () {
        $('#categorySelect').select2();
        $('#categorySelect').select2({
            placeholder: 'Select Category'
        });
    });

    $(document).on("change", "#news_type", function (e) {
        // alert($(this).val());
        if ($(this).val() == "video") {
            $("#image").after(`
              <div class="form-group" id="link">
            <label for="image" class="mt-3">YouTube Video URL:</label><br>
            <input type="text" name="news_link" class="form-control create-form" id="news_link">
            <span class="text-danger"></span>
        </div>
            `)
        } else if ($(this).val() == "image") {
            $("#link").empty();
        }

    })

    $(function () {

        //category create Modal
        $(document).on("click", "#createNews", function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{ URL::to('admin/news/create') }}",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    $("#showCreateModal").html(res.html);

                    var instance = new SelectPure("#chips", {
                        options: myOptions,
                        multiple: true, // default: false
                        autocomplete: true, // default: false,
                        icon: "fa fa-times",
                    });
                },
                error: function (jqXhr, ajaxOptions, thrownError) {}
            }); //ajax
        });





    });
    //privecy text editor


    ClassicEditor.create(document.querySelector("#description"))
        .then((editor) => {
            faqEditor = editor;
            console.log(faqEditor);
        })

</script>
@endpush
