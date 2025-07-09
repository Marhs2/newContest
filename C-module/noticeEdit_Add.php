<?php
require_once "db.php";

$getType = $_GET["type"];

if ($getType == "edit") {
  $idx = $_GET["idx"];
  $notice = DB::fetch("select * from notice where idx = '$idx'");
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["add"] == "add") {
  $type = $_POST["type"];
  $title = $_POST["title"];
  $date = $_POST["date"];

  DB::exec("INSERT INTO notice( type, title, date) VALUES ('$type','$title','$date')");
  echo "<script>location.href='noticeAdmin.php'</script>";
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $type = $_POST["type"];
  $title = $_POST["title"];
  $date = $_POST["date"];

  DB::exec("UPDATE notice SET type='$type',title='$title',date='$date' where idx = '$idx'");

  echo "<script>location.href='noticeAdmin.php'</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    table {
      border-collapse: collapse;
      vertical-align: top;
      vertical-align: bottom;
      vertical-align: middle;
    }

    td {
      padding: 5px;
    }

    input[name="title"] {
      min-width: 400px;
    }
  </style>
</head>

<body>
  <?php if ($getType == "edit") { ?>
    <form method="post">
      <select name="type" required>
        <option value="일반" <?= $notice->type == "일반" ? "selected" : "" ?>>일반</option>
        <option value="이벤트" <?= $notice->type == "이벤트" ? "selected"  : "" ?>>이벤트</option>
      </select>
      <input type="text" name="title" value="<?= $notice->title ?>" required>
      <input type="date" name="date" value="<?= $notice->date ?>" required>
      <input type="submit" value="수정">
    </form>



  <?php } else { ?>

    <form method="post">
      <input type="hidden" name="add" value="add">
      <select name="type" required>
        <option value="일반">일반</option>
        <option value="이벤트">이벤트</option>
      </select>
      <input type="text" name="title" required>
      <input type="date" name="date" required>
      <input type="submit" value="추가">
    </form>



  <?php } ?>

</body>

</html>