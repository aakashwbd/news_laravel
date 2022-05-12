<?php

namespace App\Http\Controllers;

use App\Models\NewsReport;
use Illuminate\Http\Request;
use Response;

class NewsReportController extends Controller
{
    public function index(Request $request)
    {
        $target = NewsReport::leftJoin('news', 'news.id', 'news_reports.news_id')
            ->leftJoin('users', 'users.id', 'news_reports.created_by')
            ->select('news_reports.id as report_id', 'news_reports.report as report', 'news_reports.status as reports_status', 'news.title as video', 'users.name as user');
        // begin filtering
        // $searchText = $request->fil_search;
        // if (!empty($searchText)) {
        //     $target->where(function ($query) use ($searchText) {
        //         $query->where('users.name', 'LIKE', '%' . $searchText . '%');
        //     });
        // }
        //end filtering
        $target = $target->get();
        return view('report.news.index')->with(compact('target'));
    }

    public function status(Request $request)
    {
        $target         = NewsReport::where('id', $request->id)->first();
        $target->status = $request->status ?? $target->status;
        if ($target->update()) {
            return Response::json(['success' => true], 200);
        }
    }

    public function reportShow(Request $request)
    {
        $status = NewsReport::where('id', $request->id)->first();
        $status->update();
        $target = NewsReport::leftJoin('news', 'news.id', 'news_reports.news_id')
            ->leftJoin('users', 'users.id', 'news_reports.created_by')
            ->where('news_reports.id', $request->id)
            ->select('news_reports.id as report_id', 'news_reports.report as report', 'news_reports.status as reports_status', 'news.title as video', 'users.name as user')
            ->first();
        $view = view('report.reportShow', compact('target'))->render();
        return response()->json(['html' => $view]);
    }

    public function create(Request $request)
    {
        // $target = Report::where('id', $request->id)->first();
        $view = view('report.create', compact('request'))->render();
        return response()->json(['html' => $view]);
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make(request()->all(), [
                'video_id' => 'required',
                'report'   => 'required',
            ]);

            if ($validate->fails()) {
                return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
            }

            $target              = new NewsReport();
            $target->video_id    = $request->video_id;
            $target->report      = $request->report;
            $target->view_status = 'pending';
            $target->status      = 'active';
            $target->updated_by  = auth()->id();
            $target->created_by  = auth()->id();
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
        $target = Report::where('id', $id)->first();
        return view('report.edit')->with(compact('target'));
    }

    public function update(Request $request, $id)
    {
        try {
            // dd($request->all());

            $validate = Validator::make(request()->all(), [
                'name'   => 'required|regex:/^[a-zA-Z-. ]+$/u',
                'email'  => 'required|email:rfc,dns|unique:reports,id,' . $request->id,
                'phone'  => 'required',
                'status' => Rule::in(['active', 'inactive']),
            ]);

            if ($validate->fails()) {
                return redirect('admin/report/' . $request->id . '/edit')
                    ->withInput()
                    ->withErrors($validate);
            }

            if (!empty($request->file('image'))) {
                $image     = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalName();

                if (config('app.env') === 'production') {
                    $image->move('uploads/report', $imageName);
                } else {
                    $image->move(public_path('/uploads/report'), $imageName);
                }
            }

            $target        = NewsReport::where('id', $request->id)->first();
            $target->name  = $request->name ?? $target->name;
            $target->email = $request->email ?? $target->email;
            $target->phone = $request->phone ?? $target->phone;
            $target->image = $imageName ?? $target->image;

            if ($target->update()) {
                Session::flash('success', "Report Updated Successfully!");
                return redirect('admin/report');
            } else {
                Session::flash('error', "Report Update Unuccessfull!");
                return redirect('admin/report/' . $request->id . '/edit');
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
            $target = NewsReport::find($id)->delete();
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
        return Redirect::to('admin/report?' . $url);
    }
}
