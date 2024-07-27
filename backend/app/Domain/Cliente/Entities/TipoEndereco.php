<?php

namespace App\Domain\Cliente\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoEndereco extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome',
    ];
}
