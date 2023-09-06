<?php

session_start();
require "connection.php";

$category = $_POST["c"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = $_POST["co"];
$color= $_POST["col"];
$qty = $_POST["q"];
$price = $_POST["p"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$description = $_POST["desc"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$status = 1;
$usermail = $_SESSION["u"]["email"];

if($category == "0"){
    echo "Please select your a category.";
}else if($brand == "0") {
    echo "Please select your a brand.";
}else if($model == "0") {
    echo "Please select your a model.";
}else if(empty($title)) {
    echo "Please add a title to your product.";
}else if(strlen($title) > 100){
    echo "Please enter a title contains 100 characters or lower.";
}else if(empty($qty)){
    echo "Quantity field must not be empty.";
}else if($qty == "0" || $qty == "e" || $qty < 0){
    echo "Please enter a valid quantity.";
}else if(empty($price)) {
    echo "please enter a price to your product.";
}else if(is_int($price)) {
    echo "Please enter a valid price.";
}else if(empty($dwc)) {
    echo "please enter a delivery cost inside colombo.";
}else if(is_int($dwc)) {
    echo "please enter a valid price for delivery inside colombo.";
}else if(empty($doc)) {
    echo "please enter a delivery cost outside colombo.";
}else if(is_int($doc)) {
    echo "please enter a valid price for delivery outside colombo.";
}else if(empty($description)) {
    echo "please enter a description to your product.";
}else{

    $modelHasBrand = Database::search("SELECT `id` FROM `model_has_brand` WHERE 
    `brand_id` = '".$brand."' AND `model_id` = '".$model."' ");


    if($modelHasBrand->num_rows == 0){
        echo "This product does not exists";
    }else{

        $f = $modelHasBrand->fetch_assoc();
        $modelHasBrand = $f["id"];

        Database::iud("INSERT INTO `product` (`category`, `model_has_brand_id`, `colour_id`, `price`, `qty`, `description`,
        `title`, `condition_id`, `status_id`, `user_email`, `date_time_added`, `delivery_fee_colombo`, `delivery_fee_other` ) 
        VALUES ('".$category."', '".$modelHasBrand."', '".$color."', '".$price."', '".$qty."', '".$description."', '".$title."',
         '".$condition."', '".$status."', '".$usermail."', '".$date."', '".$dwc."', '".$doc."') ");

         $last_id = Database::$connection->insert_id;

         $allowed_image_extention = array("image/jpg", "image/jpeg", "image/png", "image/svg");

         if(isset($_FILES["img"])){
            $image = $_FILES["img"];
         }

         if(isset($image)){

            $file_extention = $image["type"];

            if(in_array($file_extention, $allowed_image_extention)){


                $fileName = "resources//products//".uniqid().$image["name"];
                move_uploaded_file($image["tmp_name"], $fileName);

                Database::iud("INSERT INTO `images` (`code`, `product_id`)
                VALUES ('".$fileName."', '".$last_id."' ) ");
                

            }else{
                echo "Please Select a Valid image.";
            }

         }else{

            echo "Please select an Image";

         }

    }

    echo "success";
}
