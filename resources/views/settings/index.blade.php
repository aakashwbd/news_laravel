@extends('layouts.default.master')
@section('data_count')
    {{-- Start:: content heading --}}
    <div class="content-heading">
        <div class="row">
            {{-- title --}}
            <div class="col-md-8 content-title">
                <span class="title">Basic Settings</span>
                <div class="title-line"></div>

                <!-- Button trigger modal -->
            </div>
            {{-- title --}}

            {{-- change password --}}
            {{--            <div class="col-md-4 text-right">--}}
            {{--                <button type="button" class="create-button" data-toggle="modal" data-target="#passModal" id="passBtn">--}}
            {{--                    Change Password--}}
            {{--                </button>--}}
            {{--            </div>--}}
            {{-- change password --}}
        </div>
    </div>
    {{-- End:: content heading --}}
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

    {{-- Start::Content Body --}}
    <form id="settingsForm" method="POST" enctype="multipart/form-data" action="{{ URL::to('admin/basic-settings/create') }}">
        @csrf
        <div class="row create-body margin-top-40">
            <div class="col-md-6 margin-top-10">
                <div class="form-group">
                    <label for="systemName">System Name </label>

                    <input type="text" name="system_name" class="form-control create-form" id="systemName"
                           placeholder="System Name" value="">

                    <span class="text-danger">{{ $errors->first('system_name') }}</span>
                </div>
            </div>
            <div class="col-md-6 margin-top-10">
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" name="facebook" class="form-control create-form" id="facebook"
                           placeholder="facebook link" value="">
                    <span class="text-danger">{{ $errors->first('facebook') }}</span>
                </div>
            </div>
            <div class="col-md-6 margin-top-10">
                <div class="form-group">
                    <label for="appVersion">App Version </label>
                    <input type="text" name="app_version" class="form-control create-form" id="appVersion"
                           placeholder="App Version" value="">
                    <span class="text-danger">{{ $errors->first('app_version') }}</span>
                </div>
            </div>
            <div class="col-md-6 margin-top-10">
                <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input type="text" name="instagram" class="form-control create-form" id="instagram"
                           placeholder="instagram link" value="">
                    <span class="text-danger">{{ $errors->first('instagram') }}</span>
                </div>
            </div>
            <div class="col-md-6 margin-top-10">
                <div class="form-group">
                    <label for="mailAddress">Mail Address</label>
                    <input type="text" name="mail_address" class="form-control create-form" id="mailAddress"
                           placeholder="Mail Address" value="">
                    <span class="text-danger">{{ $errors->first('mail_address') }}</span>
                </div>
            </div>
            <div class="col-md-6 margin-top-10">
                <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="text" name="twitter" class="form-control create-form" id="twitter"
                           placeholder="twitter link" value="">
                    <span class="text-danger">{{ $errors->first('twitter') }}</span>
                </div>
            </div>
            <div class="col-md-6 margin-top-10">
                <div class="form-group">
                    <label for="updateApp">Update App</label>
                    <input type="text" name="update_app" class="form-control create-form" id="updateApp"
                           placeholder="Update App Link" value="">
                    <span class="text-danger">{{ $errors->first('update_app') }}</span>
                </div>
            </div>
            <div class="col-md-6 margin-top-10">
                <div class="form-group">
                    <label for="youtube">Youtube</label>
                    <input type="text" name="youtube" class="form-control create-form" id="youtube"
                           placeholder="youtube link" value="">
                    <span class="text-danger">{{ $errors->first('youtube') }}</span>
                </div>
            </div>
            <div class="col-md-6 margin-top-10">
                <div class="form-group">
                    <label for="developedBy">Developed By</label>
                    <input type="text" name="developed_by" class="form-control create-form" id="developedBy"
                           placeholder="Developed By" value="">
                    <span class="text-danger">{{ $errors->first('developed_by') }}</span>
                </div>
            </div>


            <div class="col-md-12 margin-top-40">
                <div class="row">
                    {{-- title --}}
                    <div class="col-md-8 content-title">
                        <span class="title">Others</span>
                        <div class="title-line"></div>
                    </div>
                    {{-- title --}}
                </div>
            </div>

            <div class="col-md-6 margin-top-40">
                <div class="form-group">
                    <label for="copyright">Copyright</label>
                    <input type="text" name="copyright" class="form-control create-form" id="copyright"
                           placeholder="your company copyright" value="">
                    <span class="text-danger">{{ $errors->first('copyright') }}</span>
                </div>
            </div>
            <div class="col-md-6 margin-top-40">
                <div class="form-group">
                    <label for="companyLogo">Company Logo</label><br>
                    <div class="file-upload-edit">
                        <div class="image-upload-wrap-edit">
                            <input value="" name="logo" class="file-upload-input-edit" type='file'
                                   onchange="readURLEdit(this);" accept="image/*" />
                            <div class="drag-text-edit text-center">
                                <span class="iconify" data-icon="bx:bx-image-alt"></span> <br>
                                <span>Upload Flag Or Drag Here</span>
                            </div>
                        </div>
                        <div class="file-upload-content-edit">

                                <img class="file-upload-image-edit"
                                     src="" alt="your image" />

                            <div class="image-title-wrap-edit">
                                <button type="button" onclick="removeUploadEdit()" class="remove-image-edit">
                                    <span class="iconify" data-icon="akar-icons:cross"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger">{{ $errors->first('logo') }}</span>
                </div>
            </div>

            <div class="col-md-12 margin-top-10">
                <div class="form-group">
                    <label for="appDescription">App Description</label>
                    <textarea class="form-control create-form" id="appDescription" name="description" rows="10"
                              placeholder="App Description"></textarea>
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                </div>
            </div>

            <div class="col-md-12 margin-top-10">
                <div class="form-group">
                    <label for="privacy">Privacy & Policy</label>
                    <textarea class="form-control create-form" id="privacy" name="privacy_policy" rows="10"
                              placeholder="Write Here Privacy & Policy"></textarea>
                    <span class="text-danger">{{ $errors->first('privacy_policy') }}</span>
                </div>
            </div>

            <div class="col-md-12 margin-top-10">
                <div class="form-group">
                    <label for="cookies">Cookies Policy</label>
                    <textarea class="form-control create-form" id="cookies" name="cookies_policy" rows="10"
                              placeholder="Write Here Cookies Policy"></textarea>
                    <span class="text-danger">{{ $errors->first('cookies_policy') }}</span>
                </div>
            </div>

            <div class="col-md-12 margin-top-10">
                <div class="form-group">
                    <label for="terms">Terms & Policy</label>
                    <textarea class="form-control create-form" id="terms" name="terms_policy" rows="10"
                              placeholder="Write Here Terms & Policy"></textarea>
                    <span class="text-danger">{{ $errors->first('terms_policy') }}</span>
                </div>
            </div>

            <div class="col-md-12 actions margin-top-10">
                <button type="submit" class="submit">Update</button>
                <a href="/basic-settings">Cancel</a>
            </div>
            <div class=" margin-top-40">
            </div>
        </div>
    </form>
    {{-- End::Content Body --}}
    {{-- create modal --}}
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="passModal">
        <div class="modal-dialog modal-lg">
            <div id="showCreateModal">

            </div>
        </div>
    </div>



@stop
@push('custom-js')

    <script type="text/javascript">
        // pass change Modal
        $(document).on("click", "#passBtn", function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ URL::to('admin/basic-settings/change-password') }}",
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

        // update Password
        $(document).on("click", "#changePass", function(e) {
            e.preventDefault();
            var formData = new FormData($('#changePassForm')[0]);

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            $.ajax({
                url: "{{ URL::to('admin/basic-settings/update-password') }}",
                type: 'POST',
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function(res) {
                    toastr.success('Password Changed successfully', res, options);
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
                    } else if (jqXhr.status == 404) {
                        toastr.error(jqXhr.responseJSON.message, '', options);
                    } else {
                        toastr.error('Error', 'Something went wrong', options);
                    }
                    App.unblockUI();
                }
            });
        });


        //privecy text editor
        ClassicEditor
            .create(document.querySelector('#privacy'))
            .catch(error => {
                console.error(error);
            });

        //cookies text editor
        ClassicEditor
            .create(document.querySelector('#cookies'))
            .catch(error => {
                console.error(error);
            });

        //terms text editor
        ClassicEditor
            .create(document.querySelector('#terms'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
