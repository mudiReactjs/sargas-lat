<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;

    protected $table = 'debts';
    protected $fillable = [
        'fishermen_id', 'nominal'
    ];

    public function fishermen()
    {
        return $this->belongsTo(Fishermen::class);
    }
}
