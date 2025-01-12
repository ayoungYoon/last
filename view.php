<!doctype html>
<head>
    <style>

    @font-face {
            font-family: 'Ownglyph_ParkDaHyun';
            src: url('https://fastly.jsdelivr.net/gh/projectnoonnu/2411-3@1.0/Ownglyph_ParkDaHyun.woff2') format('woff2');
            font-weight: normal;
            font-style: normal;
        }

        body{
            font-family: 'Ownglyph_ParkDaHyun', sans-serif;
            background-color: #e4ffe6;
            font-size: 20px;
        }

        .reply {
            margin-top: 30px;
        }

        .reply h3 {
            font-size: 30px;
            color: #4CAF50;
            margin-bottom: 15px;
        }

        form {
            margin-top: 60px;
        }

        form textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            height: 80px;
            resize: none
        }

        

        form button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #45a049;
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



$id = $_GET['idx'];
//조회수
$hit_sql = "UPDATE board SET hit = hit + 1 WHERE idx = $id";
$result = $conn -> query($hit_sql); 

// 해당 글 데이터 가져오기
$sql = " SELECT title, content,userid,date, hit FROM board WHERE idx = $id";
$result  = $conn ->query($sql);

if ($result && $result->num_rows > 0) {
    $board = $result->fetch_assoc();
    echo "<h1>" . $board['title'] . "</h1>";
    echo "<p>작성자: " . $board['userid'] . " | 작성일: " . $board['date'] . "| 조회수: " . $board['hit'] . "</p>";
    echo "<div>" . $board['content'] . "</div>";
} else {
    echo "글을 찾을 수 없습니다.";
}

$conn->close();
?>

<div style="margin-top: 20px;">
    <a href="board.php">
        <button style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
            게시판 돌아가기
        </button>
    </a>
    <a href="recommend.php">
        <button style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
            추천하기
        </button>
    </a>
</div>

<div class="reply">
<!----댓글 ---->
<?php 
$host = "localhost";  
$user = "root";         
$password = "1220";           
$dbname = "new";     

                // MySQLi 연결 생성
$conn = new mysqli($host, $user, $password, $dbname);


$id= $_GET['idx'];
$sql = "SELECT name, content, date FROM reply WHERE post_id = '$id' ORDER BY date ASC";
$result = mysqli_query($conn, $sql);


echo "<h3>댓글 목록</h3>";

if (mysqli_num_rows($result) > 0) {
    while ($reply = mysqli_fetch_assoc($result)) {
        echo "<div class='reply_2'>";
        echo "<b>" . $reply['name'] . "</b>";
        echo "<p>" . nl2br($reply['content']) . "</p>";
        echo "<small>" . $reply['date'] . "</small>";
        echo "</div>";
    }
} else {
    echo "댓글이 없습니다.";
}

?>
</div>

<form method="POST" action="reply_ok.php?idx=<?php echo $id; ?>">
<h3>댓글 작성</h3>
    <input type="text" name="name" placeholder="이름을 입력하세요">
    <textarea name="content" placeholder="댓글을 입력하세요"></textarea>
    <button type="submit">댓글 작성</button>
</form>






</body>
</html>




            


