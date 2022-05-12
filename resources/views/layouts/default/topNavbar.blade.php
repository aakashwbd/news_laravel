{{-- Start:: Top Header --}}
<?php
$notificationNumber = \App\Models\Report::where('status', 'active')->where('view_status', 'pending')->count();
?>
<div class="top-header text-right margin-top-10">
    <ul>
        {{-- <li>
            <a href="#" class="">
                <span class="iconify" data-icon="whh:headphonesalt" data-flip="horizontal"></span>
            </a>
        </li> --}}
        <li class="mt-0">
            <a href="/admin/report" class="">

                <span class="iconify" data-icon="clarity:notification-line" data-flip="horizontal"></span>
                <span class="notification-number">
                   @if($notificationNumber)
                        {{$notificationNumber}}
                    @else
                    {{"0"}}
                       @endif
                </span>
            </a>
        </li>
        <li>
            <!-- Example single danger button -->
            <div class="btn-group">
                <button type="button" class="btn profile-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">

                    {{-- <img src="{{ asset('uploads/user/images.jpeg') }}" alt="User Image" class="header-user-img"> --}}

                    @if (!empty(Auth::user()->image))
                        <img src="{{ URL::to('/') }}/uploads/user/{{ Auth::user()->image }}"
                            alt="{{ Auth::user()->name }}" class="header-user-img" />
                    @else
                        <img src="{{ URL::to('/') }}/uploads/no.jpeg" class="header-user-img" />
                    @endif
                    {{Auth::user()->name}}

                </button>
                <div class="dropdown-menu">
                    <a href="{{url('admin/profile')}}"> <span class="iconify" data-icon="healthicons:ui-user-profile"></span> My Profile</a> <br>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                        <span class="iconify" data-icon="carbon:logout"></span>  Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>


                </div>
            </div>
        </li>
    </ul>

</div>
{{-- End:: Top Header --}}
