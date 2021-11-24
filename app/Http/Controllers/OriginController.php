<?php

namespace App\Http\Controllers;

use App\Models\Origin;
use Illuminate\Http\Request;
use App\Http\Requests\OriginRequest;

class OriginController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Origin::class, 'origin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $origins = Origin::where('company_id', auth()->user()->company_id)->paginate(10);

        return view('origins.index', compact('origins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('origins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OriginRequest $request)
    {
        $data = $request->all();

        if($data['company_id'] != auth()->user()->company_id) {
            abort(403, 'Você não tem permissão de criar origens para outras empresas.');
        }

        Origin::create($data);
        
        flash('Origem criada com sucesso!')->success();
        return redirect()->route('origin.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Origin  $origin
     * @return \Illuminate\Http\Response
     */
    public function edit(Origin $origin)
    {
        if($origin->company_id != auth()->user()->company_id) {
            abort(403, 'Você não tem permissão para editar origens de outras empresas.');
        }

        return view('origins.edit', compact('origin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Origin  $origin
     * @return \Illuminate\Http\Response
     */
    public function update(OriginRequest $request, Origin $origin)
    {
        if($origin->company_id != auth()->user()->company_id) {
            abort(403, 'Você não tem permissão para editar origens de outras empresas.');
        }

        $data = $request->all();

        $origin->update($data);

        flash('Origem atualizada com sucesso!')->success();
        return redirect()->route('origin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Origin  $origin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Origin $origin)
    {
        if($origin->company_id != auth()->user()->company_id) {
            abort(403, 'Você não tem permissão para excluir origens de outras empresas.');
        }

        $origin->delete();

        flash('Origem removida com sucesso!')->success();
        return redirect()->route('origin.index');
    }
}
