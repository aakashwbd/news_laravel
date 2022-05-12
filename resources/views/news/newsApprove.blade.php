@extends('layouts.default.master')
@section('data_count')
    {{-- Start:: content heading --}}
    <div class="content-heading">
        <div class="row">
            {{-- title --}}
            <div class="col-md-8 content-title">
                <div class="row">
                    <div class="col-md-2">
                    <span class="title">
                        <a href="" class="title-btn red" id="">Manage News</a>
                    </span>
                        <div class="title-line category-title-line" id="categoryLine"></div>
                    </div>
                </div>

                <div class="row create-menus margin-top-40">
                </div>
            </div>
            {{-- title --}}

            {{-- search --}}
            {{--        <div class="col-md-3 col-sm-6 col-6 text-right">--}}
            {{--            <form action="/news/filter" method="POST" enctype="multipart/form-data">--}}
            {{--                @csrf--}}
            {{--                <div class="input-group content-search">--}}
            {{--                    <button class="input-group-text search" id="addon-wrapping">--}}
            {{--                        <span class="iconify" data-icon="bx:bx-search"></span>--}}
            {{--                    </button>--}}
            {{--                    <input name="fil_search" type="text" class="form-control search" placeholder="Search"--}}
            {{--                           aria-label="fil_search">--}}
            {{--                </div>--}}
            {{--            </form>--}}
            {{--        </div>--}}
            {{-- search --}}
        </div>
    </div>
    {{-- End:: content heading --}}

    {{-- Start::Content Body --}} <?php
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
    <div class="main-content-body" id="mainContentBody">
        {{-- single content --}}
        <div class="row">
            @if (!$target->isEmpty())
                @foreach ($target as $data)
                    @if ($viewData)
                        <div class="col-md-4 col-sm-6 col-12 single-content margin-top-40">
                            <div class="single-content-wraper margin-top-20">
                                @if (!empty($data->image))
                                    <img src="{{ $data->image}}" alt="{{ $data->name }}"
                                         title="{{ $data->name }}"/>
                                @else
                                    <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt=""/>
                                @endif
                                <div class="total-videos margin-top-20">
                                    <p class="cat-title">{{ $data->title }}</p>
                                    <label class="switch">
                                        <input id="approval" data-id="{{$data->id}}" type="checkbox"
                                               @if($data->status=="active") ? checked : @endif>
                                        <span class="slider round"></span>
                                    </label>
                                    {{-- <div class="onoffswitch">
                                        <input type="checkbox" class="onoffswitch-checkbox" data-id="celebrity" id="pannelStatus"
                                            tabindex="0" @if($data->status=="active") ? checked :  @endif>
                                        <label class="onoffswitch-label" for="pannelStatus">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div> --}}
                                    {{-- <h4 class="number">{{$numberVideo[$data->id] ?? '0'}}</h4>
                                    <span>Total Videos This Category</span> --}}
                                </div>

                                <div class="content-actions margin-top-20">

                        <span class="count" data-toggle="tooltip" data-placement="top"
                              title="
                   @foreach ($viewData as $data2)
                              @if ($data->id == $data2->news_id)
                              {{$data2->total}}
                              @else
                              {{'0'}}
                              @endif
                              @endforeach
                              @endif
                                  ">
                    <span class="iconify" data-icon="ant-design:eye-filled" style="color: red;cursor: pointer;"></span>
                </span>
                                    <a href="{{ url('admin/news/edit', $data->id) }}" class="button">
                                        <span class="iconify" data-icon="ant-design:edit-filled"></span>
                                        Edit
                                    </a>

                                    {{-- <button class="delete tooltips" title="Delete" type="submit" data-placement="top" data-rel="tooltip" data-original-title="Delete"> --}}
                                    <button onclick="deleteItem('{{ URL::to('admin/news/' . $data->id) }}')"
                                            title="Delete" id="news">
                                        <span class="iconify" data-icon="ant-design:delete-filled"></span>
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
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

        $(document).on("change", "#approval", function (e) {
            e.preventDefault();
            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            var id = $(this).data('id');
            // alert(id);
            if ($(this).prop('checked')) {
                var properties = 'active'
                // alert(properties)
            } else {
                var properties = 'inactive'
                //  alert(properties)
            }
            var url = "{{ URL::to('admin/news/manage-newsApproval') }}"
            approval(url,id,properties,options)
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


            //privecy text editor
            ClassicEditor.create(document.querySelector("#description"))
                .then((editor) => {
                    faqEditor = editor;
                    console.log(faqEditor);
                })

    </script>
@endpush
