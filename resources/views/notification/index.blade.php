@extends('layouts.default.master')
@section('data_count')
    {{-- Start:: content heading --}}
    <div class="content-heading">
        <div class="row">
            {{-- title --}}
            <div class="col-md-8 content-title">
                <span class="title">Notification</span>
                <button type="button" class="create-button" data-toggle="modal" data-target="#crateModal"
                    id="notificationCreate"><span class="iconify" data-icon="bi:plus-circle-fill"></span>Add
                    Notification</button>
                <div class="title-line"></div>
            </div>
            {{-- title --}}

            {{-- search --}}
            <div class="col-md-4 text-right">

                <a href="{{url('admin/notification/manage-notification')}}" class="btn btn-outline-dark btn-sm">
                    Manage Notification
                </a>&nbsp;&nbsp;&nbsp;&nbsp;

{{--
                <div class="input-group content-search">
                    <div class="text-right">
                        <form action="/notification/filter" method="POST" enctype="multipart/form-data">
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
                </div> --}}
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
    <div class="row margin-top-40 content-details">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col" class="text-center">SERIAL</th>
                    <th scope="col" class="text-center">NEWS TITLE</th>
                    <th scope="col" class="text-center">NOTIFICATION DATE</th>
                    <th scope="col" class="text-center">DESCRIPTION</th>
                    {{-- <th scope="col" class="text-center">ENABLE/DISABLE</th> --}}
                    <th scope="col" class="text-center">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php $sl = 1; ?>
                @if (!$target->isEmpty())
                    @foreach ($target as $data)
                        <tr>
                            <th class="text-center">{{ $sl++ }}</th>
                            <td class="text-center">{!! $data->video_title ?? '' !!}</td>
                            <td class="text-center">{{ $data->created_at->isoFormat('Do MMMM YYYY') }}</td>
                            <td class="text-center">{{ $data->description ?? '' }}</td>
                            {{-- <td class="notification-enable">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" data-id="{{$data->notification_id}}" name="" type="checkbox"
                                        id="googleStatus">
                                </div>
                            </td> --}}
                            <td class="table-actions text-center">
                                    <button onclick="deleteItem('{{ URL::to('admin/notification/' . $data->notification_id) }}')" title="Delete" id="news">
                                        <span class="iconify" data-icon="ant-design:delete-filled"></span>
                                        Delete
                                    </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

    </div>
    {{-- End::Content Body --}}

    {{-- create modal --}}
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="crateModal">
        <div class="modal-dialog modal-lg">
            <div id="showCreateModal">

            </div>
        </div>
    </div>


@stop
@push('custom-js')

    <script type="text/javascript">
        // create notification modal
        $(document).on("click", "#notificationCreate", function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ URL::to('/admin/notification/create') }}",
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

        $(document).on("keyup", "#externalurl", function() {
            var length = $(this).val().length;
            if (length > 0) {
                $("#tvId").prop("disabled", true);
                $("#videoId").prop("disabled", true);
            } else {
                $("#tvId").prop("disabled", false);
                $("#videoId").prop("disabled", false);
            }
        });

        $(document).on("change", "#videoId", function() {
            var value = $(this).val();
            if (value != 0) {
                $("#tvId").prop("disabled", true);
                $("#externalurl").prop("disabled", true);
            } else {
                $("#tvId").prop("disabled", false);
                $("#externalurl").prop("disabled", false);
            }
        });
        $(document).on("change", "#tvId", function() {
            var value = $(this).val();
            if (value != 0) {
                $("#videoId").prop("disabled", true);
                $("#externalurl").prop("disabled", true);
            } else {
                $("#videoId").prop("disabled", false);
                $("#externalurl").prop("disabled", false);
            }
        });


        // save
        $(document).on("click", "#createNotification", function(e) {
            e.preventDefault();
            var formData = new FormData($('#notificationCreateForm')[0]);

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            var url = "{{ URL::to('/api/v1/send-notification') }}"
           itemStore(formData,options,url)

        });
    </script>
@endpush
