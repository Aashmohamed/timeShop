<?php

require "connection.php";

$username = $_POST["username"];
$email =  $_POST["email"];
$password = $_POST["password"];
$mobile = $_POST["mobile"];
$gender = $_POST["gender"];

if(empty($username)){
    echo "Pleace Enter Your User Name";
}else if(strlen($username) > 50){
    echo "user Name must be less than 50 characters.";
}else if(empty($email)){
    echo "Pleace Enater Your Email Address";
}else if(strlen($email) >=100){
    echo "Email must be less than 100 characters.";
}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "Invalide Email Address";
}else if(empty($password)){
    echo "Pleace Enater Your Password";
}else if(strlen($password) < 5 || strlen($password) > 25){
    echo "Password Length Should be between 5 to 25.";
}else if(empty ($mobile)){
    echo "Pleace Enter Your Mobile";
}else if(!preg_match("/[0|94|+94][7][0|1|2|4|5|6|7|8][0-9]{7}$/",$mobile)){
     echo "Invalid Mobile Number";
}else {
    $r = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' OR `mobile`='".$mobile."' ");
    $n = $r->num_rows;

    if ($n > 0) {
        echo "UserWith the Email adders or Phone Number alert exists.";   
    } else {
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `user` (`email`, `username`, `password`, `mobile`, `gender`, `register_date`) VALUES ( '".$email."', '".$username."', '".$password."', '".$mobile."', '".$gender."', '".$date."' ) ");
        

        echo "success";

    }

}

?>