<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvChannelCategory extends Model
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
    public function notification()
    {
        return $this->hasMany(Notification::class);
    }
    public function tv_channel()
    {
        return $this->hasMany(TvChannel::class);
    }

}
