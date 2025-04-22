<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Startup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'founder_name',
        'description',
        'industry',
        'stage',
        'total_funding',
        'employee_count',
        'location',
        'founded_date',
        'website',
        'status'
    ];

    protected $casts = [
        'founded_date' => 'date',
        'total_funding' => 'decimal:2',
    ];

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }

    public function financials()
    {
        return $this->hasMany(Financial::class);
    }

    public function investments()
    {
        return $this->hasMany(Financial::class);
    }

    public function investors()
    {
        return $this->belongsToMany(Investor::class, 'financials')
            ->withPivot('investment_amount', 'equity_offered', 'valuation', 'investment_date', 'round', 'terms')
            ->withTimestamps();
    }
}
