<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsView;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NewsController extends Controller
{
    /**
     * @OA\Get(
     *      path="/news/get-all/",
     *      operationId="index",
     *      tags={"News"},
     *      summary="Get list of News",
     *      description="Returns list of News",
       *      @OA\Parameter(
     *          name="date",
     *          description="date",
     *          required=false,
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

    public function index(Request $request)
    {
        try {
            if(!$request->date){
                $allNews = News::whereDate('created_at', today())->where('status', 'active')->get();
                return response([
                    'status'    => 'success',
                    'data'      => $allNews,
                ], 200);
            }else{
                $allNews = News::whereDate('created_at',Carbon::parse($request->date))->where('status', 'active')->get();
                return response([
                    'status'    => 'success',
                    'data'      => $allNews,
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
     *      path="/news/get-feature-news",
     *      operationId="get feature news",
     *      tags={"News"},
     *      summary="Get list of feature News",
     *      description="Returns list of feature News",
     *     @OA\Parameter(
     *          name="date",
     *          description="date",
     *          required=false,
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

    public function featureNews(Request $request)
    {
            try {
                if(!$request->date){
                    $allNews = News::whereDate('created_at', today())->where('category_type', 'feature')->where('status', 'active')->get();
                    return response([
                        'status'    => 'success',
                        'data'      => $allNews,
                    ], 200);
                }else{
                    $allNews = News::whereDate('created_at',Carbon::parse($request->date))->where('category_type', 'feature')->where('status', 'active')->get();
                    return response([
                        'status'    => 'success',
                        'data'      => $allNews,
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
     *      path="/news/get-all-feature-news",
     *      operationId="feature all news",
     *      tags={"News"},
     *      summary="Get list of feature News",
     *      description="Returns list of News",
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

    public function allFeatureNews(Request $request)
    {
        try {

                $allNews = News::where('status', 'active')->where('category_type', 'feature')->get();
                return response([
                    'status'    => 'success',
                    'data'      => $allNews,
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
     *      path="/news/get-by-category",
     *      operationId="get news by category",
     *      tags={"News"},
     *      summary="Get list of by category News",
     *      description="Returns list of News",
     *      @OA\Parameter(
     *          name="id",
     *          description="categoryId",
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

    public function getByCategory(Request $request)
    {
        // dd($request->category_id);
        // return $request->category_id;
        try {
            // $allNews = News::whereIn('category_id', [(string) $request->category_id])->where('status', 'active')->get();

            $allNews = News::whereJsonContains('category_id', [(string) request('id')])->get();

            return response([
                'status' => 'success',
                'data'   => $allNews,
                // 'data'   => $newses,
                // 'view_data' => $viewData,
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
     *      path="/news/show/",
     *      operationId="show",
     *      tags={"News"},
     *      summary="Show News",
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

    public function view(Request $request)
    {

        try {
            $singleNews = News::where('id', $request->id)->withCount('view_news')->first();

            $viewUser = null;
            $ip       = $request->ip();
            if (!empty(Auth()->id())) {
                $viewUser = Auth()->id();
            }

            $videoViews             = new NewsView;
            $videoViews->news_id    =  $request->id;
            $videoViews->user_id    = $viewUser;
            $videoViews->ip_address = $ip;
            $videoViews->save();

            //End:: store video views history

            return response([
                'status' => 'success',
                'data'   => $singleNews,
//                'viewData'   => $viewData,

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
     ** path="/news/search",
     *   operationId="Get news",
     *   tags={"News"},
     *   summary="Get news search List",
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

    public function newsSearch(Request $request)
    {
        // dd($request->search_data);
        try {
            $result = News::where('title', 'LIKE', '%' . $request->search_data . '%')
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