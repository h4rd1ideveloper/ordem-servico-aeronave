<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrdemServico;
use App\Models\AeronaveComponente;
use App\Models\ServicoItem;

class OrdemServicoSeeder extends Seeder
{
    public function run()
    {
        // Criar primeira ordem de serviço
        $os1 = OrdemServico::create([
            'numero_os' => '03372/25',
            'aeronave_matricula' => 'PP-JCA',
            'data_inicio' => '2025-06-09',
            'termino_previsto' => '2025-06-20',
        ]);

        // Componentes da aeronave
        AeronaveComponente::create([
            'ordem_servico_id' => $os1->id,
            'tipo' => 'AIRFRAME',
            'serial_number' => 'LA-107',
            'modelo' => 'F50',
            'fabricante' => 'BEECH',
            'ano_fabricacao' => 1981,
            'tsn' => '9442.7',
            'tso' => 'N/A',
            'revisao' => 'Manual/CO / PN:109-590019-19',
        ]);

        AeronaveComponente::create([
            'ordem_servico_id' => $os1->id,
            'tipo' => 'LEFT ENGINE',
            'serial_number' => 'PCE-92264',
            'modelo' => 'PT6A-135',
            'fabricante' => 'PRATT & WHITNEY CANADA',
            'tsn' => '9442.7',
            'tso' => '2412',
            'cso' => '2126',
            'revisao' => 'Manual/49 / Revisão:P.M / PN:3043512',
        ]);

        AeronaveComponente::create([
            'ordem_servico_id' => $os1->id,
            'tipo' => 'RIGHT ENGINE',
            'serial_number' => 'PCE-92269',
            'modelo' => 'PT6A-135',
            'fabricante' => 'PRATT & WHITNEY CANADA',
            'tsn' => '9442.7',
            'tso' => '2412',
            'cso' => '2126',
            'revisao' => 'Manual/49 / Revisão:P.M / PN:3043512',
        ]);

        AeronaveComponente::create([
            'ordem_servico_id' => $os1->id,
            'tipo' => 'LEFT PROPELLER',
            'serial_number' => 'EAA-1533',
            'modelo' => 'HC-B4TN-3B',
            'fabricante' => 'HARTZELL',
            'tsn' => '4275.6',
            'tso' => '3547',
            'cso' => 'N/A',
            'revisao' => 'Manual/22 / Revisão:P.G.M / PN:139 (61-00-39)',
        ]);

        AeronaveComponente::create([
            'ordem_servico_id' => $os1->id,
            'tipo' => 'RIGHT PROPELLER',
            'serial_number' => 'EAA-1534',
            'modelo' => 'HC-B4TN-3B',
            'fabricante' => 'HARTZELL',
            'tsn' => '4275.6',
            'tso' => '3547',
            'cso' => 'N/A',
            'revisao' => 'Manual/22 / Revisão:P.G.M / PN:139 (61-00-39)',
        ]);

        // Itens de serviço
        $servicos = [
            'EFETUAR SUBSTITUIÇÃO DO TRANSMISSOR DE PRESSÃO DE ÓLEO LADO DIREITO',
            'EFETUAR SUBSTITUIÇÃO PNEU INTERNO DIREITO APRESENTANDO PERDA DE PRESSÃO',
            'AVALIAR JUNTAS DA TAMPA DA NACELE ESQUERDA',
            '(MSR) AIRFRAME > LUBRICATE ITEMS GM',
            '(MSR) LEFT ENGINE > CHECK AGB INTERNAL SCAVENGE OIL PUMP INLET SCREEN',
            '(MSR) RIGHT ENGINE > CHECK AGB INTERNAL SCAVENGE OIL PUMP INLET SCREEN',
            'TANQUE DA NACELLE LH DANIFICADO',
            'BARRAMENTO BUSTE DIREITO POR VEZES ABRE',
            'AUDIOS AURAIS DO SISTEMA DE AVIONICS INOPERANTE',
            'EFETUAR SUBSTITUIÇÃO DE UMA PROBE DE COMBUSTÍVEL LADO ESQUERDO',
            'EFETUAR SUBSTITUIÇÃO DE INDICADOR DE COMBUSTÍVEL LH E AFERIÇÃO DO SISTEMA',
            'VERIFICAR COMANDO DO TRIM QUANTO A INTEGRIDADE'
        ];

        foreach ($servicos as $index => $descricao) {
            ServicoItem::create([
                'ordem_servico_id' => $os1->id,
                'numero_item' => $index + 1,
                'descricao' => $descricao,
                'equipe' => 'André Segato - inspector | Thiago Paulucci Dos Santos - inspector',
                'intervalo' => $index < 4 ? 'GM' : ($index < 8 ? '200' : 'N/A'),
                'horas' => 'N/A',
                'ciclos' => 'N/A',
                'observacoes' => 'mechanic'
            ]);
        }

        // Criar segunda ordem de serviço com mais itens para testar quebra de página
        $os2 = OrdemServico::create([
            'numero_os' => '03373/25',
            'aeronave_matricula' => 'PP-ABC',
            'data_inicio' => '2025-06-15',
            'termino_previsto' => '2025-06-30',
        ]);

        // Componentes da segunda aeronave
        AeronaveComponente::create([
            'ordem_servico_id' => $os2->id,
            'tipo' => 'AIRFRAME',
            'serial_number' => 'LA-200',
            'modelo' => 'F90',
            'fabricante' => 'BEECH',
            'ano_fabricacao' => 1985,
            'tsn' => '12500.0',
            'tso' => 'N/A',
        ]);

        // Criar muitos itens para testar quebra de página
        for ($i = 1; $i <= 25; $i++) {
            ServicoItem::create([
                'ordem_servico_id' => $os2->id,
                'numero_item' => $i,
                'descricao' => "ITEM DE SERVIÇO NÚMERO {$i} - DESCRIÇÃO DETALHADA DO PROCEDIMENTO DE MANUTENÇÃO QUE DEVE SER EXECUTADO NA AERONAVE CONFORME MANUAL TÉCNICO",
                'equipe' => 'Equipe Técnica - inspector | Supervisor - mechanic',
                'intervalo' => $i % 3 == 0 ? 'GM' : ($i % 2 == 0 ? '100H' : '200H'),
                'horas' => 'N/A',
                'ciclos' => 'N/A',
            ]);
        }
    }
}

