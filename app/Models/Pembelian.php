<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'id_supplier', 'id');
    }
}
