<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ManageNotification;
use App\Models\Notification;
use App\Models\User;
use Http;
use Illuminate\Http\Request;
use Response;
use Validator;

class NotificationController extends Controller
{

    public function index(Request $request)
    {
        try {
            $target = Notification::get();
            return response([
                'status' => 'success',
                'data'   => $target,
            ], 200);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {

            $access = User::where('id', auth()->id())->first();
            if ($access->user_role != 'admin') {
                return response([
                    'status'  => 'error',
                    'message' => 'You are not a Admin. Only amin can access this fuction.',
                ], 404);
            }

            $notification = Notification::where('id', $id)->first();
            if (empty($notification)) {
                return response([
                    'status'  => 'error',
                    'message' => 'No notification found.',
                ], 404);
            }
            $notification->delete();

            return response([
                'status'  => 'success',
                'message' => 'Notification Successfully Delete',
            ], 200);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function sendNotification(Request $request)
    {
//         dd($request->all());
        $api      = ManageNotification::where('notification_type', 'mobile')->first();
        $apiKey   = $api->api_key;
        $apiId    = $api->api_id;
        $validate = Validator::make(request()->all(), [
            'title' => 'required',
        ]);
        if ($validate->fails()) {
            return Response::json(['success' => false, 'heading' => 'Validation Error', 'message' => $validate->errors()], 422);
        }

        $notification                = new Notification;
        $notification->title         = $request->title;
        $notification->video_id      = $request->video_id ?? '';
        $notification->external_link = $request->external_link ?? '';
        $notification->description   = $request->description;
        $image                       = $request->file('image');
        $imageName                   = time() . '.' . $image->getClientOriginalName();
        $image->move(public_path('/uploads/country'), $imageName);
        $notification->image = $imageName ?? '';

        $notification->save();

        $content = array(
            "en" => $request->description,
        );
        $headings = array(
            "en" => $request->title, // title
        );

        $hashes_array = array();
        array_push($hashes_array, array(
            "id"   => "like-button",
            "text" => "Like",
            "icon" => "http://i.imgur.com/N8SN8ZS.png",
            "url"  => "https://yoursite.com",
        ));
        array_push($hashes_array, array(
            "id"   => "like-button-2",
            "text" => "Like2",
            "icon" => "http://i.imgur.com/N8SN8ZS.png",
            "url"  => "https://yoursite.com",
        ));
        $response = Http::withHeaders([
            'Content-Type'  => 'application/json; charset=utf-8',
            'Authorization' => 'Basic ' . $apiKey,
        ])->post('https://onesignal.com/api/v1/notifications', [
            'app_id'            => $apiId,
            'included_segments' => array(
                'Subscribed Users',
            ),
            // 'data'              => array(
            //     "foo" => "bar",
            // ),
            'headings'          => ['en' => $request->title],
            'contents'          => $content,
            'contents'          => $content,
            'url'               => 'www.google.com',
            // 'web_buttons'       => $hashes_array,
        ]);
        $jsonResponse = $response->json();
        if (array_key_exists('errors', $jsonResponse)) {
            return response([
                'status' => 'validate_errors',
                'data'   => $jsonResponse,
            ]);
        } else {
            return response([
                'status' => 'success',
                'data'   => $jsonResponse,
            ]);
        }
    }
}
