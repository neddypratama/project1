<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KotakP3K extends Model
{
    use HasFactory;
    protected $table = 'kotak_p3ks';
    protected $primaryKey = 'kotak_id';
    protected $fillable = [
        'kotak_id',
        'lokasi',
        'p3k_id',
        'created_at',
        'updated_at',
    ];
}
