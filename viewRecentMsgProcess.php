<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $user_email = $_SESSION["u"]["email"];

    $query = "SELECT * FROM `message`";

    $allMsgrs = Database::search($query);

    $allMsgNum = $allMsgrs->num_rows;

    for ($x = 0; $x < $allMsgNum; $x++) {

        $allMsgData = $allMsgrs->fetch_assoc();

        if ($allMsgData["to"] == $user_email) {

            $query1 = "WHERE `from`='".$allMsgData["from"]."'";

            echo $allMsgData["from"];
        } else {
            echo $allMsgData["to"];
        }
    }

} else {

    echo "Please Login first.";
}
