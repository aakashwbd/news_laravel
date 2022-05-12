<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MobileAd;
use App\Models\Notification;
use App\Models\Setting;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AdsMobileController extends Controller
{
    /**
     * @OA\Get(
     *      path="/advertisement/mobile",
     *      operationId="index",
     *      tags={"Mobile Ads"},
     *      summary="Get list of Mobile Ads",
     *      description="Returns list of Mobile Ads",
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
            $target = MobileAd::get();
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
     *      path="/about/about-us",
     *      operationId="index",
     *      tags={"About Us"},
     *      summary="Get  About us",
     *      description="Returns list of About Us",
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
    public function about(Request $request)
    {
        try {
            $target = Setting::first();
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
     *      path="/notification",
     *      operationId="index",
     *      tags={"Notification"},
     *      summary="Get Notification",
     *      description="Returns list of About Us",
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
     *   )
     */
    public function notification(Request $request)
    {
        try {
            $target = Notification::with(['radio'])->orderBy('id', 'desc')->get();
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

    public function __construct()
    {
        if (!file_exists(storage_path('installed')) || !file_exists(base_path('vendor/licensed'))) {
            if (Route::has('/installation')) {
                return redirect('/installation');
            } else {
                abort(500);
            }
        }
    }
}