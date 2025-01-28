<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoice';
    protected $primaryKey = 'no_inv';
    public $incrementing = false;
    protected $guarded = ['created_at', 'updated_at'];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
