<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProduksiDetal;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aluminium extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'aluminium';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
