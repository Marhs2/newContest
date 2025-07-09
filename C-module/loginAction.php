<?php
require_once "db.php";
require_once "lib.php";

$type = $_GET["type"] || "";

if ($type == "logout") {
  echo "로그아웃입니다";
  session_destroy();
  move();
  return false;
}


$id = $_POST["loginId"];
$psw = $_POST["loginPsw"];




$user = DB::fetch("select * from userlogin where id = '$id'");

if (DB::fetch("select * from userlogin where id = '$id'")) {
  $h_pw = $user->psw;
  $salt = $user->salt;

  if ($h_pw == hash('sha256', $salt . $psw)) {
    $_SESSION["ss"] = $user;
  } else {
    alert("비밀번호를 틀리셨습니다");
  }
} else {
  alert("없는 사용자입니다");
}


move();
