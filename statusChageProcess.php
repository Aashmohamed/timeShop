<?php

require "connection.php";

$productId = $_GET["p"];
$status = $_GET["s"];

$statusrs = Database::search("SELECT * FROM `product` WHERE `id`='".$productId."'");
$sn = $statusrs->num_rows;

if($sn == 1){

    $sd = $statusrs->fetch_assoc();

    $statusId = $sd["status_id"];

    if($statusId == 1){
        Database::iud("UPDATE `product` SET `status_id`=2 WHERE `id`='".$productId."' ");

        echo "Deactivated";
    }else if($statusId == 2){

        Database::iud("UPDATE `product` SET `status_id`=1 WHERE `id`='".$productId."' ");

        echo "Activated";
    }
}else{
    echo "Something went wrong.";
}

?>