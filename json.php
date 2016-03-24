<?php
header('Content-Type: application/json');
$i = array();
$i["t"] = 5;

echo json_encode($i);
exit();
?>
