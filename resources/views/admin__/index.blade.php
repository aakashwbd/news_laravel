@extends('layouts.default.master')
@section('data_count')
    {{-- Start:: content heading --}}
    <div class="content-heading">
        <div class="row">
            {{-- title --}}
            <div class="col-md-8 content-title">
                <span class="title">Manage Admin</span>

                <a class="create-button" href="admin-management/create">
                    <span class="iconify" data-icon="bi:plus-circle-fill"></span>Add Admin
                </a>
                <div class="title-line"></div>
            </div>
            {{-- title --}}

            {{-- search --}}
            <div class="col-md-4 text-right">
                <div class="input-group content-search">
                    <span class="input-group-text search" id="addon-wrapping"><span class="iconify"
                            data-icon="bx:bx-search"></span></span>
                    <input type="text" class="form-control search" placeholder="Search" aria-label="Username">
                </div>
            </div>
            {{-- search --}}

            {{-- second title --}}
            <div class="col-md-8 margin-top-40 content-title">
                <span class="title">Admin</span>&nbsp;&nbsp;&nbsp;
                <span>Super Admin</span>
                <div class="title-line"></div>
            </div>
            <div class="col-md-4 text-right margin-top-40">
                <button type="button" class="create-button" data-toggle="modal" data-target="#crateModal"><span
                        class="iconify" data-icon="bi:plus-circle-fill"></span>Add User Role</button>
            </div>
            {{-- second title --}}

        </div>
    </div>
    {{-- End:: content heading --}}

    {{-- Start::Content Body --}}

    <div class="row margin-top-40 content-details">
        <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col" class="text-center">SERIAL</th>
                <th scope="col" class="text-center">NAME</th>
                <th scope="col" class="text-center">PHONE NO</th>
                <th scope="col" class="text-center">EMAIL</th>
                <th scope="col" class="text-center">ROLE</th>
                <th scope="col" class="text-center">ACTIONS</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th class="text-center" scope="row">1</th>
                <td class="text-center">Abir</td>
                <td class="text-center">01741709262</td>
                <td class="text-center">abir@gmail.com</td>
                <td class="text-center">Super Admin</td>
                <td class="table-actions text-center">
                    <button>EDIT</button>
                    <button>DELETE</button>
                </td>
              </tr>
            </tbody>
          </table>

    </div>
    {{-- End::Content Body --}}

    {{-- Create Modal --}}
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="crateModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-title">
                    <h4>Add User Role</h4>
                </div>
                <form>
                    <div class="form-group margin-top-40">
                        <input type="text" class="form-control create-form" id="name" placeholder="User Role Name">
                    </div>
                    <span>note: User Role Name is unique.</span>

                    <div class="actions margin-top-40">
                        <button class="submit">Save</button>
                        <button type="button" class="cancel" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@stop
@push('custom-js')

    <script type="text/javascript">

    </script>
@endpush
