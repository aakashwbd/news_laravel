<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\News;
use App\Models\Report;
use App\Models\User;
use App\Models\VideoNews;
use App\Models\VideoView;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalCategory      = Category::count();
        $totalVideo         = VideoNews::count();
        $totalNews          = News::count();
        $totalApprovalNews  = News::where('status', 'active')->count();
        $totalUser          = User::where('user_role_id', '3')->count();
        $totalVideoView     = VideoView::count();
        $lastDayVideoView   = VideoView::where('created_at', '>', now()->subDays(1))->count();
        $lastWeekVideoView  = VideoView::where('created_at', '>', now()->subDays(7))->count();
        $lastMonthVideoView = VideoView::where('created_at', '>', now()->subDays(30))->count();

        $lastDayComment   = Comment::where('created_at', '>', now()->subDays(1))->count();
        $lastWeekComment  = Comment::where('created_at', '>', now()->subDays(7))->count();
        $lastMonthComment = Comment::where('created_at', '>', now()->subDays(30))->count();

        $lastDayReport   = Report::where('created_at', '>', now()->subDays(1))->count();
        $lastWeekReport  = Report::where('created_at', '>', now()->subDays(7))->count();
        $lastMonthReport = Report::where('created_at', '>', now()->subDays(30))->count();

        $categoryList = Category::where('status', 'active')->get();

        // Start::Top Category
        $categoryViewArr           = $categoryPercentage           = [];
        $thisMonthCategoryViewData = VideoView::join('videos', 'videos.id', 'video_views.video_id')
            ->join('categories', 'categories.id', 'videos.category_id')
            ->whereMonth('video_views.created_at', now()->month)
            ->select('video_views.video_id', 'videos.category_id', 'categories.name as category_name')
            ->get();
        if (!$thisMonthCategoryViewData->isEmpty()) {
            foreach ($thisMonthCategoryViewData as $data) {
                $categoryViewArr[$data->category_id]['this'] = $categoryViewArr[$data->category_id]['this'] ?? 0;
                $categoryViewArr[$data->category_id]['this'] += 1;
            }
        }

        $prevMonthCategoryViewData = VideoView::join('videos', 'videos.id', 'video_views.video_id')
            ->join('categories', 'categories.id', 'videos.category_id')
            ->whereMonth('video_views.created_at', now()->subMonth()->month)
            ->select('video_views.video_id', 'videos.category_id', 'categories.name as category_name')
            ->get();
        if (!$prevMonthCategoryViewData->isEmpty()) {
            foreach ($prevMonthCategoryViewData as $data) {
                $categoryViewArr[$data->category_id]['prev'] = $categoryViewArr[$data->category_id]['prev'] ?? 0;
                $categoryViewArr[$data->category_id]['prev'] += 1;
            }
        }

        if (!empty($categoryViewArr)) {
            foreach ($categoryViewArr as $categoryId => $info) {
                $prevMonth  = $info['prev'] ?? 1;
                $thisMonth  = $info['this'] ?? 1;
                $difference = $info['this'] - $info['prev'];
                if ($difference >= 0) {
                    $categoryPercentage[$categoryId]['type'] = 'increase';
                } else {
                    $categoryPercentage[$categoryId]['type'] = 'decrease';
                }
                $categoryPercentage[$categoryId]['percentage'] = (($difference ?? 1) / $prevMonth) * 100;
            }
        }

        // dd($categoryViewArr);
        // End::Top Category

        return view('dashboard')->with(compact('totalCategory', 'totalVideo', 'totalUser', 'totalVideoView', 'lastDayVideoView'
            , 'lastWeekVideoView', 'lastMonthVideoView', 'lastDayComment', 'lastWeekComment', 'lastMonthComment', 'lastDayReport'
            , 'lastWeekReport', 'lastMonthReport', 'categoryList', 'categoryPercentage', 'totalNews', 'totalApprovalNews'));
    }
}
