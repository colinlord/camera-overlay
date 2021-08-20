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
  echo "<h1>Temperature</h1>: " . $temp . "<br />";
  echo "<h1>Dewpoint</h1>: " . $dew . "<br />";
  echo "<h1>Wind Number</h1>: " . $windNumber . "<br />";
  echo "<h1>Wind Speed</h1>: " . $windSpeed . "<br />";
  echo "<h1>Wind Direction</h1>: " . $windDirection . "<br />";
  echo "<h1>Wind Direction Name</h1>: " . $windDirectionName . "<br />";
  echo "<h1>Wind</h1>: " . $wind . "<br />";
?>
