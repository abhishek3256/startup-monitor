<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'total_investment',
        'number_of_investments',
        'location',
        'investment_focus',
        'website',
        'email',
        'contact_person',
        'phone',
        'investment_range'
    ];

    protected $casts = [
        'total_investment' => 'decimal:2',
    ];

    public function financials()
    {
        return $this->hasMany(Financial::class);
    }

    public function startups()
    {
        return $this->belongsToMany(Startup::class, 'financials')
            ->withPivot('investment_amount', 'equity_offered', 'valuation', 'investment_date', 'round', 'terms')
            ->withTimestamps();
    }
}
