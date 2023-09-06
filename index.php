<!DOCTYPE html>

<html>

<head>
    <title>timeShop | index</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/Capture.PNG">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body background="resources/5557339.jpg ">

<div class="col-12 col-lg-6">
    <div class="row">

<div class="container-fluid vh-100 d-flex justify-content-center">
        <div class="row align-content-center">

            <div class="col-12">
                <div class="row">
                    <div class="col-12 offset-lg-1 logo"></div>
                    <div class="col-12  offset-lg-1">
                        <p class="text-center title01">Hi, Welcome to timeeShop</p>
                    </div>
                </div>
            </div>

            <div class="col-12 p-3">
                <div class="row">
                    <div class="col-6 d-none d-lg-block background"></div>
                    <!-- Sign Up -->
                    <div class="col-10 offset-1 offset-lg-2 signInBox " id="signUpBox">
                        <div class="row g-2">

                            <div class="col-12">
                                <p class="title02">Create New Account</p>
                                <span class="text-danger" id="msg"></span>
                            </div>

                            <div class="col-12">
                                <label class="form-label">User Name</label>
                                <input class="form-control" type="text" id="username">
                            </div>

                            <div class="col-12">
                                <label class="form-labal">Email:</label>
                                <input class="form-control" type="email" id="email">
                            </div>

                            <div class="col-12">
                                <label class="form-labal">Password:</label>
                                <input class="form-control" type="password" id="password">
                            </div>

                            <div class="col-6">
                                <label class="form-labal">Mobile:</label>
                                <input class="form-control" type="text" id="mobile">
                            </div>

                            <div class="col-6">
                                <label class="form-labal">Gender:</label>
                                <select class="form-select" id="gender">

                                    <?php

                                    require "connection.php";

                                    $r = Database::search("SELECT * FROM `gender`");
                                    $n = $r->num_rows;

                                    for($x = 0;$x<$n;$x++){
                                        $d = $r->fetch_assoc();

                                        ?>

                                        <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"]; ?></option>

                                        <?php
                                    }

                                    ?>
                                </select>
                            </div>

                            <div class="col-12">

                            </div>


                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-warning" onclick="signUp();">Sign Up</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary text-dark" onclick="changeView();">Already have an account? Sign In</button>
                            </div>
                        </div>
                        <hr class="border border-1 border-danger" />

                    </div>

                    <div class="col-12 col-lg-8 offset-1 offset-lg-3 d-none signInBox" id="signInBox">
                        <div class="row g-2">

                            <div class="col-12">
                                <p class="title02">Sign In to Your Account</p>
                                <span class="text-danger" id="msg2"></span>
                            </div>

                            <?php

                            $email = "";
                            $password = "";

                            if (isset($_COOKIE["email"])) {
                                $email = $_COOKIE["email"];
                            }

                            if (isset($_COOKIE["password"])) {
                                $password = $_COOKIE["password"];
                            }

                            ?>

                            <div class="col-12">
                                <label class="form-labale">Email</label>
                                <input class="form-control" type="email" value="<?php echo $email; ?>" id="email2">
                            </div>

                            <div class="col-12">
                                <label class="form-labale">Password</label>
                                <input class="form-control" type="password" value="<?php echo $password; ?>" id="password2">
                            </div>

                            <div class="col-6">
                                <input type="checkbox" class="form-check-input" value="1" id="rememberMe" />
                                <label class="form-check-label text-primary">Remember Me</label>
                            </div>

                            <div class="col-6">
                                <a herf="#" class="text-danger" onclick="forgotPassword();">Forgot Password</a>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-warning" onclick="signIn();">Sign In</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-dark" onclick="changeView();">New to timeShop Join Now</button>
                            </div>

                        </div>
                        <hr class="border border-1 border-danger" />
                    </div>

                </div>

            </div>
            <!-- modal -->
            <div class="modal" tabindex="-1" id="forgotPasswordModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Password Reset</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row g-3">

                                <div class="col-6">
                                    <label class="from-label">New Password</label>
                                    <div class=" input-group mb-3">
                                        <input type="password" class="form-control" id="np">
                                        <button class="btn btn-outline-secondary" type="button" id="npb" onclick="showPassword1();">Show</button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="from-label">Re-type Password</label>
                                    <div class=" input-group mb-3">
                                        <input type="password" class="form-control" id="rnp">
                                        <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword2();">Show</button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="from-label">Verification Code</label>
                                    <div class=" input-group mb-3">
                                        <input type="text" class="form-control" id="vc">

                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>