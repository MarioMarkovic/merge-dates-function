<?php 

function mergeDates($arr) {
	$prevDate = $conDates = null;

	foreach($arr as $dates) {
    	if($prevDate == null) {
        	$prevDate = [ 'arrival' => $dates['arrival'], 'departure' => $dates['departure'] ];
    	} else {
        	$arrival 	= DateTime::createFromFormat('d-m-Y', $dates['arrival']);
        	$departure 	= DateTime::createFromFormat('d-m-Y', $prevDate['departure']);
        	$diff   = $arrival->diff($departure)->format("%a");
        	if($diff == 0) {
            	$prevDate  	= ['arrival' => $prevDate['arrival'], 'departure' => $dates['departure']];
        	} else {
            	$conDates[]	= $prevDate;
            	$prevDate  	= ['arrival' => $dates['arrival'], 'departure' => $dates['departure'] ];
        	}
    	}
	}

	$connected = [];

	if($conDates !== null) {
    	$conDates[]	= $prevDate;
    	$connected[] = $conDates;
	} else {
    	$connected[] = [ $prevDate ];
	}

	return $connected;
}

?>
