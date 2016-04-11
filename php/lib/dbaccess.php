<?php
define("db_host", "localhost:3306");
define("db_uid", "root");
define("db_pwd", "");
define("db_name", "nusanswers");
$db = new mysqli(db_host, db_uid, db_pwd, db_name);
if ($db->connect_errno) {
  exit("Failed to connect to MySQL, exiting this script");
}
?>
