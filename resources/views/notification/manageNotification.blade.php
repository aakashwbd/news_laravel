@extends('layouts.default.master')
@section('data_count')
    {{-- Start:: content heading --}}
    <div class="content-heading">
        <div class="row">
            {{-- title --}}
            <div class="col-md-8 content-title">
                <span class="title">Notification</span>
                <div class="title-line"></div>
            </div>
            {{-- title --}}
            {{-- search --}}
            <div class="col-md-4 text-right">
                {{-- <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#xlModal"
                    id="manageNotification">
                    Manage Notification
                </button> --}}

                <a href="{{url('/admin/notification')}}" class="btn btn-outline-dark btn-sm"><span class="iconify"
                        data-icon="akar-icons:arrow-back-thick"></span>&nbsp; Back Notification</a>

            </div>
            {{-- search --}}

        </div>
    </div>
    {{-- End:: content heading --}}

    {{-- Start::Content Body --}}
    <div class="row margin-top-40 create-body content-details">

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

        {{-- Start:: Mobile Notification --}}
        <div class="col-md-6 for-mobile" id="showMobileNotification">
        </div>
        {{-- End:: Mobile Notification --}}

        {{-- Start:: Web Notification --}}
        {{-- <div class="offset-md-1 col-md-5 for-web" id="showWebNotification">
        </div> --}}
        {{-- End:: Web Notification --}}

    </div>
    {{-- End::Content Body --}}


@stop
@push('custom-js')
    <script type="text/javascript">
        $(document).ready(function() {

            $.ajax({
                url: "{{ URL::to('admin/notification/manage-notification/get-mobile-data') }}",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    notification_type: 'mobile'
                },
                success: function(res) {
                    $("#showMobileNotification").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {}
            }); //ajax

            $.ajax({
                url: "{{ URL::to('admin/notification/manage-notification/get-web-data') }}",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    notification_type: 'web'
                },
                success: function(res) {
                    $("#showWebNotification").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {}
            }); //ajax
        });
    </script>
@endpush
