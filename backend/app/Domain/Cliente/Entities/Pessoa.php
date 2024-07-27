<?php

namespace App\Domain\Cliente\Entities;

use App\Models\ModelBase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends ModelBase
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome',
        'nome_social',
        'cpf',
        'telefone',
        'nome_pai',
        'nome_mae',
        'email',
        'id_public',
    ];

    public function endereco(): HasMany
    {
        return $this->hasMany(Endereco::class, 'pessoa_id', 'id')->withTrashed();
    }
}
