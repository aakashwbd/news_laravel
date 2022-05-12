@extends('layouts.default.master')
@section('data_count')
    {{-- Start:: content heading --}}
    <div class="content-heading">
        <div class="row">
            {{-- title --}}
            <div class="col-md-8 content-title">
                <span class="title">Manage Ad</span>
                <div class="title-line"></div>
                <!-- Button trigger modal -->
            </div>
            {{-- title --}}
        </div>
    </div>
    {{-- End:: content heading --}}

    {{-- Start::Content Body --}}

    {{-- content top --}}
    <div class="row margin-top-40">
        <div class="col-md-2 content-type">
            <div class="content-type-element">
                <a class="bold several-ad several-ad-inactive" href="/advertisement">Add For Mobile</a>
            </div>
        </div>

        <div class="col-md-2 content-type">
            <div class="content-type-element  content-type-active">
                <a class="bold several-ad several-ad-active" href="/advertisement/web-ad">Add For Web</a>
            </div>
        </div>

    </div>
    {{-- content top --}}
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

    <div class="row margin-top-40">
        <div id="accordion">
            <form id="mobileAdForm" method="POST" enctype="multipart/form-data"
                action="{{ URL::to('advertisement/webAdUpdate') }}">
                @csrf
                {{-- Start:: Header Add --}}
                @if (!$target->isEmpty())
                    @foreach ($target as $data)
                        @if ($data->ad_type == 'header')
                            <div class="card">
                                <div class="card-header" id="headingheader">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link" data-toggle="collapse"
                                            data-target="#headerAd" aria-expanded="true" aria-controls="headerAd">
                                            Header Ad
                                        </button>
                                    </h5>
                                </div>


                                <div id="headerAd" class="collapse" aria-labelledby="headingheader"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row margin-top-20">

                                            <input type="hidden" name="ad_type[]" value="header">

                                            <div class="col-md-3">
                                                <span class="bold"> Your Header Ad</span> <br /><br />
                                                <span>Paste your ad code here. Google AdSense will be made responsive
                                                    automatically.</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <textarea name="add_link[header]" class="add-link-input" cols="85"
                                                    rows="10">{{ $data->ad_link }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row margin-top-10">
                                            <div class="col-md-3">
                                                <span class="bold"> Ad Title :</span> <br /><br />
                                                <span>A title for the Ad, like - Advertisement - if you leave it blank the
                                                    ad spot will
                                                    not
                                                    have a title.</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <input type="text" name="add_title[header]" class="add-link-input"
                                                    value="{{ $data->ad_title }}">
                                            </div>
                                        </div>
                                        <div class="row margin-top-40">
                                            <div class="col-md-12">
                                                <span class="bold"> ADVANCE USASE:</span> <br /><br />
                                                <span>If you leave the AdSense size boxes on Auto, the theme will
                                                    automatically resize
                                                    the
                                                    Google Ads.</span>
                                            </div>

                                            <div class="col-md-6 margin-top-40">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableDesktopHeader">DISABLE ON
                                                                DESKTOP</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_desktop[header]" type="checkbox"
                                                                id="disableDesktopHeader" {!! $data->disable_desktop == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-40">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="desktop_adsense[header]" class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->desktop_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableTabletLandscapeHeader">DISABLE ON
                                                                TABLET LANDSCAPE</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_tablet_landscape[header]" type="checkbox"
                                                                id="disableTabletLandscapeHeader" {!! $data->disable_tablet_landscape == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="tablet_landscape_adsense[header]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->tablet_landscape_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableTabletPortraitHeader">DISABLE ON
                                                                TABLET PORTRAIT</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_tablet_portrait[header]" type="checkbox"
                                                                id="disableTabletPortraitHeader" {!! $data->disable_tablet_portrait == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="tablet_portrait_adsense[header]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->tablet_portrait_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disablePhoneHeader">DISABLE ON
                                                                PHONE</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_phone[header]" type="checkbox"
                                                                id="disablePhoneHeader" {!! $data->disable_phone == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="phone_adsense[header]" class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->phone_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="card">
                        <div class="card-header" id="headingheader">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#headerAd"
                                    aria-expanded="true" aria-controls="headerAd">
                                    Header Ad
                                </button>
                            </h5>
                        </div>


                        <div id="headerAd" class="collapse" aria-labelledby="headingheader" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row margin-top-20">

                                    <input type="hidden" name="ad_type[]" value="header">

                                    <div class="col-md-3">
                                        <span class="bold"> Your Header Ad</span> <br /><br />
                                        <span>Paste your ad code here. Google AdSense will be made responsive
                                            automatically.</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <textarea name="add_link[header]" class="add-link-input" cols="85"
                                            rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="row margin-top-10">
                                    <div class="col-md-3">
                                        <span class="bold"> Ad Title :</span> <br /><br />
                                        <span>A title for the Ad, like - Advertisement - if you leave it blank the ad spot
                                            will
                                            not
                                            have a title.</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <input type="text" name="add_title[header]" class="add-link-input">
                                    </div>
                                </div>
                                <div class="row margin-top-40">
                                    <div class="col-md-12">
                                        <span class="bold"> ADVANCE USASE:</span> <br /><br />
                                        <span>If you leave the AdSense size boxes on Auto, the theme will automatically
                                            resize
                                            the
                                            Google Ads.</span>
                                    </div>

                                    <div class="col-md-6 margin-top-40">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold" for="disableDesktopHeader">DISABLE
                                                        ON
                                                        DESKTOP</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_desktop[header]" type="checkbox"
                                                        id="disableDesktopHeader">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-40">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="desktop_adsense[header]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disableTabletLandscapeHeader">DISABLE ON
                                                        TABLET LANDSCAPE</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_tablet_landscape[header]" type="checkbox"
                                                        id="disableTabletLandscapeHeader">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="tablet_landscape_adsense[header]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disableTabletPortraitHeader">DISABLE ON
                                                        TABLET PORTRAIT</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_tablet_portrait[header]" type="checkbox"
                                                        id="disableTabletPortraitHeader">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="tablet_portrait_adsense[header]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold" for="disablePhoneHeader">DISABLE
                                                        ON
                                                        PHONE</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_phone[header]" type="checkbox"
                                                        id="disablePhoneHeader">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="phone_adsense[header]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- End:: Header Add --}}

                {{-- Start:: After Category Add --}}
                @if (!$target->isEmpty())
                    @foreach ($target as $data)
                        @if ($data->ad_type == 'after_category')
                            <div class="card margin-top-20">
                                <div class="card-header" id="headingAfterCategory">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#afterCategoryAd" aria-expanded="false" aria-controls="afterCategoryAd">
                                            After Category Ad
                                        </button>
                                    </h5>
                                </div>
                                <div id="afterCategoryAd" class="collapse" aria-labelledby="headingAfterCategory"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row margin-top-20">
                                            <input type="hidden" name="ad_type[]" value="after_category">

                                            <div class="col-md-3">
                                                <span class="bold"> Your After Category Ad</span> <br /><br />
                                                <span>Paste your ad code here. Google AdSense will be made responsive
                                                    automatically.</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <textarea name="add_link[after_category]" class="add-link-input" cols="85"
                                                    rows="10">{{ $data->ad_link }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row margin-top-10">
                                            <div class="col-md-3">
                                                <span class="bold"> Ad Title :</span> <br /><br />
                                                <span>A title for the Ad, like - Advertisement - if you leave it blank the
                                                    ad spot will
                                                    not
                                                    have a title.</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <input type="text" name="add_title[after_category]" class="add-link-input"
                                                value="{{ $data->ad_title }}">
                                            </div>
                                        </div>
                                        <div class="row margin-top-20">
                                            <div class="col-md-3">
                                                <span class="bold"> Show Add (Per Category) :</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <input type="number" name="show_per_video_category[after_category]" class="add-link-input"
                                                value="{{ $data->show_per_video_category }}">
                                            </div>
                                        </div>
                                        <div class="row margin-top-40">
                                            <div class="col-md-12">
                                                <span class="bold"> ADVANCE USASE:</span> <br /><br />
                                                <span>If you leave the AdSense size boxes on Auto, the theme will
                                                    automatically resize
                                                    the
                                                    Google Ads.</span>
                                            </div>

                                            <div class="col-md-6 margin-top-40">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableDesktopAfterCategory">DISABLE ON
                                                                DESKTOP</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_desktop[after_category]" type="checkbox"
                                                                id="disableDesktopAfterCategory" {!! $data->disable_desktop == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-40">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="desktop_adsense[after_category]" class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->desktop_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableTabletLandscapeAfterCategory">DISABLE ON
                                                                TABLET LANDSCAPE</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_tablet_landscape[after_category]" type="checkbox"
                                                                id="disableTabletLandscapeAfterCategory" {!! $data->disable_tablet_landscape == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="tablet_landscape_adsense[after_category]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->tablet_landscape_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableTabletPortraitAfterCategory">DISABLE ON
                                                                TABLET PORTRAIT</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_tablet_portrait[after_category]" type="checkbox"
                                                                id="disableTabletPortraitAfterCategory" {!! $data->disable_tablet_portrait == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="tablet_portrait_adsense[after_category]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->tablet_portrait_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disablePhoneAfterCategory">DISABLE ON
                                                                PHONE</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_phone[after_category]" type="checkbox"
                                                                id="disablePhoneAfterCategory" {!! $data->disable_phone == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="phone_adsense[after_category]" class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->phone_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="card margin-top-20">
                        <div class="card-header" id="headingAfterCategory">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#afterCategoryAd" aria-expanded="false" aria-controls="afterCategoryAd">
                                    After Category Ad
                                </button>
                            </h5>
                        </div>
                        <div id="afterCategoryAd" class="collapse" aria-labelledby="headingAfterCategory"
                            data-parent="#accordion">
                            <div class="card-body">
                                <div class="row margin-top-20">

                                    <input type="hidden" name="ad_type[]" value="after_category">

                                    <div class="col-md-3">
                                        <span class="bold"> Your After Category Ad</span> <br /><br />
                                        <span>Paste your ad code here. Google AdSense will be made responsive
                                            automatically.</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <textarea name="add_link[after_category]" class="add-link-input" cols="85"
                                            rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="row margin-top-10">
                                    <div class="col-md-3">
                                        <span class="bold"> Ad Title :</span> <br /><br />
                                        <span>A title for the Ad, like - Advertisement - if you leave it blank the ad spot
                                            will
                                            not
                                            have a title.</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <input type="text" name="add_title[after_category]" class="add-link-input">
                                    </div>
                                </div>
                                <div class="row margin-top-20">
                                    <div class="col-md-3">
                                        <span class="bold"> Show Add (Per Category) :</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <input type="number" name="show_per_video_category[after_category]" class="add-link-input">
                                    </div>
                                </div>
                                <div class="row margin-top-40">
                                    <div class="col-md-12">
                                        <span class="bold"> ADVANCE USASE:</span> <br /><br />
                                        <span>If you leave the AdSense size boxes on Auto, the theme will automatically
                                            resize
                                            the
                                            Google Ads.</span>
                                    </div>

                                    <div class="col-md-6 margin-top-40">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disableDesktopAfterCategory">DISABLE ON
                                                        DESKTOP</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_desktop[after_category]" type="checkbox"
                                                        id="disableDesktopAfterCategory">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-40">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="desktop_adsense[after_category]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disableTabletLandscapeAfterCategory">DISABLE ON
                                                        TABLET LANDSCAPE</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_tablet_landscape[after_category]" type="checkbox"
                                                        id="disableTabletLandscapeAfterCategory">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="tablet_landscape_adsense[after_category]"
                                                        class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disableTabletPortraitAfterCategory">DISABLE ON
                                                        TABLET PORTRAIT</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_tablet_portrait[after_category]" type="checkbox"
                                                        id="disableTabletPortraitAfterCategory">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="tablet_portrait_adsense[after_category]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold" for="disablePhoneAfterCategory">DISABLE
                                                        ON
                                                        PHONE</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_phone[after_category]" type="checkbox"
                                                        id="disablePhoneAfterCategory">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="phone_adsense[after_category]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- End:: After Category Add --}}

                {{-- Start:: Native You may also Like Add --}}
                @if (!$target->isEmpty())
                    @foreach ($target as $data)
                        @if ($data->ad_type == 'native_like')
                            <div class="card margin-top-20">
                                <div class="card-header" id="headingnativeLike">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#nativeLikeAd" aria-expanded="false" aria-controls="nativeLikeAd">
                                            Native Video Ad (for you may also like)
                                        </button>
                                    </h5>
                                </div>
                                <div id="nativeLikeAd" class="collapse" aria-labelledby="headingnativeLike"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row margin-top-20">

                                            <input type="hidden" name="ad_type[]" value="native_like">

                                            <div class="col-md-3">
                                                <span class="bold"> Your Native Ad(for you may also like)</span>
                                                <br /><br />
                                                <span>Paste your ad code here. Google AdSense will be made responsive
                                                    automatically.</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <textarea name="add_link[native_like]" class="add-link-input" cols="85"
                                                    rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="row margin-top-10">
                                            <div class="col-md-3">
                                                <span class="bold"> Ad Title :</span> <br /><br />
                                                <span>A title for the Ad, like - Advertisement - if you leave it blank the
                                                    ad spot will
                                                    not
                                                    have a title.</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <input type="text" name="add_title[native_like]" class="add-link-input">
                                            </div>
                                        </div>
                                        <div class="row margin-top-40">
                                            <div class="col-md-12">
                                                <span class="bold"> ADVANCE USASE:</span> <br /><br />
                                                <span>If you leave the AdSense size boxes on Auto, the theme will
                                                    automatically resize
                                                    the
                                                    Google Ads.</span>
                                            </div>

                                            <div class="col-md-6 margin-top-40">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableDesktopnativelike">DISABLE
                                                                ON
                                                                DESKTOP</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_desktop[native_like]" type="checkbox"
                                                                id="disableDesktopnativelike" {!! $data->disable_desktop == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-40">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="desktop_adsense[native_like]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->desktop_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableTabletLandscapenative_like">DISABLE ON
                                                                TABLET LANDSCAPE</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_tablet_landscape[native_like]" type="checkbox"
                                                                id="disableTabletLandscapenative_like"
                                                                {!! $data->disable_tablet_landscape == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="tablet_landscape_adsense[native_like]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->tablet_landscape_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableTabletPortraitnative_like">DISABLE ON
                                                                TABLET PORTRAIT</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_tablet_portrait[native_like]" type="checkbox"
                                                                id="disableTabletPortraitnative_like"
                                                                {!! $data->disable_tablet_portrait == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="tablet_portrait_adsense[native_like]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->tablet_portrait_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disablePhonenative_like">DISABLE
                                                                ON
                                                                PHONE</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_phone[native_like]" type="checkbox"
                                                                id="disablePhonenative_like" {!! $data->disable_phone == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="phone_adsense[native_like]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->phone_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="card margin-top-20">
                        <div class="card-header" id="headingnativeLike">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#nativeLikeAd" aria-expanded="false" aria-controls="nativeLikeAd">
                                    Native Video Ad (for you may also like)
                                </button>
                            </h5>
                        </div>
                        <div id="nativeLikeAd" class="collapse" aria-labelledby="headingnativeLike"
                            data-parent="#accordion">
                            <div class="card-body">
                                <div class="row margin-top-20">

                                    <input type="hidden" name="ad_type[]" value="native_like">

                                    <div class="col-md-3">
                                        <span class="bold"> Your Native Ad(for you may also like)</span>
                                        <br /><br />
                                        <span>Paste your ad code here. Google AdSense will be made responsive
                                            automatically.</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <textarea name="add_link[native_like]" class="add-link-input" cols="85"
                                            rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="row margin-top-10">
                                    <div class="col-md-3">
                                        <span class="bold"> Ad Title :</span> <br /><br />
                                        <span>A title for the Ad, like - Advertisement - if you leave it blank the ad spot
                                            will
                                            not
                                            have a title.</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <input type="text" name="add_title[native_like]" class="add-link-input">
                                    </div>
                                </div>
                                <div class="row margin-top-40">
                                    <div class="col-md-12">
                                        <span class="bold"> ADVANCE USASE:</span> <br /><br />
                                        <span>If you leave the AdSense size boxes on Auto, the theme will automatically
                                            resize
                                            the
                                            Google Ads.</span>
                                    </div>

                                    <div class="col-md-6 margin-top-40">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disableDesktopnativelike">DISABLE
                                                        ON
                                                        DESKTOP</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_desktop[native_like]" type="checkbox"
                                                        id="disableDesktopnativelike">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-40">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="desktop_adsense[native_like]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disableTabletLandscapenative_like">DISABLE ON
                                                        TABLET LANDSCAPE</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_tablet_landscape[native_like]" type="checkbox"
                                                        id="disableTabletLandscapenative_like">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="tablet_landscape_adsense[native_like]"
                                                        class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disableTabletPortraitnative_like">DISABLE ON
                                                        TABLET PORTRAIT</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_tablet_portrait[native_like]" type="checkbox"
                                                        id="disableTabletPortraitnative_like">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="tablet_portrait_adsense[native_like]"
                                                        class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disablePhonenative_like">DISABLE
                                                        ON
                                                        PHONE</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_phone[native_like]" type="checkbox"
                                                        id="disablePhonenative_like">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="phone_adsense[native_like]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- End:: Native You may also Like Add --}}

                {{-- Start:: Native Series Add --}}
                @if (!$target->isEmpty())
                    @foreach ($target as $data)
                        @if ($data->ad_type == 'native_series')
                            <div class="card margin-top-20">
                                <div class="card-header" id="headingnativeSeries">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#nativeSeriesAd" aria-expanded="false"
                                            aria-controls="nativeSeriesAd">
                                            Native Video Ad (for series video)
                                        </button>
                                    </h5>
                                </div>
                                <div id="nativeSeriesAd" class="collapse" aria-labelledby="headingnativeSeries"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row margin-top-20">

                                            <input type="hidden" name="ad_type[]" value="native_series">

                                            <div class="col-md-3">
                                                <span class="bold"> Your Native Ad (for series video)</span>
                                                <br /><br />
                                                <span>Paste your ad code here. Google AdSense will be made responsive
                                                    automatically.</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <textarea name="add_link[native_series]" class="add-link-input" cols="85"
                                                    rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="row margin-top-10">
                                            <div class="col-md-3">
                                                <span class="bold"> Ad Title :</span> <br /><br />
                                                <span>A title for the Ad, like - Advertisement - if you leave it blank the
                                                    ad spot will
                                                    not
                                                    have a title.</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <input type="text" name="add_title[native_series]" class="add-link-input">
                                            </div>
                                        </div>
                                        <div class="row margin-top-40">
                                            <div class="col-md-12">
                                                <span class="bold"> ADVANCE USASE:</span> <br /><br />
                                                <span>If you leave the AdSense size boxes on Auto, the theme will
                                                    automatically resize
                                                    the
                                                    Google Ads.</span>
                                            </div>

                                            <div class="col-md-6 margin-top-40">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableDesktopnative_series">DISABLE ON
                                                                DESKTOP</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_desktop[native_series]" type="checkbox"
                                                                id="disableDesktopnative_series" {!! $data->disable_desktop == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-40">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="desktop_adsense[native_series]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->desktop_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableTabletLandscapenative_series">DISABLE ON
                                                                TABLET LANDSCAPE</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_tablet_landscape[native_series]"
                                                                type="checkbox" id="disableTabletLandscapenative_series"
                                                                {!! $data->disable_tablet_landscape == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="tablet_landscape_adsense[native_series]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->tablet_landscape_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableTabletPortraitnative_series">DISABLE ON
                                                                TABLET PORTRAIT</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_tablet_portrait[native_series]"
                                                                type="checkbox" id="disableTabletPortraitnative_series"
                                                                {!! $data->disable_tablet_portrait == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="tablet_portrait_adsense[native_series]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->tablet_portrait_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disablePhonenative_series">DISABLE ON
                                                                PHONE</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_phone[native_series]" type="checkbox"
                                                                id="disablePhonenative_series" {!! $data->disable_phone == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="phone_adsense[native_series]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->phone_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="card margin-top-20">
                        <div class="card-header" id="headingnativeSeries">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#nativeSeriesAd" aria-expanded="false" aria-controls="nativeSeriesAd">
                                    Native Video Ad (for series video)
                                </button>
                            </h5>
                        </div>
                        <div id="nativeSeriesAd" class="collapse" aria-labelledby="headingnativeSeries"
                            data-parent="#accordion">
                            <div class="card-body">
                                <div class="row margin-top-20">

                                    <input type="hidden" name="ad_type[]" value="native_series">

                                    <div class="col-md-3">
                                        <span class="bold"> Your Native Ad (for series video)</span> <br /><br />
                                        <span>Paste your ad code here. Google AdSense will be made responsive
                                            automatically.</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <textarea name="add_link[native_series]" class="add-link-input" cols="85"
                                            rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="row margin-top-10">
                                    <div class="col-md-3">
                                        <span class="bold"> Ad Title :</span> <br /><br />
                                        <span>A title for the Ad, like - Advertisement - if you leave it blank the ad spot
                                            will
                                            not
                                            have a title.</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <input type="text" name="add_title[native_series]" class="add-link-input">
                                    </div>
                                </div>
                                <div class="row margin-top-40">
                                    <div class="col-md-12">
                                        <span class="bold"> ADVANCE USASE:</span> <br /><br />
                                        <span>If you leave the AdSense size boxes on Auto, the theme will automatically
                                            resize
                                            the
                                            Google Ads.</span>
                                    </div>

                                    <div class="col-md-6 margin-top-40">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disableDesktopnative_series">DISABLE ON
                                                        DESKTOP</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_desktop[native_series]" type="checkbox"
                                                        id="disableDesktopnative_series">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-40">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="desktop_adsense[native_series]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disableTabletLandscapenative_series">DISABLE ON
                                                        TABLET LANDSCAPE</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_tablet_landscape[native_series]" type="checkbox"
                                                        id="disableTabletLandscapenative_series">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="tablet_landscape_adsense[native_series]"
                                                        class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disableTabletPortraitnative_series">DISABLE ON
                                                        TABLET PORTRAIT</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_tablet_portrait[native_series]" type="checkbox"
                                                        id="disableTabletPortraitnative_series">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="tablet_portrait_adsense[native_series]"
                                                        class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disablePhonenative_series">DISABLE ON
                                                        PHONE</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_phone[native_series]" type="checkbox"
                                                        id="disablePhonenative_series">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="phone_adsense[native_series]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- End:: Native Series Add --}}

                {{-- Start:: Popup Add --}}
                @if (!$target->isEmpty())
                    @foreach ($target as $data)
                        @if ($data->ad_type == 'popup')
                            <div class="card margin-top-20">
                                <div class="card-header" id="headingPopup">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#popupAd" aria-expanded="false" aria-controls="popupAd">
                                            Popup Ad
                                        </button>
                                    </h5>
                                </div>
                                <div id="popupAd" class="collapse" aria-labelledby="headingPopup"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row margin-top-20">

                                            <input type="hidden" name="ad_type[]" value="popup">

                                            <div class="col-md-3">
                                                <span class="bold"> Your Popup Ad</span> <br /><br />
                                                <span>Paste your ad code here. Google AdSense will be made responsive
                                                    automatically.</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <textarea name="add_link[popup]" class="add-link-input" cols="85"
                                                    rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="row margin-top-10">
                                            <div class="col-md-3">
                                                <span class="bold"> Ad Title :</span> <br /><br />
                                                <span>A title for the Ad, like - Advertisement - if you leave it blank the
                                                    ad spot will
                                                    not
                                                    have a title.</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <input type="text" name="add_title[popup]" class="add-link-input">
                                            </div>
                                        </div>
                                        <div class="row margin-top-40">
                                            <div class="col-md-12">
                                                <span class="bold"> ADVANCE USASE:</span> <br /><br />
                                                <span>If you leave the AdSense size boxes on Auto, the theme will
                                                    automatically resize
                                                    the
                                                    Google Ads.</span>
                                            </div>

                                            <div class="col-md-6 margin-top-40">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableDesktoppopup">DISABLE ON
                                                                DESKTOP</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_desktop[popup]" type="checkbox"
                                                                id="disableDesktoppopup" {!! $data->disable_desktop == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-40">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="desktop_adsense[popup]" class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->desktop_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableTabletLandscapepopup">DISABLE ON
                                                                TABLET LANDSCAPE</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_tablet_landscape[popup]" type="checkbox"
                                                                id="disableTabletLandscapepopup" {!! $data->disable_tablet_landscape == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="tablet_landscape_adsense[popup]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->tablet_landscape_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableTabletPortraitpopup">DISABLE ON
                                                                TABLET PORTRAIT</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_tablet_portrait[popup]" type="checkbox"
                                                                id="disableTabletPortraitpopup" {!! $data->disable_tablet_portrait == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="tablet_portrait_adsense[popup]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->tablet_portrait_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disablePhonepopup">DISABLE ON
                                                                PHONE</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_phone[popup]" type="checkbox"
                                                                id="disablePhonepopup" {!! $data->disable_phone == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="phone_adsense[popup]" class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->phone_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="card margin-top-20">
                        <div class="card-header" id="headingPopup">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#popupAd" aria-expanded="false" aria-controls="popupAd">
                                    Popup Ad
                                </button>
                            </h5>
                        </div>
                        <div id="popupAd" class="collapse" aria-labelledby="headingPopup" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row margin-top-20">

                                    <input type="hidden" name="ad_type[]" value="popup">

                                    <div class="col-md-3">
                                        <span class="bold"> Your Popup Ad</span> <br /><br />
                                        <span>Paste your ad code here. Google AdSense will be made responsive
                                            automatically.</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <textarea name="add_link[popup]" class="add-link-input" cols="85"
                                            rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="row margin-top-10">
                                    <div class="col-md-3">
                                        <span class="bold"> Ad Title :</span> <br /><br />
                                        <span>A title for the Ad, like - Advertisement - if you leave it blank the ad spot
                                            will
                                            not
                                            have a title.</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <input type="text" name="add_title[popup]" class="add-link-input">
                                    </div>
                                </div>
                                <div class="row margin-top-40">
                                    <div class="col-md-12">
                                        <span class="bold"> ADVANCE USASE:</span> <br /><br />
                                        <span>If you leave the AdSense size boxes on Auto, the theme will automatically
                                            resize
                                            the
                                            Google Ads.</span>
                                    </div>

                                    <div class="col-md-6 margin-top-40">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold" for="disableDesktoppopup">DISABLE
                                                        ON
                                                        DESKTOP</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_desktop[popup]" type="checkbox"
                                                        id="disableDesktoppopup">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-40">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="desktop_adsense[popup]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disableTabletLandscapepopup">DISABLE ON
                                                        TABLET LANDSCAPE</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_tablet_landscape[popup]" type="checkbox"
                                                        id="disableTabletLandscapepopup">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="tablet_landscape_adsense[popup]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disableTabletPortraitpopup">DISABLE ON
                                                        TABLET PORTRAIT</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_tablet_portrait[popup]" type="checkbox"
                                                        id="disableTabletPortraitpopup">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="tablet_portrait_adsense[popup]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold" for="disablePhonepopup">DISABLE ON
                                                        PHONE</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_phone[popup]" type="checkbox" id="disablePhonepopup">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="phone_adsense[popup]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- End:: Popup Add --}}

                {{-- Start:: Custom Add --}}
                @if (!$target->isEmpty())
                    @foreach ($target as $data)
                        @if ($data->ad_type == 'custom')
                            <div class="card margin-top-20">
                                <div class="card-header" id="headingCustom">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#customAd" aria-expanded="false" aria-controls="customAd">
                                            Custom Ad
                                        </button>
                                    </h5>
                                </div>
                                <div id="customAd" class="collapse" aria-labelledby="headingCustom"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row margin-top-20">

                                            <input type="hidden" name="ad_type[]" value="custom">

                                            <div class="col-md-3">
                                                <span class="bold"> Your Custom Ad</span> <br /><br />
                                                <span>Paste your ad code here. Google AdSense will be made responsive
                                                    automatically.</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <textarea name="add_link[custom]" class="add-link-input" cols="85"
                                                    rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="row margin-top-10">
                                            <div class="col-md-3">
                                                <span class="bold"> Ad Title :</span> <br /><br />
                                                <span>A title for the Ad, like - Advertisement - if you leave it blank the
                                                    ad spot will
                                                    not
                                                    have a title.</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <input type="text" name="add_title[custom]" class="add-link-input">
                                            </div>
                                        </div>
                                        <div class="row margin-top-40">
                                            <div class="col-md-12">
                                                <span class="bold"> ADVANCE USASE:</span> <br /><br />
                                                <span>If you leave the AdSense size boxes on Auto, the theme will
                                                    automatically resize
                                                    the
                                                    Google Ads.</span>
                                            </div>

                                            <div class="col-md-6 margin-top-40">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableDesktopcustom">DISABLE ON
                                                                DESKTOP</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_desktop[custom]" type="checkbox"
                                                                id="disableDesktopcustom" {!! $data->disable_desktop == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-40">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="desktop_adsense[custom]" class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->desktop_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableTabletLandscapecustom">DISABLE ON
                                                                TABLET LANDSCAPE</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_tablet_landscape[custom]" type="checkbox"
                                                                id="disableTabletLandscapecustom" {!! $data->disable_tablet_landscape == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="tablet_landscape_adsense[custom]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->tablet_landscape_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableTabletPortraitcustom">DISABLE ON
                                                                TABLET PORTRAIT</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_tablet_portrait[custom]" type="checkbox"
                                                                id="disableTabletPortraitcustom" {!! $data->disable_tablet_portrait == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="tablet_portrait_adsense[custom]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->tablet_portrait_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disablePhonecustom">DISABLE ON
                                                                PHONE</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_phone[custom]" type="checkbox"
                                                                id="disablePhonecustom" {!! $data->disable_phone == 'on' ? 'checked' : '' !!}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="phone_adsense[custom]" class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                @if (!empty($adsenseSizeArr))
                                                                    @foreach ($adsenseSizeArr as $size)
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->phone_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option {{ $selected }}>{{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="card margin-top-20">
                        <div class="card-header" id="headingCustom">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#customAd" aria-expanded="false" aria-controls="customAd">
                                    Custom Ad
                                </button>
                            </h5>
                        </div>
                        <div id="customAd" class="collapse" aria-labelledby="headingCustom" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row margin-top-20">

                                    <input type="hidden" name="ad_type[]" value="custom">

                                    <div class="col-md-3">
                                        <span class="bold"> Your Custom Ad</span> <br /><br />
                                        <span>Paste your ad code here. Google AdSense will be made responsive
                                            automatically.</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <textarea name="add_link[custom]" class="add-link-input" cols="85"
                                            rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="row margin-top-10">
                                    <div class="col-md-3">
                                        <span class="bold"> Ad Title :</span> <br /><br />
                                        <span>A title for the Ad, like - Advertisement - if you leave it blank the ad spot
                                            will
                                            not
                                            have a title.</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <input type="text" name="add_title[custom]" class="add-link-input">
                                    </div>
                                </div>
                                <div class="row margin-top-40">
                                    <div class="col-md-12">
                                        <span class="bold"> ADVANCE USASE:</span> <br /><br />
                                        <span>If you leave the AdSense size boxes on Auto, the theme will automatically
                                            resize
                                            the
                                            Google Ads.</span>
                                    </div>

                                    <div class="col-md-6 margin-top-40">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold" for="disableDesktopcustom">DISABLE
                                                        ON
                                                        DESKTOP</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_desktop[custom]" type="checkbox"
                                                        id="disableDesktopcustom">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-40">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="desktop_adsense[custom]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disableTabletLandscapecustom">DISABLE ON
                                                        TABLET LANDSCAPE</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_tablet_landscape[custom]" type="checkbox"
                                                        id="disableTabletLandscapecustom">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="tablet_landscape_adsense[custom]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disableTabletPortraitcustom">DISABLE ON
                                                        TABLET PORTRAIT</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_tablet_portrait[custom]" type="checkbox"
                                                        id="disableTabletPortraitcustom">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="tablet_portrait_adsense[custom]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold" for="disablePhonecustom">DISABLE
                                                        ON
                                                        PHONE</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_phone[custom]" type="checkbox"
                                                        id="disablePhonecustom">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="phone_adsense[custom]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        @if (!empty($adsenseSizeArr))
                                                            @foreach ($adsenseSizeArr as $size)
                                                                <option>{{ $size }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- End:: Custom Add --}}
                <div class="col-md-12 actions margin-top-20 text-center">
                    <button type="submit" class="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
    {{-- End::Content Body --}}


@stop
@push('custom-js')
    <script type="text/javascript"></script>
@endpush
