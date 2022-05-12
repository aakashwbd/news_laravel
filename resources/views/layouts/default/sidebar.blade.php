<?php
$currentControllerName = Request::segment(2);
$currentFullRouteName = Route::getFacadeRoot()
    ->current()
    ->uri();
$logo = \App\Models\Setting::first('logo');
?>
{{-- Start:: Sidebar --}}
<div class="side-bar col-md-2 col-sm-12" id="sitebar">
    <span class="close" id="close">x</span>
    <div class="logo-section">
        <h4 class="bold"> <span class="iconify bold" data-icon="bx:bxs-user" style="float:left"></span>  Admin</h4>
{{--        @if (!empty($logo->logo))--}}
{{--        <img src="{{ URL::to('/') }}/uploads/{{ $logo->logo }}" alt="No Logo" />--}}
{{--        @else--}}
{{--        <img src="{{ URL::to('/') }}/uploads/logo.jpg" alt="" />--}}
{{--        @endif--}}
        {{-- <i class="fas fa-user"></i>
        <h5>ADMIN</h5> --}}
    </div>
    {{-- Start:: Nav bar --}}
    <nav>
        <ul>
            <li>
                <a href="/admin/dashboard" class="{{ $currentControllerName == 'dashboard' || '' ? 'active' : '' }}">
                    <span class="iconify" data-icon="ic:sharp-space-dashboard"></span>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>

        <?php
        $accessControllArr = json_decode(auth()->user()->access) ?? [];
        ?>

        <span class="nav-section">Manage</span>
        <ul>
            @if ((in_array('category', $accessControllArr)) || (in_array(auth()->user()->user_role_id, [1])))
            <li>
                <a href="/admin/category" class="{{ $currentControllerName == 'category' ? 'active' : '' }}">
                    <span class="iconify" data-icon="ic:outline-category"></span>
                    <span>Categories</span>
                </a>
            </li>
            @endif

        </ul>
        <ul>
            @if ((in_array('news', $accessControllArr)) || (in_array(auth()->user()->user_role_id, [1])))
            <li>
                <a href="/admin/news" class="{{ $currentControllerName == 'news' ? 'active' : '' }}">
                    <span class="iconify" data-icon="emojione-monotone:rolled-up-newspaper"></span>
                    <span>News</span>
                </a>
            </li>
            @endif
        </ul>
        <ul>
            @if ((in_array('news-approval', $accessControllArr)) || (in_array(auth()->user()->user_role_id, [1])))
            <li>
                <a href="/admin/news-approval" class="{{ $currentControllerName == 'news-approval' ? 'active' : '' }}">
                    <span class="iconify" data-icon="fluent:news-28-filled"></span>
                    <span>News Approval</span>
                </a>
            </li>
            @endif
        </ul>
        <ul>
            @if ((in_array('video', $accessControllArr)) || (in_array(auth()->user()->user_role_id, [1])))
            <li>
                <a href="/admin/video" class="{{ $currentControllerName == 'video' ? 'active' : '' }}">
                    <span class="iconify" data-icon="bx:bxs-video-plus"></span>
                    <span>Video</span>
                </a>
            </li>
            @endif
        </ul>




        @if ((in_array('administration', $accessControllArr)) || (in_array(auth()->user()->user_role_id, [1])))
        <span class="nav-section">Administration</span>
        <ul>
            <li>
                <a href="/admin/admin" class="{{ $currentControllerName == 'admin' ? 'active' : '' }}">
                    <span class="iconify" data-icon="fa-solid:user-cog"></span>
                    <span>Manage Admin</span>
                </a>
            </li>
        </ul>
        @endif



        <span class="nav-section">User</span>
        <ul>
            @if ((in_array('user', $accessControllArr)) || (in_array(auth()->user()->user_role_id, [1])))
            <li>
                <a href="/admin/user" class="{{ $currentControllerName == 'user' ? 'active' : '' }}">
                    <span class="iconify" data-icon="fa-solid:user-cog"></span>
                    <span>Manage User</span>
                </a>
            </li>
            @endif
            @if ((in_array('comment', $accessControllArr)) || (in_array(auth()->user()->user_role_id, [1])))
            <li>
                <a href="/admin/comment" class="{{ $currentControllerName == 'comment' ? 'active' : '' }}">
                    <span class="iconify" data-icon="fluent:comment-24-filled"></span>
                    <span>Comment</span>
                </a>
            </li>
            @endif
            @if ((in_array('report', $accessControllArr)) || (in_array(auth()->user()->user_role_id, [1])))
            <li>
                <a href="/admin/report" class="{{ $currentControllerName == 'report' ? 'active' : '' }}">
                    <span class="iconify" data-icon="ic:baseline-report"></span>
                    <span>Report</span>
                </a>
            </li>
            @endif
        </ul>




        <span class="nav-section">Settings</span>
        <ul>
              @if ((in_array('advertisement', $accessControllArr)) || (in_array(auth()->user()->user_role_id, [1])))
            <li>
                <a href="/admin/advertisement" class="{{ $currentControllerName == 'advertisement' ? 'active' : '' }}">
                    <span class="iconify" data-icon="bi:badge-ad-fill"></span>
                    <span>Advertisement</span>
                </a>
            </li>
              @endif
              @if ((in_array('notification', $accessControllArr)) || (in_array(auth()->user()->user_role_id, [1])))
            <li>
                <a href="/admin/notification" class="{{ $currentControllerName == 'notification' ? 'active' : '' }}">
                    <span class="iconify" data-icon="ic:sharp-notification-add"></span>
                    <span>Notifications</span>
                </a>
            </li>
              @endif
              @if ((in_array('basic-settings', $accessControllArr)) || (in_array(auth()->user()->user_role_id, [1])))
            <li>
                <a href="/admin/basic-settings" class="{{ $currentControllerName == 'basic-settings' ? 'active' : '' }}">
                    <span class="iconify" data-icon="eva:settings-2-fill"></span>
                    <span>Basic Settings</span>
                </a>
            </li>

            <li>
                <a href="/admin/smtp"
                    class="{{ $currentControllerName == 'sptm' ? 'active' : '' }} {{ $currentControllerName == 'smtp' ? 'active' : '' }}">
                   <span class="iconify" data-icon="icon-park:email-lock"></span>
                    <span>SMTP</span>
                </a>
            </li>
              @endif
        </ul>


    </nav>
    {{-- End:: Nav bar --}}
</div>
{{-- End:: Sidebar --}}
