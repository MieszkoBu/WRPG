<?php
if(isset($_GET['submit'])){
	$sciezka = $_GET['sciezka'];
	$nazwa_katalogu = $_GET['nazwa_katalogu'];
	$rodzaj_operacji = $_GET['rodzaj_operacji'];

	if(substr($sciezka, -1) != '/'){
		$sciezka .= '/';
	}

	if($rodzaj_operacji == 'read'){
		if(file_exists($sciezka.$nazwa_katalogu) && is_dir($sciezka.$nazwa_katalogu)){
			$dir = opendir($sciezka.$nazwa_katalogu);
			echo "Lista elementów w katalogu $nazwa_katalogu:<br>";
			while(false !== ($file = readdir($dir))){
				if($file != '.' && $file != '..'){
					echo "$file<br>";
				}
			}
			closedir($dir);
		}
		else{
			echo "Katalog $nazwa_katalogu nie istnieje lub nie jest katalogiem.<br>";
		}
	}
	elseif($rodzaj_operacji == 'delete'){
		if(file_exists($sciezka.$nazwa_katalogu) && is_dir($sciezka.$nazwa_katalogu)){
			if(count(scandir($sciezka.$nazwa_katalogu)) == 2){
				rmdir($sciezka.$nazwa_katalogu);
				echo "Katalog $nazwa_katalogu został usunięty.<br>";
			}
			else{
				echo "Nie można usunąć katalogu $nazwa_katalogu, ponieważ nie jest pusty.<br>";
			}
		}
		else{
			echo "Katalog $nazwa_katalogu nie istnieje lub nie jest katalogiem.<br>";
		}
	}
	elseif($rodzaj_operacji == 'create'){
		if(!file_exists($sciezka.$nazwa_katalogu)){
			mkdir($sciezka.$nazwa_katalogu);
			echo "Katalog $nazwa_katalogu został utworzony.<br>";
		}
		else{
			echo "Katalog $nazwa_katalogu już istnieje.<br>";
		}
	}
}
?>
