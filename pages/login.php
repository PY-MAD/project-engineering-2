<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/auth.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>login</title>
</head>
<body>
    <div class="container_bg">
        <div class="from_group w-100 d-flex flex-column justify-content-center align-items-center">
            <div class="logo mb-5">
                <img src="../assets/logos/appLogo.png" alt="" width="300px">
            </div>
            <form action="" method="post" class="d-flex form-group flex-column justify-content-center w-100">
                <div class="form-group m-auto mb-3">
                    <input type="email" name="email" id="login_Email" placeholder="EMAIL" class="form-control fs-5 p-3">
                </div>
                <div class="form-group m-auto mb-3">
                    <input type="text" name="NAME" id="login_name" placeholder="NAME" class="form-control fs-5 p-3">
                </div>
                <div class="form-group m-auto mb-3">
                    <input type="password" name="password" id="login_password" placeholder="PASSWORD" class="form-control fs-5 p-3">
                </div>
                <div class="form-group m-auto  mb-3">
                    <input type="conf_password" name="conf_password" id="login_conf_password" placeholder="CONFIRM PASSWORD" class="form-control fs-5 p-3">
                </div>
                <div class="form-group m-auto  mb-3">
                    <input type="submit" value="Login" class="btn btn-primary btn-lg btn-login-color text-white">
                </div>
                <div class="form-group m-auto  mb-3">
                    <input type="submit" value="Register" class="btn btn-primary btn-lg btn-Register-color text-white">
                </div>
                
            </form>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>