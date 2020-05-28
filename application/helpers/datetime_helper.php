<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  function tme()
                    {
                    $timezone = new DateTimeZone("Asia/Muscat");
                    $date = new DateTime();
                    $date->setTimezone($timezone );
                    $curdate=$date->format('Y-m-d');
                    $curtime=$date->format('H:i:s');
                    $cdate = $curdate;
                    $ctime = $curtime;
                    $vals = array('date'=>$cdate,'time'=>$ctime);
                    return $vals;
                    }
  
                    
 function hoursToMinutes($hours) 
   { 
    $minutes = 0; 
    if (strpos($hours, ':') !== false) 
    { 
        // Split hours and minutes. 
        list($hours, $minutes) = explode(':', $hours); 
    } 
     return $hours * 60 + $minutes; 
 }                 
     
 
 
 function layovercalculater($LayoverDepatureTime,$LayoverArrivalTime)
 {
     
$start_date = new DateTime($LayoverDepatureTime);
$since_start = $start_date->diff(new DateTime($LayoverArrivalTime));


//echo $since_start->days.' days total<br>';
//echo $since_start->y.' years<br>';
//echo $since_start->m.' months<br>';
//echo $since_start->d.' days<br>';
//echo $since_start->h.' hours<br>';
//echo $since_start->i.' minutes<br>';
//echo $since_start->s.' seconds<br>';


  return $since_start->h.'h '.$since_start->i.'m';
 }
 


function DTExploder($DT)
{
    $DT=explode('T',$DT);
    
    $date=date("d-M", strtotime($DT[0]));
    $time=date('g:ia', strtotime($DT[1]));
   // $time=date('G:ia', strtotime($DT[1]));
    
    $DT = array('date'=>$date,'time'=>$time);
    return $DT;
}

?>