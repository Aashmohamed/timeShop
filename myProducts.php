<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
    $user = $_SESSION["u"];
    $pageno;
?>


    <!DOCTYPE html>
    <html>

    <head>
        <title>eShop | My Products</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    </head>

    <body style="background-color: #E9EBEE;">

        <div class="container-fluid">
            <div class="row">
                <!-- header -->

                <div class="col-12 bg-primary">
                    <div class="row">

                        <div class="col-4">
                            <div class="row">

                                <div class="col-12 col-lg-4 mt-1 mb-1 text-center">

                                    <?php

                                    $profileImage = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $user["email"] . "'");
                                    $pn = $profileImage->num_rows;

                                    if ($pn == 1) {
                                        $prl = $profileImage->fetch_assoc();
                                    ?>
                                        <img src="<?php echo $prl["code"]; ?>" class="rounded-circle" width="90px" height="90px" />
                                    <?php
                                    } else {
                                    ?>
                                        <img src="resources/user_profile.jpg" class="rounded-circle" width="90px" height="90px" />
                                    <?php
                                    }

                                    ?>

                                </div>
                                <div class="col-12 col-lg-8">
                                    <div class="row">
                                        <div class="col-12 mt-0 mt-lg-3">
                                            <span class="fw-bold"><?php echo $user["username"]?></span>
                                        </div>
                                        <div class="col-12">
                                            <span class="text-white"><?php echo $user["email"] ?></span>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-8">
                            <div class="row">
                                <div class="col-12 mt-5 my-lg-3">
                                    <h1 class="offset-6 offset-lg-2 fw-bold text-white fs-2">My Products</h1>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <!-- header -->
                <!-- body -->

                <div class="col-12">
                    <div class="row">

                        <!-- filter -->

                        <div class="col-11 col-lg-2 mx-3 my-3 rounded border border-primary">
                            <div class="row">

                                <div class="col-12 mt-3 fs-5">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fs-3 fw-bold">Short Products</label>
                                        </div>

                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-10">
                                                    <input type="text" class="form-control" id="s" placeholder="Search....." />
                                                </div>
                                                <div class="col-1 p-1">
                                                    <label class="form-label bi bi-search fs-3"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-bold">Active Time</label>
                                        </div>

                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="n">
                                                <label class="form-check-label" for="n">
                                                    Newest to Oldset
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="o">
                                                <label class="form-check-label" for="o">
                                                    Oldset to Newest
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By Quantity</label>
                                        </div>

                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>


                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault1" id="l">
                                                <label class="form-check-label" for="l">
                                                    High to Low
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault1" id="h">
                                                <label class="form-check-label" for="h">
                                                    Low to High
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By Condition</label>
                                        </div>

                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>


                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault2" id="b">
                                                <label class="form-check-label" for="b">
                                                    Brand New
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault2" id="u">
                                                <label class="form-check-label" for="u">
                                                    Used
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center mt-3 mb-3">
                                            <button class="btn btn-success fw-bold" onclick="addFilters();">Search</button>
                                            <button class="btn btn-primary" onclick="clearfilters();">Clear Filters</button>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- filter -->

                        <!-- products -->

                        <div class="col-12 col-lg-9 mt-3 bg-white">
                            <div class="row">

                                <div class="col-10 offset-1 text-center" id="sort">
                                    <div class="row justify-content-center">

                                        <?php

                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "'");
                                        $nProducts = $products->num_rows;
                                        $userProducts = $products->fetch_assoc();

                                        $results_per_page = 6;
                                        $number_of_pages = ceil($nProducts / $results_per_page);

                                        $page_first_result = ($pageno - 1) * $results_per_page;
                                        $selectedrs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "");
                                        $srn = $selectedrs->num_rows;


                                        for ($x = 0; $x < $srn; $x++) {
                                            $p = $selectedrs->fetch_assoc();

                                        ?>

                                            <!-- card 1 -->

                                            <div class="card mb-3 mt-3 col-12 col-lg-6">
                                                <div class="row">
                                                    <div class="col-md-4 mt-4">

                                                        <?php

                                                        $pimagrs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $p["id"] . "'");
                                                        $pir = $pimagrs->fetch_assoc();

                                                        ?>

                                                        <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title fw-bold"><?php echo $p["title"]; ?></h5>
                                                            <span class="card-text text-primary fw-bold"><?php echo $p["price"]; ?> .00</span>
                                                            <br />
                                                            <span class="card-text text-success fw-bold"><?php echo $p["qty"]; ?> Item Left</span>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" role="switch" onclick="changeStatus(<?php echo $p['id']; ?>);" <?php
                                                                                                                                                                                                                            if ($p["status_id"] == 2) {

                                                                                                                                                                                                                                echo "Checked";
                                                                                                                                                                                                                            }

                                                                                                                                                                                                                            ?> />
                                                                <label class="form-check-label text-info fw-bold" for="flexSwitchCheckChecked" id="checkLable<?php echo $p['id']; ?>">
                                                                    <?php

                                                                    if ($p["status_id"] == 2) {
                                                                        echo "Make Your product Active.";
                                                                    } else {
                                                                        echo "Make your product Deactive.";
                                                                    }

                                                                    ?>
                                                                </label>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="row g-1">

                                                                        <div class="col-12 col-lg-6 d-grid">
                                                                            <a href="#" class="btn btn-success" onclick="sendId(<?php echo $p['id']; ?>);">Update</a>
                                                                        </div>

                                                                        <div class="col-12 col-lg-6 d-grid">
                                                                            <a href="#" class="btn btn-danger">Delete</a>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- card 1 -->


                                        <?php

                                        }

                                        ?>


                                    </div>
                                </div>

                                <!-- pagination -->
                                <div class=" offset-1 offset-lg-4 col-10 col-lg-2 text-center mb-3">
                                    <div class="pagination">
                                        <a href="
                                        <?php

                                        if ($pageno <= 1) {
                                            echo "#";
                                        } else {
                                            echo "?page=" . ($pageno - 1);
                                        }

                                        ?>">&laquo;</a>

                                        <?php

                                        for ($page = 1; $page <= $number_of_pages; $page++) {

                                            if ($page == $pageno) {



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

                                        <a href="
                                        <?php

                                        if ($pageno >= $number_of_pages) {
                                            echo "#";
                                        } else {
                                            echo "?page=" . ($pageno + 1);
                                        }

                                        ?>">&raquo;</a>
                                    </div>
                                </div>
                                <!-- pagination -->

                            </div>

                        </div>

                        <!-- products -->

                    </div>
                </div>

                <!-- body -->

                <?php

                require "footer.php";

                ?>

            </div>
        </div>

        <script src="script.js"></script>
    </body>

    </html>

<?php

} else {
?>

    <script>
        alert("You have to Sign In or Sign Up first.");
        window.location = "index.php";
    </script>

<?php
}

?>