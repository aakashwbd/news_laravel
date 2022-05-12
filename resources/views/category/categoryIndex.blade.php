@extends('layouts.default.master')
@section('data_count')
    {{-- Start:: content heading --}}
    <div class="content-heading">
        <div class="row">
            {{-- title --}}
            <div class="col-md-6 col-sm-12 col-12 content-title">
                <span class="title">Manage Categories</span>
                <div class="title-line"></div>
                <!-- Button trigger modal -->
            </div>
            {{-- title --}}

            {{-- search --}}
            <div class="col-md-3 col-sm-6 col-6 text-right">
                <form action="{{url('/admin/category/filter')}}" method="POST" enctype="multipart/form-data">
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
                <button type="button" class="custombtn d-flex align-items-center" data-bs-toggle="modal"
                        data-bs-target="#createModal" id="categoryCreate">
                    <span class="iconify me-2" data-icon="akar-icons:circle-plus-fill" style="color: white;"></span>
                    <span>Add Category</span>
                </button>
            </div>
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
    <div class="main-content-body mb-5" id="mainContentBody">
        {{-- single content --}}
        <div class="row">
            @if (!$target->isEmpty())
                @foreach ($target as $data)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">

                        <h6 class="fw-bold my-4 content_title">{{ $data->name }}</h6>
                        <div class="card border-0 p-3 ">
                            @if (!empty($data->image))
                                <img class="card-img-top" src="{{$data->image }}" alt="{{ $data->name }}"
                                     title="{{ $data->name }}"/>
                            @else
                                <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt=""/>
                            @endif

                                <div class="more_menu dropdown" data-bs-toggle="dropdown" role="button">
                                    <i class="bi bi-three-dots-vertical more_menu_icon"></i>
                                </div>

                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                    <li
                                        class="dropdown-item cursor-pointer"
                                        data-bs-toggle="modal"
                                        data-bs-target="#createModal"
                                        id="categoryEditBtn"
                                        data-id="{{ $data->id }}"
                                    >
                                        Edit
                                    </li>
                                    <li
                                        class="dropdown-item cursor-pointer"
                                        onclick="deleteItem('{{ URL::to('admin/category/' . $data->id . '/Category') }}')"
                                    >
                                        Delete
                                    </li>
                                    <li class="dropdown-item">
                                        Active
                                    </li>
                                </ul>

                            <div class="card-body px-0 pb-0">
                                <div class="d-flex align-items-center">
                                    <h3 class="count-value mb-0">52</h3>
                                    <span class="count-title fw-normal ms-5">News in this category</span>
                                </div>
                            </div>
                        </div>
                    </div>

{{--                                        <div class="col-md-4 col-sm-6 single-content margin-top-40">--}}
{{--                                            <div class="single-content-wraper margin-top-20">--}}
{{--                                                @if (!empty($data->image))--}}
{{--                                                    <img src="{{$data->image }}" alt="{{ $data->name }}"--}}
{{--                                                         title="{{ $data->name }}"/>--}}
{{--                                                @else--}}
{{--                                                    <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt=""/>--}}
{{--                                                @endif--}}
{{--                                                <div class="total-videos margin-top-20">--}}
{{--                                                    <p class="cat-title">{{ $data->name }}</p>--}}
{{--                                                    <div class="switch">--}}
{{--                                                        <label class="">--}}
{{--                                                            <input id="approval" data-id="{{$data->id}}" type="checkbox"--}}
{{--                                                                   @if($data->status=="active") ?--}}
{{--                                                                   checked : @endif>--}}
{{--                                                            <div class="slider round"></div>--}}
{{--                                                        </label>--}}
{{--                                                    </div>--}}

{{--                                                </div>--}}
{{--                                                <div class="content-actions margin-top-20">--}}
{{--                                                    <button title="Edit" type="button" data-toggle="modal" data-target="#createModal"--}}
{{--                                                            id="categoryEditBtn" data-id="{{ $data->id }}">--}}
{{--                                                        <span class="iconify" data-icon="ant-design:edit-filled"></span>--}}
{{--                                                        Edit--}}
{{--                                                    </button>--}}
{{--                                                     <button class="delete tooltips" title="Delete" type="submit" data-placement="top" data-rel="tooltip" data-original-title="Delete">--}}
{{--                                                    <button--}}
{{--                                                        onclick="deleteItem('{{ URL::to('admin/category/' . $data->id . '/Category') }}')"--}}
{{--                                                        title="Delete" id="news">--}}
{{--                                                        <span class="iconify" data-icon="ant-design:delete-filled"></span>--}}
{{--                                                        Delete--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                @endforeach
            @else
                <div class="col-md-6">
                    <h5 class="alert alert-warning">Category Not Found.....</h5>
                </div>
            @endif

        </div>
        {{-- single content --}}
    </div>

    {{-- End::Content Body --}}

    {{-- Start::Create pannel --}}
    <div class="modal fade" tabindex=" -1" role="dialog" aria-hidden="true" id="createModal">
        <div class="modal-dialog modal-lg">
            <div id="showCreateModal"></div>
        </div>
    </div>


    {{-- End::Create pannel --}}


@stop
@push('custom-js')
    <script>
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
            var url = "{{ URL::to('admin/category/manage-category') }}"
            approval(url, id, properties, options)

        });

    </script>
    <script type="text/javascript">
        $(function () {


            //category create Modal
            $(document).on("click", "#categoryCreate", function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ URL::to('admin/category/category-create') }}",
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        $("#showCreateModal").html(res.html);
                    },
                    error: function (jqXhr, ajaxOptions, thrownError) {
                    }
                }); //ajax
            });

            //category save
            $(document).on("click", "#createCategory", function (e) {
                e.preventDefault();
                var formData = new FormData($('#categoryCreateForm')[0]);
                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                var url = "{{ URL::to('admin/category/category-store') }}"
                itemStore(formData, options, url)
            });

            //category edit Modal
            $(document).on("click", "#categoryEditBtn", function (e) {
                e.preventDefault();
                var id = $(this).attr("data-id");

                $.ajax({
                    url: "{{ URL::to('admin/category/edit') }}",
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: id,
                    },
                    success: function (res) {
                        $("#showCreateModal").html(res.html);
                    },
                    error: function (jqXhr, ajaxOptions, thrownError) {
                    }
                }); //ajax
            });

            // category update
            $(document).on("click", "#editCategory", function (e) {
                e.preventDefault();
                var formData = new FormData($('#categoryEditForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                var url = "{{ URL::to('admin/category/update') }}";
                itemStore(formData, options, url)

            });

            $(document).on("change", ".file-uploader", function (e) {
                e.preventDefault();
                var file = e.target.files[0];
                let formData = new FormData()
                formData.append('file', file);
                formData.append('folder', 'category');
                var showurl = window.origin + '/admin/category/file-upload';
                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                fileUploader(formData, options, showurl)

            });


        });

    </script>
@endpush
