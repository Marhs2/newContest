<?php
require_once "db.php";

header('Content-Type: application/json');


$cate = $_POST["cate"];
$num = $_POST["id"];

// DB::exec("DELETE FROM `prodcut` WHERE cate = '$cate' and itemNum = '$num'");
$items = DB::fetchAll("select * from prodcut");

echo json_encode($items);
