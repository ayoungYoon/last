<!DOCTYPE html>
<html>
<head>
    <title>게시판</title>
    <style>
        @font-face {
            font-family: 'Ownglyph_ParkDaHyun';
            src: url('https://fastly.jsdelivr.net/gh/projectnoonnu/2411-3@1.0/Ownglyph_ParkDaHyun.woff2') format('woff2');
            font-weight: normal;
            font-style: normal;
        }
        body{
            background-color: #e4ffe6;
        }

        
        .board, .board2{
            font-family: 'Ownglyph_ParkDaHyun', sans-serif;
            font-size: 20px;
            background-color: #e4ffe6;
        }
        .board table, .board2 table {
            width: 100%;
            border-collapse: collapse;
        }
        .board th, .board2 th{
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            background-color: #f4f4f4;
        }
        .board td, .board2 td{
            border: 1px solid #ddd;
            background-color: white;

        }
        .boardwrite {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="board">
        <h1>자유게시판</h1>
        <!---검색--->
        <div class="search">
    <form action="search.php" method="get">
        <select name="category">
            <option value="all">전체</option>
            <option value="title">제목</option>
            <option value="content">내용</option>
            <option value="board2">게시판</option>
        </select>
        <input type="text" name="search" size="40" required="required" />
        <button>검색</button>
    </form>
</div>
        
        <table class="board list">
            <thead>
                <tr>
                    <th width="70">번호</th>
                    <th width="500">제목</th>
                    <th width="120">글쓴이</th>
                    <th width="100">작성일</th>
                    <th width="100">조회수</th>
                    <th width="100"> 추천수</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $host = "localhost";  
                $user = "root";         
                $password = "1220";           
                $dbname = "new";     

                
                $conn = new mysqli($host, $user, $password, $dbname);

                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                
                $sql = "SELECT * FROM board ORDER BY idx DESC LIMIT 0, 5";
                $result = $conn->query($sql);

                
                if ($result && $result->num_rows > 0) {
                    while ($board = $result->fetch_array()) { // 연관 배열로 가져오기
                        $title = $board["title"];
                        if (strlen($title) > 30) {
                            $title = mb_substr($title, 0, 30, "utf-8") . "..."; // 제목 길이 제한
                        }
                ?>
                <tr>
                    <td width="70"><?php echo $board['idx']; ?></td>
                    <td width="500"><a href="view.php?idx=<?php echo $board["idx"];?>"><?php echo $title;?></a></td>
                    <td width="120"><?php echo $board['userid']; ?></td>
                    <td width="100"><?php echo $board['date']; ?></td>
                    <td width="100"><?php echo $board['hit']; ?></td>
                    <td width="100"><?php echo $board['recommend'];?></a></td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>게시물이 없습니다.</td></tr>";
                }

                
                $conn->close();
                ?>
            </tbody>
        </table>
        <div class="boardwrite">
            <a href="write.html"><button>글쓰기</button></a>
        </div>
    </div>

    <div class="board2">
        <h1>자기소개게시판</h1>

    <table class="board list">
            <thead>
                <tr>
                    <th width="70">번호</th>
                    <th width="500">제목</th>
                    <th width="120">글쓴이</th>
                    <th width="100">작성일</th>
                    <th width="100">조회수</th>
                    <th width="100"> 추천수</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $host = "localhost";  
                $user = "root";         
                $password = "1220";           
                $dbname = "new";     

                
                $conn = new mysqli($host, $user, $password, $dbname);

                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                
                $sql = "SELECT * FROM board2 ORDER BY idx DESC LIMIT 0, 5";
                $result = $conn->query($sql);

                
                if ($result && $result->num_rows > 0) {
                    while ($board = $result->fetch_array()) { // 연관 배열로 가져오기
                        $title = $board["title"];
                        if (strlen($title) > 30) {
                            $title = mb_substr($title, 0, 30, "utf-8") . "..."; // 제목 길이 제한
                        }
                ?>
                <tr>
                    <td width="70"><?php echo $board['idx']; ?></td>
                    <td width="500"><a href="view2.php?idx=<?php echo $board["idx"];?>"><?php echo $title;?></a></td>
                    <td width="120"><?php echo $board['userid']; ?></td>
                    <td width="100"><?php echo $board['date']; ?></td>
                    <td width="100"><?php echo $board['hit']; ?></td>
                    <td width="100"><?php echo $board['recommend'];?></a></td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>게시물이 없습니다.</td></tr>";
                }

                
                $conn->close();
                ?>
            </tbody>
        </table>
        <div class="boardwrite">
            <a href="write2.html"><button>글쓰기</button></a>
        </div>
</body>
</html>
https://blog.naver.com/bgpoilkj/220751401209
