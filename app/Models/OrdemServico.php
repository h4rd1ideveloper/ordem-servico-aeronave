<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    use HasFactory;

    protected $table = 'ordem_servicos';

    protected $fillable = [
        'numero_os',
        'aeronave_matricula',
        'data_inicio',
        'termino_previsto',
        'empresa_nome',
        'empresa_endereco',
        'documento_codigo',
        'documento_data'
    ];

    protected $casts = [
        'data_inicio' => 'date',
        'termino_previsto' => 'date',
        'documento_data' => 'date'
    ];

    public function componentes()
    {
        return $this->hasMany(AeronaveComponente::class);
    }

    public function itensServico()
    {
        return $this->hasMany(ServicoItem::class);
    }

    public function getAirframe()
    {
        return $this->componentes()->where('tipo', 'AIRFRAME')->first();
    }

    public function getLeftEngine()
    {
        return $this->componentes()->where('tipo', 'LEFT ENGINE')->first();
    }

    public function getRightEngine()
    {
        return $this->componentes()->where('tipo', 'RIGHT ENGINE')->first();
    }

    public function getLeftPropeller()
    {
        return $this->componentes()->where('tipo', 'LEFT PROPELLER')->first();
    }

    public function getRightPropeller()
    {
        return $this->componentes()->where('tipo', 'RIGHT PROPELLER')->first();
    }
}

