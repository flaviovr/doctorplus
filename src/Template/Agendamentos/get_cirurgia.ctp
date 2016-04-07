<?php
// rendereizo a viewm sem layout
$this->layout = '';

$r = array();
$i=0;
// dou loop nos dados e formato um array no formato pedido pelo jquery ui autocomplete
foreach ($dados as $item) {
    $r[$i]['label'] =  ucfirst(mb_strtolower(h($item['DS_CIRURGIA']))) ;
    $r[$i]['value'] = $item['CD_CIRURGIA'];
    $i++;
}

// converrto o array par JSON
echo json_encode($r);
