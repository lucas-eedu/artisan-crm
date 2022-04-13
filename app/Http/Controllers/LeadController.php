<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Models\Origin;
use App\Models\Product;
use App\Mail\NewLeadEmail;
use Illuminate\Http\Request;
use App\Helpers\ProfileHelper;
use App\Http\Requests\LeadRequest;
use Illuminate\Support\Facades\Mail;

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
    public function index(Request $request)
    {
        $products = Product::where('company_id', auth()->user()->company_id);
        $origins = Origin::where('company_id', auth()->user()->company_id);

        if (ProfileHelper::isSeller()) {
            $leads = Lead::where('company_id', auth()->user()->company_id)
                ->where('user_id', auth()->user()->id)
                ->orWhere(function ($query) {
                    $query->where('company_id', auth()->user()->company_id);
                    $query->where('user_id', NULL);
                });
        } else {
            $leads = Lead::where('company_id', auth()->user()->company_id);
            $users = User::where('company_id', auth()->user()->company_id);
        }

        $search = $request->input('search');
        if ($search) {
            $leads = $leads->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
                $query->orWhere('email', 'like', '%' . $search . '%');
                $query->orWhere('phone', 'like', '%' . $search . '%');
            });
        }

        $search_product_id = $request->input('search_product_id');
        if ($search_product_id) {
            $leads = $leads->where('product_id', $search_product_id);
        }

        $search_origin_id = $request->input('search_origin_id');
        if ($search_origin_id) {
            $leads = $leads->where('origin_id', $search_origin_id);
        }

        $search_status = $request->input('search_status');
        if ($search_status) {
            $leads = $leads->where('status', $search_status);
        }

        $search_user_id = $request->input('search_user_id');
        if ($search_user_id) {
            $leads = $leads->where('user_id', $search_user_id);
        }

        $products = $products->get();
        $origins = $origins->get();
        ProfileHelper::isSeller() != true ? $users = $users->get() : $users = [];
        $leads = $leads->orderBy('created_at', 'DESC')->paginate(10);

        return view('leads.index', compact(
            'products',
            'origins',
            'users',
            'leads',
            'search',
            'search_status',
            'search_product_id',
            'search_origin_id',
            'search_user_id'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (ProfileHelper::isSeller()) {
            $users = User::where('id', auth()->user()->id)->get();
        } else {
            $users = User::where('company_id', auth()->user()->company_id)
                ->where('status', 'active')
                ->where('profile_id', '!=', 1)
                ->get();
        }

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
        $data['phone'] = str_replace(array(".", "/", "-", "(", ")", " "), '', $request->input('phone'));

        if ($data['user_id'] == 'AUTOMATIC') {

            if ($this->userWhoHasNotYetReceivedLeads($data['company_id']) == NULL) {
                $this->updatesLeadQueueColumnUsersWhoHaveAlreadyReceived($data['company_id']);

                $userWhoHasNotYetReceivedLeads = $this->userWhoHasNotYetReceivedLeads($data['company_id']);
                $data['user_id'] = $userWhoHasNotYetReceivedLeads->id;
                $leadCreated = Lead::create($data);

                $this->updatesUserWhoReceivedLead($leadCreated);
            } else {
                $data['user_id'] = $this->userWhoHasNotYetReceivedLeads($data['company_id'])->id;
                $leadCreated = Lead::create($data);

                $this->updatesUserWhoReceivedLead($leadCreated);
            }
        } else {
            $leadCreated = Lead::create($data);
        }

        $this->sendLeadEmail($leadCreated);

        flash('Lead criado com sucesso!')->success();
        return redirect()->route('lead.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        if ($lead->company_id != auth()->user()->company_id) {
            abort(403, 'Você não tem permissão para visualizar leads de outras empresas.');
        }

        if ($lead->user_id != auth()->user()->id && ProfileHelper::isSeller() && $lead->user_id != NULL) {
            abort(403, 'Você não tem permissão para visualizar leads que não pertence a você.');
        }

        if (ProfileHelper::isSeller()) {
            $users = User::where('id', auth()->user()->id)->get();
        } else {
            $users = User::where('company_id', auth()->user()->company_id)
                ->where('status', 'active')
                ->where('profile_id', '!=', 1)
                ->get();
        }

        return view('leads.show', compact('lead', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        if ($lead->company_id != auth()->user()->company_id) {
            abort(403, 'Você não tem permissão para editar leads de outras empresas.');
        }

        if ($lead->user_id != auth()->user()->id && ProfileHelper::isSeller() && $lead->user_id != NULL) {
            abort(403, 'Você não tem permissão para editar leads quem não pertence a você.');
        }

        if (ProfileHelper::isSeller()) {
            $users = User::where('id', auth()->user()->id)->get();
        } else {
            $users = User::where('company_id', auth()->user()->company_id)
                ->where('status', 'active')
                ->where('profile_id', '!=', 1)
                ->get();
        }

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
     * @param  Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        if (auth()->user()->company_id != $lead->company_id) {
            abort(403, 'Você não tem permissão para editar leads de outras empresas.');
        }

        if (ProfileHelper::isSeller() && auth()->user()->id != $lead->user_id) {
            abort(403, 'Você não tem permissão para editar leads que não pertence a você.');
        }

        $data = $request->all();

        if ($request->input('phone')) {
            $data['phone'] = str_replace(array(".", "/", "-", "(", ")", " "), '', $request->input('phone'));
        }

        $lead->update($data);

        flash('Lead atualizado com sucesso!')->success();
        return redirect()->route('lead.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Lead  $lead
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
        if (ProfileHelper::isSeller()) {
            $leads = Lead::where('company_id', auth()->user()->company_id)
                ->where('status', 'new')
                ->where('user_id', auth()->user()->id)
                ->orWhere(function ($query) {
                    $query->where('company_id', auth()->user()->company_id);
                    $query->where('status', 'new');
                    $query->where('user_id', NULL);
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
        if (ProfileHelper::isSeller()) {
            $leads = Lead::where('company_id', auth()->user()->company_id)
                ->where('status', 'negotiation')
                ->where('user_id', auth()->user()->id)
                ->orWhere(function ($query) {
                    $query->where('company_id', auth()->user()->company_id);
                    $query->where('status', 'negotiation');
                    $query->where('user_id', NULL);
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
        if (ProfileHelper::isSeller()) {
            $leads = Lead::where('company_id', auth()->user()->company_id)
                ->where('status', 'gain')
                ->where('user_id', auth()->user()->id)
                ->orWhere(function ($query) {
                    $query->where('company_id', auth()->user()->company_id);
                    $query->where('status', 'gain');
                    $query->where('user_id', NULL);
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
        if (ProfileHelper::isSeller()) {
            $leads = Lead::where('company_id', auth()->user()->company_id)
                ->where('status', 'lost')
                ->where('user_id', auth()->user()->id)
                ->orWhere(function ($query) {
                    $query->where('company_id', auth()->user()->company_id);
                    $query->where('status', 'lost');
                    $query->where('user_id', NULL);
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

    /**
     * Returns the id of the user who has not yet received leads
     *
     * @param  int $company_id
     * @return mixed
     */
    public function userWhoHasNotYetReceivedLeads(string $company_id): mixed
    {
        return User::where('company_id', $company_id)
            ->where('status', 'active')
            ->where('lead_queue', 0)
            ->where('profile_id', '!=', '1')
            ->first();
    }

    /**
     * Updates the lead_queue of users who already receive Leads
     *
     * @param  mixed $company_id
     * @return void
     */
    public function updatesLeadQueueColumnUsersWhoHaveAlreadyReceived(string $company_id)
    {
        $usersWhoReceivedLeads = User::where('company_id', $company_id)
            ->where('status', 'active')
            ->where('lead_queue', 1)
            ->where('profile_id', '!=', '1');

        $leadQueue['lead_queue'] = 0;
        $usersWhoReceivedLeads->update($leadQueue);
    }

    /**
     * Update User Who Received the Lead
     *
     * @param  mixed $leadCreated
     * @return void
     */
    public function updatesUserWhoReceivedLead($leadCreated)
    {
        $leadQueue['lead_queue'] = 1;
        $leadOwner = User::where('id', $leadCreated->user_id);
        $leadOwner->update($leadQueue);
    }

    /**
     * Send the lead email to the users who should receive it
     *
     * @param  mixed $leadCreated
     * @return void
     */
    public function sendLeadEmail($leadCreated)
    {
        $users = User::where('company_id', $leadCreated->company_id)
            ->where('status', 'active')
            ->where('lead_email', 1)
            ->where('id', $leadCreated->user_id)
            ->orWhere(function ($query) {
                $query->where('company_id', auth()->user()->company_id);
                $query->where('status', 'active');
                $query->where('lead_email', 1);
                $query->where('profile_id', '2');
            })
            ->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new NewLeadEmail($leadCreated));
        }
    }
}
