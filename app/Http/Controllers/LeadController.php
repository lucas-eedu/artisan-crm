<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Models\Origin;
use App\Models\Product;
use Illuminate\Http\Request;

class LeadController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leads = Lead::where('company_id', auth()->user()->company_id)->paginate(10);

        return view('leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('company_id', auth()->user()->company_id)->where('status', 'active')->get();
        $products = Product::where('company_id', auth()->user()->company_id)->get();
        $origins = Origin::where('company_id', auth()->user()->company_id)->get();

        return view('leads.create', compact('products', 'origins', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['company_id'] = auth()->user()->company_id;

        Lead::create($data);

        flash('Lead criada com sucesso!')->success();
        return redirect()->route('lead.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    /**
     * Display a listing new leads
     *
     * @return void
     */
    public function showListNewLeads() {
        $leads = Lead::where('company_id', auth()->user()->company_id)->where('status', 'new')->paginate(10);

        return view('leads.new', compact('leads'));
    }

    /**
     * Display a listing negotiation leads
     *
     * @return void
     */
    public function showListNegotiationLeads() {
        $leads = Lead::where('company_id', auth()->user()->company_id)->where('status', 'negotiation')->paginate(10);

        return view('leads.negotiation', compact('leads'));
    }

    /**
     * Display a listing gain leads
     *
     * @return void
     */
    public function showListGainLeads() {
        $leads = Lead::where('company_id', auth()->user()->company_id)->where('status', 'gain')->paginate(10);

        return view('leads.gain', compact('leads'));
    }

    /**
     * Display a listing lost leads
     *
     * @return void
     */
    public function showListLostLeads() {
        $leads = Lead::where('company_id', auth()->user()->company_id)->where('status', 'lost')->paginate(10);

        return view('leads.lost', compact('leads'));
    }
}
