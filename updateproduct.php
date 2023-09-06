<?php

require "connection.php";

session_start();

$product = $_SESSION["p"];

if (isset($product)) {

?>

    <!DOCTYPE html>

    <html>

    <head>

        <title>eShop | Update Product</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo.svg">

        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="style.css">

    </head>

    <body>

        <div class="container-fluid">
            <div class="row gy-3">

                <div class="col-12">
                    <div class="col-12 mb-2">
                        <h3 class="h2 text-center text-primary">Product Update</h3>
                    </div>

                    <div class="col-lg-12">
                        <div class="row">

                            <span class="text-danger h5" id="msg"></span>
                            <span class="text-success h5" id="msg2"></span>


                            <div class="col-12 col-lg-4">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label lbl1">Select Product Category</label>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="ca" disabled>

                                            <?php
                                            
                                            $category = Database::search("SELECT * FROM `category` WHERE `id` = '".$product["category"]."' ");
                                            $cd = $category->fetch_assoc();

                                            ?>

                                            <option value="0"><?php echo $cd["name"]; ?></option>

                                            <?php

                                            $rs = Database::search("SELECT * FROM `category` ");
                                            $n = $rs->num_rows;

                                            for ($x = 0; $x < $n; $x++) {

                                                $d = $rs->fetch_assoc();


                                            ?>
                                                <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"]; ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label lbl1">Select Product Brand</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="br" disabled>
                                            <option value="0" >Select Brand</option>

                                            <?php

                                            $rs = Database::search("SELECT * FROM `brand` ");
                                            $n = $rs->num_rows;

                                            for ($x = 0; $x < $n; $x++) {

                                                $d = $rs->fetch_assoc();


                                            ?>
                                                <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"]; ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label lbl1">Select Product Model</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="mo" disabled>
                                            <option value="0">Select Model</option>

                                            <?php

                                            $rs = Database::search("SELECT * FROM `model` ");
                                            $n = $rs->num_rows;

                                            for ($x = 0; $x < $n; $x++) {

                                                $d = $rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"]; ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <hr class="hr-break-1">
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Add a Title to Your Product</label>
                                    </div>
                                    <div class="offset-lg-2 col-12 col-lg-8">
                                        <input class="form-control" type="text" id="ti" value="<?php echo $product["title"];?>"/>
                                    </div>
                                </div>
                            </div>
                            <hr class="hr-break-1">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label lbl1">Select Product Condition</label>
                                            </div>
                                            <?php

                                            if($product["condition_id"] ==1){
                                                ?>
                                                <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="bn" checked />
                                                <label class="form-check-label" for="bn">
                                                    Brandnew
                                                </label>
                                            </div>

                                            <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="us" />
                                                <label class="form-check-label" for="us">
                                                    Used
                                                </label>
                                            </div>
                                                <?php
                                                
                                            }else if ($product["condition_id"] ==2){

                                            ?>
                                            <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="bn" checked />
                                                <label class="form-check-label" for="bn">
                                                    Brandnew
                                                </label>
                                            </div>

                                            <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="us" />
                                                <label class="form-check-label" for="us">
                                                    Used
                                                </label>
                                            </div>
                                            <?php

                                            }
                                            
                                            ?>

                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label lbl1">Select Product Colour</label>
                                            </div>
                                            <?php

                                            if($product["colour_id"] == 1){

                                                ?>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr1" checked/>
                                                        <label class="form-check-label" for="clr1">
                                                            Gold
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr2" />
                                                        <label class="form-check-label" for="clr1">
                                                            Silver
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr3" />
                                                        <label class="form-check-label" for="clr1">
                                                            Graphite
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr4" />
                                                        <label class="form-check-label" for="clr1">
                                                            Pasific Blue
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr5" />
                                                        <label class="form-check-label" for="clr1">
                                                            Jac Black
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr6" />
                                                        <label class="form-check-label" for="clr1">
                                                            Rose Gold
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                                <?php
                                            }

                                            if($product["colour_id"] == 2){

                                                ?>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr1" />
                                                        <label class="form-check-label" for="clr1">
                                                            Gold
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr2" checked/>
                                                        <label class="form-check-label" for="clr1">
                                                            Silver
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr3" />
                                                        <label class="form-check-label" for="clr1">
                                                            Graphite
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr4" />
                                                        <label class="form-check-label" for="clr1">
                                                            Pasific Blue
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr5" />
                                                        <label class="form-check-label" for="clr1">
                                                            Jac Black
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr6" />
                                                        <label class="form-check-label" for="clr1">
                                                            Rose Gold
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>
                                                
                                                <?php
                                            }

                                            if($product["colour_id"] == 3){

                                                ?>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr1" />
                                                        <label class="form-check-label" for="clr1">
                                                            Gold
                                                        </label>
                                                    </div>
                                                    <!--  -->
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr2" />
                                                        <label class="form-check-label" for="clr1">
                                                            Silver
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr3" checked />
                                                        <label class="form-check-label" for="clr1">
                                                            Graphite
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr4" />
                                                        <label class="form-check-label" for="clr1">
                                                            Pasific Blue
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr5" />
                                                        <label class="form-check-label" for="clr1">
                                                            Jac Black
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr6" />
                                                        <label class="form-check-label" for="clr1">
                                                            Rose Gold
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                                <?php
                                            }

                                            if($product["colour_id"] == 4){

                                                ?>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr1" />
                                                        <label class="form-check-label" for="clr1">
                                                            Gold
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr2" />
                                                        <label class="form-check-label" for="clr1">
                                                            Silver
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr3" />
                                                        <label class="form-check-label" for="clr1">
                                                            Graphite
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr4" checked/>
                                                        <label class="form-check-label" for="clr1">
                                                            Pasific Blue
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr5" />
                                                        <label class="form-check-label" for="clr1">
                                                            Jac Black
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr6" />
                                                        <label class="form-check-label" for="clr1">
                                                            Rose Gold
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                                <?php
                                            }

                                            if($product["colour_id"] == 5){

                                                ?>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr1" />
                                                        <label class="form-check-label" for="clr1">
                                                            Gold
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr2" />
                                                        <label class="form-check-label" for="clr1">
                                                            Silver
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr3" />
                                                        <label class="form-check-label" for="clr1">
                                                            Graphite
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr4" />
                                                        <label class="form-check-label" for="clr1">
                                                            Pasific Blue
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr5" checked/>
                                                        <label class="form-check-label" for="clr1">
                                                            Jac Black
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr6" />
                                                        <label class="form-check-label" for="clr1">
                                                            Rose Gold
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                                <?php
                                            }

                                            if($product["colour_id"] == 6){

                                                ?>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr1" />
                                                        <label class="form-check-label" for="clr1">
                                                            Gold
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr2" />
                                                        <label class="form-check-label" for="clr1">
                                                            Silver
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr3" />
                                                        <label class="form-check-label" for="clr1">
                                                            Graphite
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr4" />
                                                        <label class="form-check-label" for="clr1">
                                                            Pasific Blue
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr5" />
                                                        <label class="form-check-label" for="clr1">
                                                            Jac Black
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr6" checked/>
                                                        <label class="form-check-label" for="clr1">
                                                            Rose Gold
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                                <?php
                                            }
                                            
                                            ?>
                                  
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <label class="form-label lbl1">Add Product Quantity</label>
                                            <input class="form-control" type="number" value="<?php echo $product["qty"]; ?>" min="0" id="qty" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="hr-break-1">
                        <div class="col-12">
                            <div class="row">

                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label lbl1">Cost Per Item</label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="cost" value="<?php echo $product["price"];?>">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <label class="form-label lbl1">Approved Payment Methods</label>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="offset-2 col-2 pm1"></div>
                                                    <div class="col-2 pm2"></div>
                                                    <div class="col-2 pm3"></div>
                                                    <div class="col-2 pm4"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="hr-break-1">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label lbl1">Delivery Costs</label>
                                        </div>
                                        <div class="col-12 col-lg-3 offset-lg-1">
                                            <label class="form-label">Delivery Cost within Colombo</label>
                                        </div>

                                        <div class="col-12 col-lg-7">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="dwc" value="<?php echo $product["delivery_fee_colombo"];?>" />
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="row mt-lg-4">
                                        <div class="col-12"></div>

                                        <div class="col-12 col-lg-3 offset-lg-1 mt-lg-3">
                                            <label class="form-label">Delivery Cost outof Colombo</label>
                                        </div>

                                        <div class="col-12 col-lg-7 mt-lg-3">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="doc" value="<?php echo $product["delivery_fee_other"];?>" />
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="hr-break-1">

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Product Description</label>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" cols="30" rows="25" id="desc"><?php echo $product["description"];?></textarea>
                                </div>
                            </div>
                        </div>

                        <hr class="hr-break-1">

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label lbl1">Add Product Image</label>
                                </div>

                                <div class="col-12">
                                    <?php

                                    $product_image = Database::search("SELECT * FROM `images` WHERE `product_id`='".$product["id"]."'");
                                    $pid = $product_image->fetch_assoc();
                                    
                                    ?>
                                    <img src="<?php echo $pid["code"];?>" class="col-5 col-lg-2 ms-2 img-thumbnail" id="prev" />
                                    <img src="<?php echo $pid["code"];?>" class="col-5 col-lg-2 ms-2 img-thumbnail" />
                                    <img src="<?php echo $pid["code"];?>" class="col-5 col-lg-2 ms-2 img-thumbnail" />
                                </div>

                                <div class="col-12 col-lg-6 mt-2 ms-4">

                                    <input type="file" class="d-none" accept="img/*" id="imageUploader" />
                                    <label for="imageUploader" class="col-5 col-lg-5 btn btn-primary" onclick="changeProductImg();">Upload</label>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <hr class="hr-break-1">

                <div class="col-12">
                    <label class="form-label lbl1">Notice...</label>
                    <br />
                    <label class="form-label">We are taking 5% of the product from price from every
                        product as a service charge.</label>
                </div>

                <div class="col-12 col-lg-4 offset-lg-4 d-grid mb-2">
                    <button class="btn btn-success search-btn mt-1" onclick="updateProduct();">Update product</button>
                </div>

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
        alert("You have Sing In or Register First");
        window.location = "index.php";
    </script>
<?php

}

?>
