<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProduksiDetal;

class Aluminium extends Model
{
    use HasFactory;
    protected $table = 'aluminium';
    protected $primaryKey = 'id';
    protected $guarded = [];
}

