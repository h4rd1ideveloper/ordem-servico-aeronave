<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicoItem extends Model
{
    use HasFactory;

    protected $table = 'servico_itens';

    protected $fillable = [
        'ordem_servico_id',
        'numero_item',
        'descricao',
        'equipe',
        'intervalo',
        'horas',
        'ciclos',
        'observacoes'
    ];

    public function ordemServico()
    {
        return $this->belongsTo(OrdemServico::class);
    }
}

