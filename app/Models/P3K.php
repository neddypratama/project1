<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class P3K extends Model
{
    use HasFactory;
    protected $table = 'p3ks';
    protected $primaryKey = 'p3k_id';
    protected $fillable = [
        'bulan',
        'tahun',
        'p3k_hasil',
        'uraian_id',
        'created_at',
        'updated_at',
    ];
}
