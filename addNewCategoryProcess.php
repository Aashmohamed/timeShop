<?php

require "connection.php";

require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["n"]) && isset($_POST["e"])){
    $new_category = $_POST["n"];
    $user_email = $_POST["e"];

    $category_rs = Database::search("SELECT * FROM `category` WHERE `name` LIKE '%".$new_category."%' ");
    $category_num = $category_rs->num_rows;

    if($category_num==0){

        $code = uniqid();

        Database::iud("UPDATE `admin` SET `verification_code`='".$code."' WHERE `email`='".$user_email."'");

        // email code
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'newofficial66@gmail.com';
        $mail->Password = 'kavjenvovznitxgm';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('newofficial66@gmail.com', 'eShop');
        $mail->addReplyTo('newofficial66@gmail.com', 'eShop');
        $mail->addAddress($user_email);
        $mail->isHTML(true);
        $mail->Subject = 'Add Category Verification';
        $bodyContent = '<h1 style = "color : red;"><b>Your Verification Code is : ' . $code . '</b></h1>';
        $mail->Body = $bodyContent;

        if (!$mail->send()) {
            echo "Verification code sending failed";
        } else {
            echo "success";
        }

    }else{
        echo "This category exists.";
    }

}
?>