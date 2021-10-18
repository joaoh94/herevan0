<?php

function is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y)
{
   $c = 0;
  for ($i = 0, $j = $points_polygon-1 ; $i < $points_polygon; $j = $i++) {
   if(
      $latitude_y <= $vertices_y[$i] && $latitude_y >= $vertices_y[$j] &&
      $longitude_x >= $vertices_x[$j] && $longitude_x <= $vertices_x[$i]
   )
   $c = !$c;
  }
  return $c;
}

?>