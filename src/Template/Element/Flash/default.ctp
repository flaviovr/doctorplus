<?php
$class = 'alert';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
?>
<div class="alert alert-danger message error" onclick="this.classList.add('hidden');"><?= $message ?></div>
