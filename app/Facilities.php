<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facilities extends Model
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'facilities';
    protected $hidden = [
       'created_at', 'updated_at', 'deleted_at'
    ];
    protected $dates = ['deleted_at'];
}
