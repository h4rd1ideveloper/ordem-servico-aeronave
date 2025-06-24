<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordem de Serviço <?php echo e($ordemServico->numero_os); ?></title>
    <style>
        @page {
            margin: 1cm 1cm 1cm 1cm;
            size: A4;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            line-height: 1.2;
            margin: 0;
            padding: 0;
            color: #000;
        }

        .header {
            display: table;
            width: 100%;
            table-layout: fixed;
            border: 2px solid #000;
            margin-bottom: 10px;
            page-break-inside: avoid;
        }

        .header-row {
            display: table-row;
        }

        .header-cell {
            display: table-cell;
            border: 1px solid #000;
            padding: 5px;
            vertical-align: middle;
        }

        .logo-cell {
            width: 15%;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
        }

        .company-cell {
            width: 60%;
            text-align: center;
        }

        .company-name {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 2px;
        }

        .company-address {
            font-size: 10px;
        }

        .doc-cell {
            width: 25%;
            text-align: center;
        }

        .doc-code {
            font-weight: bold;
            font-size: 10px;
            margin-bottom: 2px;
        }

        .doc-date {
            font-size: 9px;
        }

        .os-info {
            display: table;
            width: 100%;
            table-layout: fixed;
            border: 2px solid #000;
            margin-bottom: 10px;
            page-break-inside: avoid;
        }

        .os-row {
            display: table-row;
        }

        .os-cell {
            display: table-cell;
            border: 1px solid #000;
            padding: 8px;
            vertical-align: top;
        }

        .os-number {
            width: 50%;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }

        .aircraft-reg {
            width: 50%;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }

        .components-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            page-break-inside: avoid;
            table-layout: fixed;
        }

        .components-table th,
        .components-table td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
            font-size: 9px;
            word-wrap: break-word;
        }

        .components-table th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }

        .component-type {
            width: 15%;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
        }

        .component-details {
            width: 21.25%;
            max-width: 21.25%;
            overflow: hidden;
        }

        .dates-section {
            display: table;
            width: 100%;
            table-layout: fixed;
            margin-bottom: 15px;
            page-break-inside: avoid;
        }

        .dates-row {
            display: table-row;
        }

        .date-cell {
            display: table-cell;
            width: 50%;
            padding: 5px;
        }

        .date-label {
            font-weight: bold;
            margin-bottom: 3px;
        }

        .services-title {
            text-align: center;
            font-weight: bold;
            font-size: 12px;
            margin: 15px 0 10px 0;
            page-break-after: avoid;
        }

        .service-item {
            display: table;
            width: 100%;
            table-layout: fixed;
            border: 1px solid #000;
            margin-bottom: 2px;
            page-break-inside: avoid;
            min-height: 40px;
        }

        .service-row {
            display: table-row;
        }

        .service-number {
            display: table-cell;
            width: 5%;
            border-right: 1px solid #000;
            padding: 5px;
            text-align: center;
            font-weight: bold;
            vertical-align: top;
        }

        .service-description {
            display: table-cell;
            width: 95%;
            padding: 5px;
            vertical-align: top;
            word-wrap: break-word;
        }

        .service-desc-text {
            font-weight: bold;
            margin-bottom: 3px;
        }

        .service-details {
            font-size: 9px;
            color: #333;
        }

        .declaration-section {
            margin-top: 20px;
            text-align: center;
            page-break-inside: avoid;
        }

        .declaration-title {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            width: 300px;
            margin: 30px auto 10px auto;
        }

        .signature-text {
            font-size: 10px;
            margin-top: 5px;
        }

        /* Quebra de página específica */
        .page-break {
            page-break-before: always;
        }

        .no-break {
            page-break-inside: avoid;
        }

        /* Estilos para páginas subsequentes */
        .continuation-header {
            height: 1cm;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<!-- Cabeçalho principal (apenas primeira página) -->
<div class="header">
    <div class="header-row">
        <div class="header-cell logo-cell">
            MTX<br>
            <small>AVIATION</small>
        </div>
        <div class="header-cell company-cell">
            <div class="company-name"><?php echo e($ordemServico->empresa_nome); ?></div>
            <div class="company-address"><?php echo e($ordemServico->empresa_endereco); ?></div>
        </div>
        <div class="header-cell doc-cell">
            <div class="doc-code"><?php echo e($ordemServico->documento_codigo); ?></div>
            <div class="doc-date"><?php echo e($ordemServico->documento_data->format('d/m/Y')); ?></div>
        </div>
    </div>
</div>

<!-- Informações da OS -->
<div class="os-info">
    <div class="os-row">
        <div class="os-cell os-number">
            OS #<?php echo e($ordemServico->numero_os); ?>

        </div>
        <div class="os-cell aircraft-reg">
            <?php echo e($ordemServico->aeronave_matricula); ?>

        </div>
    </div>
</div>

<!-- Tabela de componentes -->
<table class="components-table">
    <?php if($ordemServico->getAirframe()): ?>
        <tr>
            <td class="component-type">AIRFRAME</td>
            <td class="component-details">
                SN: <?php echo e($ordemServico->getAirframe()->serial_number ?? 'N/A'); ?><br>
                TSN: <?php echo e($ordemServico->getAirframe()->tsn ?? 'N/A'); ?><br>
                Revisão: <?php echo e($ordemServico->getAirframe()->revisao ?? 'N/A'); ?>

            </td>
            <td class="component-details">
                Modelo: <?php echo e($ordemServico->getAirframe()->modelo ?? 'N/A'); ?><br>
                TSO: <?php echo e($ordemServico->getAirframe()->tso ?? 'N/A'); ?>

            </td>
            <td class="component-details">
                Fabricante: <?php echo e($ordemServico->getAirframe()->fabricante ?? 'N/A'); ?><br>
                CSO: <?php echo e($ordemServico->getAirframe()->cso ?? 'N/A'); ?>

            </td>
            <td class="component-details">
                Ano de Fabricação: <?php echo e($ordemServico->getAirframe()->ano_fabricacao ?? 'N/A'); ?>

            </td>
        </tr>
    <?php endif; ?>

    <?php if($ordemServico->getLeftEngine()): ?>
        <tr>
            <td class="component-type">LEFT ENGINE</td>
            <td class="component-details">
                SN: <?php echo e($ordemServico->getLeftEngine()->serial_number ?? 'N/A'); ?><br>
                TSN: <?php echo e($ordemServico->getLeftEngine()->tsn ?? 'N/A'); ?><br>
                Revisão: <?php echo e($ordemServico->getLeftEngine()->revisao ?? 'N/A'); ?>

            </td>
            <td class="component-details">
                Modelo: <?php echo e($ordemServico->getLeftEngine()->modelo ?? 'N/A'); ?><br>
                TSO: <?php echo e($ordemServico->getLeftEngine()->tso ?? 'N/A'); ?>

            </td>
            <td class="component-details">
                Fabricante: <?php echo e($ordemServico->getLeftEngine()->fabricante ?? 'N/A'); ?><br>
                CSO: <?php echo e($ordemServico->getLeftEngine()->cso ?? 'N/A'); ?>

            </td>
            <td class="component-details">
                Ano de Fabricação: <?php echo e($ordemServico->getLeftEngine()->ano_fabricacao ?? 'N/A'); ?>

            </td>
        </tr>
    <?php endif; ?>

    <?php if($ordemServico->getRightEngine()): ?>
        <tr>
            <td class="component-type">RIGHT ENGINE</td>
            <td class="component-details">
                SN: <?php echo e($ordemServico->getRightEngine()->serial_number ?? 'N/A'); ?><br>
                TSN: <?php echo e($ordemServico->getRightEngine()->tsn ?? 'N/A'); ?><br>
                Revisão: <?php echo e($ordemServico->getRightEngine()->revisao ?? 'N/A'); ?>

            </td>
            <td class="component-details">
                Modelo: <?php echo e($ordemServico->getRightEngine()->modelo ?? 'N/A'); ?><br>
                TSO: <?php echo e($ordemServico->getRightEngine()->tso ?? 'N/A'); ?>

            </td>
            <td class="component-details">
                Fabricante: <?php echo e($ordemServico->getRightEngine()->fabricante ?? 'N/A'); ?><br>
                CSO: <?php echo e($ordemServico->getRightEngine()->cso ?? 'N/A'); ?>

            </td>
            <td class="component-details">
                Ano de Fabricação: <?php echo e($ordemServico->getRightEngine()->ano_fabricacao ?? 'N/A'); ?>

            </td>
        </tr>
    <?php endif; ?>

    <?php if($ordemServico->getLeftPropeller()): ?>
        <tr>
            <td class="component-type">LEFT PROPELLER</td>
            <td class="component-details">
                SN: <?php echo e($ordemServico->getLeftPropeller()->serial_number ?? 'N/A'); ?><br>
                TSN: <?php echo e($ordemServico->getLeftPropeller()->tsn ?? 'N/A'); ?><br>
                Revisão: <?php echo e($ordemServico->getLeftPropeller()->revisao ?? 'N/A'); ?>

            </td>
            <td class="component-details">
                Modelo: <?php echo e($ordemServico->getLeftPropeller()->modelo ?? 'N/A'); ?><br>
                TSO: <?php echo e($ordemServico->getLeftPropeller()->tso ?? 'N/A'); ?>

            </td>
            <td class="component-details">
                Fabricante: <?php echo e($ordemServico->getLeftPropeller()->fabricante ?? 'N/A'); ?><br>
                CSO: <?php echo e($ordemServico->getLeftPropeller()->cso ?? 'N/A'); ?>

            </td>
            <td class="component-details">
                Ano de Fabricação: <?php echo e($ordemServico->getLeftPropeller()->ano_fabricacao ?? 'N/A'); ?>

            </td>
        </tr>
    <?php endif; ?>

    <?php if($ordemServico->getRightPropeller()): ?>
        <tr>
            <td class="component-type">RIGHT PROPELLER</td>
            <td class="component-details">
                SN: <?php echo e($ordemServico->getRightPropeller()->serial_number ?? 'N/A'); ?><br>
                TSN: <?php echo e($ordemServico->getRightPropeller()->tsn ?? 'N/A'); ?><br>
                Revisão: <?php echo e($ordemServico->getRightPropeller()->revisao ?? 'N/A'); ?>

            </td>
            <td class="component-details">
                Modelo: <?php echo e($ordemServico->getRightPropeller()->modelo ?? 'N/A'); ?><br>
                TSO: <?php echo e($ordemServico->getRightPropeller()->tso ?? 'N/A'); ?>

            </td>
            <td class="component-details">
                Fabricante: <?php echo e($ordemServico->getRightPropeller()->fabricante ?? 'N/A'); ?><br>
                CSO: <?php echo e($ordemServico->getRightPropeller()->cso ?? 'N/A'); ?>

            </td>
            <td class="component-details">
                Ano de Fabricação: <?php echo e($ordemServico->getRightPropeller()->ano_fabricacao ?? 'N/A'); ?>

            </td>
        </tr>
    <?php endif; ?>
</table>

<!-- Datas -->
<div class="dates-section">
    <div class="dates-row">
        <div class="date-cell">
            <div class="date-label">Data de Início: <?php echo e($ordemServico->data_inicio->format('d/m/Y')); ?></div>
        </div>
        <div class="date-cell">
            <div class="date-label">Término Previsto: <?php echo e($ordemServico->termino_previsto->format('d/m/Y')); ?></div>
        </div>
    </div>
</div>

<!-- Título dos serviços -->
<div class="services-title">RESUMO DE ITENS EXECUTADOS</div>

<!-- Lista de serviços -->
<?php $__currentLoopData = $ordemServico->itensServico; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="service-item no-break">
        <div class="service-row">
            <div class="service-number"><?php echo e($item->numero_item); ?></div>
            <div class="service-description">
                <div class="service-desc-text"><?php echo e($item->descricao); ?></div>
                <div class="service-details">
                    <?php if($item->equipe): ?>
                        Equipe: <?php echo e($item->equipe); ?>

                    <?php endif; ?>
                    <?php if($item->intervalo): ?>
                        | Intervalo: <?php echo e($item->intervalo); ?>

                    <?php endif; ?>
                    <?php if($item->horas): ?>
                        | Horas: <?php echo e($item->horas); ?>

                    <?php endif; ?>
                    <?php if($item->ciclos): ?>
                        | Ciclos: <?php echo e($item->ciclos); ?>

                    <?php endif; ?>
                    <?php if($item->observacoes): ?>
                        | <?php echo e($item->observacoes); ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<!-- Declaração de aeronavegabilidade -->
<div class="declaration-section no-break">
    <div class="declaration-title">DECLARAÇÃO DE AERONAVEGABILIDADE</div>
    <div class="signature-line"></div>
    <div class="signature-text">
        Assinatura do Inspetor Responsável<br>
        SDCO
    </div>
</div>
</body>
</html>

<?php /**PATH /var/www/html/resources/views/pdf/ordem-servico.blade.php ENDPATH**/ ?>