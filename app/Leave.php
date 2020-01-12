<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'submit', 'vacation_start', 'vacation_end', 'reason'
    ];
}