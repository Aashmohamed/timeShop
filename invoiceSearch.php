<?php

require "connection.php";

if (isset($_GET["t"])) {
    $txt = $_GET["t"];

    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `id`='" . $txt . "'");
    $invoice_num = $invoice_rs->num_rows;

    if ($invoice_num == 1) {

        $invoice_data = $invoice_rs->fetch_assoc();
?>
        <div class="col-1 bg-secondary text-end">
            <label class="form-label fw-bold fs-5 text-white"><?php echo $invoice_data["id"]; ?></label>
        </div>
        <?php

        $q = Database::search("SELECT product.title,user.fname,user.lname FROM `invoice` INNER JOIN `product` ON invoice.id=product.id INNER JOIN `user` ON invoice.user_email=user.email WHERE `invoice`.`id` ='" . $txt . "' ");

        $qdata = $q->fetch_assoc();
        ?>
        <div class="col-3 bg-body text-end">
            <label class="form-label fw-bold fs-5 text-black"><?php echo $qdata["title"]; ?></label>
        </div>
        <div class="col-3 bg-secondary text-end">
            <label class="form-label fw-bold fs-5 text-white"><?php echo $qdata["fname"] . " " . $qdata["lname"]; ?></label>
        </div>
        <div class="col-2 bg-body text-end">
            <label class="form-label fw-bold fs-5 text-black">Rs. <?php echo $invoice_data["total"]; ?> .00</label>
        </div>
        <div class="col-1 bg-secondary text-end">
            <label class="form-label fw-bold fs-5 text-white"><?php echo $invoice_data["qty"]; ?></label>
        </div>
        <div class="col-2 bg-white d-grid">

            <?php

            $x = $invoice_data["status"];
            if ($x == 0) {
            ?>
                <button class="btn btn-success my-2 fw-bold" id="btn<?php echo $results_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $results_data['id']; ?>');">Confirm Order</button>

            <?php
            } else if ($x == 1) {
            ?>
                <button class="btn btn-warning my-2 fw-bold" id="btn<?php echo $results_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $results_data['id']; ?>');">Packing</button>

            <?php
            } else if ($x == 2) {
            ?>
                <button class="btn btn-info my-2 fw-bold" id="btn<?php echo $results_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $results_data['id']; ?>');">Dispatch</button>

            <?php
            } else if ($x == 3) {
            ?>
                <button class="btn btn-primary my-2 fw-bold" id="btn<?php echo $results_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $results_data['id']; ?>');">Shopping</button>

            <?php
            } else if ($x == 4) {
            ?>
                <button class="btn btn-danger my-2 fw-bold" id="btn<?php echo $results_data["id"]; ?>" onclick="changeInvoiceId('<?php echo $results_data['id']; ?>');" disabled>Delivered</button>

            <?php
            }

            ?>

        </div>
<?php
    } else {
        echo "Invalid invoice number";
    }
} else {
    echo "Sorry for the disturb";
}


?>