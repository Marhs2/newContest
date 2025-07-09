<?php

require_once "db.php";

$path = "./product.json";
if (!file_exists($path)) {
  die("오류: 'product.json' 파일이 존재하지 않습니다. 경로를 확인해주세요.");
}

$json = file_get_contents($path);

$data = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE) {
  die("오류: JSON 디코딩에 실패했습니다. 파일 내용이 유효한 JSON 형식이 아닙니다. (" . json_last_error_msg() . ")");
}

if (!isset($data["product"]) || !is_array($data["product"])) {
  die("오류: JSON 데이터에 'product' 키가 없거나 배열/객체 형식이 아닙니다.");
}


foreach ($data["product"] as $categoryName => $productsInCategory) {
  foreach ($productsInCategory as $productId => $productDetails) {
    $title = $productDetails["title"];
    $des = $productDetails["des"];
    $price = str_replace(",", "", $productDetails['price']);
    $discount = str_replace(",", "", $productDetails['discount']);

    // 원본 JSON 데이터에서 변수들이 제대로 할당되어 있다고 가정합니다.
    // 예: $categoryName, $productId, $title, $des, $price, $discount

    DB::exec("INSERT INTO `prodcut`(`cate`, `itemNum`, `title`, `des`, `price`, `discount`) VALUES ('"
      . addslashes($categoryName) . "','" // categoryName 이스케이프
      . addslashes($productId) . "','"    // productId 이스케이프
      . addslashes($title) . "','"        // title 이스케이프
      . addslashes($des) . "','"          // des 이스케이프
      . addslashes($price) . "','"        // price 이스케이프
      . addslashes($discount)             // discount 이스케이프 (마지막 값 뒤에 쉼표 없음)
      . "')"); // SQL 쿼리 끝    // echo $productDetails["title"];
    // echo $productDetails["title"];
  }
}

echo "</ul>";
