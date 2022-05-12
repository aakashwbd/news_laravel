<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\VideoNews;
use App\Models\VideoView;
use Illuminate\Http\Request;

class VideoNewsController extends Controller
{
    /**
     * @OA\Get(
     *      path="/video/get-all",
     *      operationId="index",
     *      tags={"Video News"},
     *      summary="Get list of Video News",
     *      description="Returns list of Video News",
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

    public function index(Request $request)
    {
        try {
            $allVideoNews = VideoNews::where('status', 'active')->get();
            return response([
                'status' => 'success',
                'data'   => $allVideoNews,
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
     *      path="/video/show/",
     *      operationId="show",
     *      tags={"Video News"},
     *      summary="Show Video News",
     *      @OA\Parameter(
     *          name="id",
     *          description="Id",
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

    public function view(Request $request)
    {
        // dd($id);
        try {
            $singleNews = VideoNews::where('id', $request->id)->first();


          $newsId = $singleNews->id;
          $viewData = VideoView::where('video_id', $newsId)->count();
          $viewUser = null;
          $ip       = $request->ip();
          // dd($ip);
          if (!empty(Auth()->id())) {
              $viewUser = Auth()->id();
          }

        //   $prevViewUser = VideoView::where('video_id', $newsId)
        //       ->where('user_id', $viewUser)
        //       ->where('ip_address', $ip)
        //       ->first();

        //   if (!empty($prevViewUser)) {
        //       $prevViewUser = $prevViewUser->delete();
        //   }
          $videoViews             = new VideoView;
          $videoViews->video_id    =  $newsId;
          $videoViews->user_id    = $viewUser;
          $videoViews->ip_address = $ip;
          $videoViews->save();

            return response([
                'status' => 'success',
                'data'   => $singleNews,
                'viewData'   => $viewData,
            ], 200);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @OA\Post(
     ** path="/video/search",
     *   operationId="Get video news",
     *   tags={"Video News"},
     *   summary="Get video news search List",
     *   @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"search_data"},
     *               @OA\Property(property="search_data", type="string"),
     *            ),
     *         ),
     *      ),
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

    public function videoNewsSearch(Request $request)
    {
        // dd($request->search_data);
        try {
            $result = VideoNews::where('title', 'LIKE', '%' . $request->search_data . '%')
                ->orWhere('description', 'LIKE', '%' . $request->search_data . '%')
                ->get();
            return response([
                'status' => 'success',
                'data'   => $result,
            ], 200);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}
