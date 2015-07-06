<?php
function the_calendar_widget() {
	$days = array("Δ", "Τ", "Τ", "Π", "Π","Σ", "Κ");
	$months = array("Ιανουάριος", "Φεβρουάριος", "Μάρτιος", "Απρίλιος", "Μάϊος","Ιούνιος", "Ιούλιος", "Αύγουστος", "Σεπτέμβριος", "Οκτώβριος", "Νοέμβριος", "Δεκέμβριος");
//	$my_time = mktime(0, 0, 0, 8, 16, 2015);
	$my_time = mktime(0, 0, 0, date('n'), date('j'), date('Y'));
	$current_day = date('j', $my_time);
	$current_month = date('n', $my_time);
	$current_year = date('Y', $my_time);
	$totalMonthDays = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);
	$firstDay = date('N', mktime(0, 0, 0, $current_month, 1, $current_year));
	echo '<h2 class="text-uppercase">'.$months[$current_month-1].'</h2>';
	echo '<table>';
	echo '<tr>';
		foreach ($days as $day):
			echo '<th>'.$day.'</th>';
		endforeach;
	echo '</tr>';
	$metr = 1;
	for ($i=0;$i<ceil($totalMonthDays/7)+1;$i++) {
		echo '<tr>';
		for ($j=0;$j<7;$j++) {
			if ($i==0 && $j>=$firstDay-1 || $i>0 && $metr<=$totalMonthDays) {
				echo '<td>';
				$classes = $current_day==$metr?' class="active"':'';
				echo '<a href="#"'.$classes.'>'.$metr.'</a>';
				echo '</td>';
				$metr++;
			} else {
				echo '<td></td>';
			}
		}
		echo '</tr>';
	}
	echo '</table>';
}
