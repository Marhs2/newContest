<?php require_once "db.php";



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="./style/sub02.css" />
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
      <?php if (isset($_SESSION["ss"]->isAdmin) == "1") { ?>
        <ul class="nav02">
          <li><a href="#" class="login"><?= $_SESSION["ss"]->id ?></a></li>
          <li><a href="#" onclick="logout()" class="logout">로그아웃</a></li>
          <li><a href="#">장바구니</a></li>
          <li><a href="#">관리자</a></li>
        </ul>
      <?php } else if (isset($_SESSION["ss"])) { ?>
        <ul class="nav02">
          <li><a href="#" class="login">로그인</a></li>
          <li><a href="#" class="signup">회원가입</a></li>
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
      <div class="title">ALL PRODCUTS</div>
      <div class="prodcuts-container">
        <div class="items">
          <div class="item">
            <div class="img-cover">
              <img src="../asset/A-Module/images/건강식품/1.PNG" alt="" />
            </div>

            <div class="item-content">
              <div class="item-title">상품명: 이뮨 멀티비타민&amp;미네랄</div>
              <div class="item-about">
                <div class="item-price">
                  가격:
                  <span style="text-decoration: line-through">75,000</span>
                  -&gt; <span class="discount">65,000</span>
                </div>
                <div class="item-btn">
                  <a href="#">구매하기</a>
                  <a href="#">장바구니담기</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="items">
          <div class="item">
            <div class="img-cover">
              <img src="../asset/A-Module/images/디지털/4.PNG" alt="" />
            </div>

            <div class="item-content">
              <div class="item-title">
                상품명: 파이널마우스 스타라이트12 페가수스 미디엄
              </div>
              <div class="item-about">
                <div class="item-price" style="font-size: 16px">
                  가격:
                  <span style="text-decoration: line-through">1,254,000</span>
                  -&gt; <span class="discount">1,128,600</span>
                </div>
                <div class="item-btn">
                  <a href="#">구매하기</a>
                  <a href="#">장바구니담기</a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="items">
          <div class="item">
            <div class="img-cover">
              <img src="../asset/A-Module/images/팬시/4.PNG" alt="" />
            </div>

            <div class="item-content">
              <div class="item-title">상품명: 게이밍 이어폰 VJJB NI</div>
              <div class="item-about">
                <div class="item-price">
                  가격:
                  <span style="text-decoration: line-through">38,900</span>
                  -&gt; <span class="discount">28,900</span>
                </div>
                <div class="item-btn">
                  <a href="#">구매하기</a>
                  <a href="#">장바구니담기</a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="items">
          <div class="item">
            <div class="img-cover">
              <img src="../asset/A-Module/images/향수/4.PNG" alt="" />
            </div>

            <div class="item-content">
              <div class="item-title">상품명: 몽블랑 익스플로러 EDP 60ml</div>
              <div class="item-about">
                <div class="item-price">
                  가격:
                  <span style="text-decoration: line-through">103,000</span>
                  -&gt; <span class="discount">93,000</span>
                </div>
                <div class="item-btn">
                  <a href="#">구매하기</a>
                  <a href="#">장바구니담기</a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="items">
          <div class="item">
            <div class="img-cover">
              <img src="../asset/A-Module/images/헤어케어/5.PNG" alt="" />
            </div>

            <div class="item-content">
              <div class="item-title">
                상품명: 닥터포헤어 피토프레시 헤어쿨링 스프레이 150ml
              </div>
              <div class="item-about">
                <div class="item-price">
                  가격:
                  <span style="text-decoration: line-through">16,000</span>
                  -&gt; <span class="discount">14,400</span>
                </div>
                <div class="item-btn">
                  <a href="#">구매하기</a>
                  <a href="#">장바구니담기</a>
                </div>
              </div>
            </div>
          </div>

        </div>
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
</body>

</html>