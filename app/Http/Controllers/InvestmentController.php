<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use App\Models\Startup;
use App\Models\Investor;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'startup_id' => 'required|exists:startups,id',
            'investor_id' => 'required|exists:investors,id',
            'investment_amount' => 'required|numeric|min:0',
            'equity_offered' => 'required|numeric|min:0|max:100',
            'valuation' => 'required|numeric|min:0',
            'investment_date' => 'required|date',
            'round' => 'required|string|max:50',
            'terms' => 'nullable|string'
        ]);

        Financial::create($validated);

        return redirect()->back()->with('success', 'Investment recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
