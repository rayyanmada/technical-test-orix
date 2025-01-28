<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $guarded = ['created_at', 'updated_at'];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
