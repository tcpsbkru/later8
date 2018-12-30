<?php
include 'dbc.php';

if (filter_input(INPUT_POST, 'doReset') === 'submit') {
    $user_email = mysqli_real_escape_string($link, $_POST ['user_email']);

    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'SELECT id FROM users WHERE user_email=?')) {
        mysqli_stmt_bind_param($stmt, "s", $user_email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $num);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    // Match row found with more than 1 results - the user is authenticated.
    if ($num <= 0) {
        $err = urlencode("Error - Sorry no such account exists or registered.");
        header("Location: recover.php?err=$err");
        exit ();
    }

    // generate 4 digit random number
    $new = rand(1000, 9999);
    $md5_new = md5($new);

    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'UPDATE users SET pwd=? WHERE user_email=?')) {
        mysqli_stmt_bind_param($stmt, "ss", $md5_new, $user_email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);

    $host = $_SERVER ['HTTP_HOST'];
    $host_upper = strtoupper($host);

    // send email

    $message = "Here are your new password details ...\n
User Email: $user_email \n
Passwd: $new\n

Thank You

Administrator
$host_upper
______________________________________________________
THIS IS AN AUTOMATED RESPONSE.
***DO NOT RESPOND TO THIS EMAIL****
";

    mail($user_email, "Reset Password", $message,
        "From: \"Member Registration\" <auto-reply@$host>\r\n" . "X-Mailer: PHP/" . phpversion());

    $msg = urlencode("Your account password has been reset and a new password has been sent to your email address.");
    header("Location: login?msg=$msg");
    exit ();
}

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<!-- Mirrored from latergain.com/index.php?a=forgot_password by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 26 Oct 2018 05:30:33 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/><!-- /Added by HTTrack -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
          content="Crypto ICO admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords"
          content="admin template, crypto ico admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>Later Gain - The best cryptocurrency investment platform</title>
    <script src="cdn-cgi/apps/head/uisqnG4EIZK9iA9RPSaARecOaks.js"></script>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i|Comfortaa:300,400,500,700"
          rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/custom.css">


    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">


    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/cryptocoins/cryptocoins.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/account-login.css">


    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Histats.com  START  (aync)-->
    <script type="text/javascript">var _Hasync = _Hasync || [];
        _Hasync.push(['Histats.start', '1,4027956,4,0,0,0,00010000']);
        _Hasync.push(['Histats.fasi', '1']);
        _Hasync.push(['Histats.track_hits', '']);
        (function () {
            var hs = document.createElement('script');
            hs.type = 'text/javascript';
            hs.async = true;
            hs.src = ('//s10.histats.com/js15_as.js');
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
        })();</script>
    <noscript><a href="/" target="_blank"><img src="//sstatic1.histats.com/0.gif?4027956&101" alt="stats counter"
                                               border="0"></a></noscript>    <!-- Histats.com  END  --></head>
<body class="vertical-layout vertical-compact-menu 1-column  bg-full-screen-image menu-expanded blank-page blank-page"
      data-open="click" data-menu="vertical-compact-menu" data-col="1-column">

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="account-login" class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">

                    <div class="col-xl-3 col-lg-4 col-md-5 col-sm-5 col-12 p-0 text-center d-none d-md-block">
                        <div class="border-grey border-lighten-3 m-0 box-shadow-0 card-account-left height-400">
                            <img src="app-assets/images/pages/account-login.png" class="card-account-img width-200"
                                 alt="card-account-img">
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-md-5 col-sm-5 col-12 p-0">
                        <div class="card border-grey border-lighten-3 m-0 box-shadow-0 card-account-right height-400">
                            <div class="card-content">
                                <div class="card-body p-3">
                                    <p class="text-center h5 text-capitalize">Recover Password</p>

                                    <script src="../ajax.cloudflare.com/cdn-cgi/scripts/2448a7bd/cloudflare-static/rocket-loader.min.js"
                                            data-cf-nonce="c0479a2853e701ea573e7af1-"></script>
                                    <form action="recover.php" method="post" name="actForm">
                                        <fieldset class="form-label-group">
                                            <input name="user_email" type="text" value="" class=form-control
                                                   autofocus="autofocus">
                                            <label for="user-name">Enter your email</label>
                                        </fieldset>
                                        <div class="form-group row">
                                        </div>
                                        <center><input type=submit value="submit" name="doReset"
                                                       class="btn-gradient-primary"></center>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>


<script src="app-assets/vendors/js/vendors.min.js" type="c0479a2853e701ea573e7af1-text/javascript"></script>


<script src="app-assets/vendors/js/forms/icheck/icheck.min.js" type="c0479a2853e701ea573e7af1-text/javascript"></script>


<script src="app-assets/js/core/app-menu.js" type="c0479a2853e701ea573e7af1-text/javascript"></script>
<script src="app-assets/js/core/app.js" type="c0479a2853e701ea573e7af1-text/javascript"></script>


<script src="app-assets/js/scripts/forms/form-login-register.js"
        type="c0479a2853e701ea573e7af1-text/javascript"></script>

<script src="../ajax.cloudflare.com/cdn-cgi/scripts/2448a7bd/cloudflare-static/rocket-loader.min.js"
        data-cf-nonce="c0479a2853e701ea573e7af1-" defer=""></script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/5a6e2c99d7591465c70728a7/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();</script><!--End of Tawk.to Script--></body>

<!-- Mirrored from latergain.com/index.php?a=forgot_password by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 26 Oct 2018 05:30:33 GMT -->
</html>

