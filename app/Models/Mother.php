<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mother extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'age',
        'email',
    ];
    protected $hidden = [

        'created_at',
        'updated_at'
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}