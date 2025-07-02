<?php if(isset($status) && !is_null($status)): ?>
    <?php echo e($status); ?>

<?php elseif(is_null($value)): ?>
    N/A
<?php else: ?>
    <?php echo e($value); ?>

<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/components/aircraft_component_status.blade.php ENDPATH**/ ?>