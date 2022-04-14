<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class DashboardController extends Controller
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * dashboard
     *
     * @return self
     */
    public function dashboard()
    {
        $currentYear = date('Y');
        $currentMonth = date('m');

        $numberLeadsThisMonth = $this->queryLeads($currentYear, $currentMonth)->count();
        $numberNegotiationLeadsThisMonth = $this->queryLeads($currentYear, $currentMonth)->where('status', 'negotiation')->count();
        $numberGainLeadsThisMonth = $this->queryLeads($currentYear, $currentMonth)->where('status', 'gain')->count();
        $numberLostLeadsThisMonth = $this->queryLeads($currentYear, $currentMonth)->where('status', 'lost')->count();

        for ($i=1; $i < 13; $i++) { 
            $numberLeadsPerMonth[$i] = $this->queryLeads($currentYear, $i)->count();
            $numberLeadsNegotiationPerMonth[$i] = $this->queryLeads($currentYear, $i)->where('status', 'negotiation')->count();
            $numberLeadsGainPerMonth[$i] = $this->queryLeads($currentYear, $i)->where('status', 'gain')->count();
            $numberLeadsLostPerMonth[$i] = $this->queryLeads($currentYear, $i)->where('status', 'lost')->count();
        }

        return view('pages.dashboard', compact(
            'numberLeadsThisMonth',
            'numberNegotiationLeadsThisMonth',
            'numberGainLeadsThisMonth',
            'numberLostLeadsThisMonth',
            'numberLeadsPerMonth',
            'numberLeadsNegotiationPerMonth',
            'numberLeadsGainPerMonth',
            'numberLeadsLostPerMonth'
        ));
    }
    
    /**
     * queryLeads
     *
     * @param  string $year
     * @param  string $month
     * @return mixed
     */
    public function queryLeads(string $year, string $month)
    {
        return Lead::where('company_id', auth()->user()->company_id)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month);
    }
}
