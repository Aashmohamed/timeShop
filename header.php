<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="col-12">
        <div class="row mt-1 mb-1">

            <div class="col-12 col-lg-4 offset-lg-1 align-self-start">

                <span class="text-lg-start label1 text-primary"><b>Welcome to timeShop</b> |

                    <?php

                    session_start();
                    if (isset($_SESSION["u"])) {
                        $data = $_SESSION["u"];
                    ?>
                        <?php echo $data["username"]; ?>

                    <?php

                    } else {
                    ?>
                        <a href="index.php" class="text-danger"> Sign In or Register</a>
                    <?php
                    }
                    ?>

                </span> |
                <span class="text-lg-start label2 text-primary">Help and Contact</span> |
                <span class="text-lg-start label2 text-primary" onclick="signOut();">Sign Out</span>

            </div>

            <div class="col-12 col-lg-3 offset-lg-4 align-self-end" style="text-align: center;">

                <div class="row">


                    <div class="col-1 col-lg-3 ms-5 ms-lg-0 mt-1 cart-icon"></div>

                </div>

            </div>


        </div>
    </div>

    <div class="col-12">
        <div class="row">

            <!-- table head -->
            <div class=" py-2 col-12 bg footerBox">
                <div class="row justify-content-center ">

                   <div class="col-2 d-grid bg-light text-center">
                        <a href="home.php" class="btn button2 text-white py-2 rounded border border-1 fs-6">
                            <i class="bi bi-house-fill fs-2 pe-2"></i>Home</a>
                    </div>

                    <div class="col-2 d-grid bg-light text-center">
                        <a href="addproduct.php" class="btn button2 py-2 text-white rounded border border-1 fs-6">
                            <i class="bi bi-cart-fill fs-2 pe-2"></i>MY Sellings</a>
                    </div>
                    <div class="col-2 d-grid bg-light text-center">
                        <a href="cart.php" class="btn button2 text-white py-2 rounded border border-1 fs-6">
                            <i class="bi bi-bookmark fs-2 pe-2"></i>Card</a>
                    </div>


                    <div class="col-2 d-grid bg-light text-center">
                        <a href="watchlist.php" class="btn button2 text-white py-2 rounded border border-1 fs-6">
                            <i class="bi bi-heart-fill fs-2 pe-2"></i>Wish List</a>
                    </div>


                    <div class="col-2 d-grid bg-light text-center">
                        <a href="purchaseHistory.php" class="btn button2 text-white py-2 rounded border border-1 fs-6">
                            <i class="bi bi-clock-history fs-2 pe-2"></i>Purchse History</a>
                    </div>

                    <div class="col-2 d-grid bg-light text-center">
                        <a href="userProfile.php" class="btn button2 text-white py-2 rounded border border-1 fs-6">
                            <i class="bi bi-person-circle fs-2 pe-2"></i>MY Profile</a>
                    </div>

                    

                    <div class=" bg-light"></div>

                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>

</body>

</html>