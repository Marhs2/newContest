<?php
function hashPw($psw)
{
  $salt = bin2hex(random_bytes(32));
  $h_pw = hash('sha256', $salt . $psw);
  return [$h_pw, $salt];
}

function  move()
{
  echo "<script>location.href='/'</script>";
}

function  alert($msg)
{
  echo "<script>alert('$msg')</script>";
}

function ss () {
  return $_SESSION['ss'];
}