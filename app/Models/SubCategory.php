<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    // protected $hidden = [
    //     'updated_at',
    //     'created_at',
    // ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function video()
    {
        return $this->hasMany(Video::class);
    }
    public function video_setting()
    {
        return $this->hasMany(VideoSetting::class);
    }

}
