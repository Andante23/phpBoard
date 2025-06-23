<?php
  session_start();
  $_SESSION = array();

// 세션 쿠키 삭제 (선택, 보안 강화)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 세션 파기
session_destroy();

// 로그인 페이지로 이동
echo "<script>alert('로그아웃 되었습니다.'); window.location.replace('/login/login.php');</script>";
?>