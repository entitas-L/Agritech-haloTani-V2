<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class AksesLaporan extends Model
{
    protected $table = 'akses_laporan';
    protected $primaryKey = 'id_akses';
    public $timestamps = false;

    protected $fillable = ['id_petani', 'id_laporan', 'waktu_akses'];

    protected function casts(): array
    {
        return [
            'waktu_akses' => 'datetime',
        ];
    }

    public function petani(): BelongsTo
    {
        return $this->belongsTo(Petani::class, 'id_petani', 'id_petani');
    }

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class, 'id_laporan', 'id_laporan');
    }
}
