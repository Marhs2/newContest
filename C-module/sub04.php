<?php require_once "db.php";


if (isset($_SESSION["ss"]->id) || isset($_SESSION["ss"])) {
  $userId = $_SESSION["ss"]->id;

  $carts = DB::fetchAll("select p.title,p.price,p.discount , p.idx , p.img ,p.itemNum,p.cate, u.count from userpur u join prodcut p on p.idx = u.itemId where u.userId = '$userId' ");
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="./style/sub02.css" />
  <link rel="stylesheet" href="./style/sub04.css" />
  <link rel="stylesheet" href="./style/main.css" />
  <link
    rel="stylesheet"
    href="../asset/공통/fontawesome/css/font-awesome.min.css" />
</head>

<body>
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
          <li><a href="#">관리자</a></li>
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

  <main>
    <div class="all-container">
      <div class="title">CART</div>

      <div class="cart">
        <?php if (isset($_SESSION["ss"]->id) || isset($_SESSION["ss"])) { ?>
          <?php foreach ($carts as $key) {

            $discount = $key->discount;


            if ($discount == "1") {
              $discount = $key->price - 10000;
            } else if ($discount == "2") {
              $discount = $key->price * 0.90;
            } else if ($discount == "3") {
              $discount = $key->price * 0.70;
            }
          ?>

            <div class="item" data-id="<?= $key->idx ?>">
              <div class="img-cover">
                <img src="../asset/A-Module/images/<?= ($key->img == null ? $key->cate . "/" . $key->itemNum . ".PNG" : "else/" . $key->img) ?>" alt="">
              </div>

              <div class="item-content">
                <div class="item-title"><?= $key->title  ?></div>
                <div class="item-about">

                  <?php if ($discount == "0") { ?>
                    <div class="item-price">가격: <span><?= number_format($key->price, 0, ".", ",") ?> </div>
                  <?php } else { ?>
                    <div class="item-price">가격: <span style="text-decoration: line-through;"><?= number_format($key->price, 0, ".", ",") ?></span> -&gt; <span class="price"><?= number_format($discount, 0, ".", ",") ?></span> </div>
                  <?php } ?>


                </div>
                <div class="itemCount">
                  <div>
                    <label for="count">개수: </label>
                    <input type="number" id="count" value="<?= $key->count  ?>" min="1">
                  </div>
                  <div><span>가격:</span> <span class="countTotal">65,000</span></div>
                </div>
              </div>

            </div>
          <?php } ?>
        <?php } ?>




      </div>
      <div class="checkout">
        <div>총 가격: <span class="total"></span></div>
        <div class="checkoutBtn">구매</div>
      </div>
    </div>
  </main>

  <footer>
    <div class="contact-nav">
      <div class="contact">
        <div class="contac">
          고객센터 이용안내 - 온라인몰 고객센터 1580-8282 - 매장고객센터
          1577-8254
        </div>
        <div class="contac">고객센터 운영시간 [평일 09:00 - 18:00]</div>
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
  <script src="./script/sub04.js"></script>
</body>

</html>