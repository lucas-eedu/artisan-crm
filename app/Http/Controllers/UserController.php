<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserMyProfileRequest;

class UserController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('profile')->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profiles = Profile::orderBy('name')->get();
        
        return view('users.create', compact('profiles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        flash('Usuário criado com sucesso!')->success();
        return redirect()->route('user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $profiles = Profile::orderBy('name')->get();
        
        return view('users.edit', compact('user', 'profiles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->all();
        if($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        flash('Usuário atualizado com sucesso!')->success();
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id == 1) {
            flash('Não é possível excluir o usuário SuperAdministrador.')->error();
            return redirect()->route('user.index');
        }

        $user->delete();

        flash('Usuário removido com sucesso!')->success();
        return redirect()->route('user.index');
    }
    
    /**
     * myProfile
     *
     * @return void
     */
    public function myProfile() {
        if(!Gate::allows('user_myprofile')) {
            abort(403);
        }

        $user = User::findOrFail(auth()->user()->id);

        return view('users.myprofile', compact('user'));
    }
    
    /**
     * myProfileUpdate
     *
     * @param  mixed $request
     * @return void
     */
    public function myProfileUpdate(UserMyProfileRequest $request) {
        if (! Gate::allows('user_myprofile')) {
            abort(403);
        }

        $user = User::findOrFail(auth()->user()->id);

        $data = $request->all();

        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        flash('Dados atualizados com sucesso!')->success();
        return redirect()->route('myProfile');
    }
}
