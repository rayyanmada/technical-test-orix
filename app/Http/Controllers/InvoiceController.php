<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Client;
use App\Models\Report;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\View\View;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetilOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class InvoiceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:invoice-list|invoice-create|invoice-edit|invoice-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:invoice-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:invoice-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:invoice-delete', ['only' => ['destroy']]);
    }
    public function index(): View
    {
        // cek role user yg login
        $invoice = [];
        $customer = [];
        $role = Auth::user()->roles->pluck('name')[0];
        if ($role == 'Admin') {
            $invoice = Invoice::all();
        } else {
            $dataCustomer = Customer::where('user_id', Auth::user()->id)->get();
            if (!empty($dataCustomer)) {
                foreach ($dataCustomer as $pq) {
                    $customer[] = $pq->id;
                }
            }
            $invoice = Invoice::whereIn('customer_id', $customer)->get();
        }
        $dt = [
            'menu' => 'Kelola Invoice',
            'submenu' => '',
            'title' => 'List invoice',
            'invoice' => $invoice,
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        return view('invoice.index', compact('dt', 'menu'));
    }
    public function cetak($no_inv)
    {
        $dataInvoice = Invoice::where('no_inv', $no_inv)->get()[0];
        $dataPengembalian = Pengembalian::findOrFail($dataInvoice->pengembalian_id);
        $detilOrder = DetilOrder::where('no_pinjaman', $dataPengembalian->no_order)->get();
        return view('invoice.cetak', compact('dataInvoice', 'dataPengembalian', 'detilOrder'));
    }
}
