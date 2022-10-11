<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $hidden = [
        'owner_id',
        'created_at',
        'updated_at',
    ];


    public $table = "companies";

    protected $fillable = [
        'company_name',
        'address',
        'contact_person',
        'email',
        'phone',
        'owner_id',
        
    ];
}
