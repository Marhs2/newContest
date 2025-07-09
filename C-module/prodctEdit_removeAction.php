<?php
require_once "db.php";
require_once "lib.php";

// $notice = DB::fetchAll("select * from product");
if ($_POST["type"] == "img") {
  $imgCheck = $_POST["typeName"];
} else {
  $cate = $_POST["typeName"];
  $idx = $_POST["typeNum"];
}
$img = $_FILES["img"];
$title = $_POST["title"];
$des = $_POST["des"];
$price = $_POST["price"];
$discount = $_POST["discount"];

// if ($img["error"] == 0) {
//   $imgPath = "./asset/A-Module/images/$cate/$idx.PNG";
//   move_uploaded_file($img["tmp_name"], $imgPath);
// }

$uploadDir = "./asset/A-Module/images/else/";


if (isset($img) && $img["error"] == 0) {
  move_uploaded_file($img["tmp_name"], $uploadDir . $img["name"]);
  $imgName = $img["name"];
  if (isset($imgCheck)) {
    DB::exec("update prodcut set title = '$title', des = '$des', img = '$imgName', price = '$price', discount = '$discount' where img='$imgCheck'");
  } else {
    DB::exec("update prodcut set title = '$title', des = '$des', img = '$imgName', price = '$price', discount = '$discount' where cate = '$cate' and itemNum = '$idx'");
  }
} else {
  if (isset($imgCheck)) {
    DB::exec("update prodcut set title = '$title', des = '$des', price = '$price', discount = '$discount' where img = '$imgCheck'");
  } else {
    DB::exec("update prodcut set title = '$title', des = '$des', price = '$price', discount = '$discount' where cate = '$cate' and itemNum = '$idx'");
  }
}

header("Location: ./prodcutAdmin.php");
