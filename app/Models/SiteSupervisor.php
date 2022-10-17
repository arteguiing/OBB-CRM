<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSupervisor extends Model
{
    use HasFactory;

    public $table = "site_supervisor";

    protected $fillable = [
        'task_name',
        'owner_id',
        'stage_id',
        'order_status',
        'duration',
        'sort_id',
        'start_date',
        'end_date',
    ];
}
