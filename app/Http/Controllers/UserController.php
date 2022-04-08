<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Profile;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserMyProfileRequest;

class UserController extends Controller
{
    use UploadTrait;

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
        if (auth()->user()->profile_id == 1) {
            $users = User::with('profile')->orderBy('company_id')->paginate(10);
        } else {
            $users = User::where('company_id', auth()->user()->company_id)->paginate(10);
        }

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = [];
        if (auth()->user()->profile_id == 1) {
            $companies = Company::orderBy('name')->get();
            $profiles = Profile::orderBy('name')->get();
        } else {
            $profiles = Profile::where('id', '!=', 1)->orWhereNull('id')->orderBy('name')->get();
        }

        return view('users.create', compact('companies', 'profiles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        if (auth()->user()->profile_id != 1 && $data['company_id'] != auth()->user()->company_id) {
            abort(403, 'Você não tem permissão para criar usuários de outras empresas.');
        }

        User::create($data);

        flash('Usuário criado com sucesso!')->success();
        return redirect()->route('user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (auth()->user()->profile_id == 1) {
            $profiles = Profile::orderBy('name')->get();
        } else {
            if ($user->company_id != auth()->user()->company_id) {
                abort(403, 'Você não tem permissão para editar usuários de outras empresas.');
            }
            $profiles = Profile::where('id', '!=', 1)->orWhereNull('id')->orderBy('name')->get();
        }

        return view('users.edit', compact('user', 'profiles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        if (auth()->user()->profile_id != 1 && $user->company_id != auth()->user()->company_id) {
            abort(403, 'Você não tem permissão para editar usuários de outras empresas.');
        }

        $data = $request->all();
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($user->id == auth()->user()->id && $user->status != $data['status']) {
            flash('Você não pode mudar o status do próprio usuário!')->error();
            return redirect()->route('user.index');
        }

        $user->update($data);

        flash('Usuário atualizado com sucesso!')->success();
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->company_id != auth()->user()->company_id) {
            abort(403, 'Você não tem permissão para excluir usuários de outras empresas.');
        }

        if ($user->id == 1) {
            flash('Não é possível excluir o usuário SuperAdministrador.')->error();
            return redirect()->route('user.index');
        }

        if ($user->id == auth()->user()->id) {
            flash('Não é possível excluir o próprio usuário')->error();
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
    public function myProfile()
    {
        if (!Gate::allows('user_myprofile')) {
            abort(403, 'Você não tem permissão para editar o perfil.');
        }

        $user = User::findOrFail(auth()->user()->id);

        return view('users.myprofile', compact('user'));
    }

    /**
     * myProfileUpdate
     *
     * @param  UserMyProfileRequest $request
     * @return void
     */
    public function myProfileUpdate(UserMyProfileRequest $request)
    {
        if (!Gate::allows('user_myprofile')) {
            abort(403, 'Você não tem permissão para editar o perfil.');
        }

        $user = User::findOrFail(auth()->user()->id);

        $data = $request->all();
        isset($data['lead_email']) ? $data['lead_email'] = 1 : $data['lead_email'] = 0;

        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('profile_picture')) {
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            $extensionCheck = in_array(strtolower($extension), $allowedExtensions);

            if (!$extensionCheck) {
                flash('O arquivo contém extensão não permitida: ' . $extension)->error();
                return redirect()->back()->withInput();
            }

            if (Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            
            $data['profile_picture'] = $this->imageUpload($request->file('profile_picture'));
        }

        $user->update($data);

        flash('Dados atualizados com sucesso!')->success();
        return redirect()->route('myProfile');
    }
}
