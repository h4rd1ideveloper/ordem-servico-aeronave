<?php if(is_null($hours)): ?>
    <span>N/A</span>
<?php elseif($hours == 0): ?>
    <span>NEW</span>
<?php else: ?>
    <span><?php echo e($hours); ?></span>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/components/maintenance_hours.blade.php ENDPATH**/ ?>