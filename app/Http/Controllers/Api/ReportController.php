<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewsReport;
use App\Models\Report;
use Auth;
use Illuminate\Http\Request;
use Validator;

class ReportController extends Controller
{
    /**
     * @OA\Post(
     ** path="/reports/video/add",
     *   operationId="store",
     *   tags={"Report"},
     *      security={{"bearerAuth":{}}},
     *   summary="Add a new Video Report",
     *
     *   @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"video_id", "report"},
     *               @OA\Property(property="video_id", type="int"),
     *               @OA\Property(property="report", type="text"),
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
                'report'   => 'required',
            ]);
            if ($validate->fails()) {
                return response([
                    'status' => 'validation_error',
                    'data'   => $validate->errors(),
                ], 422);
            }
            $target              = new Report;
            $target->video_id    = $request->video_id;
            $target->report      = $request->report;
            $target->view_status = 'pending';
            $target->status      = 'active';
            $target->created_by  = auth()->id();
            $target->updated_by  = auth()->id();
            if ($target->save()) {
                return response([
                    'status'  => 'success',
                    'message' => 'Report Created Successfully',
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
     ** path="/reports/news/add",
     *   operationId="report store",
     *   tags={"Report"},
     *      security={{"bearerAuth":{}}},
     *   summary="Add a new News Report",
     *
     *   @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"news_id", "report"},
     *               @OA\Property(property="news_id", type="int"),
     *               @OA\Property(property="report", type="text"),
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
    public function newsReportStore(Request $request)
    {
        try {
            $validate = Validator::make(request()->all(), [
                'news_id' => 'required',
                'report'  => 'required',
            ]);
            if ($validate->fails()) {
                return response([
                    'status' => 'validation_error',
                    'data'   => $validate->errors(),
                ], 422);
            }
            $target             = new NewsReport;
            $target->news_id    = $request->news_id;
            $target->report     = $request->report;
            $target->status     = 'active';
            $target->updated_by = auth()->id();
            $target->created_by = auth()->id();
            if ($target->save()) {
                return response([
                    'status'  => 'success',
                    'message' => 'Report Created Successfully',
                ], 200);
            }
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}