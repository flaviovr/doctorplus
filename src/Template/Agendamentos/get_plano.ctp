<?php
$this->layout = '';
$json="<option value=''>Selecione</option>";
if (count($planos)>0){
    foreach ($planos as $key => $value) {
        $json .= "<option value='$key'>$value</option>";
    }
} else {
    $json = "<option value=''>Selecione o Convênio</option>";
}
echo $json;
?>
