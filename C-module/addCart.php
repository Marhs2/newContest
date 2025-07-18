<?php

require_once "db.php";
header('Content-Type: application/json');








$count = $_POST["count"] ?? "";

$type = $_POST["type"] ?? '';




$idx = $_POST["idx"];




if (!isset($_SESSION['ss']) || !isset($_SESSION['ss']->id)) {
  echo json_encode("로그인 해주세요");
  return false;
} else {

  $Userid = $_SESSION['ss']->id;

  if (DB::fetch("select * from userPur where userId = '$Userid' and itemId = '$idx'")) {
    if ($type == "cart") {
      DB::exec("UPDATE userPur SET count= '$count' where userId = '$Userid'and itemId = '$idx'");
    } else {
      $count = $_POST["count"] ?? null;
      if ($count == null) {
        DB::exec("UPDATE userPur SET count= '$count' where userId = '$Userid'and itemId = '$idx'");
      } else {
        DB::exec("UPDATE userPur SET count= count+1 where userId = '$Userid'and itemId = '$idx'");
      }
    }
  } else {
    DB::exec("INSERT INTO userPur(userId , itemId ) VALUES ('$Userid','$idx')");
  }

  echo json_encode("장바구니에 추가완료 했습니다");
}
