@extends('layouts.default.master')
@section('data_count')
    <?php
    $checked = 'checked';
    $class = '';
    if (!empty($mgtStatus)) {
        if ($mgtStatus->status == 'off') {
            $checked = '';
            $class = 'display-none';
        }
    }
    ?>
    {{-- Start:: content heading --}}
    <div class="content-heading">
        <div class="row">
            {{-- title --}}
            <div class="col-md-8 content-title">
                <span class="title">Top Feature</span>
                <button type="button" class="create-button pannel-status {{ $class }}" data-toggle="modal" data-target="#crateModal" id="crateBtn">
                    <span class="iconify" data-icon="bi:plus-circle-fill"></span>Add Top Feature
                </button>
                <div class="title-line"></div>
                <!-- Button trigger modal -->
            </div>
            {{-- title --}}

            {{-- search --}}
            {{-- <div class="col-md-4 text-right">
                <form action="/top-feature/filter" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group content-search">
                        <button class="input-group-text search" id="addon-wrapping">
                            <span class="iconify" data-icon="bx:bx-search"></span>
                        </button>
                        <input name="fil_search" type="text" class="form-control search" placeholder="Search" aria-label="fil_search">
                    </div>
                </form>
            </div> --}}
            {{-- search --}}
        </div>
    </div>
    {{-- End:: content heading --}}

    <div class="onoffswitch">
        <input type="checkbox" class="onoffswitch-checkbox" data-id="top-feature" id="pannelStatus" tabindex="0"
            {{ $checked }}>
        <label class="onoffswitch-label" for="pannelStatus">
            <span class="onoffswitch-inner"></span>
            <span class="onoffswitch-switch"></span>
        </label>
    </div>


    {{-- Start::Content Body --}}
    <div class="pannel-status {{ $class }}">
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
        <div class="row margin-top-40 content-details">
            {{-- country --}}

            @if (!$target->isEmpty())
                @foreach ($target as $data)
                    <div class="col-md-2">
                        <div class="video-image text-center">
                            @if (!empty($data->thumbnail))
                                <img src="{{ URL::to('/') }}/uploads/video/thumbnail/{{ $data->thumbnail }}"
                                    alt="{{ $data->title }}" title="{{ $data->title }}" />
                            @else
                                <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" />
                            @endif

                        </div>
                        <div class="video-name margin-top-10 text-center">
                            <span class="bold">{{ $data->title }}</span>
                        </div>

                        <div class="video-action text-center margin-top-10">
                            <form action="{{ URL::to('top-feature/' . $data->top_features_id) }}" method="POST">
                                <button title="Edit" type="button" data-toggle="modal" data-target="#crateModal"
                                    id="editBtn" data-id="{{ $data->top_features_id }}">
                                    <span class="iconify" data-icon="ant-design:edit-filled"></span>
                                </button>&nbsp;&nbsp;

                                @csrf
                                @method('DELETE')
                                <button type="submit" class="" onclick="return confirm('Are you sure?')"
                                    title="Delete"><span class="iconify"
                                        data-icon="ant-design:delete-filled"></span></button>
                            </form>

                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
    {{-- End::Content Body --}}


    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="crateModal">
        <div class="modal-dialog modal-lg">
            <div id="showCreateModal">

            </div>
        </div>
    </div>


@stop
@push('custom-js')
    <script type="text/javascript">
        $(function() {
            //pannel status
            $(document).on("change", "#pannelStatus", function(e) {
                e.preventDefault();
                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                var name = $(this).data('id');
                // alert(name);

                if ($(this).prop('checked')) {
                    var properties = 'on'
                    $(".pannel-status").show();
                } else {
                    var properties = 'off'
                    $(".pannel-status").hide();
                }
                $.ajax({
                    url: "{{ URL::to('management-status') }}",
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        name: name,
                        status: properties,
                    }
                }); //ajax
            });
            
            // create Modal
            $(document).on("click", "#crateBtn", function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ URL::to('top-feature/create') }}",
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

            // get video preview
            $(document).on("change", "#videoId", function(e) {
                e.preventDefault();
                var videoId = $("#videoId").val();
                $("#preview").html('');
                $.ajax({
                    url: "{{ URL::to('top-feature/get-video-image') }}",
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        video_id: videoId,
                    },
                    success: function(res) {
                        $("#preview").html(res.html);
                        $("#preview").show();
                    },
                    error: function(jqXhr, ajaxOptions, thrownError) {}
                }); //ajax
            });

            // edit Modal
            $(document).on("click", "#editBtn", function(e) {
                e.preventDefault();
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "{{ URL::to('top-feature/edit') }}",
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

            // save
            $(document).on("click", "#createTopFeature", function(e) {
                e.preventDefault();
                var formData = new FormData($('#topFeatureCreateForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $.ajax({
                    url: "{{ URL::to('top-feature/store') }}",
                    type: 'POST',
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function(res) {
                        toastr.success('Top Feature Added successfully', res, options);
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

            // edit
            $(document).on("click", "#editTopFeature", function(e) {
                e.preventDefault();
                var formData = new FormData($('#topFeatureEditForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $.ajax({
                    url: "{{ URL::to('top-feature/update') }}",
                    type: 'POST',
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function(res) {
                        toastr.success('Top Feature updated successfully', res, options);
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
