<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * @OA\Get(
     *      path="/category/get-all",
     *      operationId="index",
     *      tags={"Category"},
     *      summary="Get list of category",
     *      description="Returns list of category",
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
            $category = Category::where('status', 'active')->get();
            return response([
                'status' => 'success',
                'data'   => $category,
            ], 200);
        } catch (\Exception$e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}
