<?php
//Zadanie 3.1
function max_for($tablica) {
    $max = $tablica[0];
    for ($i = 1; $i < count($tablica); $i++) {
        if ($tablica[$i] > $max) {
            $max = $tablica[$i];
        }
    }
    return $max;
}

function max_while($tablica) {
    $max = $tablica[0];
    $i = 1;
    while ($i < count($tablica)) {
        if ($tablica[$i] > $max) {
            $max = $tablica[$i];
        }
        $i++;
    }
    return $max;
}

function max_do_while($tablica) {
    $max = $tablica[0];
    $i = 1;
    do {
        if ($tablica[$i] > $max) {
            $max = $tablica[$i];
        }
        $i++;
    } while ($i < count($tablica));
    return $max;
}

function max_foreach($tablica) {
    $max = $tablica[0];
    foreach ($tablica as $value) {
        if ($value > $max) {
            $max = $value;
        }
    }
    return $max;
}

$tablica = range(0, 100);
shuffle($tablica);
$tablica = array_slice($tablica ,0,10);
echo "Największy element tablicy to " . max_for($tablica) . "<br>";
echo "Największy element tablicy to " . max_while($tablica) . "<br>";
echo "Największy element tablicy to " . max_do_while($tablica) . "<br>";
echo "Największy element tablicy to " . max_foreach($tablica) . "<br>";

?>
