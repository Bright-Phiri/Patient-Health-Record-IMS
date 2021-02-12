<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Health Record Information System</title>
    <link rel="icon" href="images/patient_diagnosis.png" type="image/x-icon">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.min.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/dataTables.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="js/provider.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Health Record IMS Sign In</h5>
                        <form class="form-signin">
                            <div class="form-label-group">
                                <input type="email" id="email" class="form-control" placeholder="Email address">
                            </div>

                            <div class="form-label-group">
                                <input type="password" id="password" class="form-control" placeholder="Password">
                            </div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="button"
                                id="loginBtn">Sign
                                in</button>
                            <hr class="my-4">
                            <p class="text-center">Dont have an Account? <a href="create_account.php">Create Account</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>