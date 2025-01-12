<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>검색 결과</title>

    <style>
        @font-face {
            font-family: 'Ownglyph_ParkDaHyun';
            src: url('https://fastly.jsdelivr.net/gh/projectnoonnu/2411-3@1.0/Ownglyph_ParkDaHyun.woff2') format('woff2');
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'Ownglyph_ParkDaHyun', sans-serif;
            margin: 20px;
            font-size: 20px;
            background-color: #e4ffe6;
        }

        
        table th{
            background-color: #f2f2f2;
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table td{
            background-color: white;

        }
    </style>
</head>

<body>

<?php
$host = "localhost";
$user = "root";
$password = "1220";
$dbname = "new";

$conn = new mysqli($host, $user, $password, $dbname);


if ($conn->connect_error) {
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}


$category = isset($_GET['category']) ? $_GET['category'] : "all";
$search_con = isset($_GET['search']) ? $_GET['search'] : "";

echo "<h1>" . $category . "에서 '" . $search_con . "' 검색결과</h1>";
echo '<h4 style="margin-top:30px;"><a href="board.php">게시판 돌아가기</a></h4>';

if ($category == "all") {
    $sql2 = "SELECT * FROM board WHERE title LIKE '%$search_con%' OR content LIKE '%$search_con%' ORDER BY idx DESC";
} elseif($category == "board2") {
    $sql2 = "SELECT * FROM board2 WHERE title LIKE '%$search_con%' OR content LIKE '%$search_con%' ORDER BY idx DESC";
} else {
    $sql2 = "SELECT * FROM board WHERE $category LIKE '%$search_con%' ORDER BY idx DESC";
}

$result = $conn->query($sql2);


if ($result->num_rows > 0) {
    echo '<table border="1" style="width:100%; border-collapse:collapse;">
            <thead>
              <tr>
                  <th width="70">번호</th>
                  <th width="500">제목</th>
                  <th width="120">글쓴이</th>
                  <th width="100">작성일</th>
                  <th width="100">조회수</th>
                  <th width="100">추천수</th>
              </tr>
            </thead>
            <tbody>';

    while ($board = $result->fetch_assoc()) {
        $title = $board["title"];
        if (mb_strlen($title, "utf-8") > 30) {
            $title = mb_substr($title, 0, 30, "utf-8") . "...";
        }

        echo "<tr>
                <td>" . $board['idx'] . "</td>
                <td>" . $title . "</td>
                <td>" . $board['userid'] . "</td>
                <td>" . $board['date'] . "</td>
                <td>" . $board['hit'] . "</td>
                <td>" . $board['recommend']. "</td>
              </tr>";
    }

    echo '</tbody></table>';
} else {
    echo "<p>검색 결과가 없습니다.</p>";
}

// 연결 종료
$conn->close();
?>

</body>
</html>

      