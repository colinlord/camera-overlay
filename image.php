<?php

$ch = curl_init('https://nexusapi-us1.camera.home.nest.com/get_image?uuid=e07868640e544a9d9d2cca77ea21894e&width=1920&public=tZXreYM9vZ');
$fp = fopen('/home/colinlor/sites/lordcol.in/roof-camera/image-php2.jpg', 'wb');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);


echo "This has run!!";
?>


