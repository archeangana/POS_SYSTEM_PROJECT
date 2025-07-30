<?php

use App\Core\Helpers\Flash;

$types = [
    'success' => 'alert-success',
    'error'   => 'alert-danger',
    'danger'  => 'alert-danger',
    'warning' => 'alert-warning',
    'info'    => 'alert-info',
];

foreach ($types as $key => $class):
    if (Flash::has($key)):
?>
    <div class="alert <?= $class ?> alert-dismissible fade show" role="alert">
        <?= Flash::get($key) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
    endif;
endforeach;
?>
