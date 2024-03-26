<?php

$N1 = [
    'key1' => [1,2,3],
    'key2' => [5,3,9],
    ['a', 'g', 'b'],
];
$N1[2][0] = 'abs';

usort($N1, 'compare');

function compare($x, $y) {
    if ($x[1] === $y[1]) return 0;
    if ($x[1] > $y[1]) return 0;
    else return 1;
}
foreach($N1 as $key => $value) {
    echo '$key => ';    
    foreach($value as $elem) {
        echo '$elem,';
    }
    echo '<br>';
}