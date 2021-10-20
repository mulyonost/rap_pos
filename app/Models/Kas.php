<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kas extends Model
{
    use HasFactory;
    protected $table="kas";
    protected $guarded=[];

    public function kas_detail() {
        return $this->hasMany(KasDetail::class, 'id_kas', 'id');
    }
}
