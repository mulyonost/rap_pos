<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackingDetail extends Model
{
    use HasFactory;
    protected $table = 'laporan_packing_detail';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function aluminium()
    {
        return $this->belongsTo(Aluminium::class, 'id_aluminium', 'id');
    }
}
