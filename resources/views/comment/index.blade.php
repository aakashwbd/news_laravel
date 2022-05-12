@extends('layouts.default.master')
@section('data_count')
    {{-- Start:: content heading --}}
    <div class="content-heading">

        <div class="row">
            {{-- title --}}
            <div class="col-md-2 content-title">
                <span class="title">Video Comment</span>
                <div class="title-line"></div>
            </div>
            <div class="col-md-2 content-title">
                <span class="title"><a href="{{url('admin/comment/news')}}">News Comment</a></span>

{{--                <div class="title-line"></div>--}}
            </div>
            {{-- title --}}
            {{-- search --}}
            {{-- <div class="col-md-4 text-right">
                <form action="/comment/filter" method="POST" enctype="multipart/form-data">
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
                    <th scope="col" class="text-center">VIDEO TITLE</th>
                    <th scope="col" class="text-center">USER NAME</th>
                    <th scope="col" class="text-center">COMMENT TEXT</th>
                    <th scope="col" class="text-center">ENABLE/DISABLE</th>
                    <th scope="col" class="text-center">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php $sl = 1; ?>
                @if (!$target->isEmpty())
                    @foreach ($target as $data)
                        <tr>
                            <th class="text-center" scope="row">{{ $sl++ }}</th>
                            <td class="text-center">{{ $data->video }}</td>
                            <td class="text-center">{{ $data->user }}</td>
                            <td class="text-center">{{ $data->comment }}</td>
                            <td class="text-center">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" data-id="{{ $data->comment_id }}"
                                        id="commentHideShow{{ $data->comment_id }}" tabindex="0" {!! $data->comments_status == 'active' ? 'checked' : '' !!}>
                                    <label class="onoffswitch-label" for="commentHideShow{{ $data->comment_id }}">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </td>
                            <td class="table-actions text-center">
                                    <button onclick="deleteItem('{{ URL::to('admin/comment/' . $data->comment_id) }}')" title="Delete" id="news">
                                        <span class="iconify" data-icon="ant-design:delete-filled"></span>
                                        Delete
                                    </button>
                            </td>
                    @endforeach
                @endif
                </tr>
            </tbody>
        </table>

    </div>
    {{-- End::Content Body --}}


@stop
@push('custom-js')

    <script type="text/javascript">
        $(document).on("change", ".onoffswitch-checkbox", function(e) {
            e.preventDefault();
            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            var id = $(this).data('id');

            if ($(this).prop('checked')) {
                var properties = 'active'
            } else {
                var properties = 'inactive'
            }
            $.ajax({
                url: "{{ URL::to('admin/comment/status') }}",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    status: properties,
                },
                success: function(res) {
                    toastr.success('Status Update successfully', res, options);
                    // setTimeout(location.reload.bind(location), 0);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {}
            }); //ajax
        });
    </script>
@endpush
