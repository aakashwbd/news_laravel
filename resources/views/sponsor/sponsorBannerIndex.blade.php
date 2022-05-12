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
                            <a href="/sponsor" class="title-btn red">Sponsor Banner</a>
                        </span>
                        <div class="title-line category-title-line" id="categoryLine"></div>
                    </div>
                    <div class="col-md-2">
                        <span class="sub-title">
                            <a href="/sponsor/sponsor-video-index" class="title-btn">Sponsor Video</a>
                        </span>
                        <div class="title-line sub-category-title-line display-none"></div>
                    </div>
                </div>


                <div class="row create-menus margin-top-40">

                    <div class="col-md-3">
                        <button type="button" class="" data-toggle="modal" data-target="#createModal"
                            id="sponsorBannerCreate">
                            Add Sponsor Banner &nbsp; <span class="iconify" data-icon="ant-design:plus-outlined"></span>
                        </button>
                    </div>

                    <div class="col-md-3">
                        <button type="button" class="" data-toggle="modal" data-target="#createModal"
                            id="sponsorVideoCreate">
                            Add Sponsor Video &nbsp; <span class="iconify" data-icon="ant-design:plus-outlined"></span>
                        </button>
                    </div>

                </div>
            </div>
            {{-- title --}}

            {{-- search --}}
            <div class="col-md-4 text-right">
                <form action="/sponsor/sponsor-banner-filter" method="POST" enctype="multipart/form-data">
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

    {{-- Start::Content Body --}}
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
    <div class="row content-details">

        @if (!$target->isEmpty())
            @foreach ($target as $data)
                <div class="margin-top-40 col-md-2">
                    <div class="content-image text-center">
                        @if (!empty($data->image))
                            <img src="{{ URL::to('/') }}/uploads/sponsor/{{ $data->image }}" alt="{{ $data->title }}"
                                title="{{ $data->title }}" />
                        @else
                            <img src="{{ URL::to('/') }}/uploads/no.jpeg" alt="" />
                        @endif
                    </div>
                    <div class="content-name margin-top-10 text-center">
                        <span class="bold">{{ $data->title }}</span>
                    </div>
                    
                    <div class="country-action text-center margin-top-10">
                        <form action="{{ URL::to('sponsor/' . $data->id . '/sponsor-banner-index') }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button title="Edit" type="button" data-toggle="modal" data-target="#createModal" id="editBtn"
                                data-id="{{ $data->id }}">
                                <span class="iconify" data-icon="ant-design:edit-filled"></span>
                            </button>&nbsp;&nbsp;

                            <button type="submit" class="" onclick="return confirm('Are you sure?')" title="Delete"><span class="iconify"
                                    data-icon="ant-design:delete-filled"></span></button>
                        </form>

                    </div>
                </div>
            @endforeach
        @endif

    </div>
    {{-- End::Content Body --}}


    {{-- create  modals --}}
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="createModal">
        <div class="modal-dialog modal-lg">
            <div id="showCreateModal"></div>
        </div>
    </div>


@stop
@push('custom-js')

    <script type="text/javascript">
        $(function() {


            //sponsor banner create Modal
            $(document).on("click", "#sponsorBannerCreate", function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ URL::to('sponsor/sponsor-banner-create') }}",
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

            //sponsor banner save
            $(document).on("click", "#createSponsorBanner", function(e) {
                e.preventDefault();
                var formData = new FormData($('#sponsorBannerCreateForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $.ajax({
                    url: "{{ URL::to('sponsor/sponsor-banner-store') }}",
                    type: 'POST',
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function(res) {
                        toastr.success('Sponsor Banner Added successfully', res, options);
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

            //sponsor banner edit Modal
            $(document).on("click", "#editBtn", function(e) {
                e.preventDefault();
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "{{ URL::to('sponsor/sponsor-banner-edit') }}",
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

            // sponsor banner update
            $(document).on("click", "#editSponsorBanner", function(e) {
                e.preventDefault();
                var formData = new FormData($('#sponsorBannerEditForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $.ajax({
                    url: "{{ URL::to('sponsor/sponsor-banner-update') }}",
                    type: 'POST',
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function(res) {
                        toastr.success('Sponsor Banner updated successfully', res, options);
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



            // sponsor video create Modal
            $(document).on("click", "#sponsorVideoCreate", function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ URL::to('sponsor/sponsor-video-create') }}",
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

            // sponsor video save
            $(document).on("click", "#createSponsorVideo", function(e) {
                e.preventDefault();
                var formData = new FormData($('#sponsorVideoCreateForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $.ajax({
                    url: "{{ URL::to('sponsor/sponsor-video-store') }}",
                    type: 'POST',
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function(res) {
                        toastr.success('Sponsor Video Added successfully', res, options);
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
