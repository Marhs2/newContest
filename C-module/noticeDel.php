<?php
require_once "db.php";
header('Content-Type: application/json');
$idx = $_POST["item-id"];

DB::exec("DELETE FROM notice  where idx =  '$idx'");

echo json_encode(DB::fetchAll("select * from notice"));
