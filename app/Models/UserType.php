<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserType extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_name',
        'is_active' 
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value == 1) ? 'active' : 'inactive',
        );
    }
}
