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
  <link rel="stylesheet" href="./style/main.css">
  <link rel="stylesheet" href="./style/noticeAdd.css">
</head>

<body>
  <?php if ($getType == "edit") { ?>
    <form method="post">
      <div class="container">
        <div>
          <h1>공지사황 수정</h1>
        </div>
        <div>
          <div>
            <label for="type">종류</label>
            <select name="type" id="type" required>
              <option value="일반" <?= $notice->type == "일반" ? "selected" : "" ?>>일반</option>
              <option value="이벤트" <?= $notice->type == "이벤트" ? "selected"  : "" ?>>이벤트</option>
            </select>
          </div>

          <div>
            <label for="title">제목</label>
            <input type="text" id="title" name="title" value="<?= $notice->title ?>" required>
          </div>
          <div>
            <label for="date">날짜</label>
            <input type="date" name="date" id="date" value="<?= $notice->date ?>" required>

          </div>

          <div>
            <input type="submit" value="수정">
          </div>


        </div>



      </div>
    </form>




  <?php } else { ?>



    <form method="post">
      <input type="hidden" name="add" value="add" style="display: none;">

      <div class="container">
        <div>
          <h1>공지사황 추가</h1>
        </div>
        <div>
          <div>
            <label for="type">종류</label>
            <select name="type" id="type" required>
              <option value="일반">일반</option>
              <option value="이벤트">이벤트</option>
            </select>
          </div>

          <div>
            <label for="title">제목</label>
            <input type="text" id="title" name="title" required>
          </div>
          <div>
            <label for="date">날짜</label>
            <input type="date" name="date" id="date" required>

          </div>

          <div>
            <input type="submit" value="추가">
          </div>


        </div>



      </div>
    </form>




  <?php } ?>

</body>

</html>