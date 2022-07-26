<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProjectSdg extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'sdg_id',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    public function sdg()
    {
        return $this->belongsTo(SustainableDevelopmentGoal::class, 'sdg_id', 'id');
    }

    public function active_sdg()
    {
        return $this->belongsTo(SustainableDevelopmentGoal::class, 'sdg_id', 'id')->where('is_active',1);
    }
    // public function project()
    // {
    //     return $this->belongsTo(Project::class, 'project_id', 'id');
    // }



    public function commentable()
    {
        return $this->morphTo();
    }
}
