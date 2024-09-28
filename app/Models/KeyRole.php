<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class KeyRole extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'priority',
      'status'
    ];
}
