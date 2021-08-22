<?php
session_start();

require_once('includes/Bcrypt.php');

$cls = new Bcrypt();


function str_slug($str, $separator = 'dash', $lowercase = TRUE)
{
    $permitted_uri_chars = 'a-z 0-9~%.:_\-';
    $str = trim($str);
    $foreign_characters = array(
        '/ä|æ|ǽ/' => 'ae',
        '/ö|œ/' => 'o',
        '/ü/' => 'u',
        '/Ä/' => 'Ae',
        '/Ü/' => 'u',
        '/Ö/' => 'o',
        '/À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ|Α|Ά|Ả|Ạ|Ầ|Ẫ|Ẩ|Ậ|Ằ|Ắ|Ẵ|Ẳ|Ặ|А/' => 'A',
        '/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª|α|ά|ả|ạ|ầ|ấ|ẫ|ẩ|ậ|ằ|ắ|ẵ|ẳ|ặ|а/' => 'a',
        '/Б/' => 'B',
        '/б/' => 'b',
        '/Ç|Ć|Ĉ|Ċ|Č/' => 'C',
        '/ç|ć|ĉ|ċ|č/' => 'c',
        '/Д/' => 'D',
        '/д/' => 'd',
        '/Ð|Ď|Đ|Δ/' => 'Dj',
        '/ð|ď|đ|δ/' => 'dj',
        '/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě|Ε|Έ|Ẽ|Ẻ|Ẹ|Ề|Ế|Ễ|Ể|Ệ|Е|Э/' => 'E',
        '/è|é|ê|ë|ē|ĕ|ė|ę|ě|έ|ε|ẽ|ẻ|ẹ|ề|ế|ễ|ể|ệ|е|э/' => 'e',
        '/Ф/' => 'F',
        '/ф/' => 'f',
        '/Ĝ|Ğ|Ġ|Ģ|Γ|Г|Ґ/' => 'G',
        '/ĝ|ğ|ġ|ģ|γ|г|ґ/' => 'g',
        '/Ĥ|Ħ/' => 'H',
        '/ĥ|ħ/' => 'h',
        '/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ|Η|Ή|Ί|Ι|Ϊ|Ỉ|Ị|И|Ы/' => 'I',
        '/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı|η|ή|ί|ι|ϊ|ỉ|ị|и|ы|ї/' => 'i',
        '/Ĵ/' => 'J',
        '/ĵ/' => 'j',
        '/Ķ|Κ|К/' => 'K',
        '/ķ|κ|к/' => 'k',
        '/Ĺ|Ļ|Ľ|Ŀ|Ł|Λ|Л/' => 'L',
        '/ĺ|ļ|ľ|ŀ|ł|λ|л/' => 'l',
        '/М/' => 'M',
        '/м/' => 'm',
        '/Ñ|Ń|Ņ|Ň|Ν|Н/' => 'N',
        '/ñ|ń|ņ|ň|ŉ|ν|н/' => 'n',
        '/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ|Ο|Ό|Ω|Ώ|Ỏ|Ọ|Ồ|Ố|Ỗ|Ổ|Ộ|Ờ|Ớ|Ỡ|Ở|Ợ|О/' => 'O',
        '/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º|ο|ό|ω|ώ|ỏ|ọ|ồ|ố|ỗ|ổ|ộ|ờ|ớ|ỡ|ở|ợ|о/' => 'o',
        '/П/' => 'P',
        '/п/' => 'p',
        '/Ŕ|Ŗ|Ř|Ρ|Р/' => 'R',
        '/ŕ|ŗ|ř|ρ|р/' => 'r',
        '/Ś|Ŝ|Ş|Ș|Š|Σ|С/' => 'S',
        '/ś|ŝ|ş|ș|š|ſ|σ|ς|с/' => 's',
        '/Ț|Ţ|Ť|Ŧ|τ|Т/' => 'T',
        '/ț|ţ|ť|ŧ|т/' => 't',
        '/Þ|þ/' => 'th',
        '/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ|Ũ|Ủ|Ụ|Ừ|Ứ|Ữ|Ử|Ự|У/' => 'U',
        '/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ|υ|ύ|ϋ|ủ|ụ|ừ|ứ|ữ|ử|ự|у/' => 'u',
        '/Ý|Ÿ|Ŷ|Υ|Ύ|Ϋ|Ỳ|Ỹ|Ỷ|Ỵ|Й/' => 'Y',
        '/ý|ÿ|ŷ|ỳ|ỹ|ỷ|ỵ|й/' => 'y',
        '/В/' => 'V',
        '/в/' => 'v',
        '/Ŵ/' => 'W',
        '/ŵ/' => 'w',
        '/Ź|Ż|Ž|Ζ|З/' => 'Z',
        '/ź|ż|ž|ζ|з/' => 'z',
        '/Æ|Ǽ/' => 'AE',
        '/ß/' => 'ss',
        '/Ĳ/' => 'IJ',
        '/ĳ/' => 'ij',
        '/Œ/' => 'OE',
        '/ƒ/' => 'f',
        '/ξ/' => 'ks',
        '/π/' => 'p',
        '/β/' => 'v',
        '/μ/' => 'm',
        '/ψ/' => 'ps',
        '/Ё/' => 'Yo',
        '/ё/' => 'yo',
        '/Є/' => 'Ye',
        '/є/' => 'ye',
        '/Ї/' => 'Yi',
        '/Ж/' => 'Zh',
        '/ж/' => 'zh',
        '/Х/' => 'Kh',
        '/х/' => 'kh',
        '/Ц/' => 'Ts',
        '/ц/' => 'ts',
        '/Ч/' => 'Ch',
        '/ч/' => 'ch',
        '/Ш/' => 'Sh',
        '/ш/' => 'sh',
        '/Щ/' => 'Shch',
        '/щ/' => 'shch',
        '/Ъ|ъ|Ь|ь/' => '',
        '/Ю/' => 'Yu',
        '/ю/' => 'yu',
        '/Я/' => 'Ya',
        '/я/' => 'ya'
    );

    $str = preg_replace(array_keys($foreign_characters), array_values($foreign_characters), $str);

    $replace = ($separator == 'dash') ? '-' : '_';

    $trans = array(
        '&\#\d+?;' => '',
        '&\S+?;' => '',
        '\s+' => $replace,
        '[^a-z0-9\-\._]' => '',
        $replace . '+' => $replace,
        $replace . '$' => $replace,
        '^' . $replace => $replace,
        '\.+$' => ''
    );

    $str = strip_tags($str);

    foreach ($trans as $key => $val) {
        $str = preg_replace("#" . $key . "#i", $val, $str);
    }

    if ($lowercase === TRUE) {
        if (function_exists('mb_convert_case')) {
            $str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
        } else {
            $str = strtolower($str);
        }
    }

    $str = preg_replace('#[^' . $permitted_uri_chars . ']#i', '', $str);

    return trim(stripslashes($str));
}

if (isset($_POST["btn_admin"])) {

    $_SESSION["admin_username"] = $_POST['admin_username'];
    $_SESSION["admin_email"] = $_POST['admin_email'];
    $_SESSION["admin_password"] = $_POST['admin_password'];

    $password = password_hash($_POST['admin_password'], PASSWORD_BCRYPT);
    $slug = str_slug($_POST['admin_username']);

    /* Database Credentials */
    defined("DB_HOST") ? null : define("DB_HOST", $_SESSION["db_host"]);
    defined("DB_USER") ? null : define("DB_USER", $_SESSION["db_user"]);
    defined("DB_PASS") ? null : define("DB_PASS", $_SESSION["db_password"]);
    defined("DB_NAME") ? null : define("DB_NAME", $_SESSION["db_name"]);

    /* Connect */
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $connection->query("SET CHARACTER SET utf8");
    $connection->query("SET NAMES utf8");

    /* check connection */
    if (mysqli_connect_errno()) {
        $error = 0;
    } else {

        if ($_SESSION["license"] == 'Regular License') {
            $license = 1;
        } else {
            $license = 2;
        }

        mysqli_query($connection, "INSERT INTO users (id, user_name, slug, email, password, role, status) VALUES (1, '" . $_POST["admin_username"] . "', '" . $slug . "', '" . $_POST["admin_email"] . "','" . $password . "','admin', 1)");
        
        mysqli_query($connection, "UPDATE settings SET site_info='" . $license . "', ind_code='" . $_SESSION["license_code"] . "', purchase_code='" . $_SESSION["purchase_code"] . "' WHERE id='1'");

        /* close connection */
        mysqli_close($connection);

        $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
        $redir .= "://" . $_SERVER['HTTP_HOST'];
        $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
        $redir = str_replace('install/', '', $redir);
        header("refresh:5;url=" . $redir);
        $success = 1;
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
                    <h1>Welcome to the Installer</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">

                    <div class="install-box">

                        <div class="steps">
                            <div class="step-progress">
                                <div class="step-progress-line" data-now-value="100" data-number-of-steps="3" style="width: 100%;"></div>
                            </div>
                            <div class="step">
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
                            <div class="step active">
                                <div class="step-icon"><i class="fa fa-user"></i></div>
                                <p>Admin</p>
                            </div>
                        </div>

                        <div class="messages">
                            <?php if (isset($error)) { ?>
                                <div class="alert alert-danger">
                                    <strong>Connect failed! Please check your database credentials.</strong>
                                </div>
                            <?php } ?>
                            <?php if (isset($success)) { ?>
                                <div class="alert alert-success">
                                    <strong>Completing installation... <i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> Please wait 5 sec.......</strong>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="step-contents">
                            <div class="tab-1">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <div class="tab-content">
                                        <div class="tab_1">
                                            <h1 class="step-title">Admin Account</h1>
                                            <div class="form-group">
                                                <label for="email">Username</label>
                                                <input type="text" class="form-control form-input" name="admin_username" placeholder="Username" value="<?php echo @$_SESSION["admin_username"]; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control form-input" name="admin_email" placeholder="Email" value="<?php echo @$_SESSION["admin_email"]; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Password</label>
                                                <input type="password" class="form-control form-input" name="admin_password" placeholder="Password" value="<?php echo @$_SESSION["admin_password"]; ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="buttons">
                                        <a href="database.php" class="btn btn-success btn-custom pull-left">Prev</a>
                                        <button type="submit" name="btn_admin" class="btn btn-success btn-custom pull-right">Finish</button>
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

