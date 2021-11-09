<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Permission::class, 'permission');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderBy('created_at', 'ASC')->paginate(10);

        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $data = $request->all();

        Permission::create($data);

        flash('Permissão criada com sucesso!')->success();
        return redirect()->route('permission.index');
    }
      
    /**
     * edit
     *
     * @param  mixed $permission
     * @return void
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }
   
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $data = $request->all();
        
        $permission->update($data);

        flash('Permissão atualizada com sucesso!')->success();
        return redirect()->route('permission.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        flash('Permissão excluída com sucesso!')->success();
        return redirect()->route('permission.index');
    }
}
