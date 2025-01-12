<?php

// 데이터베이스 연결 설정
$host = "localhost";
$user = "root";
$password = "1220";
$dbname = "new";

$conn = new mysqli($host, $user, $password, $dbname);

// 연결 오류 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// GET 요청으로 받은 게시글 ID
$id = isset($_GET['idx']) ? $_GET['idx'] : '';

// SQL: 추천 수 증가
$recommend_sql = "UPDATE board SET recommend = recommend + 1 WHERE idx = $id";


// 연결 종료
$conn->close();

?>
<script type="text/javascript">alert("추천되었습니다.");
    history.back();
</script>
