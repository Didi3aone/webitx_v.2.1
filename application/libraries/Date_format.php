<?php

class Date_format {

	function switchDateFormat($date) {
    $dateToInt =  explode("-", $date);
    if(!is_array($dateToInt)) return FALSE;
    $day = $dateToInt[0];
    $month = $dateToInt[1];
    $year = $dateToInt[2];
    switch($month){
      case "January": $month = "01"; break;
      case "February": $month = "02"; break; 
      case "March": $month = "03"; break;
      case "April": $month = "04"; break;
      case "May": $month = "05"; break;
      case "June": $month = "06"; break;
      case "July": $month = "07"; break;
      case "August": $month = "08"; break;
      case "September": $month = "09"; break;
      case "October": $month = "10"; break;
      case "November": $month = "11"; break;
      case "December": $month = "12"; break;
    }
    $return = $year . "-" . $month . "-" . $day;
    return $return;
  }

  function DurationFormat($time)
  {
    $return = '';
    $time = explode(":", $time);
    if ( (int) $time[0] > 0) {
      $return .= (int) $time[0].'h';
    }
    if ( (int) $time[1] > 0) {
      $return .= ','. (int) $time[1].'m';
    }
    return $return;
  }

  function get_date_diff( $time1, $time2, $precision = 2 ) {
    // If not numeric then convert timestamps
    if( !is_int( $time1 ) ) {
      $time1 = strtotime( $time1 );
    }
    if( !is_int( $time2 ) ) {
      $time2 = strtotime( $time2 );
    }

    // If time1 > time2 then swap the 2 values
    if( $time1 > $time2 ) {
      list( $time1, $time2 ) = array( $time2, $time1 );
    }

    // Set up intervals and diffs arrays
    $intervals = array( 'year'=>'y', 'month'=>'mm', 'day'=>'d', 'hour'=>'h', 'minute'=>'m', 'second'=>'s' );
    $diffs = array();

    foreach( $intervals as $interval => $label ) {
      // Create temp time from time1 and interval
      $ttime = strtotime( '+1 ' . $interval, $time1 );
      // Set initial values
      $add = 1;
      $looped = 0;
      // Loop until temp time is smaller than time2
      while ( $time2 >= $ttime ) {
        // Create new temp time from time1 and interval
        $add++;
        $ttime = strtotime( "+" . $add . " " . $interval, $time1 );
        $looped++;
      }

      $time1 = strtotime( "+" . $looped . " " . $interval, $time1 );
      $diffs[ $label ] = $looped;
    }

    $count = 0;
    $times = array();
    foreach( $diffs as $interval => $value ) {
      // Break if we have needed precission
      if( $count >= $precision ) {
        break;
      }
      // Add value and interval if value is bigger than 0
      if( $value > 0 ) {
        //if( $value != 1 ){
          //$interval .= "s";
        //}
        // Add value and interval to times array
        $times[] = $value . $interval;
        $count++;
      }
    }

    // Return string with times
    return implode( ",", $times );
  }

}

?>