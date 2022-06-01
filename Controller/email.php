<?php
require_once '..\..\itBook\vendor/autoload.php';
include_once "../../itBook/Connect/Globals.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

session_start();

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    function send_mail($email, $token)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = 'smtp.yandex.ru';
            $mail->SMTPAuth = true;
            $mail->Username = 'bendar01@tut.by';
            $mail->Password = '25874480';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->CharSet = 'UTF-8';
            $mail->setFrom('bendar01@tut.by'); /*Указываем адрес почты отправителя */
            $mail->SMTPSecure = 'ssl';
            $mail->addAddress($email);
            $mail->isHTML(true);

            if ($token != null) {
                $mail->Subject = ' Авторизация по email';
                $mail->Body = '
                <img src="https://www.adazing.com/wp-content/uploads/2019/02/open-book-clipart-07-300x300.png" style="width: 100px; height: 100px"><br>
                <a href="http://localhost/itBook/Web/index.php">Авторизация</a> ';
            } else {
                $mail->Subject = 'Регестрация по email';
                $mail->Body = '
                <img src="https://st.depositphotos.com/1552219/1341/i/600/depositphotos_13418740-stock-photo-lock-and-key.jpg" style="width: 100px; height: 100px"><br>
                <a href="http://localhost/itBook/Web/register.php">Регестрация</a>';
            }

            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            exit();
        }
    }

    try {
        $connect = Globals::getPDOConnection('bookIt');
        echo "Connect<br>";
    } catch (Exception $e) {
        echo "<br> Исключение: " . __FILE__ . " " . __LINE__ . " " . $e->getMessage() . "<br>";
    }

    $query = "SELECT * FROM bookit.users WHERE email = :email";

    try {
        $res = $connect->prepare($query);
        $res->bindValue(":email", $email);
        $res->execute();
        $num = $res->rowCount();
        $res = $res->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<br> Исключение: " . __FILE__ . "" . __LINE__ . "" . $e->getMessage() . "<br>";
    }

    for ($i = 0; $i < $num; $i++) {
        $fio = $res[$i]['name'];
        $name_db = $res[$i]['name'];
        $login_db = $res[$i]['login'];
        $password_db = $res[$i]['password'];
        $email_db = $res[$i]['email'];
        $token_db = $res[$i]['token'];
    }

    if ($email == $email_db) {
        $_SESSION['login'] = $login_db;
        $_SESSION['fio'] = $fio;
        send_mail($email, $token_db);

    } else {
        $token_db = null;
        send_mail($email, $token_db);
    }

}






