<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->authorizeResource(Profile::class, 'profile');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $profiles = Profile::select('profiles.*');

        $search = $request->input('search');
        if ($search) {
            $profiles = $profiles->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        $profiles = $profiles->orderBy('name', 'ASC')->paginate(10);

        return view('profiles.index', compact('profiles', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::orderBy('name')->get();
        return view('profiles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        $data = $request->all();
        
        $profile = Profile::create($data);

        if (isset($data['permissions'])) {
            $profile->permissions()->sync($data['permissions']);
        }

        flash('Perfil criado com sucesso!')->success();
        return redirect()->route('profile.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $permissions = Permission::orderBy('name')->get();
        return view('profiles.edit', compact('profile', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, Profile $profile)
    {
        $data = $request->all();

        $profile->update($data);

        if (isset($data['permissions'])) {
            $profile->permissions()->sync($data['permissions']);
        } else {
            $profile->permissions()->sync(array());
        }

        flash('Perfil atualizada com sucesso!')->success();
        return redirect()->route('profile.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        if ($profile->id == 1) {
            flash('Não é possível excluir o perfil SuperAdministrador.')->error();
            return redirect()->route('user.index');
        }

        $profile->delete();

        flash('Perfil removido com sucesso!')->success();
        return redirect()->route('profile.index');
    }
}
