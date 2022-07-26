<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProjectFinancial extends Model
{
     use HasFactory, SoftDeletes;
    protected $fillable = [
        'project_id',
        'paid_up_capital',
        'previously_raised',
        'current_target_to_raise',
        'raised_so_far',
        'minimum_investment',
        'deal_type_id',
        'deal_offer',
        'financials',
        'partnership_type_id',
        'estimated_project_irr',
        'return_on_investment'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    protected $appends = [
        'minimum_investment_words',
    ];

    public function getMinimumInvestmentWordsAttribute(){
        return convertNumberToWord($this->minimum_investment);
    }

    public function projects()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function dealTypes()
    {
        return $this->belongsTo(DealType::class, 'deal_type_id', 'id');
    }

    public function partnershipType()
    {
        return $this->belongsTo(PartnershipType::class, 'partnership_type_id', 'id');
    }


}
