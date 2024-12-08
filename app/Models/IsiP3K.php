<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IsiP3K extends Model
{
    use HasFactory;
    protected $table = 'isi_p3ks';
    protected $primaryKey = 'isi_id';
    protected $fillable = [
        'isi_id',
        'isi_nama',
        'jumlah_standar',
        'p3k_id',
        'created_at',
        'updated_at',
    ];

    public function isi1():HasMany{
        return $this->hasMany(InputIsiP3K::class, 'isi_id', 'isi_id');
    }
}
