<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanPaid extends Model
{
    use HasFactory;
    protected $table = "penjualan_paid";
    protected $primaryKey = "id";
    protected $guarded = [];
}
