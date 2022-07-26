<?php

namespace App\Models;

use App\Traits\SerializeDateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Project extends Model
{


    use HasFactory, SoftDeletes,SerializeDateTrait;
    protected $fillable = [
        'project_status',
        'project_title',
        'is_published',
        'is_featured',
        'sector_id',
        'sub_sector_id',
        'project_stage_id',
        'tentative_start_date',
        'tentative_duration_type',
        'tentative_duration',
        'estimated_economic_irr',
        'project_scale',
        'project_endorsement',
        'project_rating',
        'project_views',
        'project_coordinator',
        'project_entrepreneur',
        'executive_summary',
        'problem',
        'market',
        'about_competition',
        'revenue_model',
        'distribution_channel',
        'marketing_plan',
        'risk_challenge',
        'project_tags',
        'highlights'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    protected $appends = ['digitize_project_id'];

    public function getDigitizeProjectIdAttribute(){
        return sprintf("%06d", $this->id);
    }

    public function sectors()
    {
        return $this->belongsTo(Sector::class, 'sector_id', 'id');
    }

    public function sub_sector()
    {
        return $this->belongsTo(Sector::class, 'sub_sector_id', 'id');
    }

    public function stages()
    {
        return $this->belongsTo(ProjectStage::class, 'project_stage_id', 'id');
    }


    public function projectCoordinators()
    {
        return $this->belongsTo(User::class, 'project_coordinator', 'id');
    }

    public function projectEntrepreneur()
    {
        return $this->belongsTo(User::class, 'project_entrepreneur', 'id');
    }

    // protected function isPublished(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => ($value == '' || $value == null ) ? 'Not Published ' : ' Published ',
    //     );
    // }



    public function city(){
        return $this->belongsTo(City::class,'project_location_id','id');
    }

    public function financials()
    {
        return $this->belongsTo(ProjectFinancial::class, 'id', 'project_id');
    }

    public function teams()
    {
        return $this->hasMany(ProjectTeam::class, 'project_id');
    }

    public function contactUs()
    {
        return $this->belongsTo(ProjectContactUs::class, 'id', 'project_id');
    }

    public function project_medias()
    {
        return $this->hasMany(ProjectMedia::class, 'project_id');
    }

    public function potential_location()
    {
        return $this->hasMany(PotentialLocation::class, 'project_id');
    }

    public function featured_image()
    {
        return $this->hasOne(ProjectMedia::class, 'project_id')->where('is_featured',1);
    }

    public function project_investors()
    {
        return $this->hasMany(ProjectInvestor::class,'project_id','id');
    }

    public function project_mentors()
    {
        return $this->hasMany(ProjectMentor::class,'project_id','id');
    }

    public function sdgs()
    {
        return $this->morphMany(ProjectSdg::class, 'commentable');
    }
}
