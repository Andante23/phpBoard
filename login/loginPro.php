<?php
session_start();
# db 정보를 가져옴
  include "/var/www/html/DB/Database.php";
      $pdo = getPdo();  # db 객체를 가져옴니다.

# 입력받은 아이디 / 비밀번호를 가져옴니다
$useridea = $_POST['useridea'];
$pw = $_POST['pw'];

if($pdo){
try{
  # register 테이블 -> 로그인에 해당하는 id 정보 가져오고 -> 비교를 해서 맞으면 -> 로그인.....
$stmt = $pdo -> prepare('SELECT * FROM register WHERE useridea =:useridea');
$stmt->bindvalue(':useridea',$useridea,PDO::PARAM_STR);
$stmt -> execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

 if ($user) {
            // 비밀번호 검증
            if (password_verify($pw, $user['password_hash'])) {
                // 세션 저장
                $_SESSION['id'] = $user['id'];
                $_SESSION['nickname'] = $user['nickname'];

                echo "<script>alert('로그인 성공!'); window.location.replace('../index.php');</script>";
            } else {
                echo "<script>alert('비밀번호가 일치하지 않습니다.'); history.back();</script>";
            }
        } else {
            echo "<script>alert('아이디가 존재하지 않습니다.'); history.back();</script>";
        }
    } catch (PDOException $e) {
        echo "DB 오류: " . $e->getMessage();
    }
} else {
    echo "DB 연결 실패";
}
?>