<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Companies;
class Employees extends Model
{
    use HasFactory;
    // fillable for mass assignment.
    protected $fillable = [
        'company',
        'firstName',
        'lastName',
        'email',
        'phone'
    ];


    // an Employee Belong to one company.
    public function companies()
    {
        // Making one to Many relationship with company & also specifying the column name
        return $this->belongsTo(Companies::class,'company');
    }
}
