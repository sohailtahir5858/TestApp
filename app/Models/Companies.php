<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employees;
class Companies extends Model
{
    use HasFactory;
    // fillable for mass assignment.
    protected $fillable = [
        'name',
        'email',
        'logo',
        'website'
    ];

    // A company can have many employees.
    public function employees(){
        // specifying Many to One relationship & also specifying the Foreign key column name
        return $this->hasMany(Employees::class,'company');
    }
}
