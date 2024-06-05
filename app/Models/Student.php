<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{

    protected $fillable = [
        'name',
        'email',
        'exam',
        'status',
        'mobile_no',
        'password',
    ];
    use HasFactory, Notifiable;
}
