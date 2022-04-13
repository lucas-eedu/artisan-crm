<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Profile;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use App\Helpers\ProfileHelper;
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
    public function index(Request $request)
    {
        if (ProfileHelper::isSuperAdministrator()) {
            $users = User::with('profile');
            $companies = Company::with('users');
        } else {
            $users = User::where('company_id', auth()->user()->company_id);
        }

        $search = $request->input('search');
        if ($search) {
            $users = $users->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
                $query->orWhere('email', 'like', '%' . $search . '%');
                $query->orWhere('status', $search);
                $query->orWhereHas('profile', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
                $query->orWhereHas('company', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            });
        }

        $search_company_id = $request->input('search_company_id');
        if ($search_company_id) {
            $users = $users->where('company_id', $search_company_id);
        }

        $search_status = $request->input('search_status');
        if ($search_status) {
            $users = $users->where('status', $search_status);
        }

        $users = $users->paginate(10);

        ProfileHelper::isSuperAdministrator() == true ? $companies = $companies->get() : $companies = [];

        return view('users.index', compact('users', 'companies', 'search', 'search_status', 'search_company_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = [];
        if (ProfileHelper::isSuperAdministrator()) {
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
        if (ProfileHelper::isSuperAdministrator()) {
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

        if ($user->id == auth()->user()->id && $user->status != $data['status']) {
            flash('Você não pode mudar o status do próprio usuário!')->error();
            return redirect()->route('user.index');
        }

        if ($request->input('email') != $user->email) {
            $data['email_verified_at'] = NULL;
        }

        if ($data['password']) {
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
     * Returns the MyProfile view passing the data of the logged in user
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
     * Update logged user data
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

        if ($request->input('email') != $user->email) {
            $data['email_verified_at'] = NULL;
        }

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
