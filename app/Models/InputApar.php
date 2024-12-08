<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputApar extends Model
{
    use HasFactory;
    protected $table = 'input_apars';
    protected $primaryKey = 'input_apar_id';
    protected $fillable = [
        'sub_uraian_id',
        'hasil_apar',
        'revisi',
        'apar_id',
        'created_at',
        'updated_at',
    ];

    
}
