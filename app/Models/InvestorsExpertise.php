<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class InvestorsExpertise extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'expertise_id',
        'user_id',
         
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];
    
    public function expertises()
    {
        return $this->belongsTo(Expertise::class, 'expertise_id', 'id');
    }

     public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
