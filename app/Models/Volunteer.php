<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Volunteer extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'education',
        'working_experience',
        'why_volunteer',
        'week_time_spend',
        'volunteered_before',
        'interested_work_type',
        'any_question'  
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
