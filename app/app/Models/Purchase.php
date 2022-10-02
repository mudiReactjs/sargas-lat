<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

    use HasFactory;
    protected $table = 'purchases';
    protected $fillable = [
        'code_tr', 'product_id', 'tot_qty', 'tot_payment', 'payment_method', 'mitra', 'receipt'
    ];
}
