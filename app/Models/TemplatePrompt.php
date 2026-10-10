<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TemplatePrompt extends Model
{
    use HasUuids;

    const CREATED_AT = null;

    protected $table = 'template_prompt';
    protected $primaryKey = 'id_template';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_petani', 'isi_template'];

    public function petani(): BelongsTo
    {
        return $this->belongsTo(Petani::class, 'id_petani', 'id_petani');
    }

     public static function aktif(): ?self
    {
        return static::orderByDesc('updated_at')->first();
    }
}
