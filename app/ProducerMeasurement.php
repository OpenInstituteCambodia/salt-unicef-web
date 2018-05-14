<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProducerMeasurement extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'producer_measurements';
    public $timestamps = true;
//    protected $hidden = [
//        '',
//    ];
}
