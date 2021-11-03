<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AluminiumBase extends Model
{
    use HasFactory;
    protected $table = 'aluminium_base';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
