<?php
session_start();

$host ="localhost";
$user = "root";
$password ="1220";
$dbname ="new";


$conn = new mysqli($host, $user, $password, $dbname);


$username=$_POST['userid'];
$title=$_POST['title'];
$content=$_POST['content'];
$date=date('Y-m-d');

if($username && $title && $content){
    $sql = ("insert into board(userid,title,content,date) values('".$username."', '".$title."', '".$content."','".$date."')");
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('글쓰기 완료되었습니다.');
                location.href='board.php';
              </script>";
    } else {
        echo "<script>
                alert('글쓰기에 실패했습니다: " . $conn->error . "');
                history.back();
              </script>";
    }
}
$conn->close();

?>