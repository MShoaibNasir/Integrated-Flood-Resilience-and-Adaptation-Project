<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UC extends Model
{
    use HasFactory;
    protected $table = 'uc';
    protected $guarded = ['id'];

}
