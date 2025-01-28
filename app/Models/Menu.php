<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $fillable = [
        'nama', 'icon', 'url', 'akses', 'submenu', 'urutan'
    ];
    public function getMenuHaveSubmenu()
    {
        return DB::table('menu')->where('submenu', 1)->orderBy('urutan')->get();
    }
}
