<?php

/*
 * Copy images from remote server
 * Cron job command: PHP /home/colinlor/public_html/lordcol.in/camera/downloader.php
 * Other possible command: wget -qO /dev/null http://lordcol.in/roof-camera/downloader.php
 */

  // Wait for image to download
  // sleep(10);

  // variables for our FTP transfer
  // $file = 'image-roof.jpg';
  $file = __DIR__.'/images/roof.jpg';
  $remote_file = 'image.jpg';
  $ftp_server = 'webcam.wunderground.com';
  $ftp_user_name = 'colinlordCAM4';
  $ftp_user_pass = 'FqzCHMh8';

  // set up connection
  $conn_id = ftp_connect($ftp_server);

  if ($conn_id) {
    echo "We have successfully connected!<br>";
  }
  else {
    echo "We have a problem connecting.<br>";
  }

  // login with username and password
  $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

  if ($login_result) {
    echo "We have successfully logged in!<br>";
  }
  else {
    echo "We have an authentication issue.<br>" + $login_result + "<br>";
  }

  // turn passive mode on
  ftp_pasv($conn_id, true);

  // upload a file
  if (ftp_put($conn_id, $remote_file, $file, FTP_BINARY)) {
    echo "We have successfully uploaded $file.<br>";
  }
  
  else {
    echo "There was a problem while uploading $file.<br>";
  }
  

  // close the connection
  // ftp_close($conn_id);

?>
