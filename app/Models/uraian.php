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
        'apar_id',
        'created_at',
        'updated_at',
    ];

    public function uraian():HasMany{
        return $this->hasMany(SubUraian::class, 'uraian_id', 'uraian_id');
    }
}
