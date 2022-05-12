@extends('layouts.default.master')
@section('data_count')
    {{-- Start:: content heading --}}
    <div class="content-heading">
        <div class="row">
            {{-- title --}}
            <div class="col-md-8 content-title">
                <span class="title">Add Admin</span>
                <div class="title-line"></div>

                <!-- Button trigger modal -->
            </div>
            {{-- title --}}

            {{-- search --}}
            {{-- <div class="col-md-4 text-right">
                <div class="input-group content-search">
                    <span class="input-group-text search" id="addon-wrapping"><span class="iconify"
                            data-icon="bx:bx-search"></span></span>
                    <input type="text" class="form-control search" placeholder="Search" aria-label="Username">
                </div>
            </div> --}}
            {{-- search --}}
        </div>
    </div>
    {{-- End:: content heading --}}

    {{-- Start::Content Body --}}
    <form>
        <div class="row create-body margin-top-40">

            <div class="offset-md-1 col-md-10 margin-top-10">
                <div class="form-group">
                    <select id="role" class="form-control create-form">
                        <option selected>Select Role</option>
                        <option>...</option>
                    </select>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10">
                <div class="form-group">
                    <input type="text" class="form-control create-form" id="name" placeholder="Name">
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10">
                <div class="form-group">
                    <input type="text" class="form-control create-form" id="email" placeholder="Email">
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10">
                <div class="form-group">
                    <input type="text" class="form-control create-form" id="phone" placeholder="Phone">
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10">
                <div class="form-group">
                    <input type="password" class="form-control create-form" id="password" placeholder="Password">
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10">
                <h4>Access Control</h4>
                <div class="row margin-top-20">

                    <div class="form-check user-check col-md-2">
                        <input class="form-check-input" type="checkbox" value="" id="manage">
                        <label class="form-check-label" for="manage">
                            Manage
                        </label>
                    </div>
                    <div class="form-check user-check col-md-2">
                        <input class="form-check-input" type="checkbox" value="" id="video" checked>
                        <label class="form-check-label" for="video">
                            Video
                        </label>
                    </div>
                    <div class="form-check user-check col-md-2">
                        <input class="form-check-input" type="checkbox" value="" id="administration" checked>
                        <label class="form-check-label" for="administration">
                            Administration
                        </label>
                    </div>
                    <div class="form-check user-check col-md-2">
                        <input class="form-check-input" type="checkbox" value="" id="user" checked>
                        <label class="form-check-label" for="user">
                            User
                        </label>
                    </div>
                    <div class="form-check user-check col-md-2">
                        <input class="form-check-input" type="checkbox" value="" id="settings" checked>
                        <label class="form-check-label" for="settings">
                            Settings
                        </label>
                    </div>

                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-20">
                <div class="form-group">
                    <input type="file" id="photo" name="photo">
                </div>
            </div>

            <div class="offset-md-1 col-md-10 actions margin-top-10">
                <button class="submit">Add Admin</button>
                <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
            </div>
            <div class=" margin-top-40">
            </div>
        </div>
    </form>
    {{-- End::Content Body --}}



@stop
@push('custom-js')

    <script type="text/javascript">

    </script>
@endpush
