<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\VideoNews;
use App\Models\VideoView;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Response;
use Validator;

class VideoNewsController extends Controller
{
    public function VedioNewsIndex(Request $request)
    {
        $searchText = $request->fil_search;
        $target = VideoNews::where('title', 'LIKE', '%' . $searchText . '%')->get();

//end filtering

        $newsId = [];
        if (!$target->isEmpty()) {
            foreach ($target as $date) {
                array_push($newsId, $date->id);

            }
        }
        $viewData = VideoView::whereIn('video_id', $newsId)
            ->select('video_id', DB::raw('count(*) as total'))
            ->groupBy('video_id')
            ->get();

        return view('video.index')->with(compact('target', 'viewData'));
    }

    public function VedioNewsCreate(Request $request)
    {
        return view('video.create');
        // return response()->json(['html' => $view]);
    }

    public function videoNewsStore(Request $request)
    {
        // dd($request->all());
        try {

            $validate = Validator::make(request()->all(), [
                'news_type'   => 'required',
                'title'       => 'required',
                'video_link'  => 'required',
                'description' => 'required',
                'image'       => 'required',
                'status'      => Rule::in(['active', 'inactive']),
            ]);
            if ($validate->fails()) {
                return Response::json(['success' => false, 'heading' => 'Validation Error', 'message' => $validate->errors()], 422);
            }
            $target              = new VideoNews;
            $target->news_type   = $request->news_type;
            $target->title       = $request->title;
            $target->description = $request->description;
            $target->video_link  = $request->video_link;
            $target->image       = $request->image;
            $target->status      = 'active';
            if(auth()->user()->email !== "demoadmin@gmail.com"){
                if ($target->save()) {
                    return Response::json(['success' => true], 200);
                }
            }else{
                return Response::json(['status' => "error", 'message' => 'Sorry You are demo user',],422);
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function managevideoApproval(Request $request)
    {

        if(auth()->user()->email !== "demoadmin@gmail.com") {
            $target         = VideoNews::where('id', $request->id)->first();
            $target->status = $request->status;
            if ($target->update()) {
                return Response::json(['success' => true], 200);
            }
        }else {
            return Response::json(['status' => "error", 'message' => 'Sorry You are demo user',], 422);
        }
            // dd($request->all());

    }

    public function fileUploader(Request $request)
    {
        $validate = Validator::make(request()->only('file'), [
            'file' => 'required|max:10240',
        ]);
        if ($validate->fails()) {
            return response([
                'status' => 'validation_error',
                'data'   => $validate->errors(),
            ], 422);
        }
        try {
            if (request()->has('file')) {
                $folder    = $request->folder ?? 'all';
                $image     = $request->file('file');
                $imageName = $folder . "/" . time() . '.' . $image->getClientOriginalName();

                if (config('app.env') === 'production') {
                    $image->move('uploads/' . $folder, $imageName);
                } else {
                    $image->move(public_path('/uploads/' . $folder), $imageName);
                }
                $protocol = request()->secure();

                return response([
                    'status'  => 'success',
                    'message' => 'File uploaded successfully',
                    'data'    => $protocol ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . '/uploads/' . $imageName,
                ], 200);
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function videoNewsEdit($id)
    {

        $target = VideoNews::where('id', $id)->first();
        // dd($categoryList);

        return view('video.edit', compact('target'));
    }

    public function newsUpdate(Request $request)
    {

        try {

            $validate = Validator::make(request()->all(), [
                'title'       => 'required',
                'video_link'  => 'required',
                'description' => 'required',
                'status'      => Rule::in(['active', 'inactive']),
            ]);
            if ($validate->fails()) {
                return Response::json(['success' => false, 'heading' => 'Validation Error', 'message' => $validate->errors()], 422);
            }

            $target              = VideoNews::where('id', $request->id)->first();
            $target->news_type   = $request->news_type;
            $target->title       = $request->title ?? $target->title;
            $target->video_link  = $request->video_link ?? $target->video_link;
            $target->description = $request->description ?? $target->description;
            $target->image       = $request->imageEdit ?? $target->image;
            if(auth()->user()->email !== "demoadmin@gmail.com"){
                if ($target->update()) {
                    return Response::json(['success' => true], 200);
                }
            }else{
                return Response::json(['status' => "error", 'message' => 'Sorry You are demo user',],422);
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function videoFilter(Request $request)
    {
        $url = 'fil_search=' . urlencode($request->fil_search);
        return Redirect::to('admin/video?' . $url);
    }

    //destroy
    public function destroy($id)
    {
        if(auth()->user()->email !== "demoadmin@gmail.com") {
            $target = VideoNews::find($id)->delete();
            return  response([
                "status" => "success",
                "message" => "Item Successfully delete"
            ]);

        }else{
            return Response::json(['status' => "error", 'message' => 'Sorry You are demo user',],422);
        }

//        return Redirect::back()->with('msg', 'Item Successfully Delete');
    }
}
