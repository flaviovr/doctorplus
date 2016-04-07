<?php
// renderizo a view sem layout
$this->layout = '';
// jogo na variavel $json os valores para o select
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
