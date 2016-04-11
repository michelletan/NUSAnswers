<?php
define("db_host", "localhost");
define("db_uid", "root");
// need a more secure password before deploying
// define("db_pwd", "plplpl");
define("db_pwd", "");
define("db_name", "nusanswers");
$db = new mysqli(db_host, db_uid, db_pwd, db_name);
if ($db->connect_errno) {
  exit("Failed to connect to MySQL, exiting this script");
}
?>
