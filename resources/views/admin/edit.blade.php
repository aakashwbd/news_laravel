@extends('layouts.default.master')
@section('data_count')
{{-- Start:: content heading --}}
<div class="content-heading">
    <div class="row">
        {{-- title --}}
        <div class="col-md-8 content-title">
            <span class="title">Edit Admin</span>
            <div class="title-line"></div>

            <!-- Button trigger modal -->
        </div>
        {{-- title --}}
    </div>
</div>
{{-- End:: content heading --}}

{{-- Start::Content Body --}}
<form id="adminCreateForm" method="POST" enctype="multipart/form-data"
    action="{{ URL::to('admin/admin/' . $target->id . '/update') }}">
    @csrf
    <div class="row create-body margin-top-40">

        <div class="offset-md-1 col-md-10 margin-top-10">
            <div class="form-group">
                <select name="user_role_id" id="userRole" class="form-control create-form">
                    <option value=" 0">Select Role</option>
                    @foreach ($userRole as $id => $name)
                    <?php
                            $selected = '';
                            if ($id == $target->user_role_id) {
                                $selected = 'selected';
                            }
                            ?>
                    <option value="{{ $id }}" {{ $selected }}>
                        {{ $name }}
                    </option>
                    @endforeach
                </select>
                <span class="text-danger">{{ $errors->first('user_role_id') }}</span>
            </div>
        </div>

        <div class="offset-md-1 col-md-10 margin-top-10">
            <div class="form-group">
                <input type="text" name="name" class="form-control create-form" id="name" placeholder="Name"
                    value="{{ $target->name }}">
                <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>
        </div>

        <div class="offset-md-1 col-md-10 margin-top-10">
            <div class="form-group">
                <input type="text" name="email" class="form-control create-form" id="email" placeholder="Email"
                    value="{{ $target->email }}">
                <span class="text-danger">{{ $errors->first('email') }}</span>
            </div>
        </div>

        <div class="offset-md-1 col-md-10 margin-top-10">
            <div class="form-group">
                <input type="text" name="phone" class="form-control create-form" id="phone" placeholder="Phone"
                    value="{{ $target->phone }}">
                <span class="text-danger">{{ $errors->first('phone') }}</span>
            </div>
        </div>

        <div class="offset-md-1 col-md-10 margin-top-10" id="accessControl">
            @if ($target->user_role_id != '1')
            <h4>Access Control</h4>
            <div class="row margin-top-20">

                <div class="form-check user-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="access[]" value="category" id="category" {!!
                        in_array('category', $access) ? 'checked' : '' !!}>
                    <label class="form-check-label" for="category">
                        Category
                    </label>
                </div>
                <div class="form-check user-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="access[]" value="news" id="news" {!!
                        in_array('news', $access) ? 'checked' : '' !!}>
                    <label class="form-check-label" for="news">
                        News
                    </label>
                </div>
                <div class="form-check user-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="access[]" value="news-approval" id="news-approval" {!!
                        in_array('news-approval', $access) ? 'checked' : '' !!}>
                    <label class="form-check-label" for="news-approval">
                        News Approval
                    </label>
                </div>
                <div class="form-check user-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="access[]" value="video" id="video" {!!
                        in_array('video', $access) ? 'checked' : '' !!}>
                    <label class="form-check-label" for="video">
                        Video
                    </label>
                </div>
                <div class="form-check user-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="access[]" value="user" id="user" {!!
                        in_array('user', $access) ? 'checked' : '' !!}>
                    <label class="form-check-label" for="user">
                        Manage User
                    </label>
                </div>
                <div class="form-check user-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="access[]" value="comment" id="comment" {!!
                        in_array('comment', $access) ? 'checked' : '' !!}>
                    <label class="form-check-label" for="comment">
                        Comment
                    </label>
                </div>
                <div class="form-check user-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="access[]" value="report" id="report" {!!
                        in_array('report', $access) ? 'checked' : '' !!}>
                    <label class="form-check-label" for="report">
                        Report
                    </label>
                </div>

                <div class="form-check user-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="access[]" value="advertisement" id="advertisement" {!!
                        in_array('advertisement', $access) ? 'checked' : '' !!}>
                    <label class="form-check-label" for="advertisement">
                        Advertisement
                    </label>
                </div>
                <div class="form-check user-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="access[]" value="notification" id="notification" {!!
                        in_array('notification', $access) ? 'checked' : '' !!}>
                    <label class="form-check-label" for="notification">
                        Notification
                    </label>
                </div>

                <div class="form-check user-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="access[]" value="basic-settings"
                        id="basic-settings" {!! in_array('basic-settings', $access) ? 'checked' : '' !!}>
                    <label class="form-check-label" for="basic-settings">
                        Settings
                    </label>
                </div>


            </div>
            @endif
        </div>

        <div class="offset-md-1 col-md-10 margin-top-20">
            <div class="col-md-6">
                <div class="file-upload-edit">
                    <div class="image-upload-wrap-edit">
                        <input value="" name="image" class="file-upload-input-edit" type='file'
                            onchange="readURLEdit(this);" accept="image/*" />
                        <div class="drag-text-edit text-center">
                            <span class="iconify" data-icon="bx:bx-image-alt"></span> <br>
                            <span>Upload Flag Or Drag Here</span>
                        </div>
                    </div>
                    <div class="file-upload-content-edit">
                        <img class="file-upload-image-edit" src="{{ URL::to('/') }}/uploads/user/{{ $target->image }}"
                            alt="your image" />
                        <div class="image-title-wrap-edit">
                            <button type="button" onclick="removeUploadEdit()" class="remove-image-edit">
                                <span class="iconify" data-icon="akar-icons:cross"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <span class="text-danger">{{ $errors->first('image') }}</span>
            </div>
        </div>


        <div class="offset-md-1 col-md-10 actions margin-top-20">
            <button class="submit" type="submit" id="editUser">Update</button>
            <a href="/admin">Cancel</a>
        </div>
        <div class=" margin-top-40">
        </div>
    </div>
</form>
{{-- End::Content Body --}}



@stop
@push('custom-js')

<script type="text/javascript">
    // access control
    $(document).on("change", "#userRole", function (e) {
        e.preventDefault();
        var value = $(this).val();
        $("#accessControl").html('');
        if (value === '1') {
            // alert('asd');
            $("#accessControl").html('');
        } else {
            $("#accessControl").html(`
                    <h4>Access Control</h4>
                    <div class="row margin-top-20">

                       <div class="form-check user-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="access[]" value="category" id="category" checked>
                    <label class="form-check-label" for="category">
                        Category
                    </label>
                </div>
                 <div class="form-check user-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="access[]" value="news" id="news" checked>
                    <label class="form-check-label" for="news">
                        News
                    </label>
                </div>
                <div class="form-check user-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="access[]" value="news-approval" id="news-approval" checked>
                    <label class="form-check-label" for="news-approval">
                        News Approval
                    </label>
                </div>
                 <div class="form-check user-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="access[]" value="video" id="video" checked>
                    <label class="form-check-label" for="video">
                        Video
                    </label>
                </div>
               <div class="form-check user-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="access[]" value="user" id="user" checked>
                    <label class="form-check-label" for="user">
                       Manage User
                    </label>
                </div>

                <div class="form-check user-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="access[]" value="comment" id="comment" checked>
                    <label class="form-check-label" for="comment">
                        Comment
                    </label>
                </div>

                <div class="form-check user-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="access[]" value="report" id="report" checked>
                    <label class="form-check-label" for="report">
                        Report
                    </label>
                </div>

                <div class="form-check user-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="access[]" value="advertisement" id="advertisement" checked>
                    <label class="form-check-label" for="report">
                        advertisement
                    </label>
                </div>
                <div class="form-check user-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="access[]" value="notification" id="notification" checked>
                    <label class="form-check-label" for="notification">
                        Notification
                    </label>
                </div>

                <div class="form-check user-check col-md-2">
                    <input class="form-check-input" type="checkbox" name="access[]" value="basic-settings" id="settings"
                        checked>
                    <label class="form-check-label" for="settings">
                        Settings
                    </label>
                </div>

                    </div>
                `);
        }
    });

</script>
@endpush
