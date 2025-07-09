<?php
require_once "db.php";



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
  <link rel="stylesheet" href="./style/prodcutAdmin.css">
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


  <main class="edit">

    <form method="post" action="prodctEdit_removeAction.php?isAdd=add" enctype="multipart/form-data">

      <div class="item-imgUpload">
        <img src="#" alt="" id="imgPreview">
        <input type="file" name="img" accept="image/*">
      </div>


      <div class="item-title">
        <input type="text" name="title" placeholder="제목">
      </div>
      <div class="item-des">
        <input type="text" name="des" placeholder="설명">
      </div>
      <div class="item-price">
        <input type="text" name="price" placeholder="가격">
      </div>


      <div class="item-title">
        <select name="cate">
          <option value="건강식품">건강식품</option>
          <option value="디지털">디지털</option>
          <option value="팬시">팬시</option>
          <option value="향수">향수</option>
          <option value="헤어케어">헤어케어</option>
        </select>
      </div>

      <div class="discount">
        <input type="radio" name="discount" id="won" value="1">
        <label for="won">만원할인</label>
        <input type="radio" name="discount" id="ten" value="2">
        <label for="ten">10% 할인</label>
        <input type="radio" name="discount" id="three" value="3">
        <label for="three">30% 할인</label>
      </div>
      <div>
        <input type="submit" value="추가" onclick="add()">
      </div>
    </form>

  </main>





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