<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financial extends Model
{
    use HasFactory;

    protected $fillable = [
        'startup_id',
        'investor_id',
        'investment_amount',
        'equity_offered',
        'valuation',
        'investment_date',
        'round',
        'terms'
    ];

    protected $casts = [
        'investment_amount' => 'decimal:2',
        'equity_offered' => 'decimal:2',
        'valuation' => 'decimal:2',
        'investment_date' => 'date',
    ];

    public function startup()
    {
        return $this->belongsTo(Startup::class);
    }

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }
}
