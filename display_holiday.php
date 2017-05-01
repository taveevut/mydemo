<?php
 
	$strStartDate = "2011-08-01";
	$strEndDate = "2011-08-15";
	
	$intWorkDay = 0;
	$intHoliday = 0;
	$intTotalDay = ((strtotime($strEndDate) - strtotime($strStartDate))/  ( 60 * 60 * 24 )) + 1; 

	while (strtotime($strStartDate) <= strtotime($strEndDate)) {
		
		$DayOfWeek = date("w", strtotime($strStartDate));
		if($DayOfWeek == 0 or $DayOfWeek ==6)  // 0 = Sunday, 6 = Saturday;
		{
			$intHoliday++;
			echo "$strStartDate = <font color=red>Holiday</font><br>";
		}
		else
		{
			$intWorkDay++;
			echo "$strStartDate = <b>Work Day</b><br>";
		}
		//$DayOfWeek = date("l", strtotime($strStartDate)); // return Sunday, Monday,Tuesday....

		$strStartDate = date ("Y-m-d", strtotime("+1 day", strtotime($strStartDate)));
	}

	echo "<hr>";
	echo "<br>Total Day = $intTotalDay";
	echo "<br>Work Day = $intWorkDay";
	echo "<br>Holiday = $intHoliday";
?>