<?php
   $size = count($results);
   $r_string = " results ";
   $div_start = '<div id="heading">';
   $div_end = '</div>';
   $hr = '<hr id="heading-div"/>';
   
   if($key != null){
      if($size == 0) {
          $heading = $div_start . "No results found for key: <u>".$key."</u>".$div_end;
      } else {
          $results_found = true;
          if($size == 1) $r_string = " result ";
          $heading = $div_start . $size. $r_string . "for key: ".$key.$div_end.$hr."<br />";
      }
   } else {
       $key = $ul_key;
       if($size == 0) {
          $heading = $div_start . "No results found for unsaved list: <u>".$key."</u>".$div_end;
       } else {
          $results_found = true;
          if($size == 1) $r_string = " result ";
          $heading = $div_start . $size . $r_string . "for unsaved list: ".$key.$div_end.$hr."<br />";
       }
   }