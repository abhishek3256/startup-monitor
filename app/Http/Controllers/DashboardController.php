<?php

namespace App\Http\Controllers;

use App\Models\Startup;
use App\Models\Investor;
use App\Models\Milestone;
use App\Models\Financial;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStartups = Startup::count();
        $totalInvestors = Investor::count();
        $totalFunding = Financial::sum('investment_amount');
        $pendingMilestones = Milestone::where('status', 'pending')->count();
        
        $recentStartups = Startup::latest()->take(5)->get();
        $recentInvestments = Financial::with(['startup', 'investor'])
            ->latest()
            ->take(5)
            ->get();
        
        $upcomingMilestones = Milestone::with('startup')
            ->where('status', 'pending')
            ->orderBy('target_date')
            ->take(5)
            ->get();

        $industryStats = Startup::selectRaw('industry, count(*) as count')
            ->groupBy('industry')
            ->get();

        $fundingByStage = Startup::selectRaw('stage, sum(total_funding) as total')
            ->groupBy('stage')
            ->get();

        return view('dashboard', compact(
            'totalStartups',
            'totalInvestors',
            'totalFunding',
            'pendingMilestones',
            'recentStartups',
            'recentInvestments',
            'upcomingMilestones',
            'industryStats',
            'fundingByStage'
        ));
    }
}
