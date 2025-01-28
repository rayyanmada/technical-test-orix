<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = 'pengembalian';
    protected $guarded = ['created_at', 'updated_at'];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
