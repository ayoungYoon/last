<?php 

$host = "localhost";  
$user = "root";         
$password = "1220";           
$dbname = "new";

$conn = new mysqli($host, $user, $password, $dbname);


$post_id = isset($_GET['idx']) ? $_GET['idx'] : ''; 


$reply_name = isset($_POST['name']) ? $_POST['name'] : ''; 
$content = isset($_POST['content']) ? $_POST['content'] : ''; 


if (!empty($reply_name) && !empty($content)) {
    $sql = "INSERT INTO reply2 (post_id, name, content) VALUES ('$post_id', '$reply_name', '$content')";
    if (mysqli_query($conn, $sql)) {
        header("Location: view2.php?idx=$post_id");
        exit;
    } else {
        echo "댓글 저장 중 오류가 발생했습니다: " . mysqli_error($conn);
    }
} else {
    echo "모든 필드를 입력해주세요.";
}
?>