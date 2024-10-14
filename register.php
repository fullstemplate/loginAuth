<?php

require 'config/koneksi.php';
$qry = $koneksi->query("SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password'");
$cek = $qry->num_rows;

$fullname = $_POST["fullname"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$code = md5($email.date('Y-m-d H:i:s'));

// $query_sql = "INSERT INTO tbl_users (fullname, username, email, password, verifikasi_code, is_verif)
//             VALUES ('$fullname', '$username', '$email', '$password', '$verifikasi_code', '$is_verif')";




//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
    
//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'anakhidayatullah212@gmail.com';                     //SMTP username
    $mail->Password   = 'mlwxxhjshspocdmm';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@rahmat.com', 'Verifikasi');
    $mail->addAddress($email, $username);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verifikasi akun';
    $mail->Body    = 'Hi!'.$username.'<br> Saya Rahmat Terima kasih sudah mendaftar di website kami,<br> Mohoon verifikasi akun akmu!
    <a href="http://localhost/sementara/verif.php?code='.$code.'">Verifikasi</a>';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if($mail->send()){
        $koneksi->query("INSERT INTO tbl_users (fullname, username, email, password, verifikasi_code)
        VALUES('$fullname', '$username', '$email', '$password', '$code')");

        echo"<script>alert('Registrasi berhasil, Silahkan cek Email untuk ferifikasi akun');window.location='index.html'</script>";
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

