<?php

namespace App\Domain\Cliente\Entities;

use App\Models\ModelBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Endereco extends ModelBase
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'tipo_endereco_id',
        'pessoa_id',
        'id_public',
    ];

    public function tipoEndereco(): BelongsTo
    {
        return $this->belongsTo(TipoEndereco::class);
    }
}
