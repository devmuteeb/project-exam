<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam_Master extends Model
{
    use HasFactory;

    protected $table="exam_masters";

    protected $primaryKey="id";

    protected $fillable=['title','category','exam_date','status','exam_duration'];
}
