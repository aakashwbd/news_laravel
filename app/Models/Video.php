<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
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
    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function series()
    {
        return $this->belongsTo(Series::class);
    }
    public function season()
    {
        return $this->belongsTo(Season::class);
    }
    public function episod()
    {
        return $this->belongsTo(Episod::class);
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    public function report()
    {
        return $this->hasMany(Comment::class);
    }
    public function top_feature()
    {
        return $this->hasMany(TopFeature::class);
    }
    public function banner()
    {
        return $this->hasMany(Banner::class);
    }
    public function sponsor()
    {
        return $this->hasMany(Sponsor::class);
    }
    public function notification()
    {
        return $this->hasMany(Notification::class);
    }

}
