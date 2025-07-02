<?php if(is_null($date) && is_null($unit_measurement)): ?>
    <span>N/A</span>
<?php else: ?>
    <span><?php echo e($date); ?><?php echo e($unit_measurement); ?></span>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/components/maintenance_date.blade.php ENDPATH**/ ?>