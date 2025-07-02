<?php $__env->startSection('title', 'Ordens de Serviço'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-clipboard-list"></i> Ordens de Serviço</h1>
   
</div>

<?php if($ordensServico->count() > 0): ?>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>OS #</th>
                            <th>Aeronave</th>
                            <th>Data Início</th>
                            <th>Término Previsto</th>
                            <th>Itens</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $ordensServico; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $os): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><strong><?php echo e($os->numero_os); ?></strong></td>
                            <td><?php echo e($os->aeronave_matricula); ?></td>
                            <td><?php echo e($os->data_inicio->format('d/m/Y')); ?></td>
                            <td><?php echo e($os->termino_previsto->format('d/m/Y')); ?></td>
                            <td>
                                <span class="badge bg-info"><?php echo e($os->itensServico->count()); ?> itens</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="<?php echo e(route('ordem-servico.show', $os->id)); ?>"
                                       class="btn btn-sm btn-outline-primary" title="Visualizar">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                   
                                    <a href="<?php echo e(route('ordem-servico.pdf', $os->id)); ?>"
                                       class="btn btn-sm btn-outline-success" title="Gerar PDF" target="_blank">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                    <a href="<?php echo e(route('ordem-servico.download', $os->id)); ?>"
                                       class="btn btn-sm btn-outline-info" title="Download PDF">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="card">
        <div class="card-body text-center">
            <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
            <h4>Nenhuma Ordem de Serviço encontrada</h4>
           
        </div>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/ordem-servico/index.blade.php ENDPATH**/ ?>