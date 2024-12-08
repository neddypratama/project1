<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InputIsiP3K extends Model
{
    use HasFactory;
    protected $table = 'input_isi_p3ks';
    protected $primaryKey = 'input_isi_id';
    protected $fillable = [
        'input_isi_id',
        'isi_id',
        'jumlah_aktual',
        'tanggal_kadaluarsa',
        'keterangan',
        'p3k_id',
        'created_at',
        'updated_at',
    ];
}
