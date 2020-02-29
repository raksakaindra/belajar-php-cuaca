<?php
  // menggunakan mysqli_connect untuk koneksi database

  $databaseHost = 'localhost';
  $databaseName = 'cuaca';
  $databaseUsername = 'root';
  $databasePassword = 'root';

  $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 

  if ($mysqli->ping()) {
      //printf ("Our connection is ok!\n");
  } else {
      //printf ("Error: %s\n", $mysqli->error);
  }
?>