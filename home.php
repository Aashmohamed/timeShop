<?php

require "connection.php";

?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>timeShop | Home</title>

    <link rel="icon" href="resources/tlogo4.jpg">

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

</head>

<body class="homebackground">

    <div class=" container-fluid">
        <div class="row">
            <?php

            require "header.php";

            ?>

            <hr class="hr-break-1 bg-dark">

            <div class="row">

                <div class="col-4">
                <div class=" col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <P class="text-center adminpanel">Hi, Welcome to timeShop</P>
                    </div>
                </div>
                 </div>

                    <div class="col-12 mb-4">
                        <div class="row">

                            <div class="col-12">
                                <input type="text" class="form-control" aria-label="Text input with dropdown button" id="basic_search_txt">
                            </div>
                            <div class="col-12 d-grid gap-2">
                                <button class="btn btn-primary mt-3 search-btn" onclick="advancedSearch(0);">Search</button>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 ">
                        <div class="row">

                            <div class="col-12">
                                <div class="input-group input-group-lg mt-3 mb-3">


                                    <select class="btn btn-warning col-12" id="basic_search_select">
                                        <option value="0" readonly>Categorys</option>

                                        <?php

                                        $rs = Database::search("SELECT * FROM `category`");
                                        $n = $rs->num_rows;

                                        for ($x = 0; $x < $n; $x++) {
                                            $fa = $rs->fetch_assoc();

                                        ?>

                                            <option value="<?php echo $fa["id"]; ?>"><?php echo $fa["name"]; ?></option>

                                        <?php

                                        }

                                        ?>

                                    </select>
                                    
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-12 d-grid gap-2">
                        <a href="advancedSearch.php" class="btn btn-primary mt-3 search-btn">Advanced Search</a>
                    </div>

                </div>
                <div class="col-8 mx-auto d-none d-lg-block text-center">
                    <img src="resources/profiles/time (2).jpg " />

                </div>
            </div>

        </div>

        <?php

        $rs = Database::search("SELECT * FROM `category`");
        $n = $rs->num_rows;

        for ($x = 0; $x < $n; $x++) {

            $cat = $rs->fetch_assoc();

        ?>

            <div class="col-12">
                <a href="#" class="link-dark link-2"><?php echo $cat["name"]; ?></a>&nbsp;&nbsp;
                <a href="#" class="link-dark link-3">See All&nbsp; &rarr;</a>
            </div>

            <?php

            $resultset = Database::search("SELECT * FROM `product` WHERE `category` = '" . $cat["id"] . "' ORDER BY  `date_time_added` DESC LIMIT 5 OFFSET 0");
            $norows = $resultset->num_rows;
            ?>

            <div class="col-12 mb-3">

                <div class="row border border-success">

                    <div class="col-12 col-lg-12">

                        <div class="row justify-content-center gap-2">
                            <?php

                            for ($y = 0; $y < $norows; $y++) {

                                $product = $resultset->fetch_assoc();

                            ?>

                                <div class="card col-6 col-lg-2 mt-2 mb-2 btn-outline-orange" style="width: 20rem;">

                                    <?php

                                    $pimage = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $product["id"] . "' ");
                                    $img = $pimage->fetch_assoc();

                                    ?>

                                    <img src="<?php echo $img["code"]; ?>" class="card-img-top card-img-top">
                                    <div class="card-body ms-0 m-0">
                                        <h5 class="card-title"><?php echo $product["title"]; ?><span class="badge bg-primary">New</span></h5>
                                        <span class="card-text text-primary"><?php echo $product["price"]; ?> .00</span>
                                        <br />

                                        <?php

                                        if ($product["qty"] > 0) {
                                        ?>

                                            <span class="card-text text-info"><b>In Stock</b></span>
                                            <br />
                                            <span class="card-text text-success"><b><?php echo $product["qty"]; ?> Items Available</b></span><br />
                                            <a href='<?php echo "singleProductView.php?id=" . ($product["id"]) ?>' class="btn btn-outline-warning col-6 d-inline">&nbsp; Buy Now &nbsp;</a>
                                            <a href="cart.php" class="btn btn-outline-primary col-6 d-inline mt-1" onclick="addToCart(<?php echo $product['id'] ?>);">Add to Cart&nbsp;</a>

                                        <?php

                                        } else {
                                        ?>

                                            <span class="card-text text-danger"><b>Out of Stock</b></span>
                                            <br />
                                            <span class="card-text text-danger fw-bold"><b>0 Items Available</b></span><br />
                                            <a href="#" class="btn btn-outline-warning col-6 d-inline disabled">&nbsp; Buy Now &nbsp;</a>
                                            <a href="#" class="btn btn-outline-primary col-6 d-inline mt-1 disabled">Add to Cart&nbsp;</a>

                                        <?php
                                        }
                                        if (isset($_SESSION["u"])) {
                                            $usd = $_SESSION["u"]["email"];


                                            $watchrs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $product["id"] . "'AND `user_email`='" . $usd . "'");

                                            if ($watchrs->num_rows == 1) {
                                            ?>

                                                <a onclick='addToWatchlist(<?php echo $product["id"]; ?>);' class="btn btn-outline-danger col-12 mt-1"><i class="bi bi-heart-fill fs-5 text-danger" id="heart"></i></a>

                                            <?php
                                            } else {

                                            ?>

                                                <a onclick='addToWatchlist(<?php echo $product["id"]; ?>);' class="btn btn-outline-danger col-12 mt-1"><i class="bi bi-heart-fill fs-5" id="heart"></i></a>

                                        <?php
                                            }
                                        }

                                        ?>

                                    </div>
                                </div>

                            <?php

                            }

                            ?>

                        </div>

                    </div>

                </div>

            </div>


        <?php

        }

        ?>
        <?php

        require "footer.php";

        ?>

    </div>
    </div>

    <script src="script.js"></script>

</body>

</html>