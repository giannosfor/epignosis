<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'vacation_start',
        'vacation_end',
        'reason',
    ];
}