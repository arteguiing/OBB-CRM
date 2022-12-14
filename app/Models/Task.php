<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Task extends Model
{
    use HasFactory;

    public $table = "tasks";

    protected $fillable = [
        'task_name',
        'company_id',
        'contact_person',
        'phone',
        'project_id',
        'task_id',
        'category_id',
        'sort_id',
        'start'
        
    ];
}
