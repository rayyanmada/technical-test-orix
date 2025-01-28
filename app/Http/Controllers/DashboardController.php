<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $periodeBulan = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $x_axis = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        $namaBulan = [
            '01' => 'Januari',
            '02' => 'Febuari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'Nopember',
            '12' => 'Desember',
        ];
        $dataOrder = [];
        foreach ($periodeBulan as $p) {
            $dataOrder[] = [
                'bulan' => $namaBulan[$p],
                'nominal' => Order::whereMonth('tgl', '=', $p)->sum('nominal'),
            ];
        }

        foreach ($periodeBulan as $p) {
            $nomOrder[] = Order::whereMonth('tgl', '=', $p)->sum('nominal');
        }

        $dt = [
            'menu' => 'Dashboard',
            'submenu' => '',
            'title' => 'Dashboard',
            'x_axis' => $x_axis,
            'nom_order' => $nomOrder,
            'order' => $dataOrder,
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        return view('dashboard', compact('dt', 'menu'));
    }
}
