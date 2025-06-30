<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\PhotoUploadService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Exibir uma lista de todos os usuários.
     * Apenas usuários com o papel de 'master' podem acessar essa lista.
     */
    public function index(){
        $this->authorize('viewAny', User::class);
        $users = User::all();
        return view('auth.users.index', compact('users'));
    }

    /**
     * Exibir o formulário para criar um novo usuário.
     * Apenas usuários com o papel de 'master' podem acessar o formulário.
     */
    public function create(){
        $this->authorize('create', User::class);
        return view('auth.users.create');
    }

    /**
     * Armazenar um novo usuário no banco de dados.
     * Apenas usuários com o papel de 'master' podem criar novos usuários.
     */
    public function store(StoreUserRequest $request, PhotoUploadService $photoService){

        $this->authorize('create', User::class);

        $userData = $request->validated();
        $userData['password'] = bcrypt($userData['password']);
        $userData['is_master'] = $userData['is_master'] ?? false;

        if ($request->hasFile('profile_photo')) {
            $userData['profile_photo_path'] = $photoService->upload($request->file('profile_photo'));
        }

        User::create($userData);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }

    /**
     * Exibir o formulário para editar um usuário existente.
     * Apenas usuários com o papel de 'master' podem acessar o formulário de edição.
     */
    public function edit($id){
        $user = User::findOrFail($id);
        $this->authorize('update', $user);
        return view('auth.users.edit', compact('user'));
    }

    /**
     * Atualizar um usuário existente no banco de dados.
     * Apenas usuários com o papel de 'master' podem atualizar usuários.
     */
    public function update(UpdateUserRequest $request, $id, PhotoUploadService $photoService){
        $user = User::findOrFail($id);
        $this->authorize('update', $user);

        $data = $request->validated();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->telephone = $data['telephone'];

        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }

        // Só permite alterar is_master se não estiver editando a si mesmo
        if (Auth::user()->id !== $user->id && isset($data['is_master'])) {
            $user->is_master = $data['is_master'];
        }

        try {
            if ($request->has('remove_photo') && $request->remove_photo == '1') {
                $photoService->delete($user->profile_photo_path);
                $user->profile_photo_path = null;
            } elseif ($request->hasFile('profile_photo')) {
                $photoService->delete($user->profile_photo_path);
                $user->profile_photo_path = $photoService->upload($request->file('profile_photo'));
            }
            $user->save();
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar usuário: ' . $e->getMessage());
        }
    
        if (Auth::user()->is_master) {
            return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
        } else {
            return redirect()->route('admin.index')->with('success', 'Perfil atualizado com sucesso!');
        }
    }

    /**
     * Excluir um usuário do banco de dados.
     * Apenas usuários com o papel de 'master' podem excluir usuários.
     */
    public function destroy($id){
        $user = User::findOrFail($id);
        $this->authorize('delete', $user);

        if ($user->products()->count() > 0) {
            return redirect()->route('users.index')->with('error', 'Não é possível excluir este usuário enquanto houver produtos cadastrados em sua conta.');
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
    }
}
