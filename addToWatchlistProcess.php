<?php

session_start();

require "connection.php";

if(isset($_SESSION["u"])){

    $id = $_GET["id"];
    $mail = $_SESSION["u"]["email"];

    $watchlistrs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='".$id."'
    AND `user_email`='".$mail."'");

    if($watchlistrs->num_rows == 1){
        
        Database::iud("DELETE FROM `watchlist` WHERE `product_id`='".$id."' AND `user_email`='".$mail."'");
        echo "success2";

    }else{
        Database::iud("INSERT INTO `watchlist` (`product_id`,`user_email`) VALUES('".$id."','".$mail."')");
        echo "Success";
    }

}else{
    echo "You have to Sign In first.";
}




?>