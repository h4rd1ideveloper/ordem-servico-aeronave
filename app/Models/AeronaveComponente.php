<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AeronaveComponente extends Model
{
    use HasFactory;

    protected $table = 'aeronave_componentes';

    protected $fillable = [
        'ordem_servico_id',
        'tipo',
        'serial_number',
        'modelo',
        'fabricante',
        'ano_fabricacao',
        'tsn',
        'tso',
        'revisao',
        'cso'
    ];

    public function ordemServico()
    {
        return $this->belongsTo(OrdemServico::class);
    }
}

