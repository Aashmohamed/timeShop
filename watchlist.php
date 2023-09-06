<?php

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title>Watchlist | eShop</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php
            require "header.php";

            if (isset($_SESSION["u"])) {

                $mail = $_SESSION["u"]["email"];
            ?>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 border border-1 border-secondary rounded mb-3 mt-3 pe-3 ps-3">
                            <div class="row">

                                <div class="col-12">
                                    <label class="form-label fs-1 fw-bold">Watchlist <i class="bi bi-heart-fill fs-2"></i></label>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <hr class="hr-break-1">
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Search in watchlist..." />
                                        </div>
                                        <div class="col-12 col-lg-2 d-grid mb-3">
                                            <button class="btn btn-primary">Search</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="hr-break-1">
                                </div>

                                <div class="col-11 col-lg-2 border border-start-0 border-top-0 border-bottom-0 border-end border-primary">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                        </ol>
                                    </nav>
                                    <nav class="nav nav-pills flex-column">
                                        <a class="nav-link active" aria-current="page" href="#">Active</a>
                                        <a class="nav-link disabled">Recently View</a>
                                    </nav>
                                </div>

                                <?php

                                $products = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $mail . "' ");
                                $productCount = $products->num_rows;

                                if ($productCount == 0) {

                                ?>
                                    <!-- no items -->

                                    <div class="col-12 col-lg-9">
                                        <div class="row">
                                            <div class="col-12 emptyview"></div>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-1 fw-bolder mb-3">
                                                    You Have no items in your Watchlist yet.
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- no items -->
                                <?php
                                } else {

                                ?>

                                    <!--items -->

                                    <div class="col-12 col-lg-9">
                                        <div class="row g-2">

                                            <?php

                                            for ($x = 0; $x < $productCount; $x++) {
                                                $product = $products->fetch_assoc();
                                                $prod_id = $product["product_id"];
                                                $prod_details = Database::search("SELECT * FROM `product` WHERE `id`='" . $prod_id . "'");
                                                $pn = $prod_details->num_rows;
                                                // for ($y = 0; $y < $pn; $y++) {
                                                if ($pn == 1) {
                                                    $pf = $prod_details->fetch_assoc();
                                                    $pid = $pf["id"];
                                            ?>
                                                    <div class="card mb-3 mx-0 mx-lg-2  col-12">
                                                        <div class="row g-0">
                                                            <div class="col-md-4">
                                                            <?php

                                                            $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id`='".$prod_id."' ");
                                                            $pimg = $pimgrs->fetch_assoc();
                                                            
                                                            ?>
                                                                <img src="<?php echo $pimg["code"]; ?>" class="img-fluid rounded-start" style="height: 25vh;">
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="card-body">
                                                                    <h5 class="card-title"><?php echo $pf["title"]; ?></h5>
                                                                    <?php

                                                                    $condition = Database::search("SELECT * FROM `condition` WHERE `id`='".$pf["condition_id"]."' ");
                                                                    $cf = $condition->fetch_assoc();

                                                                    ?>

                                                                    <br />
                                                                    <span class="fw-bold text-black-50">Condition : <?php echo $cf["name"]; ?></span>

                                                                    <br />
                                                                    <span class="fw-bold text-black-50 fs-5">Price : <?php echo $pf["price"]; ?></span>&nbsp;
                                                                    <span class="fw-bold text-black-50 fs-5"></span>
                                                                    <br />
                                                                    <?php

                                                                    $user = Database::search("SELECT * FROM `user` WHERE `email`='".$mail."' ");
                                                                    $uf = $user->fetch_assoc();

                                                                    ?>
                                                                    <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                                                    <br />
                                                                    <span class="fw-bold text-black-50 fs-5"><?php echo $uf["username"]; ?></span>&nbsp;
                                                                    <br />
                                                                    <span class="fw-bold text-black-50 fs-5"><?php echo $uf["email"]; ?></span>&nbsp;

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 mt-4">
                                                                <div class="card-body d-grid">
                                                                    <a href='<?php echo "singleProductView.php?id=" . ($product["id"]) ?>' class="btn btn-outline-success mb-2">&nbsp; Buy Now &nbsp;</a>
                                                                    <a href="cart.php" class="btn btn-outline-warning mb-2" onclick="addToCart(<?php echo $product['id'] ?>);">Add to Cart&nbsp;</a>
                                                                    <a href="#" class="btn btn-outline-danger mb-2" onclick="deleteFromWatchList(<?php echo $product['id']; ?>);">Remove</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php
                                                }
                                            }

                                            ?>


                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                                <!--items -->

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
    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>

<?php

            } else {
                echo "You have to Sign in first";
            }

?>