<?php

namespace App\Models;

use App\Models\Produksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProduksiDetail extends Model
{
    use HasFactory;
    protected $table = 'laporan_produksi_detail';
    protected $guarded = [];

    public function laporan_produksi()
    {
        $this->belongsTo(Produksi::class, 'id_laporan_detail', 'id_laporan_detail');
    }
}
