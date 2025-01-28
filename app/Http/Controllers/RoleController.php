<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    //Authentication
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request): View
    {
        $dt = [
            'menu' => 'Kelola Hak Akses',
            'title' => 'List Role'
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('roles.index', compact('dt', 'menu', 'roles'));
    }
    public function create(): View
    {
        $dt = [
            'menu' => 'Kelola Hak Akses',
            'title' => 'Tambah Hak Akses Baru'
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        $permission = Permission::get();
        return view('roles.create', compact('dt', 'menu', 'permission'));
    }
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ], [
            'name.required' => 'nama belum diisi',
            'name.unique' => 'nama sudah terdaftar',
            'permission.required' => 'permission belum diisi',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('success', 'Role berhasil disimpan');
    }
    public function show($id): View
    {
        $dt = [
            'menu' => 'Kelola Hak Akses',
            'title' => 'Detil Hak Akses'
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('roles.show', compact('dt', 'menu', 'role', 'rolePermissions'));
    }
    public function edit($id): View
    {
        $dt = [
            'menu' => 'Kelola Hak Akses',
            'title' => 'Edit Hak Akses'
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('roles.edit', compact('dt', 'menu', 'role', 'permission', 'rolePermissions'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ], [
            'name.required' => 'nama belum diisi',
            'permission.required' => 'permission belum diisi',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('success', 'Role berhasil diupdate');
    }
    public function destroy($id): RedirectResponse
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Role berhasil dihapus');
    }
}
