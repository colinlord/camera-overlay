<?php
/* GET OUR WEATHER DATA */

  // Get our environment variables
  include('.env.php');

  // Get our JSON
  // Documentation: https://ibm.co/v2PWSCC
  $data = file_get_contents("https://api.weather.com/v2/pws/observations/current?stationId=" . $_ENV['STATION_ID'] . "&format=json&units=e&apiKey=" . $_ENV['API_KEY']);
  $weather = json_decode($data, true);

  // Convert temperature and dew point
  $temp = $weather['observations'][0]['imperial']['temp'] . '°';
  $dew = $weather['observations'][0]['imperial']['dewpt'] . '°';

  // Convert wind speed
  $windNumber = $weather['observations'][0]['imperial']['windSpeed'];
  $windDirection = $weather['observations'][0]['winddir'];

  if ($windDirection) {
    $windSpeed = $windNumber . ' mph';
    $compass = array('N', 'NNE', 'NE', 'ENE', 'E', 'ESE', 'SE', 'SSE', 'S', 'SSW', 'SW', 'WSW', 'W', 'WNW', 'NW', 'NNW');
    $windDirectionName = $compass[round( ($windDirection % 360 - 11.25) / 22.5)];
    $wind = $windSpeed.' '.$windDirectionName;
  } else {
    $wind = 'Calm';
  }


/* CREATE OUR NEW IMAGE */

  // Make the canvas
  header('Content-Type: image/jpg');
  $canvas = imagecreatetruecolor(1920, 1080);

  // Add overlay box
  $offline = imagecreatefromjpeg(__DIR__.'/camera-offline.jpg');
  $camera = imagecreatefromjpeg('https://nexusapi-us1.camera.home.nest.com/get_image?uuid=' . $_ENV['NEST_CAMERA']);
  $overlay = imagecreatefrompng(__DIR__.'/time-overlay.png');
  imagecopy($canvas, $offline, 0, 0, 0, 0, 1920, 1080);
  imagecopy($canvas, $camera, 0, 0, 0, 0, 1920, 1080);
  imagecopy($canvas, $overlay, 0, 0, 0, 0, 1920, 1080);  // second zero is vertical orientation

  // Put the weather and time in the overlay box
  $color = imagecolorallocate($canvas, 255, 255, 255);
  $date = date("m/d/y", time());
  $time = date("h:i A", time());
  putenv('GDFONTPATH=' . realpath('.'));
  $font = __DIR__.'/sofia.ttf';
  $white = imagecolorallocate(imagecreatetruecolor(1920, 1080), 255, 255, 255);
  imagettftext($canvas, 36, 0, 1405, 62, $white, $font, $date);
  imagettftext($canvas, 36, 0, 1680, 62, $white, $font, $time);
  imagettftext($canvas, 36, 0, 390, 62, $white, $font, $temp);
  imagettftext($canvas, 36, 0, 780, 62, $white, $font, $dew);
  imagettftext($canvas, 36, 0, 1050, 62, $white, $font, $wind);

  // Save the image and free memory
  imagejpeg($canvas, __DIR__.'/camera.jpg', 100);
  imagedestroy($canvas);
?>
