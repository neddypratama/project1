<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apar extends Model
{
    use HasFactory;
    protected $table = 'apars';
    protected $primaryKey = 'apar_id';
    protected $fillable = [
        'bulan',
        'tahun',
        'apar_hasil',
        'sub_uraian_id',
        'created_at',
        'updated_at',
    ];
}
