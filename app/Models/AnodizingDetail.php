<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnodizingDetail extends Model
{
    use HasFactory;
    protected $table = 'anodizing_detail';
    protected $guarded = [];

    public function anodizing()
    {
        $this->belongsTo(Produksi::class);
    }

    public function aluminium()
    {
        return $this->belongsTo(Aluminium::class, 'id_aluminium', 'id');
    }

    public function master()
    {
        return $this->belongsTo(Anodizing::class, 'id_laporan_anodizing', 'id');
    }
}
