<?php if(is_null($cycles)): ?>
    <span >N/A</span>
<?php elseif($cycles == 0): ?>
    <span >NEW</span>
<?php else: ?>
    <span ><?php echo e($cycles); ?></span>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/components/maintenance_cycles.blade.php ENDPATH**/ ?>