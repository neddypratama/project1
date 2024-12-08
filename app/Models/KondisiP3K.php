<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KondisiP3K extends Model
{
    use HasFactory;
    protected $table = 'kondisi_p3ks';
    protected $primaryKey = 'kondisi_id';
    protected $fillable = [
        'kondisi_id',
        'item_check',
        'p3k_id',
        'created_at',
        'updated_at',
    ];

    public function kondisi1():HasMany{
        return $this->hasMany(InputKondisiP3K::class, 'kondisi_id', 'kondisi_id');
    }
}
