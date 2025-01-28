<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MerkController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:merk-list|merk-create|merk-edit|merk-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:merk-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:merk-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:merk-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $dt = [
            'menu' => 'Kelola Merk',
            'title' => 'List merk',
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
                return view('merk.index', compact('dt', 'menu'));
    }
}
