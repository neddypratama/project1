<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class P3K extends Model
{
    use HasFactory;
    protected $table = 'p3ks';
    protected $primaryKey = 'p3k_id';
    protected $fillable = [
        'p3k_id',
        'tanggal',
        'status',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function p3k1():HasMany{
        return $this->hasMany(IsiP3K::class, 'p3k_id', 'p3k_id');
    }

    public function p3k2():HasMany{
        return $this->hasMany(KondisiP3K::class, 'p3k_id', 'p3k_id');
    }

    public function p3k3():HasMany{
        return $this->hasMany(InputIsiP3K::class, 'p3k_id', 'p3k_id');
    }

    public function p3k4():HasMany{
        return $this->hasMany(InputKondisiP3K::class, 'p3k_id', 'p3k_id');
    }
    public function p3k5():HasMany{
        return $this->hasMany(KotakP3K::class, 'p3k_id', 'p3k_id');
    }
}


