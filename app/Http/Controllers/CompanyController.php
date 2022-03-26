<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\MyCompanyRequest;

class CompanyController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Company::class, 'company');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('name', 'ASC')->paginate(10);

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $data = $request->all();

        Company::create($data);

        flash('Empresa criada com sucesso!')->success();
        return redirect()->route('company.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $data = $request->all();
        
        $company->update($data);

        flash('Empresa atualizada com sucesso!')->success();
        return redirect()->route('company.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if ($company->users()) {
            flash('Não é possível excluir uma empresa que tenha usuários!')->error();
            return redirect()->route('company.index');
        }

        $company->delete();

        flash('Empresa excluída com sucesso!')->success();
        return redirect()->route('company.index');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @return void
     */
    public function myCompany()
    {
        if (!Gate::allows('my_company')) {
            abort(403, 'Você não tem permissão para editar a empresa.');
        }
        
        $company = Company::findOrFail(auth()->user()->company_id);

        if ($company->id != auth()->user()->company_id) {
            flash('Não é possível editar outra empresa')->error();
            return redirect()->route('dashboard');
        }

        return view('companies.mycompany', compact('company'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  MyCompanyRequest $request
     * @return void
     */
    public function myCompanyUpdate(MyCompanyRequest $request)
    {
        if (!Gate::allows('my_company')) {
            abort(403, 'Você não tem permissão para editar a empresa.');
        }

        $company = Company::findOrFail(auth()->user()->company_id);

        if ($company->id != auth()->user()->company_id) {
            flash('Não é possível editar outra empresa')->error();
            return redirect()->route('dashboard');
        }

        $data = $request->all();
        $company->update($data);

        flash('Dados atualizados com sucesso!')->success();
        return redirect()->route('myCompany');
    }
}
