<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassData extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'classes';

    protected $fillable = [
        'className',
        'capacity',
        'isFulled',
        'price',
        'timeFrom',
        'timeTo',

    ];
}
