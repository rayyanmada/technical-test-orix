<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Inventory;
use App\Models\DetilOrder;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:inventory-list|inventory-create|inventory-edit|inventory-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:inventory-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:inventory-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:inventory-delete', ['only' => ['destroy']]);
    }
    public function index(): View
    {
        $dt = [
            'menu' => 'Kelola Inventory',
            'title' => 'List Inventory',
            'inventory' => Inventory::all(),
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        return view('inventory.index', compact('dt', 'menu'));
    }
    public function create(): View
    {
        $dt = [
            'menu' => 'Kelola Inventory',
            'title' => 'Tambah Inventory Baru'
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        return view('inventory.create', compact('dt', 'menu'));
    }
    public function store(Request $request): RedirectResponse
    {
        $validated = request()->validate([
            'nama' => 'required',
            'merek' => 'required',
            'pwr_mesin' => 'required',
            'oil' => 'required',
            'qtt' => 'required',
            'photo' => 'required',
            'harga_sewa' => 'required',
            'keterangan' => 'required',
        ], [
            'nama.required' => 'nama belum diisi',
            'merek.required' => 'merek belum diisi',
            'pwr_mesin.required' => 'power mesin belum diisi',
            'oil.required' => 'oil belum diisi',
            'qtt.required' => 'qtt belum diisi',
            'photo.required' => 'file photo belum diupload',
            'harga_sewa.required' => 'harga belum diisi',
            'keterangan.required' => 'keterangan belum diisi',
        ]);

        //menyimpan photo inventory 
        $photo = $request->file('photo');
        $namaPhoto = $photo->hashName();
        $photo->storeAs('public/inventory', $namaPhoto);
        $validated['photo'] = $namaPhoto;

        //menyimpan inventory dan photonya ke database
        Inventory::create($validated);
        return redirect()->route('inventory.index')->with('success', 'Inventory berhasil disimpan.');
    }
    public function edit(Inventory $inventory): View
    {
        $dt = [
            'menu' => 'Kelola Inventory',
            'title' => 'Edit Inventory',
            'inventory' => $inventory,
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        return view('inventory.edit', compact('dt', 'menu'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
        $validated = request()->validate([
            'nama' => 'required',
            'merek' => 'required',
            'pwr_mesin' => 'required',
            'oil' => 'required',
            'qtt'  => 'required',
            'harga_sewa' => 'required',
            'keterangan' => 'required',
        ], [
            'nama.required' => 'nama belum diisi',
            'merek.required' => 'merek belum diisi',
            'pwr_mesin.required' => 'power mesin belum diisi',
            'oil.required' => 'oil belum diisi',
            'qtt.required' => 'qtt belum diisi',
            'harga_sewa.required' => 'harga belum diisi',
            'keterangan.required' => 'keterangan belum diisi',
        ]);

        $inventory = Inventory::findOrFail($id);
        //Cek apakah ada photo yg diupload
        if ($request->hasFile('photo')) {

            //hapus photo inventory lama
            Storage::delete('public/inventory/' . basename($inventory->photo));
            //upload photo inventory baru
            $photo = $request->file('photo');
            $namaPhoto = $photo->hashName();
            $photo->storeAs('public/inventory', $namaPhoto);
            $validated['photo'] = $namaPhoto;
        } else {
            $validated['photo'] = $inventory->photo;
        }
        //update produk
        $inventory->update($validated);

        return redirect()->route('inventory.index')->with('success', 'Data inventory berhasil diupdate');
    }
    public function destroy(Inventory $inventory): RedirectResponse
    {
        // cek apakah ada invoice utk inventory tsb
        $cek = DetilOrder::where('inventory_id', $inventory->id)->count();
        if ($cek > 0) {
            return redirect()->route('inventory.index')->with('success', 'Inventory tidak boleh dihapus');
        }
        //hapus photo inventory
        Storage::delete('public/inventory/' . basename($inventory->photo));
        $inventory->delete();
        return redirect()->route('inventory.index')->with('success', 'Data inventory berhasil dihapus');
    }
    public function getphoto(Request $request)
    {
        $id = $request->id;
        $photo = Inventory::findOrFail($id)->photo;
        return response()->json([
            'photo' => $photo,
            'psn' => 'Berhasil'
        ]);
    }
    public function getinventory(Request $request)
    {
        $inventory = Inventory::findOrFail($request->id);
        return response()->json([
            'berhasil' => true,
            'data' => $inventory,
        ]);
    }
}
