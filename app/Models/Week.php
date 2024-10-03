<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'from',
        'to'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
