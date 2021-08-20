<?php
  // Get our JSON
  $strJsonFileContents = file_get_contents("https://api.darksky.net/forecast/7b5851f6d0a0b4ee4fdef257deb1ff39/35.8020,-86.9114?exclude=[minutely,hourly,daily,alerts,flags]");
  $weather = json_decode($strJsonFileContents, true);

  // Convert temperature and dew point
  $temp = round($weather['currently']['temperature']) . '°';
  $dew = round($weather['currently']['dewPoint']) . '°';

  // Convert wind speed
  $windNumber = round($weather['currently']['windSpeed']);
  $windSpeed = $windNumber . ' mph';
  $windDirection = $weather['currently']['windBearing'];
  $compass = array('N', 'NNE', 'NE', 'ENE', 'E', 'ESE', 'SE', 'SSE', 'S', 'SSW', 'SW', 'WSW', 'W', 'WNW', 'NW', 'NNW');
  $windDirectionName = $compass[round( ($windDirection % 360 - 11.25) / 22.5)];
  $wind = $windSpeed.' '.$windDirectionName;

  // Display data
  echo "<strong>Temperature</strong>: " . $temp . "<br />";
  echo "<strong>Dewpoint</strong>: " . $dew . "<br />";
  echo "<strong>Wind Number</strong>: " . $windNumber . "<br />";
  echo "<strong>Wind Speed</strong>: " . $windSpeed . "<br />";
  echo "<strong>Wind Direction</strong>: " . $windDirection . "<br />";
  echo "<strong>Wind Direction Name</strong>: " . $windDirectionName . "<br />";
  echo "<strong>Wind</strong>: " . $wind . "<br />";
?>
