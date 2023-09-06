<?php

session_start();

require "connection.php";

$email = $_POST["email"];
$password = $_POST["password"];
$rememberme = $_POST["rememberMe"];

$resultest =Database::search("SELECT * FROM `admin` WHERE `email` = '".$email."' AND `password` = '".$password."'");
$n = $resultest->num_rows;

if($n == 1){

    echo"Success";
    $d = $resultest->fetch_assoc();
    $_SESSION["a"] = $d;

    if($rememberme == "true"){
            
        setcookie("email",$email,time()+(60*60*24*365));
        setcookie("password",$password,time()+(60*60*24*365));
    }else{

        setcookie("email","",-1);
        setcookie("password","",-1);

    }

}else{

    echo "Invalid Email or Password.";
}
?>
