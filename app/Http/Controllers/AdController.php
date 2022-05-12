<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MobileAd;
use App\Models\WebAd;
use Illuminate\Http\Request;
use Response;
use Session;

class AdController extends Controller
{
    public function mobileAd(Request $request)
    {
        $target = MobileAd::get();
        return view('advertisement.mobileAd')->with(compact('target'));
    }

    public function mobileAdUpdate(Request $request)
    {
        try {
            if (auth()->user()->email !== "demoadmin@gmail.com") {
                $data = $target = [];
                if (!empty($request->banner_image)) {
                    $image     = $request->banner_image['custom'];
                    $imageName = time() . '.' . $image->getClientOriginalName();
    
                    if (config('app.env') === 'production') {
                        $image->move('uploads/ad', $imageName);
                    } else {
                        $image->move(public_path('/uploads/ad'), $imageName);
                    }
                    $protocol = request()->secure() ? 'https://' : 'http://';
                    $fileName = $protocol.$_SERVER['HTTP_HOST'].'/uploads/ad/'.$imageName;
                    $data['custom']['banner_image'] = $fileName;
                }
                if (!empty($request->interesticial_image)) {
                    $image     = $request->interesticial_image['custom'];
                    $imageName = time() . '.' . $image->getClientOriginalName();
    
                    if (config('app.env') === 'production') {
                        $image->move('uploads/ad', $imageName);
                    } else {
                        $image->move(public_path('/uploads/ad'), $imageName);
                    }
                    $protocol = request()->secure() ? 'https://' : 'http://';
                    $fileName = $protocol.$_SERVER['HTTP_HOST'].'/uploads/ad/'.$imageName;
    
                    $data['custom']['interesticial_image'] = $fileName;
                }
                if (!empty($request->native_image)) {
                    $image     = $request->native_image['custom'];
                    $imageName = time() . '.' . $image->getClientOriginalName();
                    if (config('app.env') === 'production') {
                        $image->move('uploads/ad', $imageName);
                    } else {
                        $image->move(public_path('/uploads/ad'), $imageName);
                    }
                    $protocol = request()->secure() ? 'https://' : 'http://';
                    $fileName = $protocol.$_SERVER['HTTP_HOST'].'/uploads/ad/'.$imageName;
    
                    $data['custom']['native_image'] = $fileName;
                }
    
                // dd($data);

                if (!empty($request->ad_type)) {
                    foreach ($request->ad_type as $adType) {
                        $data[$adType]['ad_type'] = $adType;
                        $data[$adType]['created_at'] = date('Y-m-d H:i:s');
                        $data[$adType]['updated_at'] = date('Y-m-d H:i:s');
                    }
                }
                if (!empty($request->google_status)) {
                    foreach ($request->google_status as $adType => $google) {
                        $data[$adType]['google_status'] = $google ?? '';
                    }
                }
                if (!empty($request->facebook_status)) {
                    foreach ($request->facebook_status as $adType => $facebook) {
                        $data[$adType]['facebook_status'] = $facebook ?? null;
                    }
                }
                if (!empty($request->custom_status)) {
                    foreach ($request->custom_status as $adType => $custom) {
                        $data[$adType]['custom_status'] = $custom ?? null;
                    }
                }
                if (!empty($request->startup_status)) {
                    foreach ($request->startup_status as $adType => $startup) {
                        $data[$adType]['startup_status'] = $startup ?? null;
                    }
                }
                if (!empty($request->banner_id)) {
                    foreach ($request->banner_id as $adType => $banner) {
                        $data[$adType]['banner_id'] = $banner ?? null;
                    }
                }
                if (!empty($request->banner_link)) {
                    foreach ($request->banner_link as $adType => $banlink) {
                        $data[$adType]['banner_link'] = $banlink ?? null;
                    }
                }
                if (!empty($request->interesticial_id)) {
                    foreach ($request->interesticial_id as $adType => $interesticial_id) {
                        $data[$adType]['interesticial_id'] = $interesticial_id ?? null;
                    }
                }
                if (!empty($request->interesticial_link)) {
                    foreach ($request->interesticial_link as $adType => $interesticial_link) {
                        $data[$adType]['interesticial_link'] = $interesticial_link ?? null;
                    }
                }
                if (!empty($request->interesticial_click)) {
                    foreach ($request->interesticial_click as $adType => $interesticial_click) {
                        $data[$adType]['interesticial_click'] = $interesticial_click ?? 0;
                    }
                }
                if (!empty($request->native_id)) {
                    foreach ($request->native_id as $adType => $native_id) {
                        $data[$adType]['native_id'] = $native_id ?? null;
                    }
                }
                if (!empty($request->native_link)) {
                    foreach ($request->native_link as $adType => $native_link) {
                        $data[$adType]['native_link'] = $native_link ?? null;
                    }
                }
                if (!empty($request->native_per_video)) {
                    foreach ($request->native_per_video as $adType => $native_per_video) {
                        $data[$adType]['native_per_video'] = $native_per_video ?? 0;
                    }
                }
                if (!empty($request->native_per_news)) {
                    foreach ($request->native_per_news as $adType => $native_per_news) {
                        $data[$adType]['native_per_news'] = $native_per_news ?? 0;
                    }
                }
                if (!empty($request->startup_id)) {
                    foreach ($request->startup_id as $adType => $startup_id) {
                        $data[$adType]['startup_id'] = $startup_id ?? null;
                    }
                }

                $prevImg = MobileAd::where('ad_type', 'custom')->first();

                if (!empty($data)) {
                    foreach ($data as $fieldName => $column) {
                        $target[$fieldName]['ad_type'] = $column['ad_type'];

                        $target[$fieldName]['google_status'] = $column['google_status'] ?? 'off';
                        $target[$fieldName]['facebook_status'] = $column['facebook_status'] ?? 'off';
                        $target[$fieldName]['custom_status'] = $column['custom_status'] ?? 'off';
                        $target[$fieldName]['startup_status'] = $column['startup_status'] ?? 'off';

                        $target[$fieldName]['banner_id'] = $column['banner_id'] ?? null;
                        $target[$fieldName]['banner_link'] = $column['banner_link'] ?? null;
                        $target[$fieldName]['banner_image'] = $column['banner_image'] ?? ((!empty($prevImg->banner_image) && ($fieldName == 'custom')) ? $prevImg->banner_image : null);

                        $target[$fieldName]['interesticial_id'] = $column['interesticial_id'] ?? null;
                        $target[$fieldName]['interesticial_link'] = $column['interesticial_link'] ?? null;
                        $target[$fieldName]['interesticial_image'] = $column['interesticial_image'] ?? ((!empty($prevImg->interesticial_image) && ($fieldName == 'custom')) ? $prevImg->interesticial_image : null);
                        $target[$fieldName]['interesticial_click'] = $column['interesticial_click'] ?? 0;

                        $target[$fieldName]['native_id'] = $column['native_id'] ?? null;
                        $target[$fieldName]['native_link'] = $column['native_link'] ?? null;
                        $target[$fieldName]['native_image'] = $column['native_image'] ?? ((!empty($prevImg->native_image) && ($fieldName == 'custom')) ? $prevImg->native_image : null);
                        $target[$fieldName]['native_per_news'] = $column['native_per_news'] ?? 0;
                        $target[$fieldName]['native_per_video'] = $column['native_per_video'] ?? 0;

                        $target[$fieldName]['startup_id'] = $column['startup_id'] ?? null;

                        $target[$fieldName]['created_at'] = $column['created_at'];
                        $target[$fieldName]['updated_at'] = $column['updated_at'];
                    }
                }

                // dd($target);
                $prev = MobileAd::first();
                if (!empty($prev)) {
                    MobileAd::truncate();
                }
                if (MobileAd::insert($target)) {
                    Session::flash('success', "Advertisement Updated Successfully!");
                    return redirect()->back();
                } else {
                    Session::flash('error', "Advertisement  Update Unsuccessfull!");
                    return redirect()->back();
                }

            } else {
                Session::flash('error', "Sorry You Are Demo User");
                return redirect()->back();
            }
        } catch (\Exception$e) {
            return response([
                'status' => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function webAd(Request $request)
    {
        $adsenseSizeArr = [
            '120*90', '120*240', '120*600', '125*125', '160*90', '160*600',
            '180*90', '180*150', '200*90', '200*200', '234*60', '250*250',
            '320*100', '300*250', '300*600', '300*1050', '320*50', '336*280',
            '360*300', '435*300', '468*15', '468*60', '640*165', '640*190',
            '640*300', '728*15', '728*90', '970*90', '970*250', '240*400-Regional ad size',
            '250*360-Regional ad size', '580*400-Regional ad size', '750*100-Regional ad size', '750*200-Regional ad size',
            '750*300-Regional ad size', '980*120-Regional ad size', '930*180-Regional ad size',
        ];
        $target = WebAd::get();
        return view('advertisement.webAd')->with(compact('target', 'adsenseSizeArr'));
    }

}