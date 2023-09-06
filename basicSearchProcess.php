<?php

require "connection.php";

$sText = $_POST["st"];
$sSelect = $_POST["ss"];

$query = "SELECT * FROM product ";

$status = 0;

if($status ==0){

    if(!empty($sText) && $sSelect == "0"){

        $query .= "WHERE `title` LIKE '%".$sText."%'";
        $status = 1;

    }else if(empty($sText) && $sSelect != "0"){

        $query .= "WHERE `category` = '".$sSelect."'";
        $status = 1;

    }else if(!empty($sText) && $sSelect != "0"){

        $query .= "WHERE `title` LIKE '%".$sText."%' AND `category` = '".$sSelect."'";
        $status = 1;
    }
} else if($status == 1){

    if(!empty($sText) && $sSelect == "0"){

        $query .= "WHERE `title` LIKE '%".$sText."%'";
        $status = 1;

    }else if(empty($sText) && $sSelect != "0"){

        $query .= "WHERE `category` = '".$sSelect."'";
        $status = 1;

    }
}

$query1 = $query;

// echo $query;
?>

<div class="row">
    <div class="offset-0 offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row">

            <?php

            if ("0" != ($_POST["page"])) {

                $pageno = $_POST["page"];
            } else {

                $pageno = 1;
            }

            $products = Database::search($query);
            $nProducts = $products->num_rows;
            $userProducts = $products->fetch_assoc();

            $results_per_page = 6;
            $number_of_pages = ceil($nProducts / $results_per_page);

            $viewed_results_count = ((int)$pageno - 1) * $results_per_page;
            $query1 .= "LIMIT " . $results_per_page . " OFFSET " . $viewed_results_count . " ";
            $selectedrs = Database::search($query1);
            $srn = $selectedrs->num_rows;

            while ($ps = $selectedrs->fetch_assoc()) {

            ?>

                <div class="card mb-3 mt-3 col-12 col-lg-6">
                    <div class="row">
                        <div class="col-md-4 mt-4">

                            <?php

                            $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $ps["id"] . "' ");
                            $presult = $pimgrs->fetch_assoc();

                            ?>

                            <img src="<?php echo $presult["code"]; ?>" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">

                                <h5 class="card-title fw-bold"><?php echo $ps["title"]; ?></h5>
                                <span class="card-text text-primary fw-bold"><?php echo $ps["price"]; ?></span>
                                <br />
                                <span class="card-text text-success fw-bold fs"><?php echo $ps["qty"]; ?> Items Left</span>

                                <div class="row">
                                    <div class="col-12">

                                        <div class="row g-1">
                                            <div class="col-12 col-lg-4 d-grid">
                                                <a href="#" class="btn btn-success fs">Buy Now</a>
                                            </div>
                                            <div class="col-12 col-lg-4 d-grid">
                                                <a href="#" class="btn btn-primary fs">Add to Cart</a>
                                            </div>
                                            <div class="col-12 col-lg-4 d-grid">
                                                <a href="#" class="btn btn-light fs"><i class="bi bi-heart-fill"></i></a>
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

    </div>

    <div class="offset-0 offset-lg-4 col-12 col-lg-4 mb-3">
        <div class="row">
            <div class="pagination">

                <!-- left arrow -->
                <a <?php if($pageno <= 1){
                    echo "#";
                }else{

                    ?> onclick="basicSearch('<?php echo ($pageno - 1); ?>');"<?php

                } ?>> &laquo;</a>
                <!-- left arrow -->


                <?php

                for($page = 1; $page <= $number_of_pages; $page++){

                    if($page == $pageno){
                        ?>

                        <a onclick="basicSearch('<?php echo $page; ?>');" class="active"><?php echo $page; ?></a>

                        <?php

                    }else{
                        ?>

                        <a onclick="basicSearch('<?php echo $page; ?>');"><?php echo $page; ?></a>

                        <?php

                    }
                }
                
                ?>

                <!-- right arrow -->
                <a <?php if($pageno >= $number_of_pages){
                    echo "#";
                }else{

                    ?> onclick="basicSearch('<?php echo ($pageno + 1); ?>');"<?php

                } ?>>&raquo;</a>
                <!-- right arrow -->

            </div>
        </div>
    </div>

</div>
