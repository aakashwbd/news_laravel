<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ManageNotification;
use App\Models\News;
use App\Models\Notification;
use File;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Response;
use Session;
use Validator;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        try {
            $target = Notification::leftJoin('news', 'news.id', 'notifications.news_id')
                ->select('news.title as video_title', 'notifications.created_at', 'notifications.description', 'notifications.id as notification_id')
                ->get();
            return view('notification.index')->with(compact('target'));
        } catch (\Exception$e) {
            return response([
                'status' => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function manageNotification(Request $request)
    {
        try {
            return view('notification.manageNotification');
        } catch (\Exception$e) {
            return response([
                'status' => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getMobileData(Request $request)
    {
        $target = ManageNotification::where('notification_type', $request->notification_type)->first();
        $view = view('notification.getMobileData', compact('target'))->render();
        return response()->json(['html' => $view]);
    }

    public function getWebData(Request $request)
    {
        $target = ManageNotification::where('notification_type', $request->notification_type)->first();
        $view = view('notification.getWebData', compact('target'))->render();
        return response()->json(['html' => $view]);
    }

    public function manageNotificationUpdate(Request $request)
    {
        try {
            // dd($request->all());

            if (auth()->user()->email !== "demoadmin@gmail.com") {
                $rules = [];
                if ($request->notification_type == 'mobile') {
                    $rules = [
                        'mobile_api_key' => 'required',
                        'mobile_api_id' => 'required',
                    ];
                }
                if ($request->notification_type == 'web') {
                    $rules = [
                        'web_api_key' => 'required',
                        'web_api_id' => 'required',
                    ];
                }
                $validate = Validator::make(request()->all(), $rules);
                if ($validate->fails()) {
                    return redirect('admin/notification/manage-notification')
                        ->withInput()
                        ->withErrors($validate);
                }

                $target = new ManageNotification;
                $target->notification_type = $request->notification_type;

                if ($request->notification_type == 'mobile') {
                    $target->api_key = $request->mobile_api_key;
                    $target->api_id = $request->mobile_api_id;
                }

                if ($request->notification_type == 'web') {
                    $target->api_key = $request->web_api_key;
                    $target->api_id = $request->web_api_id;
                }

                $prev = ManageNotification::where('notification_type', $request->notification_type)->first();
                if (!empty($prev)) {
                    $prev->delete();
                }

                if ($target->save()) {
                    Session::flash('success', "Manage Notification Updated Successfully!");
                    return redirect('admin/notification/manage-notification');
                } else {
                    Session::flash('error', "Manage Notification  Update Unsuccessfull!");
                    return redirect('admin/notification/manage-notification');
                }

            } else {
                Session::flash('error', "Sorry You Are Demo User");
                return redirect('admin/notification/manage-notification');
            }


        } catch (\Exception$e) {
            return response([
                'status' => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function create(Request $request)
    {
        $videoList = News::where('status', 'active')->pluck('title', 'id')->toArray();
        // $tvList    = TvChannel::where('status', 'active')->pluck('name', 'id')->toArray();
        $view = view('notification.create', compact('videoList'))->render();
        return response()->json(['html' => $view]);
    }

    public function store(Request $request)
    {
//        dd($request->all());
        try {
            $validate = Validator::make(request()->all(), [
                'title' => 'required',
                'status' => Rule::in(['active', 'inactive']),
            ]);

            if ($validate->fails()) {
                return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
            }
            $imageName = '';
            if (!empty($request->file('image'))) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalName();
                $image->move(public_path('/uploads/notification'), $imageName);
            }

            $target = new Notification;
            $target->title = $request->title;
            $target->description = $request->description;
            $target->image = $imageName ?? '';
            $target->news_id = $request->news_id;
            $target->external_link = $request->external_link;
            $target->status = 'active';

            if ($target->save()) {
                return Response::json(['success' => true], 200);
            }
        } catch (\Exception$e) {
            return response([
                'status' => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->email !== "demoadmin@gmail.com") {
            $target = Notification::find($id)->delete();
            return response([
                "status" => "success",
                "message" => "Item Successfully delete"
            ]);

        } else {
            return Response::json(['status' => "error", 'message' => 'Sorry You are demo user',], 422);
        }

//        return Redirect::back()->with('msg', 'Item Successfully Delete');
    }
}