<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request): View
    {
        $dt = [
            'menu' => 'Kelola User',
            'submenu' => '',
            'title' => 'List User'
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        $data = User::all();
        return view('users.index', compact('dt', 'menu', 'data'));
    }

    public function create(): View
    {
        $dt = [
            'menu' => 'Kelola User',
            'submenu' => '',
            'title' => 'Tambah User Baru'
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('dt', 'menu', 'roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                'roles' => 'required'
            ],
            [
                'name.required' => 'Nama belum diisi',
                'email.required' => 'Email belum diisi',
                'email.email' => 'Email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Password belum diisi',
                'password.same' => 'Password tidak sama',
                'role.required' => 'Role belum diisi',
            ]
        );

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User berhasil disimpan');
    }

    public function show($id): View
    {
        $dt = [
            'menu' => 'Kelola User',
            'submenu' => '',
            'title' => 'Detil User'
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        $user = User::find($id);
        return view('users.show', compact('dt', 'user', 'menu'));
    }

    public function edit($id): View
    {
        $dt = [
            'menu' => 'Kelola User',
            'submenu' => '',
            'title' => 'Form Tambah User Baru'
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('dt', 'user', 'menu', 'roles', 'userRole'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ], [
            'name.required' => 'Nama belum diisi',
            'email.required' => 'Email belum diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.same' => 'Password tidak sama',
            'role.required' => 'Role belum diisi',
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diupdate');
    }

    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus');
    }
}
