<?php

require_once "db.php";
header('Content-Type: application/json');
$type = $_GET["type"];
$con = $_GET["con"];


if ($type == "type") {
  $notice = DB::fetchAll("select * from notice where type =  '$con'");
} else {
  $notice = DB::fetchAll("select * from notice order by date $con");
}




echo json_encode($notice);
