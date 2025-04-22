<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'startup_id',
        'title',
        'description',
        'target_date',
        'achieved_date',
        'status',
        'category'
    ];

    protected $casts = [
        'target_date' => 'date',
        'achieved_date' => 'date',
    ];

    public function startup()
    {
        return $this->belongsTo(Startup::class);
    }
}
