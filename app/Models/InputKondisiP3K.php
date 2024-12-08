<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputKondisiP3K extends Model
{
    use HasFactory;
    protected $table = 'input_kondisi_p3ks';
    protected $primaryKey = 'input_kondisi_id';
    protected $fillable = [
        'input_kondisi_id',
        'kondisi_id',
        'hasil_check',
        'tindakan_perbaikan',
        'p3k_id',
        'created_at',
        'updated_at',
    ];
}
