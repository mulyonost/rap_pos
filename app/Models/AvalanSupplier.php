<?php

namespace App\Models;

use App\Models\Avalan;
use App\Models\Suppliers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AvalanSupplier extends Model
{
    use HasFactory;
    protected $table = 'avalan_supplier';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'id_supplier', 'id');
    }

    public function avalan()
    {
        return $this->belongsTo(Avalan::class, 'id_avalan', 'id');
    }
}
