<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\ViewName;

class News extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['is_favorite','added_on'];
    protected $casts   = [
        "category_id" => "array",
    ];
    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

    public function favorite_news()
    {
        return $this->hasMany(FavoriteNews::class, 'news_id', 'id');
    }
    public function getIsFavoriteAttribute()
    {
        // dd($request->user('sanctum'));
        if(request()->user('sanctum')){
            return $this->favorite_news->where('user_id', request()->user('sanctum')['id'])->first() ? true : false;
        }else{
            return false;
        }

    }
    public function getAddedOnAttribute()
    {
        return $this->created_at->toFormattedDateString();
    }

    public function view_news(){
        return $this->hasMany(NewsView::class);
    }

}
