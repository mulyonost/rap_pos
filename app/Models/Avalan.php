<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avalan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'avalan';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function detail()
    {
        return $this->hasMany(PembelianAvalanDetail::class, 'id_avalan', 'id');
    }
}
