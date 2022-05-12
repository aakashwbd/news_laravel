<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoNews extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['added_on','is_favorite'];

    public function getAddedOnAttribute()
    {
        return $this->created_at->toFormattedDateString();
    }

    public function favorite_videos()
    {
        return $this->hasMany(FavoriteVideo::class, 'video_id', 'id');
    }

    public function getIsFavoriteAttribute()
    {
        // dd($request->user('sanctum'));
        if(request()->user('sanctum')){
            return $this->favorite_videos->where('user_id', request()->user('sanctum')['id'])->first() ? true : false;
        }else{
            return false;
        }
    }



}
