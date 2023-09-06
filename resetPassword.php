<?php

require "connection.php";

$e = $_POST["e"];
$np = $_POST["np"];
$rnp = $_POST["rnp"];
$vc = $_POST["vc"];

if(empty ($e)){
    echo "Missing Email Address.";
}else if (empty($np)){
    echo "Please entr you new password.";
}else if(strlen($np) < 5 || strlen($np) >= 25){
    echo "Password Length should be between 5 to 25.";
}else if(empty($rnp)){
    echo "Please re-enter your new password.";
}else if($np !=($rnp)){
    echo "Please & Re-type password does not match.";
}else if(empty($vc)){
    echo "Please enter your verification code.";
}else{

  $rs  = Database::search("SELECT * FROM `user` WHERE `email`='".$e."' AND `verificaticode`='".$vc."'");

  if($rs->num_rows == 1){

   Database::iud("UPDATE `user` SET `password`='".$np."' WHERE `email`='".$e."'");
   echo "success";

  }else{
      echo "Password reset failed";
  }

}


?>