<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'age',
        'email',
        'sex',
        'password'
    ];
    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];
    public function mother()
    {
        return $this->hasOne(Mother::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

}