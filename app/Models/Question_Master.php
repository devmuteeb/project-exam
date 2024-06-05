<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question_Master extends Model
{
    use HasFactory;

    protected $table="question_masters";

    protected $primaryKey="id";
    protected $fillbale=['exam_id','questions','ans','options','status'];
}
