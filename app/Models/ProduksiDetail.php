<?php

namespace App\Models;

use App\Models\Produksi;
use App\Models\Aluminium;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProduksiDetail extends Model
{
    use HasFactory;
    protected $table = 'produksi_detail';
    protected $guarded = [];

    public function aluminium()
    {
        return $this->belongsTo(AluminiumBase::class, 'id_aluminium_base', 'id');
    }

    public function master()
    {
        return $this->belongsTo(Produksi::class, 'id_laporan_produksi', 'id');
    }
}
