<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Celebrity;
use App\Models\Country;
use App\Models\Episod;
use App\Models\FavoriteVideo;
use App\Models\Genre;
use App\Models\ImdbKey;
use App\Models\Season;
use App\Models\Series;
use App\Models\SubCategory;
use App\Models\Video;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Redirect;
use Response;
use Session;
use Validator;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $searchText = $request->fil_search;
        $target       = Video::where('title', 'LIKE', '%' . $searchText . '%');
        $target = $target->get();
        return view('video.index')->with(compact( 'target'));
    }

    public function storeImdbKey(Request $request)
    {
        try {
            // dd($request->all());
            $rules = [
                'key' => 'required',
            ];

            $validate = Validator::make(request()->all(), $rules);
            if ($validate->fails()) {
                return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
            }
            $existKey = ImdbKey::first();
            if (!empty($existKey)) {
                $existKey->key = $request->key ?? $existKey->key;
                if ($existKey->update()) {
                    return Response::json(['success' => true], 200);
                }
            } else {
                $target      = new ImdbKey;
                $target->key = $request->key;
                if ($target->save()) {
                    return Response::json(['success' => true], 200);
                }
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function create(Request $request)
    {
        $categoryList  = Category::where('status', 'active')->pluck('name', 'id')->toArray();
        $countryList   = Country::where('status', 'active')->pluck('name', 'id')->toArray();
        $celebrityList = Celebrity::where('status', 'active')->pluck('name', 'id')->toArray();
        $genreList     = Genre::where('status', 'active')->pluck('name', 'id')->toArray();
        $seriesList    = Series::where('status', 'active')->pluck('name', 'id')->toArray();
        $target        = Video::get();
        return view('video.create')->with(compact('target', 'categoryList', 'countryList', 'celebrityList', 'genreList', 'seriesList'));
    }

    public function getSubCategory(Request $request)
    {
        $subCategoryList = SubCategory::where('category_id', $request->category_id)->pluck('name', 'id')->toArray();
        $view            = view('video.getSubCategory', compact('subCategoryList'))->render();
        return response()->json(['html' => $view]);
    }

    public function getSeason(Request $request)
    {
        $seasonList = Season::where('series_id', $request->series_id)->pluck('name', 'id')->toArray();
        $view       = view('video.getSeason', compact('seasonList'))->render();
        return response()->json(['html' => $view]);
    }

    public function getEpisod(Request $request)
    {
        $episodList = Episod::where('season_id', $request->season_id)->pluck('name', 'id')->toArray();
        $view       = view('video.getEpisod', compact('episodList'))->render();
        return response()->json(['html' => $view]);
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'category_id'        => 'required|not_in:0',
                'title'              => 'required',
                'year'               => 'required|numeric',
                'duration'           => 'required|numeric',
                'video_type'         => 'required|not_in:0',
                'thumbnail'          => 'required',
                'thumbnail_vertical' => 'required',
                'description'        => 'required',
                'status'             => Rule::in(['active', 'inactive']),
            ];
            if (($request->video_type) == "4") {
                $rules['video'] = 'required';
            } else {
                $rules['url'] = 'required';
            }

            if (($request->is_series) == "on") {
                $rules['series_id'] = 'required|not_in:0';
                $rules['season_id'] = 'required|not_in:0';
                $rules['episod_id'] = 'required|not_in:0';
            }
            // $seasonName = '';
            // if ((($request->is_series) == "on") && (($request->is_new_season) == "yes")) {
            //     $rules['season_name'] = 'required';
            //     $seasonName           = $request->season_name;
            // }
            // if ((($request->is_series) == "on") && (($request->is_new_season) == "no")) {
            //     $rules['season'] = 'required|not_in:0';
            //     $seasonName      = $request->season;
            // }

            $validate = Validator::make(request()->all(), $rules);
            if ($validate->fails()) {
                return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
            }

            $imageName = $imageNameVer = $videoName = '';
            // start:: image upload
            if (!empty($request->file('thumbnail'))) {
                $image     = $request->file('thumbnail');
                $imageName = time() . '.' . $image->getClientOriginalName();
                $image->move(public_path('/uploads/video/thumbnail'), $imageName);
            }
            // end:: image upload

            // start:: vertical image upload
            if (!empty($request->file('thumbnail_vertical'))) {
                $image        = $request->file('thumbnail_vertical');
                $imageNameVer = time() . '.' . $image->getClientOriginalName();
                $image->move(public_path('/uploads/video/thumbnail'), $imageNameVer);
            }
            // end:: vertical image upload

            // start:: video upload
            if (!empty($request->file('video'))) {
                $video     = $request->file('video');
                $videoName = time() . '.' . $video->getClientOriginalName();
                $video->move(public_path('/uploads/video'), $videoName);
            }
            // end:: video upload

            $target                     = new Video;
            $target->category_id        = $request->category_id;
            $target->sub_category_id    = $request->sub_category_id;
            $target->title              = $request->title;
            $target->year               = $request->year;
            $target->duration           = $request->duration;
            $target->video_type         = $request->video_type;
            $target->url                = $request->url;
            $target->video              = $videoName ?? '';
            $target->thumbnail          = $imageName ?? '';
            $target->thumbnail_vertical = $imageNameVer ?? '';
            $target->video_on_off       = $request->video_on_off ?? 'off';
            $target->comment_on_off     = $request->comment_on_off ?? 'off';
            $target->is_series          = $request->is_series ?? 'off';
            $target->series_id          = $request->series_id;
            $target->season_id          = $request->season_id;
            $target->episod_id          = $request->episod_id;
            $target->description        = $request->description;
            $target->country_id         = json_encode($request->country_id);
            $target->celebrity_id       = json_encode($request->celebrity_id);
            $target->genre_id           = json_encode($request->genre_id);
            $target->imdb_id            = $request->imdb_id;
            $target->status             = 'active';
            $target->updated_by         = auth()->id();
            $target->created_by         = auth()->id();
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
        $categoryList    = Category::where('status', 'active')->pluck('name', 'id')->toArray();
        $countryList     = Country::where('status', 'active')->pluck('name', 'id')->toArray();
        $celebrityList   = Celebrity::where('status', 'active')->pluck('name', 'id')->toArray();
        $genreList       = Genre::where('status', 'active')->pluck('name', 'id')->toArray();
        $seriesList      = Series::where('status', 'active')->pluck('name', 'id')->toArray();
        $target          = Video::where('id', $id)->first();
        $seasonList      = Season::where('series_id', $target->series_id)->pluck('name', 'id')->toArray();
        $episodList      = Episod::where('season_id', $target->season_id)->pluck('name', 'id')->toArray();
        $subCategoryList = SubCategory::where('status', 'active')->where('category_id', $target->category_id)->pluck('name', 'id')->toArray();
        $prevCountry     = json_decode($target->country_id);
        $prevCelebrity   = json_decode($target->celebrity_id);
        $prevGenre       = json_decode($target->genre_id);
        // dd($prevCountry);exit;
        return view('video.edit')->with(compact('target', 'categoryList', 'countryList', 'celebrityList', 'genreList', 'subCategoryList'
            , 'seriesList', 'seasonList', 'episodList', 'prevCountry', 'prevCelebrity', 'prevGenre'));
    }

    public function update(Request $request)
    {
        try {
            // dd($request->all());
            $rules = [
                'category_id' => 'required|not_in:0',
                'title'       => 'required',
                'year'        => 'required|numeric',
                'duration'    => 'required|numeric',
                'video_type'  => 'required|not_in:0',
                'description' => 'required',
                'status'      => Rule::in(['active', 'inactive']),
            ];
            if (($request->video_type) == "4") {
            } else {
                $rules['url'] = 'required';
            }

            if (($request->is_series) == "on") {
                $rules['series_id'] = 'required|not_in:0';
                $rules['season_id'] = 'required|not_in:0';
                $rules['episod_id'] = 'required|not_in:0';
            }
            // $seasonName = '';
            // if ((($request->is_series) == "on") && (($request->is_new_season) == "yes")) {
            //     $rules['season_name'] = 'required';
            //     $seasonName           = $request->season_name;
            // }
            // if ((($request->is_series) == "on") && (($request->is_new_season) == "no")) {
            //     $rules['season'] = 'required|not_in:0';
            //     $seasonName      = $request->season;
            // }

            $validate = Validator::make(request()->all(), $rules);
            if ($validate->fails()) {
                return Response::json(['success' => false, 'heading' => 'Validtion Error', 'message' => $validate->errors()], 422);
            }

            // start:: image upload
            if (!empty($request->file('thumbnail'))) {
                $image     = $request->file('thumbnail');
                $imageName = time() . '.' . $image->getClientOriginalName();
                $image->move(public_path('/uploads/video/thumbnail'), $imageName);
            }
            // end:: image upload

            // start:: vertical image upload
            if (!empty($request->file('thumbnail_vertical'))) {
                $image        = $request->file('thumbnail_vertical');
                $imageNameVer = time() . '.' . $image->getClientOriginalName();
                $image->move(public_path('/uploads/video/thumbnail'), $imageNameVer);
            }
            // end:: vertical image upload

            // start:: video upload
            if (!empty($request->file('video'))) {
                $video     = $request->file('video');
                $videoName = time() . '.' . $video->getClientOriginalName();
                $video->move(public_path('/uploads/video'), $videoName);
            }
            // end:: video upload
            $target                     = Video::where('id', $request->id)->first();
            $target->category_id        = $request->category_id ?? $target->category_id;
            $target->sub_category_id    = $request->sub_category_id ?? $target->sub_category_id;
            $target->title              = $request->title ?? $target->title;
            $target->year               = $request->year ?? $target->year;
            $target->duration           = $request->duration ?? $target->duration;
            $target->video_type         = $request->video_type ?? $target->video_type;
            $target->url                = $request->url ?? $target->url;
            $target->video              = $videoName ?? $target->video;
            $target->thumbnail          = $imageName ?? $target->thumbnail;
            $target->thumbnail_vertical = $imageNameVer ?? $target->thumbnail_vertical;
            $target->video_on_off       = $request->video_on_off ?? 'off';
            $target->comment_on_off     = $request->comment_on_off ?? 'off';
            $target->is_series          = $request->is_series ?? 'off';
            $target->series_id          = $request->series_id ?? $target->series_id;
            $target->season_id          = $request->season_id ?? $target->season_id;
            $target->episod_id          = $request->episod_id ?? $target->episod_id;
            $target->description        = $request->description ?? $target->description;
            $target->imdb_id            = $request->imdb_id ?? $target->imdb_id;
            $target->country_id         = json_encode($request->country_id);
            $target->celebrity_id       = json_encode($request->celebrity_id);
            $target->genre_id           = json_encode($request->genre_id);
            $target->status             = 'active';
            $target->updated_by         = auth()->id();
            $target->created_by         = auth()->id();
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

    public function destroy(Request $request, $id)
    {
        $target = Video::find($id);

        if (empty($target)) {
            Session::flash('error', 'Invalid Data Id');
        }

        $fileName = 'uploads/video/thumbnail/' . $target->thumbnail;
        if (File::exists($fileName)) {
            File::delete($fileName);
        }

        $videoName = 'uploads/video/' . $target->video;
        if (File::exists($videoName)) {
            File::delete($videoName);
        }

        if ($target->delete()) {
            Session::flash('success', "Video Delete Successfully!");
            return redirect()->back();
        } else {
            Session::flash('error', "Video Delete Unsuccessfully!");
            return redirect()->back();
        }
        return redirect('/video');
    }

    public function addFavorite(Request $request)
    {
        try {
            $prevData = FavoriteVideo::where('video_id', $request->video_id)->where('user_id', Auth()->id())->first();
            if (!empty($prevData)) {
                $prevData->delete();
            }

            if ($request->status == 'unchecked') {
                return Response::json(['success' => true, 'message' => 'Remove from favorite list'], 200);
            }

            $target           = new FavoriteVideo;
            $target->user_id  = Auth()->id();
            $target->video_id = $request->video_id;

            if ($target->save()) {
                return Response::json(['success' => true, 'message' => 'Add your favorite list'], 200);
            }

        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function filter(Request $request)
    {
        $url = 'fil_search=' . urlencode($request->fil_search);
        return Redirect::to('video?' . $url);
    }

}
