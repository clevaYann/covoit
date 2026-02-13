<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CampusEmploye extends Pivot
{
    protected $table = 'campus_employe';

    public $incrementing = false;

    protected $fillable = [
        'campus_id',
        'employe_id'
    ];
}
