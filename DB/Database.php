<?php
   # 여러 데이터베이스 지원 / 편리한 예외 처리에 특별화 

   function getPdo(){
      $dbHost = "localhost";
      $dbName = "board";
      $dbUser = "root";
      $pw = "1234";


     try{
       $pdo = new PDO("mysql:host={$dbHost};dbname={$dbName}",$dbUser, $pw);   # pdo 객체 생성
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       return $pdo;  # pdo 반환 
    
       } catch (PDOException $e) {
          echo "DB 연결 실패: " . $e->getMessage();  #pdo가 안될때 나오는  에러
       }
       }


?>









