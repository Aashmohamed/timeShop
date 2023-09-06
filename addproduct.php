<?php

require "connection.php";

session_start();

if (isset($_SESSION["u"])) {

?>

    <!DOCTYPE html>

    <html>

    <head>

        <title>timeShop | Add Product</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/tlogo4.jpg">

        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="style.css">

    </head>

    <body class="homebackground">

        <div class="container-fluid">
            <div class="row gy-3">

                <div class="col-12">
                    <div class="col-12 mb-2">
                        <h3 class="h1 text-center text-danger">Product Listing</h3>
                    </div>

                    <div class="col-lg-12">
                        <div class="row">

                            <span class="text-danger h5" id="msg"></span>
                            <span class="text-success h5" id="msg2"></span>


                            <div class="col-12 col-lg-4">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label lble1 hed1">Select Product Category</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select border-info" id="ca">
                                            <option value="0" class=" btn-outline-success">Select Category</option>

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
                                        <label class="form-label lble1 hed1" >Select Product Brand</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="br">
                                            <option value="0">Select Brand</option>

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
                                        <label class="form-label lble1 hed1">Select Product Model</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="mo">
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
                                        <label class="form-label lble1 hed1">Add a Title to Your Product</label>
                                    </div>
                                    <div class="offset-lg-2 col-12 col-lg-8">
                                        <input class="form-control" type="text" id="ti">
                                    </div>
                                </div>
                            </div>

                            <hr class="hr-break-1">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="from-label lble1 hed1">Select Product Condition</label>
                                            </div>
                                            <div class="offset-1 col-11 col-lg-3 ms-5  form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="bn" checked>
                                                <label class="form-check-label" for="bn">
                                                    Brandnew
                                                </label>
                                            </div>
                                            <div class="offset-1 col-11 col-lg-3 ms-5  form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="us">
                                                <label class="form-check-label" for="us">
                                                    Used
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label lble1 lble1 hed1  ">Select Prouct Colour</label>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4  form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr1" checked>
                                                        <label class="form-check-label" for="clr1">
                                                            Gold
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4   form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr2">
                                                        <label class="form-check-label" for="clr2">
                                                            Silver
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4  form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr3">
                                                        <label class="form-check-label" for="clr3">
                                                            Brown
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4  form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr4">
                                                        <label class="form-check-label" for="clr4">
                                                              Black
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4   form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr5">
                                                        <label class="form-check-label" for="clr5">
                                                            white
                                                        </label>
                                                    </div>
                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4  form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr6">
                                                        <label class="form-check-label" for="clr6">
                                                            Light brown
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <label class="form-label lble1 hed1 ">Add Product Quantity</label>
                                            <input class="from-control" type="number" value="0" min="0" id="qty" />
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
                                            <label class="from-label lble1 hed1 ">Cost Per Item</label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="cost">
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
                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="from-label lble1 hed1 ">Delivery Costs</label>
                                        </div>


                                        <div class="col-12 col-lg-3 offset-lg-1">
                                            <label class="from-label">Delivery Cost with Colombo</label>
                                        </div>

                                        <div class="col-12 col-lg-7">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee) " id="dwc">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="row mt-lg-4">
                                            <div class="mt-lg-3"></div>

                                            <div class="col-12 col-lg-3 offset-lg-1">
                                                <label class="from-label">Delivery Cost Outof Colombo</label>
                                            </div>

                                            <div class="col-12 col-lg-7">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Rs.</span>
                                                    <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" id="doc">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="hr-break-1" />

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-lable lble1 hed1 ">Product Description</label>
                                        </div>

                                        <div class="col-12">
                                            <textarea class="form-control" id="desc" cols="10" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <hr class="hr-break-1" />

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label lble1 hed1 ">Add Product Image</label>
                                        </div>
                                        <div class="col-12">
                                            <img src="resources/ti.jpg" class="col-5 col-lg-2 ms-2 img-thumbnail " id="prev" />
                                            <img src="" class="col-5 col-lg-2 ms-2 img-thumbnail" />
                                            <img src="resources/ti.jpg" class="col-5 col-lg-2 ms-2 img-thumbnail" />
                                        </div>
                                        <div class="col-12 col-lg-6 mt-2 ms-4">
                                            <input type="file" class="d-none" accept="img/*" id="imageUploader">
                                            <label for="imageUploader" class="col-5 col-lg-12 btn btn-success" onclick="changeProductImg();">Uplode</label>
                                        </div>



                                    </div>
                                </div>

                            </div>
                        </div>



                    </div>

                </div>

                <hr class="hr-break-1">

                <div class="col-12">
                    <label class="form-label lble1 hed1 ">Notice...</label>
                    <br />
                    <label class="from-label blockquote-footer">We are taking 5% of the product from price from every product as a service charge.</label>
                </div>

                <div class="col-12 col-lg-4 offset-lg-4 d-grid mb-2">
                    <button class="btn btn-success search-btn mt-1" onclick="addProduct();">Add product</button>
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
        alert("You have to SignIn or Register First.");
        window.location = "index.php";
    </script>

<?php

}

?>