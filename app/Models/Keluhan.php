<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Keluhan extends Model
{
    use HasUuids;

    public $timestamps = false;

    protected $table = 'keluhan';
    protected $primaryKey = 'id_keluhan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_petani', 'teks_keluhan', 'tanggal', 'status'];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function petani(): BelongsTo
    {
        return $this->belongsTo(Petani::class, 'id_petani', 'id_petani');
    }
}
