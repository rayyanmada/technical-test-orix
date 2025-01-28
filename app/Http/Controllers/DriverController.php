<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Driver;
use Illuminate\View\View;
use App\Models\DetilOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:driver-list|driver-create|driver-edit|driver-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:driver-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:driver-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:driver-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $dt = [
            'menu' => 'Kelola Driver',
            'title' => 'List Driver',
            'driver' => Driver::all(),
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        return view('driver.index', compact('dt', 'menu'));
    }
    public function create(): View
    {
        $dt = [
            'menu' => 'Kelola Driver',
            'title' => 'Tambah Driver Baru'
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        return view('driver.create', compact('dt', 'menu'));
    }
    public function store(Request $request): RedirectResponse
    {
        $validated = request()->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'aktive' => 'required',
            'photo' => 'required',
        ], [
            'nama.required' => 'nama belum diisi',
            'alamat.required' => 'alamat belum diisi',
            'telp.required' => 'telp belum diisi',
            'aktive.required' => 'status belum diisi',
            'photo.required' => 'file photo belum diupload',
        ]);

        //menyimpan photo driver 
        $photo = $request->file('photo');
        $namaPhoto = $photo->hashName();
        $photo->storeAs('public/driver', $namaPhoto);
        $validated['photo'] = $namaPhoto;

        //menyimpan driver dan photonya ke database
        Driver::create($validated);
        return redirect()->route('driver.index')->with('success', 'Driver berhasil disimpan.');
    }
    public function edit(driver $driver): View
    {
        $dt = [
            'menu' => 'Kelola Driver',
            'title' => 'Edit Driver',
            'driver' => $driver,
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        return view('driver.edit', compact('dt', 'menu'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
        $validated = request()->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'aktive' => 'required',
        ], [
            'nama.required' => 'nama belum diisi',
            'alamat.required' => 'alamat belum diisi',
            'telp.required' => 'telp belum diisi',
            'aktive.required' => 'aktive belum diisi',
        ]);

        $driver = driver::findOrFail($id);
        //Cek apakah ada photo yg diupload
        if ($request->hasFile('photo')) {

            //hapus photo driver lama
            Storage::delete('public/driver/' . basename($driver->photo));
            //upload photo driver baru
            $photo = $request->file('photo');
            $namaPhoto = $photo->hashName();
            $photo->storeAs('public/driver', $namaPhoto);
            $validated['photo'] = $namaPhoto;
        } else {
            $validated['photo'] = $driver->photo;
        }
        //update produk
        $driver->update($validated);

        return redirect()->route('driver.index')->with('success', 'Data driver berhasil diupdate');
    }
    public function destroy(driver $driver): RedirectResponse
    {
        // cek apakah ada invoice utk driver tsb
        $cek = Order::where('driver_id', $driver->id)->count();
        if ($cek > 0) {
            return redirect()->route('driver.index')->with('success', 'Driver tidak boleh dihapus');
        }
        //hapus photo driver
        Storage::delete('public/driver/' . basename($driver->photo));
        $driver->delete();
        return redirect()->route('driver.index')->with('success', 'Data driver berhasil dihapus');
    }
    public function getphoto(Request $request)
    {
        $id = $request->id;
        $photo = Driver::findOrFail($id)->photo;
        return response()->json([
            'photo' => $photo,
            'psn' => 'Berhasil'
        ]);
    }
    public function getdriver(Request $request)
    {
        $driver = Driver::findOrFail($request->id);
        return response()->json([
            'berhasil' => true,
            'data' => $driver,
        ]);
    }
}