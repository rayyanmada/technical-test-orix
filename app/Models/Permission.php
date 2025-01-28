<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = [];
    public function getPermission()
    {
        return DB::table('permissions')->where('name', 'like', "%" . 'list' . "%")->get();
    }
}
