<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetilOrder extends Model
{
    use HasFactory;
    protected $table = 'detil_order';
    protected $guarded = ['created_at', 'updated_at'];
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
