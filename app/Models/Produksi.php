<?php

namespace App\Models;

use App\Models\ProduksiDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produksi extends Model
{
    use HasFactory;
    protected $table = "laporan_produksi";
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function laporan_produksi_detail()
    {
        return $this->hasMany(ProduksiDetail::class);
    }
}
