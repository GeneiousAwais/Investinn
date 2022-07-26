<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PotentialLocation extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'location_title',
        'full_address',
        'latitude',
        'longitude',
        'project_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    public function getLatitudeAttribute($value){
        return (float)($value);
    }

    public function getLongitudeAttribute($value){
        return (float)($value);
    }

    public function projects()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

}
