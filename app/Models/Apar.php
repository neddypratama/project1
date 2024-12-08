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
        'apar_id',
        'tanggal',
        'status',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function apar1():HasMany{
        return $this->hasMany(uraian::class, 'apar_id', 'apar_id');
    }

    public function apar2():HasMany{
        return $this->hasMany(InputApar::class, 'apar_id', 'apar_id');
    }
}
