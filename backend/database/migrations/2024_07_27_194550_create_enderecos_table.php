<?php

use App\Domain\Cliente\Entities\Pessoa;
use App\Domain\Cliente\Entities\TipoEndereco;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->uuid('id_public');
            $table->string('cep');
            $table->string('logradouro');
            $table->string('numero')->nullable();
            $table->string('complemento');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado');
            $table->boolean('historico')->nullable();
            $table->foreignIdFor(Pessoa::class)->constrained('pessoas');
            $table->foreignIdFor(TipoEndereco::class)->constrained('tipo_enderecos');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enderecos');
    }
};
