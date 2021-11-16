<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianAvalan extends Model
{
    use HasFactory;
    protected $table = 'pembelian_avalan';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
