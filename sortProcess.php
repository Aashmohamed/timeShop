<?php

session_start();
$user = $_SESSION["u"];

require "connection.php";

$search = $_POST["s"];
$age = $_POST["a"];
$qty = $_POST["q"];
$condition = $_POST["c"];

$query = "SELECT * FROM `product` WHERE `user_email` = '" . $user["email"] . "' ";

if ($condition == "1") {
    $query .= "AND `condition_id` ='1' ";
} else if ($condition == "2") {
    $query .= "AND `condition_id` ='2' ";
} else if (!empty($search)) {
    $query .= "AND `title` LIKE '%" . $search . "%' ";
} else if ($age == "1") {
    $query .= "ORDER BY `date_time_added` DESC";
} else if ($age == "2") {
    $query .= "ORDER BY `date_time_added` ASC";
} else if ($qty == "1") {
    $query .= "ORDER BY `qty` DESC";
} else if ($qty == "2") {
    $query .= "ORDER BY `qty` ASC";
}

$query1 = $query;

?>

<div class="row justify-content-center">

    <?php

    if (isset($_GET["page"])) {
        $pageno = $_GET["page"];
    } else {
        $pageno = 1;
    }

    $products = Database::search($query);
    $nProducts = $products->num_rows;
    $userProducts = $products->fetch_assoc();

    $results_per_page = 6;
    $number_of_pages = ceil($nProducts / $results_per_page);

    $page_first_result = ($pageno - 1) * $results_per_page;
    $selectedrs = Database::search($query1 . " LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "");
    $srn = $selectedrs->num_rows;


    for ($x = 0; $x < $srn; $x++) {
        $p = $selectedrs->fetch_assoc();

    ?>

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
                                        <a href="#" class="btn btn-success">Update</a>
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

    <?php

    }

    ?>

</div>