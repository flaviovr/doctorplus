<?php
$content = explode("\n", $texto);
//debug($user);
echo "<h2>Feedback enviado pelo site</h2>";
echo "<p style='font-size: 14px;margin: 0px;line-height: 14px;font-family: Arial;text-align: left;margin-bottom: 20px;color: #585858;'>Enviado por:". h($user) . "</p>";
foreach ($content as $line):
    echo '<p style="font-size: 13px;margin: 0px;line-height: 14px;font-family: Arial;text-align: left;margin-bottom: 10px;color: #585858;"> ' . h($line) . "</p>\n";
endforeach;
?>
