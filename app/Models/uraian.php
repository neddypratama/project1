<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class uraian extends Model
{
    use HasFactory;
    protected $table = 'uraians';
    protected $primaryKey = 'uraian_id';
    protected $fillable = [
        'uraian_nama',
        'uraian_tipe',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function uraian1():HasMany{
        return $this->hasMany(SubUraian::class, 'uraian_id', 'uraian_id');
    }

    public function uraian2():HasMany{
        return $this->hasMany(P3K::class, 'uraian_id', 'uraian_id');
    }
}
