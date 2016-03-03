<?php
$class = 'alert';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
?>
<div class="alert alert-warning <?= h($class) ?>"><?= h($message) ?></div>
