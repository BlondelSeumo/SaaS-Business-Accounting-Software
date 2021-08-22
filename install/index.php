<?php
session_start();
$_SESSION['status'] = 'success';
$_SESSION["license_code"] = 'Regular License';
$_SESSION["license"] = '1';

if (!function_exists('curl_init')) {
    die('cURL is not available on your server! Please enable cURL to continue the installation. You can read the documentation for more information.');
}

if (phpversion() <= 7.1) {
    die('<div style="background: rgba(220,53,69,.1); padding: 50px; margin:300px 0px; color: red; font-size: 20px; font-family: Arial"> You are using phpversion:<b>'.phpversion().'</b>, Please set your phpversion <b>7.2 or higher </b>from your server to continue the installation.</div>');
}

function currentUrl($server)
{
    $http = 'http';
    if (isset($server['HTTPS'])) {
        $http = 'https';
    }
    $host = $server['HTTP_HOST'];
    $requestUri = $server['REQUEST_URI'];
    return $http . '://' . htmlentities($host) . '/' . htmlentities($requestUri);
}

$current_url = currentUrl($_SERVER);

if (isset($_POST["btn_purchase_code"])) {

    $_SESSION["purchase_code"] = $_POST['purchase_code'];
    $response = "";
    header("Location: folder-permissions.php");

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response);

    if (!empty($data)) {

        if ($data->status == "300" || $data->status == "400") {
            $_SESSION["error"] = "Invalid purchase code!";
        } else {
            $_SESSION["status"] = $data->status;
            $_SESSION["license_code"] = $data->license_code;
            $_SESSION["license"] = $data->license;
            exit();
        }
    } else {
        $_SESSION["error"] = "Invalid purchase code!";
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accufy &bull; Installer</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/libs/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,500,600,700&display=swap" rel="stylesheet">
    <script src="assets/js/jquery-1.12.4.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-12 col-md-offset-2">

            <div class="row">
                <div class="col-sm-12 logo-cnt">
                    <p>
                        <img src="assets/img/logo.png" alt="">
                    </p>
                    <h1>Welcome to the Installer </h1>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">

                    <div class="install-box">

                        <div class="steps">
                            <div class="step-progress">
                                <div class="step-progress-line" data-now-value="33.33" data-number-of-steps="3" style="width: 33.33%;"></div>
                            </div>
                            <div class="step active">
                                <div class="step-icon"><i class="fa fa-arrow-circle-right"></i></div>
                                <p>Start</p>
                            </div>
                            <div class="step">
                                <div class="step-icon"><i class="fa fa-folder-open"></i></div>
                                <p>Folder Permissions</p>
                            </div>
                            <div class="step">
                                <div class="step-icon"><i class="fa fa-database"></i></div>
                                <p>Database</p>
                            </div>
                            <div class="step">
                                <div class="step-icon"><i class="fa fa-user"></i></div>
                                <p>Admin</p>
                            </div>
                        </div>

                        <div class="messages">
                            <?php if (isset($_SESSION["success"])): ?>
                                <div class="alert alert-success">
                                    <strong><?php echo htmlspecialchars($_SESSION["success"]); ?></strong>
                                </div>
                            <?php elseif (isset($_SESSION["error"])): ?>
                                <div class="alert alert-danger">
                                    <strong><?php echo htmlspecialchars($_SESSION["error"])?></strong>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="step-contents">
                            <div class="tab-1">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <div class="tab-content">
                                        <div class="tab_1">
                                           
                                            <div class="form-group">
                                                <label for="email">Purchase Code</label>
                                                <textarea name="purchase_code" class="form-control form-input" style="resize: vertical; height: 80px;line-height: 24px;padding: 10px;" placeholder="Nulled" required></textarea>
                                            </div>

                                            <div class="form-group text-center">
                                                <button type="submit" name="btn_purchase_code" class="btn-custom"><i class="fa fa-key" aria-hidden="true"></i> Get License</button>
                                            </div><br><br><br><br>

                                            <div class="form-group text-left">
                                                <p><i class="fa fa-question-circle" aria-hidden="true"></i> If you don't know how to get item purchase code on envato please click the below button</p>
                                                <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank" class="btn btn-success btn-sm btn-custom-sm"><i class="fa fa-search" aria-hidden="true"></i> Find my Code </a>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-footer">
                                        
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


        </div>


    </div>


</div>


<?php

unset($_SESSION["error"]);
unset($_SESSION["success"]);

?>

</body>
</html>
