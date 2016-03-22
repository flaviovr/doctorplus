<?php
$this->layout = '';
//pr($dados);
//exit();
$r = array();
$i=0;
foreach ($dados as $item) {
    $r[$i]['label'] =  ucfirst(mb_strtolower(h($item['DS_CIRURGIA']))) ;
    $r[$i]['value'] = $item['CD_PRO_FAT'];
    $i++;
}
//die();
echo json_encode($r);
