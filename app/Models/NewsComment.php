<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsComment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['added_on']; 
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    // protected $hidden = [
    //     'updated_at',
    //     'created_at',
    // ];
    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'created_by', 'id');
    }
    
    public function getAddedOnAttribute()
    {
        return $this->created_at->toFormattedDateString();
    }
}