<?php $__env->startSection('title', 'Ordem de Serviço #' . $ordemServico->numero_os); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Ordem de Serviço #<?php echo e($ordemServico->numero_os); ?></h1>
            <div>
               
                <a href="<?php echo e(route('ordem-servico.pdf', $ordemServico->id)); ?>" class="btn btn-danger" target="_blank">Gerar
                    PDF</a>
                <a href="<?php echo e(route('ordem-servico.index')); ?>" class="btn btn-secondary">Voltar</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Informações Gerais</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Número da OS:</strong> <?php echo e($ordemServico->numero_os); ?></p>
                        <p><strong>Matrícula da Aeronave:</strong> <?php echo e($ordemServico->aeronave_matricula); ?></p>
                        <p><strong>Data de Início:</strong> <?php echo e($ordemServico->data_inicio->format('d/m/Y')); ?></p>
                        <p><strong>Término Previsto:</strong> <?php echo e($ordemServico->termino_previsto->format('d/m/Y')); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Empresa:</strong> <?php echo e($ordemServico->empresa_nome); ?></p>
                        <p><strong>Endereço:</strong> <?php echo e($ordemServico->empresa_endereco); ?></p>
                        <p><strong>Documento:</strong> <?php echo e($ordemServico->documento_codigo); ?></p>
                        <p><strong>Data do Documento:</strong> <?php echo e($ordemServico->documento_data->format('d/m/Y')); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5>Componentes da Aeronave</h5>
            </div>
            <div class="card-body">
                <?php if($ordemServico->componentes->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Serial Number</th>
                                <th>TSN</th>
                                <th>Modelo</th>
                                <th>TSO</th>
                                <th>Fabricante</th>
                                <th>CSO</th>
                                <th>Ano Fabricação</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $ordemServico->componentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $componente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><strong><?php echo e($componente->tipo); ?></strong></td>
                                    <td><?php echo e($componente->serial_number ?? 'N/A'); ?></td>
                                    <td><?php echo e($componente->tsn ?? 'N/A'); ?></td>
                                    <td><?php echo e($componente->modelo ?? 'N/A'); ?></td>
                                    <td><?php echo e($componente->tso ?? 'N/A'); ?></td>
                                    <td><?php echo e($componente->fabricante ?? 'N/A'); ?></td>
                                    <td><?php echo e($componente->cso ?? 'N/A'); ?></td>
                                    <td><?php echo e($componente->ano_fabricacao ?? 'N/A'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-muted">Nenhum componente cadastrado.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5>Itens de Serviço Executados</h5>
            </div>
            <div class="card-body">
                <?php if($ordemServico->itensServico->count() > 0): ?>
                    <?php $__currentLoopData = $ordemServico->itensServico; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border p-3 mb-3">
                            <div class="row">
                                <div class="col-md-1">
                                    <strong><?php echo e($item->numero_item); ?></strong>
                                </div>
                                <div class="col-md-11">
                                    <h6><?php echo e($item->descricao); ?></h6>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <small><strong>Equipe:</strong> <?php echo e($item->equipe ?? 'N/A'); ?></small>
                                        </div>
                                        <div class="col-md-3">
                                            <small><strong>Intervalo:</strong> <?php echo e($item->intervalo ?? 'N/A'); ?></small>
                                        </div>
                                        <div class="col-md-3">
                                            <small><strong>Horas:</strong> <?php echo e($item->horas ?? 'N/A'); ?></small>
                                        </div>
                                        <div class="col-md-3">
                                            <small><strong>Ciclos:</strong> <?php echo e($item->ciclos ?? 'N/A'); ?></small>
                                        </div>
                                    </div>
                                    <?php if($item->observacoes): ?>
                                        <div class="mt-2">
                                            <small><strong>Observações:</strong> <?php echo e($item->observacoes); ?></small>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <p class="text-muted">Nenhum item de serviço cadastrado.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/ordem-servico/show.blade.php ENDPATH**/ ?>