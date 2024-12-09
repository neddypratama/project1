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
        'dokumentasi',
        'created_at',
        'updated_at',
    ];

    public function apar2():HasMany{
        return $this->hasMany(InputApar::class, 'apar_id', 'apar_id');
    }
}
