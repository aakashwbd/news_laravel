<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\NewsComment;
use Auth;
use Illuminate\Http\Request;
use Validator;

class NewsCommentController extends Controller
{
    /**
     * @OA\Post(
     ** path="/comment/news/add",
     *   operationId="new comment store",
     *   tags={"Comment"},
     *      security={{"bearerAuth":{}}},
     *   summary="Add a new Comment",
     *
     *   @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"news_id", "comment"},
     *               @OA\Property(property="news_id", type="int"),
     *               @OA\Property(property="comment", type="text"),
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
        // dd($request->all());
        try {
            $validate = Validator::make(request()->all(), [
                'news_id' => 'required',
                'comment' => 'required',
            ]);
            if ($validate->fails()) {
                return response([
                    'status' => 'validation_error',
                    'data'   => $validate->errors(),
                ], 422);
            }
            $target             = new NewsComment();
            $target->news_id    = $request->news_id;
            $target->comment    = $request->comment;
            $target->status     = 'active';
            $target->updated_by = auth()->id();
            $target->created_by = auth()->id();
            if ($target->save()) {
                return response([
                    'status'  => 'success',
                    'message' => "Comment Successfully Added",
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
     *      path="/comment/news/get-all/",
     *      operationId="news comment show",
     *      tags={"Comment"},
     *      security={{"bearerAuth":{}}},
     *      summary="Show News Comment",
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
            $newsComment = NewsComment::with(['user'])->where('news_id', $request->id)->where('status', 'active')->get();
            return response([
                'status' => 'success',
                'data'   => $newsComment,
            ], 200);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
