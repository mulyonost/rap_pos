<?php

namespace App\Models;

use App\Models\Produksi;
use App\Models\Aluminium;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProduksiDetail extends Model
{
    use HasFactory;
    protected $table = 'laporan_produksi_detail';
    protected $guarded = [];

    public function laporan_produksi()
    {
        $this->belongsTo(Produksi::class);
    }

    public function aluminium()
    {
        return $this->belongsTo(Aluminium::class, 'id_aluminium', 'id');
    }

    public function master()
    {
        return $this->belongsTo(Produksi::class, 'id_laporan_produksi', 'id');
    }
}
