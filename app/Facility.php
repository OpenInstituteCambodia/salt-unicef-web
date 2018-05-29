<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends Model
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'facilities';
//    protected $hidden = [
//       'created_at', 'updated_at', 'deleted_at'
//    ];
    protected $hidden = ['deleted_at'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;
}
