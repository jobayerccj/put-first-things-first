<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'key_role_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keyRole()
    {
        return $this->belongsTo(KeyRole::class);
    }
}
