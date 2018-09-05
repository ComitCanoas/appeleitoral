<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var RoleRepository
     */
    private $roleRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        //$users = $this->userRepository->orderBy('name')->paginate();

        $users = User::withTrashed()->OrderBy('name')->paginate(10);

        return view('administrar.user.index', compact('users'));
    }

    public function edit($id)
    {
        $perfis = $this->roleRepository->pluck('nome', 'id');
        $perfis->prepend('Selecione', '');

        $user = $this->userRepository->find($id);

        return view('administrar.user.edit', compact('user', 'perfis'));
    }
}
