<?php

  require_once('db_credentials.php');

  function db_connect() {
     try {
       $dbh = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_SERVER,
                      DB_USER,
                      DB_PWD,
                      array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

     } catch (PDOException $e) {
       echo "This application exited with failure " .
            "because there was an error when trying to " .
            "connect to its database.";
       exit();
     }
     return $dbh;
  }

  function db_disconnect() {
    global $db;
    if (isset($db)) {
      $db = null;
    }
  }
