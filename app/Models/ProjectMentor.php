<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProjectMentor extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'project_mentor',
        'project_id'
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
        return $this->belongsTo(User::class, 'project_mentor', 'id');
    }
    public function projects()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

}
