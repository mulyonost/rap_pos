<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasDetail extends Model
{
    use HasFactory;
    protected $table="kas_detail";
    protected $guarded =[];

    public function kas(){
        return $this->belomgsTo(Kas::class, 'id', 'id');
    }
}
