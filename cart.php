<?php

require "connection.php";

?>
<!DOCTYPE html>
<html>

<head>
    <title>Cart | eShop</title>

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

                $total = 0;
                $subtotal = "0";
                $shipping = 0;

            ?>

                <div class="col-12 pt-2" style="background-color: #E3E5E4;">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Library</li>
                        </ol>
                    </nav>

                </div>

                <div class="col-12 border border-1 border-secondary rounded mb-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-label fs-1 fw-bold">Basket <i class="bi bi-cart3 fs-1"></i></div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <hr class="hr-break-1" />
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-6 offset-0 offset-lg-2 mb-3">
                                    <input type="text" class="form-control" placeholder="Seearch in Basket..." />
                                </div>
                                <div class="col-12 col-lg-2 d-grid mb-3">
                                    <button class="btn btn-outline-primary">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr class="hr-break-1" />
                        </div>

                        <?php

                        $cartrs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $mail . "' ");
                        $cartnum = $cartrs->num_rows;

                        if ($cartnum == 0) {
                        ?>
                            <!-- empty -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 emptycart"></div>
                                    <div class="col-12 text-center mb-2">
                                        <label class="form-label fs-1">You have no items in your basket.</label>
                                    </div>
                                    <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid mb-4">
                                        <a href="" class="btn btn-primary fs-3">Start Shopping</a>
                                    </div>
                                </div>
                            </div>
                            <!-- empty -->
                            <?php
                        } else {

                            for ($x = 0; $x < $cartnum; $x++) {
                                $cartrow = $cartrs->fetch_assoc();

                                $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cartrow["product_id"] . "' ");
                                $productrow = $productrs->fetch_assoc();

                                $userrs = Database::search("SELECT * FROM `user` WHERE `email`='" . $productrow["user_email"] . "'");
                                $userrow = $userrs->fetch_assoc();

                                $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $cartrow["product_id"] . "' ");
                                $imagerow = $imagers->fetch_assoc();

                                $colourrs = Database::search("SELECT * FROM `colour` WHERE `id`='" . $productrow["colour_id"] . "' ");
                                $colourrow = $colourrs->fetch_assoc();

                                $conditionrs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $productrow["condition_id"] . "' ");
                                $conditionrow = $conditionrs->fetch_assoc();

                                $total = $total + ($productrow["price"] * $cartrow["qty"]);

                                $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $mail . "'");
                                $ar = $addressrs->fetch_assoc();
                                $cityid = $ar["city_id"];

                                $districtrs = Database::search("SELECT * FROM `city` WHERE `id`='" . $cityid . "'");
                                $xr = $districtrs->fetch_assoc();
                                $districtid = $xr["district_id"];

                                $ship = 0;

                                if ($districtid == 9) {
                                    $ship = $productrow["delivery_fee_colombo"];
                                    $shipping = $ship + $productrow["delivery_fee_colombo"];
                                } else {
                                    $ship = $productrow["delivery_fee_other"];
                                    $shipping = $ship + $productrow["delivery_fee_other"];
                                }

                            ?>

                                <!-- have products -->
                                <div class="col-12 col-lg-9">
                                    <div class="row">
                                        <div class="card mb-3 mx-0 col-12">
                                            <div class="row g-0">
                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                                            <span class="fw-bold text-black fs-5"><?php echo $userrow["username"]; ?></span>&nbsp;
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="col-md-4">

                                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $productrow["description"]; ?>" title="Product Description">
                                                        <img src="<?php echo $imagerow["code"]; ?>" class="img-fluid rounded-start" style="max-width: 200px;">
                                                    </span>

                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card-body">

                                                        <h3 class="card-title"><?php echo $productrow["title"]; ?></h3>

                                                        <span class="fw-bold text-black-50">Colour : <?php echo $colourrow["name"]; ?></span> &nbsp; |

                                                        &nbsp; <span class="fw-bold text-black-50">Condition : <?php echo $conditionrow["name"]; ?></span>
                                                        <br>
                                                        <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs. <?php echo $productrow["price"]; ?>.00</span>
                                                        <br>
                                                        <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp;
                                                        <input type="number" class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cardqtytext" value="<?php echo $cartrow["qty"]; ?>">
                                                        <br><br>
                                                        <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs. <?php echo $ship; ?>.00</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="card-body d-grid">
                                                        <a class="btn btn-outline-success mb-2">Buy Now</a>
                                                        <a class="btn btn-outline-danger mb-2" onclick="deleteFromCart(<?php echo $cartrow['id']; ?>);">Remove</a>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-6 col-md-6">
                                                            <!-- total = (price * qty) + delivery fee -->
                                                            <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                        </div>
                                                        <div class="col-6 col-md-6 text-end">
                                                            <span class="fw-bold fs-5 text-black-50">Rs. <?php echo ($productrow["price"] * $cartrow["qty"]) + $ship ?>.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- have products -->

                        <?php
                            }
                        }

                        ?>


                        <div class="col-12 col-lg-3">
                            <div class="row">

                                <div class="col-12">
                                    <label class="form-label fs-3 fw-bold">Summary</label>
                                </div>
                                <div class="col-12">
                                    <hr />
                                </div>
                                <div class="col-6 mb-3">
                                    <span class="fs-6 fw-bold">Items (<?php echo $cartnum; ?>)</span>
                                </div>
                                <div class="col-6 text-end mb-3">
                                    <span class="fs-6 fw-bold">Rs. <?php echo $total; ?>.00</span>
                                </div>
                                <div class="col-6">
                                    <span class="fs-6 fw-bold">Shipping</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span class="fs-6 fw-bold">Rs. <?php echo $shipping; ?>.00</span>
                                </div>
                                <div class="col-12 mt-3">
                                    <hr />
                                </div>
                                <div class="col-6 mt-2">
                                    <span class="fs-4 fw-bold">Total</span>
                                </div>
                                <div class="col-6 mt-2 text-end">
                                    <span class="fs-4 fw-bold">Rs. <?php echo $total + $shipping ?>.00</span>
                                </div>
                                <div class="col-12 mt-3 mb-3 d-grid">
                                    <button class="btn btn-primary fs-5 fw-bold">CHECKOUT</button>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <?php require "footer.php"; ?>
            <?php
            }
            ?>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>