<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class InvestorIntrest extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'project_id',
    ];

    protected $casts = [
        // 'created_at' => 'date:d M, Y H:i',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
