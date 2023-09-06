<html>

<head>
    <title>timeShop | Transaction History</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php require "header.php"; ?>

            <div class="col-12 text-center mb-3">
                <span class="fs-1 fw-bold text-primary">Transaction History</span>
            </div>

            <div class="col-12">
                <div class="row">

                    <!-- table head -->
                    <div class="col-12 d-none d-lg-block">
                        <div class="row">

                            <div class="col-1 bg-light">
                                <label class="form-label fw-bold">#</label>
                            </div>

                            <div class="col-3 bg-light">
                                <label class="form-label fw-bold">Order Details</label>
                            </div>

                            <div class="col-1 bg-light text-end">
                                <label class="form-label fw-bold">Quantity</label>
                            </div>

                            <div class="col-2 bg-light text-end">
                                <label class="form-label fw-bold">Amount</label>
                            </div>

                            <div class="col-2 bg-light text-end">
                                <label class="form-label fw-bold">Purchase Date & Time</label>
                            </div>

                            <div class="col-3 bg-light"></div>
                            <div class="col-12">
                                <hr>
                            </div>

                        </div>
                    </div>
                    <!-- table head -->
                    <!-- table body -->

                    <div class="col-12">
                        <div class="row">

                            <div class="col-12 col-lg-1 bg-info text-center text-lg-start">
                                <label class="form-label text-white fs-6 py-5">11111111111</label>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="row g-2">

                                    <div class="card mx-0 my-3" style="max-width: 540px;">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img src="genswatch/RADO_centrix_Diamonds.webp" class="img-fluid rounded-start">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title">RADO_centrix_Diamonds</h5>
                                                    <p class="card-text"><b>Seller :</b> Mohamed Aash</p>
                                                    <p class="card-text"><b>Price :</b> Rs. 100000.00</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 col-lg-1 bg-light text-center text-lg-end">
                                <label class="form-label fs-4 pt-5">1</label>
                            </div>

                            <div class="col-12 col-lg-2 bg-info text-center text-lg-end">
                                <label class="form-label fs-5 fw-bold py-5 text-white">Rs. 100000.00</label>
                            </div>

                            <div class="col-12 col-lg-2 bg-light text-center text-lg-end">
                                <label class="form-label fs-5 fw-bold px-3 py-5">2022-10-16 23:06:47</label>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="row">
                                    <div class="col-6 d-grid">
                                        <button class="btn btn-secondary rounded border border-1 border-primary mt-5 fs-5">
                                            <i class="bi bi-info-circle-fill"></i> Feedback</button>
                                    </div>
                                    <div class="col-6 d-grid">
                                        <button class="btn btn-danger rounded border border-1 mt-5 fs-5">
                                        <i class="bi bi-trash-fill"></i> Delete</button>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- table body -->
                </div>
            </div>

            <div class="col-12">
                <hr>
            </div>

            <div class="col-12 mb-3">
                <div class="row">
                    <div class="col-lg-10 d-none d-lg-block"></div>
                    <div class="col-12 col-lg-2 d-block">
                        <button class="btn btn-danger rounded border border-1 fs-6">
                            <i class="bi bi-trash-fill"></i>Clear All Records</button>
                    </div>
                </div>
            </div>

            <?php require "footer.php"; ?>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>