<?php

require "connection.php";

session_start();

if (isset($_SESSION["u"])) {


  $username = $_POST["username"];
  $mobile = $_POST["m"];
  $addline1 = $_POST["a1"];
  $addline2 = $_POST["a2"];
  $city = $_POST["c"];
  if (isset($_FILES["i"])) {
    $img = $_FILES["i"];
  }


  if (isset($img)) {

    $allowed_img_extention = array("image/jpg", "image/jpeg", "image/png", "image/svg");
    $filex = $img["type"];
    //  echo $filex;

    if (!in_array($filex, $allowed_img_extention)) {

      echo "Please Select a Valid Image";
    } else {


      $newimageextention;

      if ($filex == "image/jpg") {
        $newimageextention = ".jpg";
      } elseif ($filex == "image/jpeg") {
        $newimageextention = ".jpeg";
      } elseif ($filex == "image/png") {
        $newimageextention = ".png";
      } elseif ($filex == "image/svg") {
        $newimageextention = ".svg";
      }

      $file_name = "resources//profiles//" . uniqid() . $newimageextention;
      //echo $file_name;

      move_uploaded_file($img["tmp_name"], $file_name);
      $profilers =  Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
      $in = $profilers->num_rows;

      if ($in == 1) {

        Database::iud("UPDATE `profile_img` SET `code`='" . $file_name . "' WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");

        echo "Profile image updated Successfully";
      } else {


        Database::iud("INSERT INTO `profile_img` (`code`,`user_email`) VALUES ('" . $file_name . "','" . $_SESSION["u"]["email"] . "')");

        echo "New Profile image Saved Successfully";
      }
    }
  } else {
    echo "Please Select an Image";
  }

  Database::iud("UPDATE `user` SET `username`='" . $username . "' `mobile`='" . $mobile . "' WHERE `email`='" . $_SESSION["u"]["email"] . "'");

  echo "User Has Been Updated";

  $addresrs =  Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
  $nrs = $addresrs->num_rows;

  if ($nrs == 1) {

    Database::iud("UPDATE `user_has_address` SET `line1`='" . $addline1 . "',`line2`='" . $addline2 . "',`city_id`='" . $city . "' WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
  } else {

    Database::iud("INSERT INTO `user_has_address` (`user_email`,`line1`,`line2`,`city_id`) VALUE ('" . $_SESSION["u"]["email"] . "','" . $addline1 . "','" . $addline2 . "','" . $city . "')");
  }
} else {
  echo "error";
}
