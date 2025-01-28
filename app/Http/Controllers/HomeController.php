<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dt = [
            'menu' => 'Profile',
            'submenu' => '',
            'title' => 'Profile'
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        return view('profile', compact('dt', 'menu'));
    }
    public function layout()
    {
        $dt = [
            'menu' => 'Profile',
            'submenu' => '',
            'title' => 'Profile'
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        return view('halkos', compact('dt', 'menu'));
    }
    public function fganti_psswrd()
    {
        $dt = [
            'menu' => 'Profile',
            'submenu' => '',
            'title' => 'Profile'
        ];
        $menu = [
            'menu' => Menu::all()->sortBy('urutan'),
        ];
        $user = User::where('name', Auth::user()->name)->get()[0];
        return view('ganti_password', compact('dt', 'menu', 'user'));
    }
    public function update_psswrd(Request $request, User $user): RedirectResponse
    {
        $this->validate(
            $request,
            [
                'pss1' => 'required|min:5',
                'pss2' => 'required|min:5|same:pss1',
            ],
            [
                'pss1.required' => 'Password belum diisi',
                'pss1.min' => 'minimal 5 karakter',
                'pss2.required' => 'Konfirmasi passwrd belum diisi',
                'pss2.min' => 'minimal 5 karakter',
                'pss2.same' => 'Password dan konfirmasinya tidak sama',
            ]
        );

        $pssbaru = [
            'password'  => bcrypt($request->pss1)
        ];
        // update password user  
        $user->update($pssbaru);
        return redirect()->route('home')->with(['success' => 'Password Berhasil Diubah']);
    }
}
