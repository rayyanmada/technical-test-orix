<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Driver;
use App\Models\Customer;
use App\Models\Inventory;
use Illuminate\View\View;
use App\Models\DetilOrder;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:peminjaman-list|peminjaman-create|peminjaman-edit|peminjaman-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:peminjaman-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:peminjaman-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:peminjaman-delete', ['only' => ['destroy']]);
    }
    public function index(): View
    {
        // cek role user yg login
        $order = [];
        $customer = [];
        $role = Auth::user()->roles->pluck('name')[0];
        if ($role == 'Admin') {
            $order = order::all();
        } else {
            $dataCustomer = Customer::where('user_id', Auth::user()->id)->get();
            if (!empty($dataCustomer)) {
                foreach ($dataCustomer as $pq) {
                    $customer[] = $pq->id;
                }
            }
            $order = Order::whereIn('customer_id', $customer)->get();
        }
        $tglKembali = [];
        foreach ($order as $pq) {
            $tglKembali[] = DetilOrder::where('no_pinjaman', $pq->no_order)->first()->tgl_kembali;
        }
        $dt = [
            'menu' => 'Data Order',
            'title' => 'List order',
            'order' => $order,
            'tgl_kembali' => $tglKembali,
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        return view('order.index', compact('dt', 'menu'));
    }
    public function create(): View
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
            'menu' => 'Kelola Order',
            'title' => 'Tambah Order Baru',
            'customer' => $customer,
            'inventory' => Inventory::all(),
            'driver' => Driver::all(),
            'no_order' => 'ORD-0' . count(order::all()) + 1,
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        return view('order.create', compact('dt', 'menu'));
    }
    public function store(Request $request)
    {
        $nominal = 0;
        $nominalInv = 0;
        $k = 0;
        // simpan ke detil order 
        foreach ($request->inventory_id as $p) {
            $durasi = strtotime($request->tgl_kembali) - strtotime($request->tgl_pinjam);
            $durasi = $durasi / (24 * 60 * 60);
            $nominal = $durasi * $request->hrg_sewa[$k] * $request->qtt_rental[$k];
            $nominalInv += $durasi * $request->hrg_sewa[$k] * $request->qtt_rental[$k];
            DetilOrder::create([
                'no_pinjaman' => $request->no_order,
                'inventory_id' => $p,
                'qtt' => $request->qtt_rental[$k],
                'tgl_pinjam' => $request->tgl_pinjam,
                'tgl_kembali' => $request->tgl_kembali,
                'durasi' => $durasi,
                'nominal' => $nominal,
            ]);
            // update stock inventory 
            $dataInventory = Inventory::findOrFail($p);
            $dataInventory->update([
                'qtt' => $dataInventory->qtt - $request->qtt_rental[$k],
            ]);
            $k++;
        }
        // simpan ke tabel order 
        Order::create([
            'no_order' => $request->no_order,
            'customer_id' => $request->customer_id,
            'driver_id' => $request->driver_id,
            'tgl' => $request->tgl_pinjam,
            'nominal' => $nominalInv,
            'keterangan' => $request->keterangan,
            'status' => 'Open',
        ]);

        return redirect()->route('order.index')->with('success', 'Data order berhasil disimpan');
    }
    public function pengembalian($order_id)
    {
        $dataOrder = Order::findOrFail($order_id);
        $dataDetilOrder = DetilOrder::where('no_pinjaman', $dataOrder->no_order)->first();
        // insert ke table pengembalian
        $tepatWaktu = strtotime(date('Y-m-d')) < strtotime($dataDetilOrder->tgl_kembali);
        if (!$tepatWaktu) {
            $durasiRental = (strtotime(date('Y-m-d')) - strtotime($dataDetilOrder->tgl_pinjam)) / (24 * 60 * 60);
            $terlambat = $durasiRental - $dataDetilOrder->durasi;
            $dataPengembalian = [
                'no_order' => $dataOrder->no_order,
                'customer_id' => $dataOrder->customer_id,
                'tgl_kembali' => date('Y-m-d'),
                'keterangan' => $dataOrder->keterangan,
                'status' => ($tepatWaktu) ? 'Tepat Waktu' : 'Terlambat',
                'durasi' => $dataDetilOrder->durasi,
                'terlambat' => $terlambat,
            ];
        } else {
            $dataPengembalian = [
                'no_order' => $dataOrder->no_order,
                'customer_id' => $dataOrder->customer_id,
                'tgl_kembali' => date('Y-m-d'),
                'keterangan' => $dataOrder->keterangan,
                'status' => ($tepatWaktu) ? 'Tepat Waktu' : 'Terlambat',
                'durasi' => $dataDetilOrder->durasi,
                'terlambat' => 0,
            ];
        }
        Pengembalian::create($dataPengembalian);
        // ubah status order 
        $dataOrder->update([
            'status' => 'Kembali'
        ]);
        // update stock inventory
        $dataDetilOrder = DetilOrder::where('no_pinjaman', $dataOrder->no_order)->get();
        foreach ($dataDetilOrder as $ab) {
            $inventory = Inventory::findOrFail($ab->inventory_id);
            $inventory->update([
                'qtt' => $inventory->qtt + $ab->qtt,
            ]);
        }
        return redirect()->route('order.index')->with('success', 'Data pengembalian order berhasil disimpan');
    }
    public function approval($order_id)
    {
        $dataOrder = Order::findOrFail($order_id);
        $dataOrder->update([
            'approval' => 1,
        ]);
        return redirect()->route('order.index')->with('success', 'Data order berhasil diapprove');
    }
}
