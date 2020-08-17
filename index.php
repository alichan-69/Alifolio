<?php

require_once('config.php');
require_once('functions.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] != "POST") {
  // 投稿前
  // CSRF対策
  setToken();
  $submit=false;
} else {
  // 投稿後
  //checkToken();
  $submit=true;
  $name = $_POST['name'];
  $email = $_POST['email'];
  $memo = $_POST['memo'];

  $error = array();

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $error['email'] = 'メールアドレスの形式が正しくありません';
  }
  if ($email == '') {
    $error['email'] = 'メールアドレスを入力してください。';
  }
  if ($memo == '') {
    $error['memo'] = '内容を入力してください。';
  }

  if (empty($error)) {
    // DBに格納
    $dbh = connectDb();
           
    $sql = "insert into entries 
            (name, email, memo, created, modified) 
            values 
            (:name, :email, :memo, now(), now())";
    $stmt = $dbh->prepare($sql);
    $params = array(
        ":name" => $name,
        ":email" => $email,
        ":memo" => $memo
    );
    $stmt->execute($params);
    
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>ありふぉりお</title>
    <link rel="icon" href="favicon.ico">
    <meta name="description" cotent="ありちゃんのポートフォリオサイトです">
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>  
    <!-- ヘッダー -->
    <header>
      <div class="container">
        <div>
          <img src="images/programing.png">
        </div>
        <div>
          <img src="images/alifolio.png"><br>
          駆け出しwebエンジニアありちゃんのポートフォリオサイトです。HTML・CSS・jquery・javascript・PHP・Mysql・C#使えます。
        </div>
      </div>
    </header>

    <!-- ナビ -->
    <nav class="container3">
      <a href="#profile">
        PROFILE
      </a>
      <a href="#works">
        WORKS
      </a>
      <a href="#skills">
        SKILLS
      </a>
      <a href="#contact">
        CONTACT
      </a>
    </nav>
    
    <!-- ルーレット -->
    <div class="roulette-style roulette-position1" id="roulette">
      <p>ありちゃんのイラストルーレット</p>
      <img src="images/rachel.png" id="image">
      <input type="button" value="スタート" class="button2" id="start" onclick="start();"/>
    </div>

    <!-- メイン -->
    <main>
      <!-- プロフィール -->
      <section class="profile">      
        <h2 id="profile">PROFILE</h2>
        <div class="container">
          <div>
            <img src="images/alichan.png" class="image fadeout">
          </div>
          <div class="alichaninfo">
            <h2>ありちゃん</h2>
            <p>高校三年生の時にはやっていた脱出ゲームがにはまり、自分も作りたくなって脱出×ノベルアリスゲームを作る。そこからプログラミングの世界を知り、エンジニアを目指す。今は動画やブログ等でプログラミングを学びつつ、作品を増やしている。お絵描きが趣味。</p>
          </div>
        </div>
      </section>
      <hr>
      <!-- 作品 -->
      <section class="works">      
        <h2 id="works">WORKS</h2>
        <section class="container">
          <div>
            <img src="images/alicegame.png" class="image fadeout">
          </div>
          <div class="alicegameinfo">
            <a href="https://apps.apple.com/jp/app/%E8%84%B1%E5%87%BA-%E3%83%8E%E3%83%99%E3%83%AB-%E3%82%A2%E3%83%AA%E3%82%B9%E3%82%B2%E3%83%BC%E3%83%A0/id1449550497">
              <h2>スマートフォンアプリ  脱出×ノベルアリスゲーム</h2>
              <p>
                ノベルゲームと脱出ゲームを組み合わせたアプリ。1000ダウンロードを突破。プログラム・イラスト・シナリオ全て一人で作成した。<br>使用言語： C#<br>使用ツール： Unity<br>
              </p>              
            </a>  
          </div>
        </section>
        <section class="container comics">
          <div>
            <img src="images/manga.png" class="image fadeout">
          </div>
          <div class="comicsinfo">
            <a href="http://alichan.php.xdomain.jp/question_php/index.php">
              <h2>webアプリケーション  漫画診断</h2>
              <p>
                ユーザーに色々な質問に答えてもらい、漫画をお勧めするアプリ。<br>使用言語： HTML・CSS・jquery・PHP・Mysql<br>
              </p>
            </a>
          </div>
        </section>
        <section class="container portfolio">
          <div>
            <img src="images/programing.png" class="image fadeout">
          </div>
          <div class="portfolioinfo">
            <a href="">
              <h2>ありふぉりお</h2>
              <p>駆け出しwebエンジニアありちゃんのポートフォリオサイト。
                <br>使用言語： HTML・CSS・jquery・javascript・PHP・Mysql<br>
              </p>
            </a>
          </div>
        </section>
      </section>
      <hr>
      <!-- 技術 -->
      <section class="skills">
        <h2 id="skills">SKILLS</h2>
        <div class="container2">
          <div class="languagesinfo">
            <h2>使用可能言語</h2>
            <p>C#・ HTML・CSS・jquery・javascript・PHP・Mysql</p>
          </div>
          <div class="toolsinfo"> 
            <h2>使用可能ツール</h2>
            <p>Unity</p>
          </div>
          <div class="frameworksinfo">
            <h2>使用可能フレームワーク</h2>
            <p>Bootstrap</p>
          </div>
        </div>
      </section>
      <hr>
      <!-- お問い合わせ -->
      <section class="contact">
        <h2 id="contact">CONTACT</h2>
        <h2 id="submit"><?php if(!$error['email'] && !$error['memo'] && $submit===true){echo 送信されました！;} ?></h2>
        <form method="post" action="">
          <div class="container3">
            <div class="namailinfo">
              名前<br>
              <input type="text" name="name" value="<?php if($submit===false){echo h($name);}?>"><br>
              メールアドレス*<br>
              <input type="text" name="email" value="<?php if($submit===false){echo h($email);} ?>"><br>
              <?php if ($error['email']) { echo h($error['email']); } ?>         
            </div>
            <div class="messageinfo">
              メッセージ*<br>
              <textarea name="memo" rows="8"><?php if($submit===false){echo h($memo);} ?></textarea>
              <?php if ($error['memo']) { echo h($error['memo']); } ?>
            </div>
          </div>
            
          <div class="buttonout"><input type="submit" class="button" value="送信"></div>
          <input type="hidden" name="token" value="<?php echo h($_SESSION['token']); ?>">
        </form>
      </section>
    </main>
    <!-- フッター -->
    <footer>
      © Copyright 2020 ありふぉりお All rights reserved.
    </footer>
    <script src="http://code.jquery.com/jquery-1.9.0rc1.js"></script>
    <script>
      "use strict";

      $(function() {
        $("#submit").fadeOut(10000);
        // ルーレット 移動
        $(window).scroll(function () {
          if ($(this).scrollTop() > 254) {
            $("#roulette").removeClass("roulette-position1").addClass("roulette-position2");
          }else{
            $("#roulette").removeClass("roulette-position2").addClass("roulette-position1");
          }
        });
        // 画像 移動
        $(window).scroll(function () {
          var scroll_top = $(window).scrollTop();
          var window_h = $(window).height();

          $(".image").each(function() {
            var image_top = $(this).offset().top;
            var image_h = $(this).height();

            if (scroll_top > image_top - window_h + image_h / 2) {
            $(this).removeClass("fadeout").addClass("fadein");
            }else{
              $(this).removeClass("fadein").addClass("fadeout"); 
            }
          });
        });
      });

      //ルーレット
      var roulette;
      var arr = ["images/koron.png","images/menhera.png","images/neko.png","images/rachel.png","images/riinu.png","images/ritu.png","images/yukinari.png","images/mia.png","images/natu.png","images/noa.png","images/rachel2.png","images/ruuto.png","images/satomi.png","images/sirou.png","images/zomu.png"];
      var image;

      function start() {         
        roulette = setInterval(function() {
        // 1〜7の範囲でランダムな数値を作成
        var image = Math.floor( Math.random() * 13 );
        // ルーレット
        document.getElementById("image").src = arr[image];
        }, 50);
        document.getElementById("start").value = "ストップ";
        document.getElementById("start").onclick = new Function("stop();");
      }

      function stop() {
        if(roulette) {
          clearInterval(roulette);
          document.getElementById("start").value = "スタート";
          document.getElementById("start").onclick = new Function("start();");
        }
      }
    </script>
  </body>
</html>