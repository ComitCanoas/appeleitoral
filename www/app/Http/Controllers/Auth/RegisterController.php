<?php

namespace App\Http\Controllers\Auth;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserRoleRepository;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * @var UserRoleRepository
     */
    private $userRoleRepository;

    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository, UserRoleRepository $userRoleRepository)
    {
        //$this->middleware('guest');
        $this->userRepository = $userRepository;
        $this->userRoleRepository = $userRoleRepository;
        $this->roleRepository = $roleRepository;
    }

    public function showRegistrationForm()
    {
        $perfis = $this->roleRepository->pluck('nome', 'id');
        $perfis->prepend('Selecione', '');

        return view('auth.register', compact('perfis'));
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->userRoleRepository->create(['user_id' => $user->id, 'role_id' => $request->get('perfil')]);

        Session::flash('mensagem', 'Usuário cadastrado com sucesso');

        return redirect()->route('user.create');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'perfil' => 'required|numeric'
        ]);
    }

    protected function validatorEdit(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'perfil' => 'required|numeric'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validatoredit($request->all())->validate();

        $this->userRepository->update($request->all(), $id);

        $user = $this->userRepository->find($id);

        if(!$user->userRole){
            $this->userRoleRepository->create(['user_id' => $id, 'role_id' => $request->get('perfil')]);
        }else{
            $this->userRoleRepository->update(['role_id' => $request->get('perfil')], $user->userRole->id);
        }

        Session::flash('mensagem', 'Dados alterados com sucesso');

        return redirect()->route('user.edit', $id);
    }

    public function destroy($id)
    {
        $this->userRepository->delete($id);

        Session::flash('mensagem', 'Usuário inativado com sucesso');

        return redirect()->route('user.index');
    }

    public function restore($id)
    {
        //Modo de pesquisar usuário deletado com repository
        $user = $this->userRepository->scopeQuery(function($query){
            return $query->withTrashed();
        })->find($id);

        $user->restore();

        Session::flash('mensagem', 'Usuário '. $user->name .' ativado novamente');

        return redirect()->route('user.index');
    }
}
