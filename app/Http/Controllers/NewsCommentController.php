<?php

namespace App\Http\Controllers;

use App\Models\NewsComment;
use File;
use Illuminate\Http\Request;
use Response;
use Session;
use Validator;

class NewsCommentController extends Controller
{
    public function index(Request $request)
    {
        $target = NewsComment::leftJoin('news', 'news.id', 'news_comments.news_id')
            ->join('users', 'users.id', 'news_comments.created_by')
            ->select('news_comments.id as comment_id', 'news_comments.comment as comment', 'news_comments.status as comments_status', 'news.title as video', 'users.name as user');
        //begin filtering
        $searchText = $request->fil_search;
        // if (!empty($searchText)) {
        //     $target->where(function ($query) use ($searchText) {
        //         $query->where('users.name', 'LIKE', '%' . $searchText . '%');
        //     });
        // }
        //end filtering
        $target = $target->get();
        // dd($target);
        return view('comment.news')->with(compact('target'));
    }

    public function status(Request $request)
    {
        $target         = NewsComment::where('id', $request->id)->first();
        $target->status = $request->status ?? $target->status;
        if ($target->update()) {
            return Response::json(['success' => true], 200);
        }
    }

    public function create(Request $request)
    {
        return view('comment.create');
    }

    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $validate = Validator::make(request()->all(), [
                'comment' => 'required',
            ]);

            if ($validate->fails()) {
                return Response::json(['success' => false, 'heading' => 'Validation Error', 'message' => $validate->errors()], 422);
            }
            $target             = new NewsComment;
            $target->news_id    = $request->news_id;
            $target->comment    = $request->comment;
            $target->status     = 'active';
            $target->updated_by = auth()->id();
            $target->created_by = auth()->id();
            if ($target->save()) {
                return Response::json(['success' => true], 200);
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Request $request, $id)
    {
        $target = NewsComment::where('id', $id)->first();
        return view('comment.edit')->with(compact('target'));
    }

    public function update(Request $request, $id)
    {
        try {
            // dd($request->all());
            $validate = Validator::make(request()->all(), [
                'name'   => 'required|regex:/^[a-zA-Z-. ]+$/u',
                'email'  => 'required|email:rfc,dns|unique:comments,id,' . $request->id,
                'phone'  => 'required|regex:/(01[3-9]\d{8})$/',
                'status' => Rule::in(['active', 'inactive']),
            ]);

            if ($validate->fails()) {
                return redirect('comment/' . $request->id . '/edit')
                    ->withInput()
                    ->withErrors($validate);
            }

            if (!empty($request->file('image'))) {
                $image     = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalName();

                if (config('app.env') === 'production') {
                    $image->move('uploads/comment', $imageName);
                } else {
                    $image->move(public_path('/uploads/comment'), $imageName);
                }
            }

            $target        = NewsComment::where('id', $request->id)->first();
            $target->name  = $request->name ?? $target->name;
            $target->email = $request->email ?? $target->email;
            $target->phone = $request->phone ?? $target->phone;
            $target->image = $imageName ?? $target->image;

            if ($target->update()) {
                Session::flash('success', "Comment Updated Successfully!");
                return redirect('comment');
            } else {
                Session::flash('error', "Comment Update Unuccessfull!");
                return redirect('comment/' . $request->id . '/edit');
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        if(auth()->user()->email !== "demoadmin@gmail.com") {
            $target = NewsComment::find($id)->delete();
            return  response([
                "status" => "success",
                "message" => "Item Successfully delete"
            ]);
        }else{
            return Response::json(['status' => "error", 'message' => 'Sorry You are demo user',],422);
        }
//        return Redirect::back()->with('msg', 'Item Successfully Delete');
    }
    public function filter(Request $request)
    {
        $url = 'fil_search=' . urlencode($request->fil_search);
        return Redirect::to('comment?' . $url);
    }
}
