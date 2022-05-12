<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Response;
use Session;
use Validator;

class CategoryController extends Controller
{
    public function categoryIndex(Request $request)
    {
        // $target = Category::all();
        // return view('category.categoryIndex')->with(compact('target'));
        try {
            $searchText = $request->fil_search;
            $target = Category::where('name', 'LIKE', '%' . $searchText . '%')->get();
//            $target = $target->get();
            return view('category.categoryIndex')->with(compact('target'));
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }

    }

    public function categoryCreate(Request $request)
    {
        $view = view('category.categoryCreate')->render();
        return response()->json(['html' => $view]);
    }
    public function categoryApproval(Request $request)
    {
        if(auth()->user()->email !== "demoadmin@gmail.com") {
            // dd($request->all());
            $target         = Category::where('id', $request->id)->first();
            $target->status = $request->status;
            if ($target->update()) {
                return Response::json(['success' => true], 200);
            }
        }else{
            return Response::json(['status' => "error", 'message' => 'Sorry You are demo user',],422);
        }

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

    public function categoryStore(Request $request)
    {
        // dd($request->all());
        try {
            $validate = Validator::make(request()->all(), [
                'name'   => 'required|unique:categories',
                'image'  => 'required',
                'status' => Rule::in(['active', 'inactive']),
            ]);

            if ($validate->fails()) {
                return Response::json(['success' => false, 'heading' => 'Validation Error', 'message' => $validate->errors()], 422);
            }
            $target             = new Category;
            $target->name       = $request->name;
            $target->image      = $request->image;
            $target->status     = 'active';
            $target->updated_by = auth()->id();
            $target->created_by = auth()->id();
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

    public function categoryEdit(Request $request)
    {
        $target = Category::where('id', $request->id)->first();
        $view   = view('category.categoryEdit', compact('target'))->render();
        return response()->json(['html' => $view]);
    }

    public function categoryUpdate(Request $request)
    {
        // dd($request->all());
        try {
            $validate = Validator::make(request()->all(), [
                'name'   => 'required|unique:categories,id,' . $request->id,
                'status' => Rule::in(['active', 'inactive']),
            ]);
            if ($validate->fails()) {
                return Response::json(['success' => false, 'heading' => 'Validation Error', 'message' => $validate->errors()], 422);
            }

            $target        = Category::where('id', $request->id)->first();
            $target->name  = $request->name ?? $target->name;
            $target->image = $request->imageEdit ?? $target->image;
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
    public function categoryFilter(Request $request)
    {
        $url = 'fil_search=' . urlencode($request->fil_search);
        return Redirect::to('admin/category?' . $url);
    }

    //destroy
//    public function destroy(Request $request, $id, $model)
//    {
//        $NamespacedModel = 'App\\Models\\' . $model;
//        $target          = $NamespacedModel::find($id);
//
//        if (empty($target)) {
//            Session::flash('error', 'Invalid Data Id');
//        }
//        $fileName = 'uploads/category/' . $target->image;
//        if (File::exists($fileName)) {
//            File::delete($fileName);
//        }
//
//        if ($target->delete()) {
//            Session::flash('success', "Category Delete Successfully!");
//        } else {
//            Session::flash('error', "Category Delete Unsuccessfully!");
//        }
//
//        if ($model == "Category") {
//            return redirect('/category');
//        }
//
//        if ($model == "SubCategory") {
//            return redirect('/category/sub-category-view');
//        }
//
//        if ($model == "SeriesCategory") {
//            return redirect('/category/series-category-view');
//        }
//
//        if ($model == "TvChannelCategory") {
//            return redirect('/category/tv-category-view');
//        }
//
//    }

    public function destroy($id)
    {
        if(auth()->user()->email !== "demoadmin@gmail.com") {
            $target = Category::find($id)->delete();
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
