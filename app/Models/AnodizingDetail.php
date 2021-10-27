<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnodizingDetail extends Model
{
    use HasFactory;
    protected $table = 'laporan_anodizing_detail';
    protected $guarded = [];

    public function laporan_anodizing()
    {
        $this->belongsTo(Produksi::class);
    }

    public function aluminium()
    {
        return $this->belongsTo(Aluminium::class, 'id_aluminium', 'id');
    }
}
