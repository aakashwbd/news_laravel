<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FavoriteNews;
use App\Models\FavoriteVideo;
use Illuminate\Http\Request;
use Validator;

class FavoriteVideoController extends Controller
{
    /**
     * @OA\Post(
     ** path="/favorite/video/added",
     *   operationId="store",
     *   tags={"Favorite"},
     *      security={{"bearerAuth":{}}},
     *   summary="Add a new Video to favorite list",
     *
     *   @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"video_id"},
     *               @OA\Property(property="video_id", type="int"),
     *            ),
     *        ),
     *    ),
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=422,
     *      description="Validation error"
     *   ),
     *   @OA\Response(
     *      response=500,
     *      description="Server error"
     *   )
     *)
     **/
    public function store(Request $request)
    {
        try {
            $validate = Validator::make(request()->all(), [
                'video_id' => 'required',
            ]);
            if ($validate->fails()) {
                return response([
                    'status' => 'validation_error',
                    'data'   => $validate->errors(),
                ], 422);
            }
            $target           = new FavoriteVideo;
            $target->video_id = $request->video_id;
            $target->user_id  = auth()->id();
            if ($target->save()) {
                return response([
                    'status'  => 'success',
                    'message' => 'Add To Favortie List...',
                ], 200);
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    /**
     * @OA\Post(
     ** path="/favorite/news/added",
     *   operationId="news store",
     *   tags={"Favorite"},
     *      security={{"bearerAuth":{}}},
     *   summary="Add a news to favorite list",
     *
     *   @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"news_id"},
     *               @OA\Property(property="news_id", type="int"),
     *            ),
     *        ),
     *    ),
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=422,
     *      description="Validation error"
     *   ),
     *   @OA\Response(
     *      response=500,
     *      description="Server error"
     *   )
     *)
     **/
    public function newsStore(Request $request)
    {
        try {
            $validate = Validator::make(request()->all(), [
                'news_id' => 'required',
            ]);
            if ($validate->fails()) {
                return response([
                    'status' => 'validation_error',
                    'data'   => $validate->errors(),
                ], 422);
            }
            $target          = new FavoriteNews;
            $target->news_id = $request->news_id;
            $target->user_id = auth()->id();
            if ($target->save()) {
                return response([
                    'status'  => 'success',
                    'message' => 'Add To Favorite List...',
                ], 200);
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *      path="/favorite/video/list",
     *      operationId="show",
     *      tags={"Favorite"},
     *      security={{"bearerAuth":{}}},
     *      summary="Show video favorite list",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="server error"
     *      )
     *     )
     */

    public function favoriteList(Request $request)
    {
        // dd($request->auth()->user()->id);
        try {
            $target = FavoriteVideo::leftJoin('video_news', 'video_news.id', 'favorite_videos.video_id')
                ->join('users', 'users.id', 'favorite_videos.user_id')
                ->where('favorite_videos.user_id', auth()->id())
                ->select('video_news.id as video_id', 'video_news.title as title', 'video_news.video_link as link', 'video_news.image as image')
                ->get();
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

    /**
     * @OA\Get(
     *      path="/favorite/news/list",
     *      operationId="news show",
     *      tags={"Favorite"},
     *      security={{"bearerAuth":{}}},
     *      summary="Show favorite news list",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="server error"
     *      )
     *     )
     */

    public function favoriteNewsList(Request $request)
    {
        // dd($request->all());
        try {
            $target = FavoriteNews::leftJoin('news', 'news.id', 'favorite_news.news_id')
                ->join('users', 'users.id', 'favorite_news.user_id')
                ->where('favorite_news.user_id', auth()->id())
                ->select('news.id as news_id', 'news.title as title', 'news.video_link as link', 'news.image as image', 'news.description as description')
                ->get();

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

    /**
     * @OA\post(
     *      path="/favorite/news/delete",
     *      operationId="news delete",
     *      tags={"Favorite"},
     *      security={{"bearerAuth":{}}},
     *      summary="delete favorite news list",
     *      @OA\Parameter(
     *          name="id",
     *          description="News Id",
     *          required=true,
     *          in="query"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="server error"
     *      )
     *     )
     */

    public function favoriteNewsDelete(Request $request)
    {
//         dd($request->all());
        try {
            $target = FavoriteNews::where('user_id', auth()->id())->where('news_id', $request->id)->delete();
            return response([
                'status'  => 'success',
                'message' => "Delete From Favorite List",
            ], 200);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\post(
     *      path="/favorite/video/delete",
     *      operationId="video delete",
     *      tags={"Favorite"},
     *      security={{"bearerAuth":{}}},
     *      summary="delete favorite video list",
    *      @OA\Parameter(
     *          name="id",
     *          description="News Id",
     *          required=true,
     *          in="query"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="server error"
     *      )
     *     )
     */

    public function favoriteVideoDelete(Request $request)
    {
        // dd($request->all());
        try {
            $target = FavoriteVideo::where('user_id', auth()->id())->where('video_id', $request->id)->delete();
            return response([
                'status'  => 'success',
                'message' => "Delete From Favorite List",
            ], 200);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}