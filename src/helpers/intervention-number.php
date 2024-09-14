<?php
function genererNumeroIntervention($n)
{
    //$Matri = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $Num = "0123456789";
    $randomNum = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($Num) - 1);
        $randomNum .= $Num[$index];
    }
    return $randomNum;
}

$n = 6;
$getNumIntervention = genererNumeroIntervention($n);
