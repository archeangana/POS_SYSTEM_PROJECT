<?php
use App\Core\Helpers\Flash;

$types = [
    'success' => 'alert-success',
    'error' => 'alert-danger',
    'warning' => 'alert-warning',
    'info' => 'alert-info',
];
?>

<!-- Flash Notifications -->
<div style="position: fixed; top: 4rem; right: 3rem; z-index: 1050; width: 300px;">
      <?php foreach ($types as $key => $class) : ?>
            <?php if (Flash::has($key)) : ?>
                  <div class="alert <?= $class ?> alert-dismissible fade show shadow-sm" role="alert">
                        <?= Flash::get($key); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            <?php endif; ?>
      <?php endforeach; ?>
</div>
