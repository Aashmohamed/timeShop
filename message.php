<?php

require "connection.php";

?>
<html>

<head>
    <title>eShop | Messages</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
</head>

<body onload="viewRecent();" style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">

    <div class="container-fluid">
        <div class="row">
            <?php
            require "header.php";
            $e = $_SESSION["u"]["email"]
            ?>

            <div class="col-12">
                <hr>
            </div>

            <div class="col-12 py-5 px-4">
                <div class="row rounded shadow overflow-hidden">
                    <div class="col-12 col-lg-5 px-0">

                        <div class="bg-white">
                            <div class="bg-light px-4 py-2">
                                <h5 class="mb-0 py-1">Recent</h5>
                            </div>

                            <div class="col-12">

                                <?php

                                $message_rs = Database::search("SELECT DISTINCT `from`,`content`,`date_time`,`status` FROM `message` WHERE `to`='" . $e . "' ORDER BY `date_time` ");
                                $message_num = $message_rs->num_rows;


                                ?>
                                <!--  -->
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Inbox</button>
                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Sent box</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                                        <!--  -->

                                        <div class="message_box" id="message_box">
                                            <?php

                                            for ($x = 0; $x < $message_num; $x++) {
                                                $message_data = $message_rs->fetch_assoc();

                                                if ($message_data["status"] == "0") {
                                                    //unreaded
                                            ?>
                                                    <div class="list-group rounded-0" onclick="viewMessages('<?php echo $message_data['from']; ?>');">
                                                        <a href="#" class="list-group-item list-group-item-action text-white rounded-0 bg-info">

                                                            <?php
                                                            $user_rs = Database::search("SELECT * FROM `user` INNER JOIN `profile_img` ON `user`.`email`=`profile_img`.`user_email` 
                                                        WHERE `email`='" . $message_data["from"] . "'");

                                                            $user_data = $user_rs->fetch_assoc();
                                                            ?>
                                                            <div>
                                                                <img src="<?php echo $user_data["code"]; ?>" width="60px" class="rounded-circle" />
                                                                <div class="me-4">
                                                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                                                        <h6 class="mb-0"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></h6>
                                                                        <small class="small fw-bold"><?php echo $message_data["date_time"]; ?></small>
                                                                    </div>
                                                                    <p class="mb-0"><?php echo $message_data["content"]; ?></p>
                                                                </div>
                                                            </div>

                                                        </a>
                                                    </div>

                                                <?php
                                                } else {
                                                    //readed
                                                ?>
                                                    <div class="list-group rounded-0">
                                                        <a href="#" class="list-group-item list-group-item-action text-white rounded-0 bg-primary">

                                                        <?php
                                                            $user_rs = Database::search("SELECT * FROM `user` INNER JOIN `profile_img` ON `user`.`email`=`profile_img`.`user_email` 
                                                        WHERE `email`='" . $message_data["from"] . "'");

                                                            $user_data = $user_rs->fetch_assoc();
                                                            ?>
                                                            <div>
                                                                <img src="<?php echo $user_data["code"]; ?>" width="60px" class="rounded-circle" />
                                                                <div class="me-4">
                                                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                                                        <h6 class="mb-0"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></h6>
                                                                        <small class="small fw-bold"><?php echo $message_data["date_time"]; ?></small>
                                                                    </div>
                                                                    <p class="mb-0"><?php echo $message_data["content"]; ?></p>
                                                                </div>
                                                            </div>

                                                        </a>
                                                    </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>

                                        <!--  -->
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                                        <!--  -->
                                        <div class="message_box" id="message_box">
                                            <div class="list-group rounded-0">
                                                <a href="#" class="list-group-item list-group-item-action rounded-0 bg-white">

                                                    <div>
                                                        <img src="resources/user.svg" width="60px" class="rounded-circle" />
                                                        <div class="me-4">
                                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                                <h6 class="mb-0">Nimal</h6>
                                                                <small class="small fw-bold">01:10</small>
                                                            </div>
                                                            <p class="mb-0">Got the product.</p>
                                                        </div>
                                                    </div>

                                                </a>
                                            </div>
                                        </div>
                                        <!--  -->
                                    </div>
                                </div>
                                <!--  -->

                            </div>


                        </div>
                    </div>
                    <div class="col-12 col-lg-7 px-0">
                        <div class="row px-4 py-5 text-white chat_box">

                            <div class="col-12" style="height: 405px;" id="chat_box">
                            </div>

                            <!-- text -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="input-group">
                                        <input type="text" placeholder="Type your message..." aria-describedby="sendbtn" 
                                        class="form-control rounded-0 border-0 py-3 bg-light" id="msgTxt"/>
                                        <button id="sendbtn" class="btn btn-link fs-2 bg-dark text-white" onclick="sendMsg();">
                                            <i class="bi bi-send-fill"></i></button>
                                    </div>
                                </div>
                            </div>
                            <!-- text -->
                        </div>
                    </div>
                </div>
            </div>
            <?php require "footer.php"; ?>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>