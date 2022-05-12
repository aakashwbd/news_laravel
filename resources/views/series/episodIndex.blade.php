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
                            <a href="/series" class="title-btn" id="category">Series</a>
                        </span>
                        <div class="title-line category-title-line display-none" id="categoryLine"></div>
                    </div>
                    <div class="col-md-2">
                        <span class="sub-title">
                            <a href="/series/season" class="title-btn" id="subCategory">Season</a>
                        </span>
                        <div class="title-line sub-category-title-line display-none"></div>
                    </div>
                    <div class="col-md-1">
                        <span class="sub-title">
                            <a href="/series/episod" class="title-btn red" id="seriesCategory">Episode</a>
                        </span>
                        <div class="title-line series-category-title-line"></div>
                    </div>
                </div>



                <div class="row create-menus margin-top-40">

                    <div class="col-md-3">
                        <button type="button" class="" data-toggle="modal" data-target="#createModal"
                            id="episodCreate">
                            Add Episode &nbsp; <span class="iconify"
                                data-icon="ant-design:plus-outlined"></span>
                        </button>
                    </div>

                </div>
            </div>
            {{-- title --}}

            {{-- search --}}
            <div class="col-md-4 text-right">
                <form action="/series/episod/filter" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group content-search">
                        <button class="input-group-text search" id="addon-wrapping">
                            <span class="iconify" data-icon="bx:bx-search"></span>
                        </button>
                        <input name="fil_search" type="text" class="form-control search" placeholder="Search" aria-label="fil_search">
                    </div>
                </form>
            </div>
            {{-- search --}}
        </div>
    </div>
    {{-- End:: content heading --}}

    {{-- Start::Content Body --}}  <?php
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
                    <div class="col-md-4 single-content margin-top-40">
                        <div class="title">
                            <span>{{ $data->name }}</span>
                        </div>
                        <div class="single-content-wraper margin-top-20">
                            @if (!empty($data->image))
                                <img src="{{ URL::to('/') }}/uploads/series/{{ $data->image }}"
                                    alt="{{ $data->name }}" title="{{ $data->name }}" />
                            @else
                                <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" />
                            @endif
                            <div class="total-videos margin-top-20">
                                <h4 class="number">{{$numberVideo[$data->id] ?? '0'}}</h4>
                                <span>Total Videos This Episode</span>
                            </div>
                            <div class="content-actions margin-top-20">
                                <form action="{{ URL::to('series/' . $data->id . '/Episod') }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button title="Edit" type="button" data-toggle="modal" data-target="#createModal"
                                        id="episodEditBtn" data-id="{{ $data->id }}">
                                        <span class="iconify" data-icon="ant-design:edit-filled"></span>
                                        Edit Episode
                                    </button>

                                    <button type="submit" onclick="return confirm('Are you sure?')" title="Delete" id="Episod">
                                        <span class="iconify" data-icon="ant-design:delete-filled"></span>
                                        Delete Episode
                                    </button>
                                </form>
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
    <div class="modal fade tabindex="-1 " role="dialog" aria-hidden="true" id="createModal">
        <div class="modal-dialog modal-lg">
            <div id="showCreateModal"></div>
        </div>
    </div>
    {{-- End::Create pannel --}}


@stop
@push('custom-js')
    <script type="text/javascript">
        $(function() {

            //Episode edit Modal
            $(document).on("click", "#episodEditBtn", function(e) {
                e.preventDefault();
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "{{ URL::to('series/episod-edit') }}",
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: id,
                    },
                    success: function(res) {
                        $("#showCreateModal").html(res.html);
                    },
                    error: function(jqXhr, ajaxOptions, thrownError) {}
                }); //ajax
            });

            //get season edit Modal
            $(document).on("change", "#seriesType", function(e) {
                e.preventDefault();
                var id = $(this).val();
                $("#seasonSelect").html('');
                // alert(id);
                $.ajax({
                    url: "{{ URL::to('series/get-season') }}",
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        series_id: id,
                    },
                    success: function(res) {
                        $("#seasonSelect").html(res.html);
                    },
                    error: function(jqXhr, ajaxOptions, thrownError) {}
                }); //ajax
            });

            //Episode update
            $(document).on("click", "#editEpisod", function(e) {
                e.preventDefault();
                var formData = new FormData($('#episodEditForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $.ajax({
                    url: "{{ URL::to('series/episod-update') }}",
                    type: 'POST',
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function(res) {
                        toastr.success('Episode updated successfully', res, options);
                        setTimeout(location.reload.bind(location), 1000);
                    },
                    error: function(jqXhr, ajaxOptions, thrownError) {
                        if (jqXhr.status == 422) {
                            var errorsHtml = '';
                            var errors = jqXhr.responseJSON.message;
                            $.each(errors, function(key, value) {
                                errorsHtml += '<li>' + value + '</li>';
                            });
                            toastr.error(errorsHtml, jqXhr.responseJSON.heading, options);
                        } else if (jqXhr.status == 500) {
                            toastr.error(jqXhr.responseJSON.message, '', options);
                        } else {
                            toastr.error('Error', 'Something went wrong', options);
                        }
                        App.unblockUI();
                    }
                });
            });

            //Episode create Modal
            $(document).on("click", "#episodCreate", function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ URL::to('series/episod-create') }}",
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        $("#showCreateModal").html(res.html);
                    },
                    error: function(jqXhr, ajaxOptions, thrownError) {}
                }); //ajax
            });

            //Episode save
            $(document).on("click", "#createEpisod", function(e) {
                e.preventDefault();
                var formData = new FormData($('#episodCreateForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $.ajax({
                    url: "{{ URL::to('series/episod-store') }}",
                    type: 'POST',
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function(res) {
                        toastr.success('Episode Create successfully', res, options);
                        setTimeout(location.reload.bind(location), 1000);
                    },
                    error: function(jqXhr, ajaxOptions, thrownError) {
                        if (jqXhr.status == 422) {
                            var errorsHtml = '';
                            var errors = jqXhr.responseJSON.message;
                            $.each(errors, function(key, value) {
                                errorsHtml += '<li>' + value + '</li>';
                            });
                            toastr.error(errorsHtml, jqXhr.responseJSON.heading, options);
                        } else if (jqXhr.status == 500) {
                            toastr.error(jqXhr.responseJSON.message, '', options);
                        } else {
                            toastr.error('Error', 'Something went wrong', options);
                        }
                        App.unblockUI();
                    }
                });
            });
        });
    </script>
@endpush
