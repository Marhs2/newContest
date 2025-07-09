<?php

require_once "db.php";
header('Content-Type: application/json');








$count = $_POST["count"] ?? "";

$type = $_POST["type"] ?? '';





$id = $_POST["id"] ?? "";
$itemCate = $_POST["item-cate"] ?? "";
$itemId = $_POST["item-id"] ?? "";
$title = $_POST["title"] ?? "";
$price = $_POST["price"] ?? "";
$discount = $_POST["discount"] ?? "";




if (!isset($_SESSION['ss']) || !isset($_SESSION['ss']->id)) {
  echo json_encode("로그인 해주세요");
  return false;
} else {
  $Userid = $_SESSION['ss']->id;

  if (DB::fetch("show tables like '$Userid'")) {
    if (DB::fetch("select * from `$Userid` where item_id = '$itemId' and item_cate = '$itemCate'")) {
      if ($type == "cart") {
        DB::exec("UPDATE `$Userid` SET count= $count where item_id = '$itemId' and item_cate = '$itemCate'");
      } else {
        DB::exec("UPDATE `$Userid` SET count= count +1 where item_id = '$itemId' and item_cate = '$itemCate'");
      }
    } else {
      DB::exec("INSERT INTO $Userid(`item_id`, `item_cate`, `count`, `price`, `discount`, `title`) VALUES ('$itemId','$itemCate',1,'$price','$discount','$title')");
    }

    echo json_encode("장바구니에 추가완료 했습니다");
  } else {
    DB::exec("create table `{$Userid}`(
      idx int AUTO_INCREMENT PRIMARY KEY,
      item_id varchar(20) not null,
      item_cate varchar(20) not null,
      count int not null,
            price varchar(20) not null,
            discount int not null,
            title varchar(100) not null
            )");
    DB::exec("INSERT INTO $Userid(`item_id`, `item_cate`, `count`, `price`, `discount`, `title`) VALUES ('$itemId','$itemCate',1,'$price','$discount','$title')");
    echo json_encode("장바구니에 추가완료 했습니다");
  }
}
