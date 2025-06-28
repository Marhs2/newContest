<?php
require_once "db.php";
require_once "lib.php";

$id = $_POST["id"];
$psw = $_POST["psw"];
$name = $_POST["name"];
$email = $_POST["email"];

[$h_pw, $salt] = hashPw($psw);


if (DB::fetch("select * from userlogin where id = '$id'")) {
  alert("이미 사용중인 아이디입니다");
  move();
  return false;
} else {
  DB::exec("INSERT INTO userlogin ( id, psw, name, email,salt) VALUES ('$id','$h_pw','$name','$email','$salt')");
  move();
}
