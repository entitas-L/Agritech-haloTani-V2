<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laporan extends Model
{
    use HasUuids;

    const UPDATED_AT = null;

    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['bulan', 'tahun', 'isi_data'];

    public function akses(): HasMany
    {
        return $this->hasMany(AksesLaporan::class, 'id_laporan', 'id_laporan');
    }
}
