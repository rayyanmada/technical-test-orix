<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Customer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class CustomerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:customer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:customer-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }
    public function index(): View
    {
        // cek role user yg login
        $customer = [];
        $role = Auth::user()->roles->pluck('name')[0];
        if ($role == 'Admin') {
            $customer = Customer::all();
        } else {
            $customer = Customer::where('user_id', Auth::user()->id)->get();
        }
        $dt = [
            'menu' => 'Kelola Customer',
            'title' => 'List customer',
            'customer' => $customer,
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        return view('customer.index', compact('dt', 'menu'));
    }
    public function create(): View
    {
        // cek role user yg login
        $sales = [];
        $role = Auth::user()->roles->pluck('name')[0];
        if ($role == 'Admin') {
            $sales = User::all();
        } else {
            $sales = User::where('name', Auth::user()->name)->get();
        }
        $dt = [
            'menu' => 'Kelola Customer',
            'title' => 'Tambah Customer Baru',
            'sales' => $sales,
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        return view('customer.create', compact('dt', 'menu'));
    }
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'pic' => 'required',
        ], [
            'user_id.required' => 'belum diisi',
            'nama.required' => 'belum diisi',
            'alamat.required' => 'belum diisi',
            'telp.required' => 'belum diisi',
            'pic.required' => 'belum diisi',
        ]);

        $berhasil = Customer::create($validated);
        if ($berhasil) {
            return redirect()->route('customer.index')->with('success', 'Data customer berhasil disimpan');
        }
    }
    public function edit(customer $customer): View
    {
        // cek role user yg login
        $sales = [];
        $role = Auth::user()->roles->pluck('name')[0];
        if ($role == 'Admin') {
            $sales = User::all();
        } else {
            $sales = User::where('name', Auth::user()->name)->get();
        }
        $dt = [
            'menu' => 'Kelola Customer',
            'title' => 'Edit Data customer',
            'customer' => $customer,
            'sales' => $sales,
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        return view('customer.edit', compact('dt', 'menu'));
    }
    public function update(Request $request, Customer $customer): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'pic' => 'required',
        ], [
            'user_id.required' => 'belum diisi',
            'nama.required' => 'belum diisi',
            'alamat.required' => 'belum diisi',
            'telp.required' => 'belum diisi',
            'pic.required' => 'belum diisi',
        ]);

        $berhasil = $customer->update($validated);
        if ($berhasil) {
            return redirect()->route('customer.index')->with('success', 'Data customer berhasil diupdate');
        }
    }
    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();
        return redirect()->route('customer.index')->with('success', 'Data customer berhasil dihapus');
    }
    public function getcustomer(Request $request)
    {
        $customer = Customer::findOrFail($request->id);
        return response()->json([
            'berhasil' => true,
            'customer' => $customer,
        ]);
    }
}
