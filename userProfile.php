<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

?>

    <!DOCTYPE html>

    <html>

    <head>
        <title>timeShop | User Profile</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo.svg">

        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="style.css">
    </head>

    <body >

            <div class="col-12 mb-3">
                <div class="row">
                <div class="col-md-4 border-start border-end homebackground">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5 ">

                        <?php

                        $profileImg = Database::search("SELECT * FROM `profile_img` WHERE
                        `user_email` = '" . $_SESSION["u"]["email"] . "'");
                        $pn = $profileImg->num_rows;

                        if ($pn == 1) {
                            $p = $profileImg->fetch_assoc();

                        ?>

                            <img class="rounded mt-5" width="300px" src="<?php echo $p["code"]; ?>" id="prev0" />

                        <?php

                        } else {

                        ?>

                            <img class="rounded mt-5" width="150px" src="resources/profiles/clock5.jpg" id="prev0" />

                        <?php

                        }

                        ?>
                        <span class="fw-bold"><?php echo $_SESSION["u"]["username"]; ?></span>
                        <span class="text-black-50"><?php echo $_SESSION["u"]["email"]; ?></span>
                        <input type="file" class="d-none" id="profileimg" accept="img/*">
                        <label class="btn btn-success mt-4" for="profileimg" onclick="changeImage();">Update Profile Image</label>
                    </div>
                </div>

                    <div class="col-md-7 center">
                        <div class="p-3 py-5">

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4>Profile Settings</h4>
                            </div>

                            <div class="row mt-2">

                                <div class="col-md-6">
                                    <label class="form-label">User Name</label>
                                    <input class="form-control" id="username" placeholder="user Name" type="text" value="<?php echo $_SESSION["u"]["username"]; ?>" />
                                </div>

                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Mobile No.</label>
                                    <input class="form-control" id="mobile" placeholder="Enter Your Mobile Number" type="text" value="<?php echo $_SESSION["u"]["mobile"]; ?>" />
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Password</label>

                                    <div class="input-group mb-3">
                                        <input readonly type="password" class="form-control" placeholder="Enter Your Password" id="show_text" aria-label="Enter Your Password" aria-describedby="button-addon2" value="<?php echo $_SESSION["u"]["password"]; ?>">
                                        <button class="btn btn-outline-dark" type="button" id="button-addon2" onclick="pswd_addon();"><i class="bi bi-eye-fill" id="img_show"></i><i class="bi bi-eye-slash-fill d-none" id="img_hide"></i></button>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input readonly class="form-control" placeholder="Enter Your Email Address" type="email" value="<?php echo $_SESSION["u"]["email"]; ?>" />
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Registered Date</label>
                                    <input readonly class="form-control" placeholder="Enter Your Registered Date" type="text" value="<?php echo $_SESSION["u"]["register_date"]; ?>" />
                                </div>
                                <?php

                                $usermail = $_SESSION["u"]["email"];
                                $address = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $usermail . "' ");
                                $n = $address->num_rows;

                                if ($n > 0) {
                                    $d = $address->fetch_assoc();

                                    $city = Database::search("SELECT * FROM `city` WHERE `id` = '" . $d["city_id"] . "' ");
                                    // $cn = $city->num_rows;
                                    $cf = $city->fetch_assoc();

                                    $district = Database::search("SELECT * FROM `district` WHERE `id` = '" . $cf["district_id"] . "' ");
                                    // $cn = $city->num_rows;
                                    $df = $district->fetch_assoc();

                                    $province = Database::search("SELECT * FROM `province` WHERE `id` = '" . $df["province_id"] . "' ");
                                    $pf = $province->fetch_assoc();

                                ?>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Address</label>
                                        <input class="form-control" id="addline1" placeholder="Address Line 01" type="text" value="<?php echo $d["line1"]; ?>" />
                                        <input class="form-control mt-2" id="addline2" placeholder="Address Line 02" type="text" value="<?php echo $d["line2"]; ?>" />

                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Province</label>
                                        <select class="form-select">
                                            <option value="<?php echo $pf["id"]; ?>"><?php echo $pf["name"]; ?></option>
                                            <?php

                                            $pall = Database::search("SELECT * FROM `province` WHERE `name` != '" . $pf["name"] . "' ");
                                            $num1 = $pall->num_rows;

                                            for ($x = 1; $x <= $num1; $x++) {

                                                $row1 = $pall->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $row1["id"]; ?>"><?php echo $row1["name"]; ?></option>

                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">District</label>
                                        <select class="form-select">
                                            <option value="<?php echo $df["id"]; ?>"><?php echo $df["name"]; ?></option>
                                            <?php

                                            $pall1 = Database::search("SELECT * FROM `district` WHERE `name` != '" . $df["name"] . "' ");
                                            $num2 = $pall1->num_rows;

                                            for ($x = 1; $x <= $num2; $x++) {

                                                $row2 = $pall1->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $row2["id"]; ?>"><?php echo $row2["name"]; ?></option>

                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">City</label>
                                        <select class="form-select" id="usercity">
                                            <option value="<?php echo $cf["id"]; ?>"><?php echo $cf["name"]; ?></option>
                                            <?php

                                            $pall2 = Database::search("SELECT * FROM `city` WHERE `name` != '" . $cf["name"] . "' ");
                                            $num3 = $pall2->num_rows;

                                            for ($x = 1; $x <= $num3; $x++) {

                                                $row3 = $pall2->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $row3["id"]; ?>"><?php echo $row3["name"]; ?></option>

                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Postal Code</label>
                                        <input class="form-control" placeholder="Postal Code" type="text" />
                                    </div>

                                <?php
                                } else {

                                ?>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Address</label>
                                        <input class="form-control" id="addline1" placeholder="Address Line 01" type="text" />
                                        <input class="form-control mt-2" id="addline2" placeholder="Address Line 02" type="text" />

                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Province</label>
                                        <select class="form-select">
                                            <option>Select Your Province</option>
                                            <?php

                                            $pall = Database::search("SELECT * FROM `province`");
                                            $num1 = $pall->num_rows;

                                            for ($x = 1; $x <= $num1; $x++) {

                                                $row1 = $pall->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $row1["id"]; ?>"><?php echo $row1["name"]; ?></option>

                                            <?php
                                            }

                                            ?>

                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">District</label>
                                        <select class="form-select">
                                            <option>Select Your District</option>
                                            <?php

                                            $pall1 = Database::search("SELECT * FROM `district`");
                                            $num2 = $pall1->num_rows;

                                            for ($x = 1; $x <= $num2; $x++) {

                                                $row2 = $pall1->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $row2["id"]; ?>"><?php echo $row2["name"]; ?></option>

                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">City</label>
                                        <select class="form-select" id="usercity">
                                            <option>Select Your City</option>
                                            <?php

                                            $pall2 = Database::search("SELECT * FROM `city`");
                                            $num3 = $pall2->num_rows;

                                            for ($x = 1; $x <= $num3; $x++) {

                                                $row3 = $pall2->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $row3["id"]; ?>"><?php echo $row3["name"]; ?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Postal Code</label>
                                        <input class="form-control" placeholder="Postal Code" type="text" />
                                    </div>

                                <?php

                                }

                                ?>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Gender</label>
                                    <?php

                                    $gid = $_SESSION["u"]["gender"];
                                    $g = Database::search("SELECT * FROM `gender` WHERE `id` = '" . $gid . "' ");
                                    $gf = $g->fetch_assoc();

                                    ?>
                                    <input class="form-control" placeholder="Gender" type="text" readonly value="<?php echo $gf["name"]; ?>" />
                                </div>

                                <div class="mt-3 text-center">
                                    <button class="btn btn-primary" onclick="updateProfile();">Update Profile</button>
                                </div>

                            </div>

                        </div>
                    </div>

                    <?php

                    require "footer.php";

                    ?>

                </div>
            </div>


        <script src="script.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    </body>

    </html>

<?php

} else {

?>

    <script>
        window.location = "index.php";
    </script>

<?php

}

?>