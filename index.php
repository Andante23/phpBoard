<?php
    session_start();
    # DB 연결 파일  include 
    include "/var/www/html/DB/Database.php"; 
   ?>


   

  <html>
   <head>

   </head>
    <body>
     <?php if (!isset($_SESSION["id"])): ?>

      <?php include "/join/join.php" ?>
    <p><a href="/login/login.php">로그인페이지</a></p>
    
  <?php else: ?>
       
     <?php 
        session_start();
        echo $_SESSION["nickname"] . "님"; ?>

        <a href="login/logout.php">로그아웃</a>
     
     <?php endif; ?>

    </body>
  </html>