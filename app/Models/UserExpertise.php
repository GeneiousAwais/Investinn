<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserExpertise extends Model
{use HasFactory;

    protected $fillable = [
        'expertise_id',
        'user_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    public function expertise()
    {
        return $this->belongsTo(User::class, 'expertise_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
