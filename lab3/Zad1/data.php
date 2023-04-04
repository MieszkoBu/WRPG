<?php
		$birthdate = $_GET["birthdate"];
		
		function get_day_of_week($date) {
			$days = array("niedziela", "poniedziałek", "wtorek", "środa", "czwartek", "piątek", "sobota");
			$day_of_week = date('w', strtotime($date));
			return $days[$day_of_week];
		}
		
		function get_age($date) {
			$birthdate = new DateTime($date);
			$today = new DateTime();
			$age = $today->diff($birthdate);
			return $age->y;
		}
		
		function get_days_to_next_birthday($date) {
			$birthdate = new DateTime($date);
			$today = new DateTime();
			$next_birthday = new DateTime();
			$next_birthday->setDate($today->format('Y'), $birthdate->format('m'), $birthdate->format('d'));
			if ($next_birthday < $today) {
				$next_birthday->modify('+1 year');
			}
			$days_to_next_birthday = $today->diff($next_birthday)->format('%a');
			return $days_to_next_birthday;
		}
		
		if (!empty($birthdate)) {
			echo "<p>Urodziłeś/aś się w " . get_day_of_week($birthdate) . ".</p>";
			echo "<p>W wieku " . get_age($birthdate) . " lat.</p>";
			echo "<p>Do Twoich następnych urodzin pozostało " . get_days_to_next_birthday($birthdate) . " dni.</p>";
		}
		else {
			echo "<p>Podaj datę urodzenia.</p>";
		}
	?>
