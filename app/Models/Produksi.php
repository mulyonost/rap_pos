<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    use HasFactory;
    protected $table="laporan_produksi";
    protected $guarded=[];

    // public function kas_detail() {
    //     return $this->hasMany(KasDetail::class, 'id_kas', 'id');

}
