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

//Zadanie 3.2

function rzuty_koscia($rzuty) {
  $wyniki = array();
  for ($i = 0; $i < $rzuty; $i++) {
    $wynik = rand(1, 6);
    array_push($wyniki, $wynik);
  }
  return $wyniki;
}
$wyniki = rzuty_koscia(7);
print_r($wyniki);

//Zadanie 3.3

function tabliczka_mnozenia($rozmiar) {
    for ($i = 1; $i <= $rozmiar; $i++) {
      for ($j = 1; $j <= $rozmiar; $j++) {
        echo str_pad($i * $j, 4, " ", STR_PAD_LEFT);
      }
      echo "<br>";
    }
  }
tabliczka_mnozenia(12);

//Zadanie 3.4

function czy_pierwsza($liczba) {
    $iteracja = 0;
  
    if ($liczba < 2) {
      return false;
    }
  
    for ($i = 2; $i <= sqrt($liczba); $i++) {
      $iteracja++;
      if ($liczba % $i == 0) {
        return false;
      }
    }
  
    echo "Liczba iteracji: $iteracja" . "<br>";
    return true;
  }
  $liczba = 8;
  echo czy_pierwsza($liczba) ? "Liczba $liczba jest liczbą pierwszą.\n" : "Liczba $liczba nie jest liczbą pierwszą.\n";

?>
