<?php

function potencia($num, $expo) {
    // Caso Base
    switch(true){
        case $expo < 0:
            return "Não estou a fim de fazer expoentes negativos! ;P";
        case $expo == 0:
            return 1;
        case $expo == 1:
            return $num;
    }
    // Caso recursivo
    return $num * potencia($num, --$expo);
}

function potencia2($num, $expo) {
    if($expo < 0) return "Não estou a fim de fazer expoentes negativos! ;P";
    if($expo == 0) return 1;
    $temp = $num;
    for($i = 1; $i < $expo; $i++) $num *= $temp;
    return $num;
}

echo potencia(2,2);
echo "<br>" . potencia2(4,3);
echo "<br>" . potencia(-8,5);
echo "<br>" . potencia2(-8,6);
