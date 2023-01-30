<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Student extends Model
{
    use HasFactory , HasApiTokens, Notifiable;
    protected $fillable = [
        'name',
        'phone',
        'age',
        'email',
        'sex',
        'password',
        'teacher_id',

    ];
    protected $hidden = [
        // 'password',
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
