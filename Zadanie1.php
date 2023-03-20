<?php
// Zadanie 1.1
function kostka(){
    return rand(1,6) . "<br>";
}
echo kostka();
// Zadanie 1.2
function srednica($promien){
    return $promien*2;
}
echo srednica(5) . "<br>";
// Zadanie 1.3
function cenzura($zdanie, $niepozadane_slowa) {
    $slowawzdaniu = explode(" ", $zdanie);
    foreach($slowawzdaniu as &$slowo) {
      if(in_array($slowo, $niepozadane_slowa)) {
        $slowo = str_repeat("*", strlen($slowo));
      }
    }
    return implode(" ", $slowawzdaniu);
  }
  $zdanie = "dsada cenzura gs słowo asds dupa";
$niepozadane_slowa = array("słowo", "cenzura","dupa");

echo cenzura($zdanie, $niepozadane_slowa);

}
$slowa=array("dupa","aaaas","ffasda");
$zdanie = "dafags dupa gds, aaaas, dasfd, ffasda";
echo cenzura($zdanie);
// Zadanie 1.4
function data($pesel){
    $rok=substr($pesel,0,2);
    $miesiac=substr($pesel,2,2);
    $dzien=substr($pesel,4,2);
    $data=$dzien . "-" . $miesiac . "-" . $rok;
    return $data;
}
$pesel=123456789;
echo data($pesel) . "<br>";
// Zadanie 1.5

?>
