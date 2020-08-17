<?php
function connectDb() {
  try {
    return new PDO(DSN, DB_USER, DB_PASSWORD);
  } catch (PDOException $e) {
    echo $e->getMessage();
    exit;
  }
}

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

function setToken() {
  if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));

  }
}

function checkToken() {
  if (empty($_POST['token']) ) {
    echo "不正な処理です！postempty";
    exit;
  }
  if (empty($_SESSION['token'])) {
    echo "不正な処理です！sessionempty";
    exit;
  }
  if ($_SESSION['token'] != $_POST['token']) {
    echo $_SESSION['token'];
    echo "kugiri";
    echo $_POST['token'];
    echo "不正な処理です！equal";
    exit;
   }
}