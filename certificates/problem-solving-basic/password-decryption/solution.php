<?php

function decryptPassword($s) {
    $s = str_split($s);
    $i = 0;
    $length = count($s);
    while ($i < $length && is_numeric($s[$i]) && $s[$i] != "0") {
        $i++;
    }
    $zeroIndices = [];
    for ($j = $i; $j < $length; $j++) {
        if ($s[$j] == "0") {
            $zeroIndices[] = $j;
        }
    }
    foreach (array_reverse($zeroIndices) as $k) {
        $s[$k] = $s[$i - (count($zeroIndices) - array_search($k, array_reverse($zeroIndices))) - 1];
    }
    for ($j = $i; $j < $length; $j++) {
        if ($s[$j] == "*") {
            $temp = $s[$j - 1];
            $s[$j - 1] = $s[$j - 2];
            $s[$j - 2] = $temp;
        }
    }
    return implode("", array_slice($s, $i))->replace("*", "");
}

$s = readline();

$result = decryptPassword($s);

echo $result . "\n";
?>