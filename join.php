<?php
include "PHPMailer.php";
include "SMTP.php";
include "Exception.php";



session_start();

$host = "localhost";  
$user = "root";         
$password = "1220";           
$dbname = "new";     

$conn = new mysqli($host, $user, $password, $dbname);

// 데이터베이스 연결 오류 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newuserid = $_POST['userid'];
    $newuserpw = $_POST['pw'];
    $newuseremail=$_POST['email'];

    // 빈 값 체크
    if (!empty($newuserid) && !empty($newuserpw) && !empty($newuseremail)) {
        // 기존 사용자 확인
        $checkSql = "SELECT * FROM users WHERE userid = '$newuserid'";
        $result = $conn->query($checkSql);

        if ($result->num_rows > 0) {
            // 이미 존재하는 회원인 경우 메시지 출력
            echo "<script>
                alert(\"이미존재하는 회원입니다. 다른 아이디를 사용해주세요.\");
                history.back();
            </script>";
        } else {
            // 사용자 정보를 데이터베이스에 삽입
            $sql = "INSERT INTO users (userid, pw , email) VALUES ('$newuserid', '$newuserpw','$newuseremail')";

            if ($conn->query($sql) === TRUE) {
                // 회원가입 성공 메시지 출력
                echo "회원가입 성공! <a href='login.html' style='margin-left: 10px;'>
             <button style='cursor: pointer;'>로그인 하러 가기</button>
          </a>";
            } 
        }
    } else {
        echo "<script>
                alert(\"회원가입에 실패했습니다. 모든정보를 입력해주세요.\");
                history.back();
            </script>";
    }
}



$mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->Host = 'smtp.naver.com';


$mail->Port = 465;

$mail = new PHPMailer();

$mail->isSMTP();

$mail->SMTPDebug = SMTP::DEBUG_OFF;


$mail->Host = 'smtp.naver.com';


$mail->Port = 465;


$mail->SMTPSecure = "ssl";


$mail->SMTPAuth = true;


$mail->Username = 'ymy2777@naver.com';


$mail->Password = '3DFB3M8FJYG9';


$mail->CharSet = 'UTF-8'; //한글 안 깨지게!


$mail->setFrom('test@naver.com', 'test');


$mail->addReplyTo('test@naver.com', 'test');


$mail->addAddress($_SESSION["email"], $_SESSION["userid"]);


$mail->Subject = '메일 테스트 입니다.';


$mail->msgHTML("메일 내용 입니다.");


$mail->AltBody = 'This is a plain-text message body';


$mail->addAttachment('a.jpg');


if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo '메일이 정상적으로 전송되었습니다. 메일함을 확인해주세요!';
    
}


function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}

$conn->close();
?>