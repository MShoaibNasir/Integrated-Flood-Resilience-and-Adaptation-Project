<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionTitle extends Model
{
    use HasFactory;
    protected $table='question_title';
    protected $guarded=['id'];
}
