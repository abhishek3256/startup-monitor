<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Startup;
use App\Models\Investor;
use App\Models\Milestone;
use App\Models\Financial;
use Carbon\Carbon;

class StartupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Investors
        $investor1 = Investor::create([
            'name' => 'TechVentures Capital',
            'type' => 'VC',
            'total_investment' => 5000000,
            'number_of_investments' => 10,
            'location' => 'Mumbai',
            'investment_focus' => 'Technology, SaaS, FinTech',
            'website' => 'www.techventures.com'
        ]);

        $investor2 = Investor::create([
            'name' => 'Angel Network India',
            'type' => 'Angel',
            'total_investment' => 2000000,
            'number_of_investments' => 5,
            'location' => 'Bangalore',
            'investment_focus' => 'Early Stage, Technology',
            'website' => 'www.angelnetwork.in'
        ]);

        // Create Startups
        $startup1 = Startup::create([
            'name' => 'TechHealth Solutions',
            'founder_name' => 'Rajesh Kumar',
            'description' => 'AI-powered healthcare diagnostics platform',
            'industry' => 'Healthcare',
            'stage' => 'Series A',
            'total_funding' => 2000000,
            'employee_count' => 25,
            'location' => 'Bangalore',
            'founded_date' => '2022-01-15',
            'website' => 'www.techhealth.com',
            'status' => 'active'
        ]);

        $startup2 = Startup::create([
            'name' => 'EduTech Pro',
            'founder_name' => 'Priya Sharma',
            'description' => 'Online learning platform for professional courses',
            'industry' => 'Education',
            'stage' => 'Seed',
            'total_funding' => 1000000,
            'employee_count' => 15,
            'location' => 'Mumbai',
            'founded_date' => '2023-03-20',
            'website' => 'www.edutechpro.com',
            'status' => 'active'
        ]);

        // Create Milestones
        Milestone::create([
            'startup_id' => $startup1->id,
            'title' => 'Product Launch',
            'description' => 'Launch of AI diagnostic platform',
            'target_date' => '2024-06-30',
            'status' => 'pending',
            'category' => 'product'
        ]);

        Milestone::create([
            'startup_id' => $startup1->id,
            'title' => 'Series B Funding',
            'description' => 'Raise Series B funding round',
            'target_date' => '2024-12-31',
            'status' => 'pending',
            'category' => 'funding'
        ]);

        Milestone::create([
            'startup_id' => $startup2->id,
            'title' => 'User Base Growth',
            'description' => 'Reach 100,000 active users',
            'target_date' => '2024-08-31',
            'status' => 'pending',
            'category' => 'growth'
        ]);

        // Create Financials
        Financial::create([
            'startup_id' => $startup1->id,
            'investor_id' => $investor1->id,
            'investment_amount' => 1500000,
            'equity_offered' => 15.00,
            'valuation' => 10000000,
            'investment_date' => '2023-06-15',
            'round' => 'Series A',
            'terms' => 'Standard terms with 1x liquidation preference'
        ]);

        Financial::create([
            'startup_id' => $startup1->id,
            'investor_id' => $investor2->id,
            'investment_amount' => 500000,
            'equity_offered' => 5.00,
            'valuation' => 10000000,
            'investment_date' => '2023-06-15',
            'round' => 'Series A',
            'terms' => 'Standard terms with 1x liquidation preference'
        ]);

        Financial::create([
            'startup_id' => $startup2->id,
            'investor_id' => $investor1->id,
            'investment_amount' => 1000000,
            'equity_offered' => 20.00,
            'valuation' => 5000000,
            'investment_date' => '2023-09-01',
            'round' => 'Seed',
            'terms' => 'Standard terms with 1x liquidation preference'
        ]);
    }
}
