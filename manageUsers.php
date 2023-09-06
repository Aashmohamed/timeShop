<?php

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title>eShop | Admin | Manage Users</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center">
                <h2 class="text-primary fw-bold">Manage All Users</h2>
            </div>

            <div class="col-12 mt-3">
                <div class="row">
                    <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" class="form-control" />
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn btn-warning">Search User</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3 mb-3">
                <div class="row">
                    <div class="col-2 col-lg-1 bg-primary margi py-3 text-end">
                        <span class="fs-6 fw-bold ">#</span>
                    </div>
                    <div class="col-2 bg-primary  py-3 d-none d-lg-block">
                        <span class="fs-6 fw-bold text-dark">Profile Image</span>
                    </div>
                    <div class="col-3 col-lg-2 bg-primary py-3">
                        <span class="fs-6 fw-bold ">User Name</span>
                    </div>
                    <div class="col-3 col-lg-2 bg-primary py-3 d-lg-block">
                        <span class="fs-6 fw-bold text-dark">Email</span>
                    </div>
                    <div class="col-2  bg-primary py-3 d-none d-lg-block">
                        <span class="fs-6 fw-bold t">Mobile</span>
                    </div>
                    <div class="col-2 bg-primary  py-3 d-none d-lg-block">
                        <span class="fs-6 fw-bold text-dark">Registered Date</span>
                    </div>
                    <div class="col-6 col-lg-1 "></div>
                </div>
            </div>

            <?php

            $page_no;

            if (isset($_GET["page"])) {
                $page_no = $_GET["page"];
            } else {
                $page_no = 1;
            }

            $user_rs = Database::search("SELECT * FROM `user`");
            $user_num = $user_rs->num_rows;

            $results_per_page = 10;
            $number_of_pages = ceil($user_num / $results_per_page);

            $page_first_result = ((int)$page_no - 1) * $results_per_page;
            $view_user_rs = Database::search("SELECT * FROM `user` LIMIT " . $results_per_page . " OFFSET " . $page_first_result . " ");

            $view_results_num = $view_user_rs->num_rows;

            $c = 0;

            ?>


            <?php

            while ($user_data = $view_user_rs->fetch_assoc()) {
                $c = $c + 1;

            ?>

                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-2 col-lg-1 bg-white py-2 text-end">
                            <span class="fs-6 fw-bold text-danger bg-white"><?php echo $c; ?></span>
                        </div>
                        <?php

                        $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $user_data["email"] . "'");
                        $image_data = $image_rs->fetch_assoc();

                        ?>
                        <div class="col-2 bg-light py-2 d-none d-lg-block" onclick="viewMsgModal();">
                            <img src="<?php echo $image_data["code"]; ?>" style="height: 160px; margin-left: 200px;" />
                        </div>
                        <div class="col-3 col-lg-2 bg-white py-2">
                            <span class="fs-6 fw-bold "><?php echo $user_data["username"]; ?></span>
                        </div>
                        <div class="col-3 col-lg-2 bg-light py-2 d-lg-block">
                            <span class="fs-6 fw-bold text-dark"><?php echo $user_data["email"]; ?></span>
                        </div>
                        <div class="col-2 bg-white py-2 d-none d-lg-block">
                            <span class="fs-6 fw-bold"><?php echo $user_data["mobile"]; ?></span>
                        </div>
                        <div class="col-2 bg-light py-2 d-none d-lg-block">
                            <span class="fs-6 fw-bold text-dark">
                                <?php $row = $user_data["register_date"];
                                $splited = explode(" ", $row);
                                echo $splited[0]; ?></span>
                        </div>
                        <div class="col-4 col-lg-1 bg-white py-2 d-grid">
                            <?php

                            $s = $user_data["status_id"];
                            if ($s == "1") {
                            ?>
                                <button class="btn btn-danger" onclick="userBlock('<?php echo $user_data['email']; ?>');">Block</button>
                            <?php
                            } else {
                            ?>
                                <button class="btn btn-success" onclick="userBlock('<?php echo $user_data['email']; ?>');">Unblock</button>
                            <?php
                            }

                            ?>
                        </div>
                    </div>
                </div>



                <!-- modal -->
                <div class="modal" tabindex="-1" id="viewMsgModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">My Messages</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <!-- receved -->
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-8 rounded bg-success">
                                            <div class="row">
                                                <div class="col-12 pt-2">
                                                    <span class="text-white fs-4">Hello there!!!</span>
                                                </div>
                                                <div class="col-12 text-end pb-2">
                                                    <span class="text-white fs-6">2022-06-11 | 08:00:00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- receved -->

                                <!-- sent -->
                                <div class="col-12 mt-3">
                                    <div class="row">
                                        <div class="offset-4 col-8 rounded bg-primary">
                                            <div class="row">
                                                <div class="col-12 pt-2">
                                                    <span class="text-white fs-4">How are you!!!</span>
                                                </div>
                                                <div class="col-12 text-end pb-2">
                                                    <span class="text-white fs-6">2022-06-11 | 08:05:00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- sent -->

                            </div>
                            <div class="modal-footer">

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-8">
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-4 d-grid">
                                            <button class="btn btn-primary">Send</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->

            <?php

            }
            ?>

            <div class="col-12 text-center mt-3">
                <div class="pagination">
                    <a href="<?php if ($page_no <= 1) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($page_no - 1);
                                } ?>">&laquo;</a>

                    <?php

                    for ($page = 1; $page <= $number_of_pages; $page++) {
                        if ($page == $page_no) {
                    ?>
                            <a href="<?php echo "?page=" . ($page); ?>" class="active"><?php echo $page; ?></a>
                        <?php
                        } else {
                        ?>
                            <a href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                    <?php
                        }
                    }

                    ?>
                    <a href="<?php if ($page_no >= $number_of_pages) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($page_no + 1);
                                } ?>">&raquo;</a>
                </div>
            </div>


        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>