<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EmployeTrajet extends Pivot
{
    protected $table = 'employe_trajet';

    public $incrementing = false;

    protected $fillable = [
        'employe_id',
        'trajet_id',
        'date_inscription'
    ];

    protected $casts = [
        'date_inscription' => 'datetime'
    ];
}
