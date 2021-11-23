<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    use HasFactory;
    protected $table = 'pembelian_detail';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function items()
    {
        return $this->belongsTo(Items::class, 'id_item', 'id');
    }
}
