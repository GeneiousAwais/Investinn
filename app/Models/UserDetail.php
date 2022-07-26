<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserDetail extends Model
{      

    use HasFactory, SoftDeletes;
    protected $fillable = [
        'about_me',
        'expertise_id',
        'sector_id',
        'sub_sector_id',
        'investment_range_id',
        'picture',
        'project_id'
        
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


    public function sectors()
    {
        return $this->belongsTo(Sector::class, 'sector_id', 'id');
    }

    public function subSectors()
    {
        return $this->belongsTo(Sector::class, 'sub_sector_id', 'id');
    }

    public function investmentRanges()
    {
        return $this->belongsTo(InvestmentRange::class, 'investment_range_id', 'id');
    }

    public function projects()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
