<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\DetilOrder;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:pengembalian-list|pengembalian-create|pengembalian-edit|pengembalian-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:pengembalian-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:pengembalian-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pengembalian-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        // cek role user yg login
        $pengembalian = [];
        $customer = [];
        $role = Auth::user()->roles->pluck('name')[0];
        if ($role == 'Admin') {
            $pengembalian = Pengembalian::all();
        } else {
            $dataCustomer = Customer::where('user_id', Auth::user()->id)->get();
            if (!empty($dataCustomer)) {
                foreach ($dataCustomer as $pq) {
                    $customer[] = $pq->id;
                }
            }
            $pengembalian = Pengembalian::whereIn('customer_id', $customer)->get();
        }
        $dt = [
            'menu' => 'Kelola Pengembalian',
            'title' => 'List Pengembalian',
            'pengembalian' => $pengembalian,
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        return view('pengembalian.index', compact('dt', 'menu'));
    }
    public function destroy($id)
    {
        $dataPengembalian = Pengembalian::findOrFail($id);
        $dataOrder = Order::where('no_order', $dataPengembalian->no_order)->first();
        $dataOrder->update([
            'status' => 'Open'
        ]);
        // update stock inventory
        $dataDetilOrder = DetilOrder::where('no_pinjaman', $dataPengembalian->no_order)->get();
        foreach ($dataDetilOrder as $ab) {
            $inventory = Inventory::findOrFail($ab->inventory_id);
            $inventory->update([
                'qtt' => $inventory->qtt - $ab->qtt,
            ]);
        }
        $dataPengembalian->delete();
        return redirect()->route('finishorder.index')->with('success', 'Data pengembalian berhasil dihapus');
    }
    public function invoicing($id)
    {
        $dataPengembalian = Pengembalian::findOrFail($id);
        $detilOrder = DetilOrder::where('no_pinjaman', $dataPengembalian->no_order)->get();
        $nominal = 0;
        foreach ($detilOrder as $d) {
            $nominal += $d->nominal;
        }
        $dataPengembalian->update([
            'status' => 'Invoice'
        ]);
        // jika ada perpanjangan 
        if ($dataPengembalian->terlambat > 0) {
            foreach ($detilOrder as $d) {
                $nominal += $d->qtt * $d->inventory->harga_sewa * $dataPengembalian->terlambat;
            }
        }
        Invoice::create([
            'no_inv' => 'INV-00' . count(Invoice::all()) + 1,
            'customer_id' => $dataPengembalian->customer_id,
            'tgl' => $dataPengembalian->tgl_kembali,
            'pengembalian_id' => $dataPengembalian->id,
            'nominal' => $nominal,
            'deskripsi' => 'Total biaya dari inventory yang anda pinjam',
        ]);
        return redirect()->route('finishorder.index')->with('success', 'Pembuatan invoice berhasil');
    }
}
