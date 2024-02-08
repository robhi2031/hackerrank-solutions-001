<?php

function findSubstring($s, $k) {
    $vowels = ["a", "e", "i", "o", "u"];
    $cur = $best = array_sum(array_map(function($c) use ($vowels) {
        return in_array($c, $vowels) ? 1 : 0;
    }, str_split(substr($s, 0, $k))));
    $ans = 0;
    for ($i = $k; $i < strlen($s); $i++) {
        $cur += in_array($s[$i], $vowels) ? 1 : 0;
        $cur -= in_array($s[$i - $k], $vowels) ? 1 : 0;
        if ($cur > $best) {
            $best = $cur;
            $ans = $i - $k + 1;
        }
    }
    if ($best > 0) {
        return substr($s, $ans, $k);
    } else {
        return "Not found!";
    }
}

$s = readline();
$k = readline();

$result = findSubstring($s, $k);
echo $result . "\n";