<?php
require_once "db.php";


$notice = DB::fetchAll("select * from prodcut");

print_r(DB::fetchAll("select cate, count(*) from prodcut group by cate"));

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>


  <link rel="stylesheet" href="./style/main.css">
  <link rel="stylesheet" href="./style/sub02.css">
  <link rel="stylesheet" href="./style/noticeAdmin.css">
  <link rel="stylesheet" href="../asset/공통/fontawesome/css/font-awesome.min.css">

</head>

<body>
  <div class="signupLayer">

    <div>
      <span class="closesignup">닫기</span>
      <form action="singupAction.php" method="post">
        <table>
          <tr>
            <td><label for="id">아이디</label> <input type="text" name="id" id="id" required></td>
          </tr>
          <tr>
            <td><label for="psw">비밀번호</label> <input type="password" name="psw" id="psw" required></td>
          </tr>
          <tr>
            <td><label for="name">이름</label> <input type="text" name="name" id="name" required></td>
          </tr>
          <tr>
            <td><label for="email">이메일</label> <input type="email" name="email" id="email" required></td>
          </tr>
          <tr>
            <td><input type="submit" value="회원가입"></td>
          </tr>
        </table>
      </form>
    </div>


  </div>



  <div class="loginLayer">

    <div>
      <span class="closeLogin">닫기</span>
      <form action="loginAction.php" method="post">
        <table>
          <tr>
            <td><label for="id">아이디</label> <input type="text" name="loginId" id="id" required></td>
          </tr>
          <tr>
            <td><label for="psw">비밀번호</label> <input type="password" name="loginPsw" id="psw" required></td>
          </tr>

          <tr>
            <td><input type="submit" value="회원가입"></td>
          </tr>
        </table>
      </form>
    </div>

  </div>



  <header>
    <a href="index.php"><img src="../images/logo.png" alt="logo" /></a>

    <nav>
      <ul class="nav01">
        <li>
          <a href="./sub01.php">소개</a>
          <ul>
            <li><a href="#">-</a></li>
            <li><a href="#">-</a></li>
          </ul>
        </li>
        <li>
          <a href="./sub02.php">판매상품</a>
          <ul>
            <li><a href="./sub02.php">전체상품</a></li>
            <li><a href="./sub03.php">인기상품</a></li>
          </ul>
        </li>
        <li>
          <a href="./sub03.php">가맹점</a>
          <ul>
            <li><a href="#">-</a></li>
            <li><a href="#">-</a></li>
          </ul>
        </li>
        <li>
          <a href="./sub04.php">장바구니</a>
          <ul>
            <li><a href="#">-</a></li>
            <li><a href="#">-</a></li>
          </ul>
        </li>
      </ul>
      <?php if (isset($_SESSION["ss"]->isAdmin) && $_SESSION["ss"]->isAdmin  == 1) { ?>
        <ul class="nav02">
          <li><a href="#" class="login"><?= $_SESSION["ss"]->id ?></a></li>
          <li><a href="#" onclick="logout()" class="logout">로그아웃</a></li>
          <li><a href="#">장바구니</a></li>
          <li><a href="#">관리자</a>
            <ul>
              <li><a href="./noticeAdmin.php">공지사항관리</a></li>
              <li><a href="./prodcutAdmin.php">판매상품관리</a></li>
            </ul>
          </li>
        </ul>
      <?php } else if (isset($_SESSION["ss"])) { ?>
        <ul class="nav02">
          <li><a href="#" class="login"><?= $_SESSION["ss"]->id ?></a></li>
          <li><a href="#" onclick="logout()" class="logout">로그아웃</a></li>
          <li><a href="#">장바구니</a></li>
        </ul>
      <?php } else { ?>
        <ul class="nav02">
          <li><a href="#" class="login">로그인</a></li>
          <li><a href="#" class="signup">회원가입</a></li>
          <li><a href="#">장바구니</a></li>
        </ul>
      <?php } ?>

    </nav>
  </header>
  <div class="prodcuts-container">



    <?php
    // 1. 데이터를 카테고리별로 그룹화합니다.
    $categorized_items = [];
    foreach ($notice as $item) {
      // $item->cate 값을 키로 사용하여 아이템을 배열에 추가합니다.
      $categorized_items[$item->cate][] = $item;
    }


    // 2. 그룹화된 데이터를 기반으로 HTML을 생성합니다.
    // $category_name에는 '디지털', '가구' 등의 카테고리 이름이 들어갑니다.
    // $items_in_category에는 해당 카테고리의 아이템 배열이 들어갑니다.
    foreach ($categorized_items as $category_name => $items_in_category) {

      // 카테고리 제목을 출력합니다. (선택 사항)
      echo "<h2>" . htmlspecialchars($category_name) . "</h2>";

      $counter = 0; // 각 카테고리마다 카운터를 리셋합니다.

      foreach ($items_in_category as $key => $value) {
        // 할인율 계산 로직 (기존과 동일)
        if ($value->discount == "1") {
          $discount = $value->price - 10000;
        } else if ($value->discount == "2") {
          $discount = $value->price * 0.90;
        } else if ($value->discount == "3") {
          $discount = $value->price * 0.70;
        } else {
          $discount = $value->price; // 할인 코드가 0이거나 다른 값일 때 원래 가격 표시
        }

        // 5개마다 div.items를 열고 닫는 로직 (기존과 동일)
        if ($counter % count($items_in_category) === 0) {
          if ($counter > 0) {
            echo '</div>';
          }
          echo '<div class="items">';
        }
    ?>

        <div class="item" data-cate="<?= htmlspecialchars($value->cate) ?>" data-idx="<?= htmlspecialchars($value->itemNum) ?>">
          <?php if (isset($value->img) && $value->img != null) { ?>
            <input type="hidden" name="type" value="img">
            <input type="hidden" name="typeName" value="<?= htmlspecialchars($value->img) ?>">
          <?php } else { ?>
            <input type="hidden" name="type" value="cate">
            <input type="hidden" name="typeName" value="<?= htmlspecialchars($value->cate) ?>">
            <input type="hidden" name="typeNum" value="<?= htmlspecialchars($value->itemNum) ?>">
          <?php } ?>
          <div class="img-cover">
            <?php if (isset($value->img) && $value->img != null) { ?>
              <img src="../asset/A-Module/images/else/<?= htmlspecialchars($value->img) ?>" alt="<?= htmlspecialchars($value->cate) ?><?= htmlspecialchars($value->itemNum) ?>Img">
            <?php } else { ?>
              <img src="../asset/A-Module/images/<?= htmlspecialchars($value->cate) ?>/<?= htmlspecialchars($value->itemNum) ?>.PNG" alt="<?= htmlspecialchars($value->cate) ?><?= htmlspecialchars($value->itemNum) ?>Img">
            <?php } ?>
          </div>

          <div class="item-content">
            <div class="item-title"><?= htmlspecialchars($value->title) ?></div>
            <div class="item-about" style="text-align: center;">
              <?php if ($value->discount == "0") { ?>
                <div class="item-price">가격: <span><?= number_format($value->price) ?></span></div>
              <?php } else { ?>
                <div class="item-price"><span style="text-decoration: line-through;"><?= number_format($value->price) ?></span>-&gt;<span class="discount"><?= number_format($discount) ?></span></div>
              <?php } ?>
              <div class="item-des"><?= htmlspecialchars($value->des) ?></div>
              <div class="item-btn">
                <span onclick="delProdcut('<?= htmlspecialchars($value->cate) ?>','<?= htmlspecialchars($value->itemNum) ?>')">삭제</span>
                <?php if (isset($value->img) && $value->img  != null) { ?>
                  <a href="./prodctEdit_remove.php?img=<?= htmlspecialchars($value->img) ?>">수정</a>
                <?php } else { ?>
                  <a href="./prodctEdit_remove.php?cate=<?= htmlspecialchars($value->cate) ?>&idx=<?= htmlspecialchars($value->itemNum) ?>">수정</a>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>

    <?php
        $counter++;
      } // 한 카테고리의 아이템 루프 종료

      // 루프가 끝난 후 마지막으로 열린 div.items를 닫아줍니다.
      if ($counter > 0) {
        echo '</div>';
      }
    } // 전체 카테고리 루프 종료
    ?>



    <!-- <td><a href="./noticeEdit_Add.php?idx=<?= $value->idx ?>&type=edit">수정</a> </td>
      <td class="del" onclick="del(this)">삭제</td> -->


  </div>
  <div class="add" onclick="productAdd()">추가</div>

  <footer>
    <div class="contact-nav">
      <div class="contact">
        <div class="contac">
          고객센터 이용안내 - 온라인몰 고객센터 1580-8282 - 매장고객센터
          1577-8254
        </div>
        <div class="contac">
          고객센터 운영시간 [평일 09:00 - 18:00]
        </div>
        <div class="contac">
          주말 및 공휴일은 1:1문의하기를 이용해주세요. 업무가 시작되면 바로
          처리해드립니다.
        </div>
      </div>

      <div class="footerNav">
        <a href="#"><img src="../images/logo.png" alt="footerLogo" /></a>
        <div class="footerNavMain">
          <a href="#">개인정보처리방침</a> |
          <a href="#">이용약관.법적고지</a> | <a href="#">청소년보호방침</a> |
          <a href="#">이메일무단수집거부</a> | <a href="#">사이트맵</a> |
          <a href="#">채용</a>
        </div>

        <div class="footerNavSns">
          <div class="fa fa-twitter"></div>
          <div class="fa fa-twitch"></div>
          <div class="fa fa-whatsapp"></div>
          <div class="fa fa-youtube-play"></div>
          <div class="fa fa-facebook"></div>
        </div>
      </div>
    </div>

    <div class="who-safe">
      <div class="who">
        (주)GIFTS:Mall | 사업자등록번호 : 809-81-01157 | 대표이사 황기영 주소
        : 서울특별시 용산구 한강대로 123, 40층 본사 대표전화 : 02-123-4567 |
        GIFTS:Mall 가맹상담전화 : 02-123-4568
      </div>

      <div class="safe">
        지방은행구매안전서비스 GIFTS:Mall은 현금 결제한 금액에 대해 지방은행과
        채무지급보증 계약을체결하여 안전한 거래를 보장하고 있습니다 서비스
        가입사실 확인 &gt;
      </div>

      <div class="copy">
        COPYRIGHTⓒ 2024 GIFTS:MALL KOREA INC. ALL RIGHTS RESERVED
      </div>
    </div>
  </footer>
  <script src="./script/admin.js"></script>


</body>

</html>