<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;
    public $table = "notes";

    protected $fillable = [
        'task_id',
        'note',

    ];
}
