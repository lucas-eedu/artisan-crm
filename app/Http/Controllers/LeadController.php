<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Models\Origin;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\LeadRequest;

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
        $this->authorizeResource(Lead::class, 'lead');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->profile_id == 3) {
            $leads = Lead::where('company_id', auth()->user()->company_id)
                ->where('user_id', auth()->user()->id)
                ->orWhere(function ($query) {
                    $query->where('user_id', NULL);
                })
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        } else {
            $leads = Lead::where('company_id', auth()->user()->company_id)
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }

        return view('leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('company_id', auth()->user()->company_id)
            ->where('status', 'active')
            ->where('profile_id', '!=', 1)
            ->get();

        $products = Product::where('company_id', auth()->user()->company_id)
            ->where('status', 'active')
            ->get();

        $origins = Origin::where('company_id', auth()->user()->company_id)
            ->where('status', 'active')
            ->get();

        return view('leads.create', compact('products', 'origins', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeadRequest $request)
    {
        $data = $request->all();
        $data['company_id'] = auth()->user()->company_id;
        $data['status'] = 'new';

        Lead::create($data);

        flash('Lead criado com sucesso!')->success();
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
    public function edit(Lead $lead)
    {
        if ($lead->company_id != auth()->user()->company_id) {
            abort(403, 'Você não tem permissão para editar leads de outras empresas.');
        }

        $users = User::where('company_id', auth()->user()->company_id)
            ->where('status', 'active')
            ->where('profile_id', '!=', 1)
            ->get();

        $products = Product::where('company_id', auth()->user()->company_id)
            ->where('status', 'active')
            ->get();

        $origins = Origin::where('company_id', auth()->user()->company_id)
            ->where('status', 'active')
            ->get();

        return view('leads.edit', compact('lead', 'users', 'products', 'origins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        if ($lead->company_id != auth()->user()->company_id) {
            abort(403, 'Você não tem permissão para editar leads de outras empresas.');
        }

        $data = $request->all();

        $lead->update($data);

        flash('Lead atualizado com sucesso!')->success();
        return redirect()->route('lead.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        if ($lead->company_id != auth()->user()->company_id) {
            abort(403, 'Você não tem permissão para excluir leads de outras empresas.');
        }

        $lead->delete();

        flash('Lead removido com sucesso!')->success();
        return redirect()->route('lead.index');
    }

    /**
     * Display a listing new leads
     *
     * @return void
     */
    public function showListNewLeads()
    {
        if (auth()->user()->profile_id == 3) {
            $leads = Lead::where('company_id', auth()->user()->company_id)
                ->where('status', 'new')->where('user_id', auth()->user()->id)
                ->orWhere(function ($query) {
                    $query->where('user_id', NULL)
                        ->where('status', 'new');
                })
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        } else {
            $leads = Lead::where('company_id', auth()->user()->company_id)
                ->where('status', 'new')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }

        return view('leads.new', compact('leads'));
    }

    /**
     * Display a listing negotiation leads
     *
     * @return void
     */
    public function showListNegotiationLeads()
    {
        if (auth()->user()->profile_id == 3) {
            $leads = Lead::where('company_id', auth()->user()->company_id)
                ->where('status', 'negotiation')->where('user_id', auth()->user()->id)
                ->orWhere(function ($query) {
                    $query->where('user_id', NULL)
                        ->where('status', 'negotiation');
                })
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        } else {
            $leads = Lead::where('company_id', auth()->user()->company_id)
                ->where('status', 'negotiation')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }

        return view('leads.negotiation', compact('leads'));
    }

    /**
     * Display a listing gain leads
     *
     * @return void
     */
    public function showListGainLeads()
    {
        if (auth()->user()->profile_id == 3) {
            $leads = Lead::where('company_id', auth()->user()->company_id)
                ->where('status', 'gain')
                ->where('user_id', auth()->user()->id)
                ->orWhere(function ($query) {
                    $query->where('user_id', NULL)
                        ->where('status', 'gain');
                })
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        } else {
            $leads = Lead::where('company_id', auth()->user()->company_id)
                ->where('status', 'gain')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }

        return view('leads.gain', compact('leads'));
    }

    /**
     * Display a listing lost leads
     *
     * @return void
     */
    public function showListLostLeads()
    {
        if (auth()->user()->profile_id == 3) {
            $leads = Lead::where('company_id', auth()->user()->company_id)
                ->where('status', 'lost')
                ->where('user_id', auth()->user()->id)
                ->orWhere(function ($query) {
                    $query->where('user_id', NULL)
                        ->where('status', 'lost');
                })
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        } else {
            $leads = Lead::where('company_id', auth()->user()->company_id)
                ->where('status', 'lost')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }

        return view('leads.lost', compact('leads'));
    }
}
