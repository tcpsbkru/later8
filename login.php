<?php
require_once __DIR__ . '/vendor/autoload.php';
include 'dbc.php';

/******************* email activation *******************/
if (isset ($_GET ['md5_id']) && !empty ($_GET ['activation_code']) && !empty ($_GET ['md5_id'])) {
    $user = mysqli_real_escape_string($link, $_GET ['md5_id']);
    $activation_code = mysqli_real_escape_string($link, $_GET ['activation_code']);

    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'SELECT id FROM users WHERE md5_id=? AND activation_code=?')) {
        mysqli_stmt_bind_param($stmt, "si", $user, $activation_code);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    // Match row found with more than 1 results - the user is authenticated.
    if ($id <= 0) {
        $err = urlencode("Sorry no such account exists or activation code invalid.");
        header("Location: login.php?err=$err");
        exit ();
    }

    // set the approved field to 1 to activate the account
    $approved = 1;
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'UPDATE users SET approved=? WHERE md5_id=? AND activation_code = ?')) {
        mysqli_stmt_bind_param($stmt, "isi", $approved, $user, $activation_code);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    $msg = urlencode("Thank you. Your account has been activated.");
    header("Location: login.php?done=1&msg=$msg");
    exit ();
}

/******************* login *******************/
if (filter_input(INPUT_POST, 'doLogin', FILTER_SANITIZE_SPECIAL_CHARS) === 'Login') {
    foreach ($_POST as $key => $value) {
        $data [$key] = filter($link, $value);
    }

    $user_email = $data['user_email'];
    $md5pass = md5($data['pwd']);

    $banned = 0;
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'SELECT id,full_name,approved FROM users WHERE user_email=? AND pwd=? AND banned=?')) {
        mysqli_stmt_bind_param($stmt, "ssi", $user_email, $md5pass, $banned);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id, $full_name, $approved);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

// Match row found with more than 1 results - the user is authenticated.
    if ($id > 0) {
        if (!$approved) {
            $err = urlencode("Account not activated. Please check your email for activation code");
            header("Location: login.php?err=$err");
            exit ();
        }

        // set session and logs user in
        session_start();
        // this sets variables in the session
        $_SESSION ['user_id'] = $id;
        $_SESSION ['user_name'] = $full_name;

        // set the cookie for 60 days
        setcookie("user_id", $_SESSION ['user_id'], time() + 60 * 60 * 24 * 60, "/");
        setcookie("user_name", $_SESSION ['user_name'], time() + 60 * 60 * 24 * 60, "/");
        header("Location: account.php");
    } else {
        $err = urlencode("Wrong user credentials.");
        header("Location: login.php?err=$err");
    }

}

//
//FB.getLoginStatus(function(response) {
//    statusChangeCallback(response);
//});
//
//function checkLoginState() {
//    FB.getLoginStatus(function(response) {
//        statusChangeCallback(response);
//    });
//}


$fb = new Facebook\Facebook([
    'app_id' => '414325452639716',
    'app_secret' => '93f1094fb0283ed926d94d89bc799cb6',
    'default_graph_version' => 'v2.10',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/later8/fb-callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<!-- Mirrored from latergain.com/index.php?a=login by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 26 Oct 2018 05:30:13 GMT -->
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

<!--    <script>-->
<!--        window.fbAsyncInit = function() {-->
<!--            FB.init({-->
<!--                appId      : '{your-app-id}',-->
<!--                cookie     : true,-->
<!--                xfbml      : true,-->
<!--                version    : '{api-version}'-->
<!--            });-->
<!---->
<!--            FB.AppEvents.logPageView();-->
<!---->
<!--        };-->
<!---->
<!--        (function(d, s, id){-->
<!--            var js, fjs = d.getElementsByTagName(s)[0];-->
<!--            if (d.getElementById(id)) {return;}-->
<!--            js = d.createElement(s); js.id = id;-->
<!--            js.src = "https://connect.facebook.net/en_US/sdk.js";-->
<!--            fjs.parentNode.insertBefore(js, fjs);-->
<!--        }(document, 'script', 'facebook-jssdk'));-->
<!--    </script>-->
    <!-- Histats.com  START  (aync)-->    <script type="text/javascript">var _Hasync = _Hasync || [];        _Hasync.push(['Histats.start', '1,4027956,4,0,0,0,00010000']);        _Hasync.push(['Histats.fasi', '1']);        _Hasync.push(['Histats.track_hits', '']);        (function () {            var hs = document.createElement('script');            hs.type = 'text/javascript';            hs.async = true;            hs.src = ('//s10.histats.com/js15_as.js');            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);        })();</script>    <noscript><a href="/" target="_blank"><img src="//sstatic1.histats.com/0.gif?4027956&101" alt="stats counter"                                               border="0"></a></noscript>    <!-- Histats.com  END  --></head>
<body class="vertical-layout vertical-compact-menu 1-column  bg-full-screen-image menu-expanded blank-page blank-page"
      data-open="click" data-menu="vertical-compact-menu" data-col="1-column">
<?php
if (isset ($_GET ['err'])) {
    $err = mysqli_real_escape_string($link, $_GET ['err']);
    echo "<div class=\"alertku\">
  <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>$err</div>";
}

if (isset ($_GET ['msg'])) {
    $err = mysqli_real_escape_string($link, $_GET ['msg']);
    echo "<div class=\"alertku\">
  <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>$msg</div>";
}
?>
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
                                    <p class="text-center h5 text-capitalize">Welcome to Later Gain!</p>
                                    <p class="mb-3 text-center">Please enter your login details</p>



<!--                                    <fb:login-button-->
<!--                                            scope="public_profile,email"-->
<!--                                            onlogin="checkLoginState();">-->
<!--                                    </fb:login-button>-->

                                    <div>
                                        <p></p>
                                    </div>
                                    <script src="ajax.cloudflare.com/cdn-cgi/scripts/2448a7bd/cloudflare-static/rocket-loader.min.js"
                                            data-cf-nonce="fbc85dd0bb0bb72e38bb1c17-"></script>
                                    <form class="form-horizontal form-signin" method=post name=mainform
                                          action="login.php" id="i-recaptcha">

                                        <input type="hidden" name="form_id" value="15405316932041">
                                        <input type="hidden" name="form_token" value="bd0a251090b131a170a78db2a1e7def2">
                                        <input type=hidden name=a value='do_login'>
                                        <input type=hidden name=follow value=''>
                                        <input type=hidden name=follow_id value=''>

                                        <fieldset class="form-label-group">
                                            <input type=text name=user_email value='' class=form-control
                                                   autofocus="autofocus">
                                            <label for="user-name">Email</label>
                                        </fieldset>
                                        <fieldset class="form-label-group">
                                            <input type=password name=pwd value='' class=form-control>
                                            <label for="user-password">Password</label>
                                        </fieldset>
                                        <div class="form-group row">
                                            <div class="col-md-6 col-12 text-center text-sm-left">
                                                <fieldset>
                                                    <input type="checkbox" id="remember-me" class="chk-remember"
                                                           name="check" value="checkLogin">
                                                    <label for="remember-me"> Remember</label>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6 col-12 float-sm-left text-center text-sm-right"><a
                                                        href="recover.php" class="card-link">Forgot
                                                    Password?</a></div>
                                        </div>
                                        <input type="hidden" name="doLogin" value="Login">
                                        <center>
                                            <input class=" btn-gradient-primary" type="submit">

                                        </center>
                                        <div>
                                            <p></p>
                                        </div>
                                        <p class="text-center"><a href="reg.php?a=signup" class="card-link">Register</a>
                                        </p>
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


<script src="app-assets/vendors/js/vendors.min.js" type="fbc85dd0bb0bb72e38bb1c17-text/javascript"></script>


<script src="app-assets/vendors/js/forms/icheck/icheck.min.js" type="fbc85dd0bb0bb72e38bb1c17-text/javascript"></script>


<script src="app-assets/js/core/app-menu.js" type="fbc85dd0bb0bb72e38bb1c17-text/javascript"></script>
<script src="app-assets/js/core/app.js" type="fbc85dd0bb0bb72e38bb1c17-text/javascript"></script>


<script src="app-assets/js/scripts/forms/form-login-register.js"
        type="fbc85dd0bb0bb72e38bb1c17-text/javascript"></script>

<script src="ajax.cloudflare.com/cdn-cgi/scripts/2448a7bd/cloudflare-static/rocket-loader.min.js"
        data-cf-nonce="fbc85dd0bb0bb72e38bb1c17-" defer=""></script>
<!--Start of Tawk.to Script--><script type="text/javascript">    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();    (function () {        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];        s1.async = true;        s1.src = 'https://embed.tawk.to/5a6e2c99d7591465c70728a7/default';        s1.charset = 'UTF-8';        s1.setAttribute('crossorigin', '*');        s0.parentNode.insertBefore(s1, s0);    })();</script><!--End of Tawk.to Script--></body>

<!-- Mirrored from latergain.com/index.php?a=login by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 26 Oct 2018 05:30:14 GMT -->
</html>