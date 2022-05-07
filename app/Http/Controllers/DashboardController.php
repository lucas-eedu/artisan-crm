<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

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

        $leadsOfMonth = $this->returnsLeadsOfMonthReport($currentYear, $currentMonth);

        for ($i=1; $i < 13; $i++) { 
            $numberLeadsPerMonth[$i] = $this->queryLeadsByYearAndMonth($currentYear, $i)->count();
            $numberLeadsNegotiationPerMonth[$i] = $this->queryLeadsByYearAndMonth($currentYear, $i)->where('status', 'negotiation')->count();
            $numberLeadsGainPerMonth[$i] = $this->queryLeadsByYearAndMonth($currentYear, $i)->where('status', 'gain')->count();
            $numberLeadsLostPerMonth[$i] = $this->queryLeadsByYearAndMonth($currentYear, $i)->where('status', 'lost')->count();
        }

        return view('pages.dashboard', compact(
            'leadsOfMonth',
            'numberLeadsPerMonth',
            'numberLeadsNegotiationPerMonth',
            'numberLeadsGainPerMonth',
            'numberLeadsLostPerMonth'
        ));
    }
    
    /**
     * returns Leads Of Month Report
     *
     * @param  int $currentYear
     * @param  int $currentMonth
     * @return array
     */
    public function returnsLeadsOfMonthReport(int $currentYear, int $currentMonth): array
    {
        $data = [
            'numberLeadsThisMonth' => $numberLeadsThisMonth = $this->queryLeadsByYearAndMonth($currentYear, $currentMonth)->count(),
            'numberNegotiationLeadsThisMonth' => $numberNegotiationLeadsThisMonth = $this->queryLeadsByYearAndMonth($currentYear, $currentMonth)->where('status', 'negotiation')->count(),
            'numberGainLeadsThisMonth' => $numberGainLeadsThisMonth = $this->queryLeadsByYearAndMonth($currentYear, $currentMonth)->where('status', 'gain')->count(),
            'numberLostLeadsThisMonth' => $numberLostLeadsThisMonth = $this->queryLeadsByYearAndMonth($currentYear, $currentMonth)->where('status', 'lost')->count(),
        ];
        return $data;
    }
    
    /**
     * Query leads by year and by month
     *
     * @param  string $year
     * @param  string $month
     * @return mixed
     */
    public function queryLeadsByYearAndMonth(string $year, string $month): Collection
    {
        return Lead::where('company_id', auth()->user()->company_id)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month);
    }
}
