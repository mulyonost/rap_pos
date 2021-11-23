<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianAvalanDetail extends Model
{
    use HasFactory;
    protected $table = "pembelian_avalan_detail";
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function master()
    {
        return $this->belongsTo(PembelianAvalan::class, 'id_pembelian_avalan', 'id');
    }

    public function avalan()
    {
        return $this->belongsTo(Avalan::class, 'id_avalan', 'id');
    }
}
