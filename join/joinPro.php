<?php
  # db 정보를 가져옴
  include "/var/www/html/DB/Database.php";
      $pdo = getPdo();  # db 객체를 가져옴니다.

  # 아이디 / 비밀번호 / 나이 / 닉네임을 가져옴니다. 
    $useridea = $_POST["useridea"];
    $pw = $_POST["pw"];
    $age = $_POST["age"];
    $nickname = $_POST["nickname"];

    #비밀번호 해시값으로 반환합니다.
    $password_hash = password_hash($pw , PASSWORD_DEFAULT);

    # pdo가 존재하면....
   if($pdo){
      try{
        $sql = "INSERT INTO register(useridea, password_hash,nickname,age) VALUES(:useridea,:password_hash ,:nickname,:age)";
        $stmt = $pdo -> prepare($sql);

        $stmt->bindvalue(':useridea',$useridea,PDO::PARAM_STR);
        $stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
        $stmt->bindValue(':nickname', $nickname, PDO::PARAM_STR);
        $stmt->bindValue(':age',$age,PDO::PARAM_INT);        
         if($stmt -> execute()) {    # 회원가입이 성공 또는 실패 
             echo "<script>"."window.alert('회원가입 성공!')"."</script>";
           echo "<script>window.location.replace('../login/login.php');</script>";  # 회원가입 성공시에 로그인 페이지로 이동 
         }else{
            echo "회원가입 실패";  
         }
         }catch(PDOException $e){
           echo "DB 오류: " . $e->getMessage();  # pdo 관련 예외처리
         }
       }else{ # pdo가 연결되지 않으면 
          echo "db 연결 안됨";
       }
?>