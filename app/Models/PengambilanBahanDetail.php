<?php

namespace App\Models;

use App\Models\Items;
use App\Models\PengambilanBahan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengambilanBahanDetail extends Model
{
    use HasFactory;
    protected $table = 'pengambilan_bahan_detail';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function master()
    {
        return $this->belongsTo(PengambilanBahan::class, 'id_pengambilan_bahan', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Items::class, 'id_item', 'id');
    }
}
