
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['send'])){

    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'alexis.viloria23@gmail.com';
        $mail->Password = 'vjuiwbbitsgcjztx';
        $mail->Port = 465;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        
        $mail->setFrom('alexis.viloria23@gmail.com', 'School of Everlasting Pearl Inc.');
        
        // Checking whether email is single or multiple
        $to = $_POST['email'];
        if(strpos($to, ',') !== false){
            // multiple emails, split them and add to mailer
            $emails = explode(',', $to);
            foreach($emails as $email){
                $mail->addAddress(trim($email));
            }
        }else{
            // single email, add to mailer
            $mail->addAddress($to);
        }

        $mail->isHTML(true);
        $mail->Subject = $_POST['subject'];
        $mail->Body = $_POST['message'];
        $mail->AltBody = $_POST['message'];

        $mail->send();
        echo '<script>alert("Message has been sent");</script>';
        echo '<script>window.location.href="index.php";</script>';

    }catch (Exception $e){
        echo '<script>alert("Message could not be sent. Mailer Error:");</script>', $mail->ErrorInfo;
    }

} else {
    header("Location: index.php");
}