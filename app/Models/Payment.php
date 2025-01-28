<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payment';
    protected $primaryKey = 'no_bayar';
    public $incrementing = false;
    protected $guarded = ['created_at', 'updated_at'];
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
