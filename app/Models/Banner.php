<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Banner extends Model
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

    public function video(){
        return $this->belongsTo(Video::class);
    }


    public function category(){
        return $this->belongsTo(Category::class);
    }

}