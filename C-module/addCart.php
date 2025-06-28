<?php
header('Content-Type: application/json');

$id = $_POST["id"];
$con = $_POST["con"];

echo json_encode($con);
