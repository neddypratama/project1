<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubUraian extends Model
{
    use HasFactory;
    protected $table = 'sub_uraians';
    protected $primaryKey = 'sub_uraian_id';
    protected $fillable = [
        'sub_uraian_nama',
        'sub_uraian_tipe',
        'uraian_id',
        'created_at',
        'updated_at',
    ];

    public function sub_uraian():HasMany{
        return $this->hasMany(InputApar::class, 'sub_uraian_id', 'sub_uraian_id');
    }
}
