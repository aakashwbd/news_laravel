<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\NewsView;
use App\Models\VideoNews;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Response;
use Validator;

class NewsController extends Controller
{
    public function newsIndex(Request $request)
    {
        try {

            $searchText = $request->fil_search;
            $target = News::where('title', 'LIKE', '%' . $searchText . '%')->get();
//            $target = $target->get();

            $newsId = [];
            if (!$target->isEmpty()) {
                foreach ($target as $date) {
                    array_push($newsId, $date->id);

                }
            }

            $viewData = NewsView::whereIn('news_id', $newsId)
                ->select('news_id', DB::raw('count(*) as total'))
                ->groupBy('news_id')
                ->get();

            return view('news.newsIndex')->with(compact('target', "viewData"));
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }

        // $target = News::where("status", "active")->get();
        // $newsId = [];
        // if (!$target->isEmpty()) {
        //     foreach ($target as $date) {
        //         array_push($newsId, $date->id);

        //     }
        // }
        // $viewData = NewsView::whereIn('news_id', $newsId)
        //     ->select('news_id', DB::raw('count(*) as total'))
        //     ->groupBy('news_id')
        //     ->get();
        // return view('news.newsIndex')->with(compact('target', "viewData"));
    }
    public function newsApproval(Request $request)
    {
        $target = News::where('status', 'inactive')->get();
        $newsId = [];
        if (!$target->isEmpty()) {
            foreach ($target as $date) {
                array_push($newsId, $date->id);

            }
        }
        $viewData = NewsView::whereIn('news_id', $newsId)
            ->select('news_id', DB::raw('count(*) as total'))
            ->groupBy('news_id')
            ->get();

        return view('news.newsApprove')->with(compact('target', 'viewData'));

    }

    public function manageApproval(Request $request)
    {
//        dd($request->all());
        $target         = News::where('id', $request->id)->first();
        $target->status = $request->status;
        if ($target->update()) {
            return Response::json(['success' => true], 200);
        }
    }
    public function managevideoApproval(Request $request)
    {

        $target = VideoNews::where('id', $request->id)->first();

        $target->status = $request->status;
        if ($target->update()) {
            return Response::json(['success' => true], 200);
        }
    }

    public function newsCreate(Request $request)
    {
        $categoryList = Category::where('status', 'active')->pluck('name', 'id')->toArray();
        // dd($categoryList);
        return view('news.newsCreate')->with(compact('categoryList'))->render();
        // return response()->json(['html' => $view]);
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

    public function newsStore(Request $request)
    {

        try {
            $validate = Validator::make(request()->all(), [
                'title'       => 'required',
                'description' => 'required',
                'category_id' => 'required',
                'image'       => 'required',
                // 'status'      => Rule::in(['active', 'inactive']),
            ]);
            if ($validate->fails()) {
                return Response::json(['success' => false, 'heading' => 'Validation Error', 'message' => $validate->errors()], 422);
            }

            $target              = new News;
            $target->category_id = (array) $request->category_id;
            $target->category_type = $request->category_type;
            $target->video_type = $request->video_type;
            $target->news_type   = $request->news_type;
            $target->title       = $request->title;
            $target->description = $request->description;
            $target->video_link  = $request->video_link;
            $target->image       = $request->image;
            // dd($target->image);

            if (auth()->user()->user_role_id === 1) {
                $target->status = 'active';

            } else {
                $target->status = 'inactive';
            }

            if(auth()->user()->email !== "demoadmin@gmail.com") {
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

    public function newsEdit($id)
    {
        $target       = News::where('id', $id)->first();
        $prevCategory = $target->category_id;
        $categoryList = Category::where('status', 'active')->pluck('name', 'id')->toArray();
        // dd($target->category_id);
        return view('news.newsEdit', compact('target', 'categoryList', 'prevCategory'));
    }

    public function newsUpdate(Request $request)
    {
        try {

            $validate = Validator::make(request()->all(), [
                'title'       => 'required',
                'description' => 'required',
                'category_id' => 'required',
                'status'      => Rule::in(['active', 'inactive']),
            ]);
            if ($validate->fails()) {
                return Response::json(['success' => false, 'heading' => 'Validation Error', 'message' => $validate->errors()], 422);
            }

            $target              = News::where('id', $request->id)->first();
            $target->category_id = $request->category_id ?? $target->category_id;
            $target->category_type = $request->category_type ?? $target->category_type;
            $target->news_type   = $request->news_type ?? $target->news_type;
            $target->video_type  = $request->video_type ?? $target->video_type;
            $target->title       = $request->title ?? $target->title;
            $target->video_link  = $request->video_link ?? $target->video_link;
            $target->description = $request->description ?? $target->description;
            $target->image       = $request->imageEdit ?? $target->image;
            if(auth()->user()->email !== "demoadmin@gmail.com") {
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
    public function newsFilter(Request $request)
    {
        $url = 'fil_search=' . urlencode($request->fil_search);
        // dd($url);
        return Redirect::to('admin/news?' . $url);
    }

    //destroy
    public function destroy($id)
    {
        if(auth()->user()->email !== "demoadmin@gmail.com") {
            $target = News::find($id)->delete();
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