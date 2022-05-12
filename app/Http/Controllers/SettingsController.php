<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Setting;
use App\Models\SubCategory;
use App\Models\VideoSetting;
use File;
use Illuminate\Http\Request;
use Response;
use Session;
use Validator;

class SettingsController extends Controller
{
    public function basicSettings(Request $request)
    {
        $target = Setting::first();
        if($target){
            return view('settings.basicSettings')->with(compact('target'));
        }else{
            return view('settings.index');
        }
    }
    public function basicSettingsUpdate(Request $request)
    {
        try {
            // dd($request->all());

            $validate = Validator::make(request()->all(), [
                'system_name'    => 'required',
                'app_version'    => 'required',
                'mail_address'   => 'required',
                'developed_by'   => 'required',
                'copyright'      => 'required',
                'privacy_policy' => 'required',
                'terms_policy'   => 'required',
            ]);

            if ($validate->fails()) {
                return redirect('basic-settings')
                    ->withInput()
                    ->withErrors($validate);
            }

            if (!empty($request->file('logo'))) {
                $image     = $request->file('logo');
                $imageName = time() . '.' . $image->getClientOriginalName();
                if (config('app.env') === 'production') {
                    $image->move('uploads', $imageName);
                } else {
                    $image->move(public_path('/uploads'), $imageName);
                }
            }

            $target                 = Setting::first();
            $target->system_name    = $request->system_name ?? $target->system_name;
            $target->app_version    = $request->app_version ?? $target->app_version;
            $target->mail_address   = $request->mail_address ?? $target->mail_address;
            $target->update_app     = $request->update_app;
            $target->developed_by   = $request->developed_by ?? $target->developed_by;
            $target->facebook       = $request->facebook;
            $target->instagram      = $request->instagram;
            $target->twitter        = $request->twitter;
            $target->youtube        = $request->youtube;
            $target->copyright      = $request->copyright ?? $target->copyright;
            $target->logo           = $imageName ?? $target->logo;
            $target->description    = $request->description;
            $target->privacy_policy = $request->privacy_policy ?? $target->privacy_policy;
            $target->cookies_policy = $request->cookies_policy;
            $target->terms_policy   = $request->terms_policy ?? $target->terms_policy;
            if(auth()->user()->email !== "demoadmin@gmail.com") {
                if ($target->update()) {
                    Session::flash('success', "Basic Settings Updated Successfully!");
                    return redirect('admin/basic-settings');
                } else {
                    Session::flash('error', "Basic Settings  Update Unsuccessfull!");
                    return redirect('admin/basic-settings');
                }

            }else{
                Session::flash('error', "Sorry You Are Demo User");
                return redirect('admin/basic-settings');
            }

        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function basicSettingsCreate(Request $request)

    {
        try {
            // dd($request->all());

            $validate = Validator::make(request()->all(), [
                'system_name'    => 'required',
                'app_version'    => 'required',
                'mail_address'   => 'required',
                'developed_by'   => 'required',
                'copyright'      => 'required',
                'privacy_policy' => 'required',
                'terms_policy'   => 'required',
            ]);

            if ($validate->fails()) {
                return redirect('basic-settings')
                    ->withInput()
                    ->withErrors($validate);
            }

            if (!empty($request->file('logo'))) {
                $image     = $request->file('logo');
                $imageName = time() . '.' . $image->getClientOriginalName();
                $image->move(public_path('/uploads'), $imageName);
            }

            $target                 = new Setting;
            $target->system_name    = $request->system_name;
            $target->app_version    = $request->app_version;
            $target->mail_address   = $request->mail_address;
            $target->update_app     = $request->update_app;
            $target->developed_by   = $request->developed_by;
            $target->facebook       = $request->facebook;
            $target->instagram      = $request->instagram;
            $target->twitter        = $request->twitter;
            $target->youtube        = $request->youtube;
            $target->copyright      = $request->copyright;
            $target->logo           = $imageName ?? '';
            $target->description    = $request->description;
            $target->privacy_policy = $request->privacy_policy;
            $target->cookies_policy = $request->cookies_policy;
            $target->terms_policy   = $request->terms_policy;

            if ($target->save()) {
                Session::flash('success', "Basic Settings Create Successfully!");
                return redirect('basic-settings');
            } else {
                Session::flash('error', "Basic Settings  Create Unsuccessfull!");
                return redirect('basic-settings');
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function videoSettings(Request $request)
    {
        $target       = VideoSetting::where('show_page', 'home')->get();
        $categoryList = Category::where('status', 'active')->pluck('name', 'id')->toArray();
        // dd($categoryList);
        return view('settings.videoSettings')->with(compact('target', 'categoryList'));
    }
    public function getCategoryContent(Request $request)
    {
        $target   = VideoSetting::where('show_page', 'home')->get();
        $category = Category::where('id', $request->category_id)->first();
        // dd($category);
        $view = view('settings.getCategoryContent', compact('target', 'category'))->render();
        return response()->json(['html' => $view]);
    }

    public function videoSettingsCategory(Request $request)
    {
        $categoryList = Category::where('status', 'active')->pluck('name', 'id')->toArray();
        return view('settings.videoSettingsCategory')->with(compact('categoryList'));
    }

    public function getSettingsCategory(Request $request)
    {
        // dd($request->all());
        $category = Category::where('id', $request->category_id)->first();
        $target   = VideoSetting::where('show_page', '!=', 'home')
            ->where('category_id', $request->category_id)
            ->get();
        $subCategoryList = SubCategory::where('category_id', $request->category_id)
            ->where('status', 'active')
            ->pluck('name', 'id')->toArray();

        $view = view('settings.getSettingsCategory', compact('category', 'target', 'subCategoryList'))->render();
        return response()->json(['html' => $view]);
    }
    public function getSubCategoryContent(Request $request)
    {
        $subCategory = SubCategory::where('id', $request->sub_category_id)->first();
        // dd($category);
        $view = view('settings.getSubCategoryContent', compact('subCategory'))->render();
        return response()->json(['html' => $view]);
    }

    public function videoSettingsUpdate(Request $request)

    {
        try {
            // dd($request->all());

            $validate = Validator::make(request()->all(), [
                'system_name'    => 'required',
                'app_version'    => 'required',
                'mail_address'   => 'required',
                'developed_by'   => 'required',
                'copyright'      => 'required',
                'privacy_policy' => 'required',
                'terms_policy'   => 'required',
            ]);

            if ($validate->fails()) {
                return redirect('basic-settings')
                    ->withInput()
                    ->withErrors($validate);
            }

            if (!empty($request->file('logo'))) {
                $image     = $request->file('logo');
                $imageName = time() . '.' . $image->getClientOriginalName();

                if (config('app.env') === 'production') {
                    $image->move('uploads', $imageName);
                } else {
                    $image->move(public_path('/uploads'), $imageName);
                }

            }

            $target                 = new Setting;
            $target->system_name    = $request->system_name;
            $target->app_version    = $request->app_version;
            $target->mail_address   = $request->mail_address;
            $target->update_app     = $request->update_app;
            $target->developed_by   = $request->developed_by;
            $target->facebook       = $request->facebook;
            $target->instagram      = $request->instagram;
            $target->twitter        = $request->twitter;
            $target->youtube        = $request->youtube;
            $target->copyright      = $request->copyright;
            $target->logo           = $imageName ?? '';
            $target->description    = $request->description;
            $target->privacy_policy = $request->privacy_policy;
            $target->cookies_policy = $request->cookies_policy;
            $target->terms_policy   = $request->terms_policy;

            if ($target->save()) {
                Session::flash('success', "Basic Settings Create Successfully!");
                return redirect('basic-settings');
            } else {
                Session::flash('error', "Basic Settings  Create Unsuccessfull!");
                return redirect('basic-settings');
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }




}
