<?php
require 'produtividade.php';
$produtividade = new produtividade();
$arrayFunc = $produtividade->findProdTotal();
$bln = array();
$bln['name'] = 'Departamentos';
$rows['name'] = 'Produção';
if ($arrayFunc) {

    foreach ($arrayFunc as $key => $value) {


        $bln['data'][] = $value->nome;
        $rows['data'][] = $value->prod;
    }
    
$rslt = array();
array_push($rslt, $bln);
array_push($rslt, $rows);
echo json_encode($rslt, JSON_NUMERIC_CHECK);

}

