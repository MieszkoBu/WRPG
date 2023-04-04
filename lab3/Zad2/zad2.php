<?php
function factorial_recursive($n) {
	if ($n <= 1) {
		return 1;
	}
	else {
		return $n * factorial_recursive($n - 1);
	}
}

function fibonacci_recursive($n) {
	if ($n <= 1) {
		return $n;
	}
	else {
		return fibonacci_recursive($n - 1) + fibonacci_recursive($n - 2);
	}
}

function factorial_iterative($n) {
	$result = 1;
	for ($i = 2; $i <= $n; $i++) {
		$result *= $i;
	}
	return $result;
}

function fibonacci_iterative($n) {
	if ($n <= 1) {
		return $n;
	}
	$previous = 0;
	$current = 1;
	for ($i = 2; $i <= $n; $i++) {
		$next = $previous + $current;
		$previous = $current;
		$current = $next;
	}
	return $current;
}

function measure_execution_time($function, $argument) {
	$start_time = microtime(true);
	$result = $function($argument);
	$end_time = microtime(true);
	$execution_time = $end_time - $start_time;
	echo "<p>Wynik: " . $result . "</p>";
	echo "<p>Czas wykonania: " . $execution_time . " s</p>";
    return $execution_time;
}

$argument = 13;

echo "<h2>Obliczanie silni</h2>";
echo "<h3>Rekurencyjnie</h3>";
$factorial_recursive_time=measure_execution_time("factorial_recursive", $argument);

echo "<h3>Nierekurencyjnie</h3>";
$factorial_iterative_time=measure_execution_time("factorial_iterative", $argument);

echo "<h2>Obliczanie ciągu Fibonacciego</h2>";
echo "<h3>Rekurencyjnie</h3>";
$fibonacci_recursive_time=measure_execution_time("fibonacci_recursive", $argument);

echo "<h3>Nierekurencyjnie</h3>";
$fibonacci_iterative_time=measure_execution_time("fibonacci_iterative", $argument);
echo "<h2>Wnioski</h2>";
if($factorial_recursive_time<$factorial_iterative_time){
    echo "Silnia została szybciej obliczona rekurencyjnie o " . $factorial_iterative_time-$factorial_recursive_time . "</p>";
}
else{
    echo "Silnia została szybciej obliczona nierekurencyjnie o " . $factorial_recursive_time-$factorial_iterative_time . "</p>";
}
if($fibonacci_recursive_time<$fibonacci_iterative_time){
    echo "Ciąg Fibonacciego został szybciej obliczony rekurencyjnie o " . $fibonacci_iterative_time-$fibonacci_recursive_time . "</p>";
}
else{
    echo "Ciąg Fibonacciego został szybciej obliczony nierekurencyjnie o " . $fibonacci_recursive_time-$fibonacci_iterative_time . "</p>";
}
?>
