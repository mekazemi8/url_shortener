<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $fillable = [
        'short_url',
        'long_url',
        'user_id',
        'views'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
