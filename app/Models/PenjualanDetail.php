<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    use HasFactory;
    protected $table = "penjualan_detail";
    protected $primaryKey = "id";
    protected $guarded = [];

    public function aluminium()
    {
        return $this->belongsTo(Aluminium::class, 'id_aluminium', 'id');
    }

    public function master()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan', 'id');
    }
}
