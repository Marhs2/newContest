<?php
require_once "db.php";
require_once "lib.php";

// $notice = DB::fetchAll("select * from product");
$isAdd = $_GET["isAdd"] ?? false;


if ($isAdd == "add") {
  $img = $_FILES["img"];
  $uploadDir = "./asset/A-Module/images/else/";
  move_uploaded_file($img["tmp_name"], $uploadDir . $img["name"]);
  $imgName = $img["name"];

  $title = $_POST["title"];
  $cate = $_POST["cate"];
  $des = $_POST["des"];
  $price = $_POST["price"];
  $discount = $_POST["discount"] ?? "";


  DB::exec("INSERT INTO `prodcut`(`img`, `title`, `des`, `price`, `discount`,cate) VALUES ('$imgName','$title','$des','$price','$discount','$cate')");
} else {
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
      echo "1번쨰";
      DB::exec("update prodcut set title = '$title', des = '$des', img = '$imgName', price = '$price', discount = '$discount' where img='$imgCheck'");
    } else {
      echo "2번쨰";
      DB::exec("update prodcut set title = '$title', des = '$des', img = '$imgName', price = '$price', discount = '$discount' where cate = '$cate' and itemNum = '$idx'");
    }
  } else {
    if (isset($imgCheck) && $imgCheck != null) {
      echo "3번쨰";
      DB::exec("update prodcut set title = '$title', des = '$des', price = '$price', discount = '$discount' where img = '$imgCheck'");
    } else {
      echo "4번쨰";
      DB::exec("update prodcut set title = '$title', des = '$des', price = '$price', discount = '$discount' where cate = '$cate' and itemNum = '$idx'");
    }
  }
}
header("Location: ./prodcutAdmin.php");
