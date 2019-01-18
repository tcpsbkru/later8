<?php
include 'dbc.php';
if (filter_input(INPUT_POST, 'doRegister') === 'Register') {


    //checkbox add array element, if checkbox not checked element not added
    $data ['agree'] = 0;

    // Sanitizing
    foreach ($_POST as $key => $value) {
        $data [$key] = filter($link, $value);
    }

    $user_email = $data ['user_email'];
    $user_name = $data ['user_name'];
    $full_name = $data ['full_name'];
    $address = $data ['address'];
    $tel = $data ['tel'];
    $fax = $data ['fax'];
    $web = $data ['web'];
    $country = $data ['country'];
    $sq = $data ['sq'];
    $sa = $data ['sa'];
    $agree = $data ['agree'];
    $eth = $data ['eth'];

//     server side validation
    if (empty ($full_name) || strlen($full_name) < 3) {
        $err = urlencode("ERROR: Invalid name. Please enter atleast 3 or more for your name.");
        header("Location: reg.php?err=$err");
        exit ();
    }

    // agree checkbox validation
    if ($agree === 0) {
        $err = urlencode("ERROR: Please agree with our terms and conditions.");
        header("Location: reg.php?err=$err");
        exit ();
    }

    // Validate User Name
    if (!isUserID($user_name)) {
        $err = urlencode("ERROR: Invalid user name. It can only contain alphabet characters, numbers and underscores.");
        header("Location: reg.php?err=$err");
        exit ();
    }

    // Validate Email
    if (!isEmail($user_email)) {
        $err = urlencode("ERROR: Invalid email.");
        header("Location: reg.php?err=$err");
        exit ();
    }
    // Check User Passwords
    if (!checkPwd($data ['pwd'], $data ['pwd2'])) {
        $err = urlencode("ERROR: Invalid Password or mismatch. Enter 10 chars or more");
        header("Location: reg.php?err=$err");
        exit ();
    }

    $user_ip = $_SERVER ['REMOTE_ADDR'];

    // store md5 of password
    $md5pass = md5($data ['pwd']);

    // Automatically collects the hostname or domain like example.com)
    $host = $_SERVER ['HTTP_HOST'];
    $host_upper = strtoupper($host);
    $path = rtrim(dirname($_SERVER ['PHP_SELF']), '/\\');

    // Generate activation code simple 4 digit number
    $activation_code = rand(1000, 9999);

    // check on the server side if the email or user name already exists
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'SELECT count(*) AS total FROM users WHERE user_email=? OR user_name=?')) {
        mysqli_stmt_bind_param($stmt, "ss", $user_email, $user_name);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $total);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    if ($total > 0) {
        $err = urlencode("ERROR: This username/email already exists. Please try again with different username and email.");
        header("Location: reg.php?err=$err");
        exit ();
    }

    //check on the server side if the ip already exists (decided to allow the same IP)
//    $stmt = mysqli_stmt_init($link);
//    if (mysqli_stmt_prepare($stmt, 'SELECT count(*) AS total FROM users WHERE user_ip=?')) {
//        mysqli_stmt_bind_param($stmt, "s", $user_ip);
//        mysqli_stmt_execute($stmt);
//        mysqli_stmt_bind_result($stmt, $total);
//        mysqli_stmt_fetch($stmt);
//        mysqli_stmt_close($stmt);
//    }
//
//    if ($total > 0) {
//        $err = urlencode("ERROR: Only one IP address permited.");
//        header("Location: reg.php?err=$err");
//        exit ();
//    }

    $stmt = mysqli_stmt_init($link);
    $sql = "INSERT INTO users (eth, full_name, user_name, user_email, pwd, address, country, tel, fax, website, user_ip, sq, sa, activation_code, agree, account_date)
	VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,now())";
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssssssssssssii", $eth, $full_name, $user_name, $user_email, $md5pass, $address, $country, $tel, $fax, $web, $user_ip, $sq, $sa, $activation_code, $agree);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    $user_id = mysqli_insert_id($link);
    $md5_id = md5($user_id);

    $stmt = mysqli_stmt_init($link);
    $sql = "UPDATE users SET md5_id=? WHERE id=?";
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $md5_id, $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    // send email
    $message = "Thank you for registering with us. Here are your login details...\n
User ID: $user_name
Email: $user_email \n
Passwd: $data[pwd] \n
Activation code: $activation_code \n

*****ACTIVATION LINK*****\n



https://$host$path/login.php?md5_id=$md5_id&activation_code=$activation_code



Thank You

Administrator
$host_upper
______________________________________________________
THIS IS AN AUTOMATED RESPONSE.
***DO NOT RESPOND TO THIS EMAIL****
";

    mail($user_email, "Login Details", $message,
        "From: \"Member Registration\" <auto-reply@$host>\r\n" . "X-Mailer: PHP/" . phpversion());

    header("Location: thankyou.php");

}

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<!-- Mirrored from latergain.com/index.php?a=signup by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 26 Oct 2018 05:30:09 GMT -->
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
    <title>Account Profile - Crypto ICO - Cryptocurrency Website Landing Page HTML + Dashboard Template + Bitcoin
        Dashboard</title>
    <script src="cdn-cgi/apps/head/uisqnG4EIZK9iA9RPSaARecOaks.js"></script>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i|Comfortaa:300,400,500,700"
          rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/toggle/switchery.min.css">


    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">


    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/cryptocoins/cryptocoins.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/account-profile.css">
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
                                               border="0"></a></noscript>
    <!-- Histats.com  END  -->
    <!-- Histats.com  START  (aync)-->    <script type="text/javascript">var _Hasync = _Hasync || [];        _Hasync.push(['Histats.start', '1,4027956,4,0,0,0,00010000']);        _Hasync.push(['Histats.fasi', '1']);        _Hasync.push(['Histats.track_hits', '']);        (function () {            var hs = document.createElement('script');            hs.type = 'text/javascript';            hs.async = true;            hs.src = ('//s10.histats.com/js15_as.js');            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);        })();</script>    <noscript><a href="/" target="_blank"><img src="//sstatic1.histats.com/0.gif?4027956&101" alt="stats counter"                                               border="0"></a></noscript>    <!-- Histats.com  END  --></head>
<body>
<?php
if (isset ($_GET ['err'])) {
    $err = mysqli_real_escape_string($link, $_GET ['err']);
    echo "<div class=\"alertku\">
  <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>$err</div>";
}
?>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">Started with Later Gain!</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html"><< Home Page</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-4 col-12 d-none d-md-inline-block">
                <div class="btn-group float-md-right"><a class="btn-gradient-secondary btn-sm white"
                                                         href="login.php?a=login">Already have an account? Sign in</a>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12 col-md-8">

                    <section class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-2 col-12">
                                            <img src="images/loader-logo.png" class="rounded-circle height-100"
                                                 alt="Card image"/>
                                        </div>
                                        <div class="col-md-10 col-12">
                                            <div class="row">
                                                <div class="col-12 col-md-4">
                                                    <p class="text-bold-700 text-uppercase mb-0">Your Upline: </p>
                                                    <p class="mb-0">You do not have an upline.</p>

                                                </div>
                                            </div>
                                            <hr/>

                                            <script src="ajax.cloudflare.com/cdn-cgi/scripts/2448a7bd/cloudflare-static/rocket-loader.min.js"
                                                    data-cf-nonce="1bb72d6d4cac3e38847f6993-"></script>

                                            <form class="form-horizontal form-user-profile row mt-2" method="post"
                                                  name="regform" action="reg.php">
                                                <input type="hidden" name="form_id" value="15405316927311">
                                                <input type="hidden" name="form_token" value="b3005e369d1b25a88c3673d2ced025ed">

                                                <div class="col-6">
                                                    <fieldset class="form-label-group">
                                                         <input type="text" class="form-control" name="full_name"
                                                               id="target" value="" minlength="3" required>
                                                        <label for="full_name">Full Name</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-6">
                                                    <fieldset class="form-label-group">
                                                        <input type="text" class="form-control" name="user_name" value=""
                                                               required>
                                                        <label for="user_name">Username</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-6">
                                                    <fieldset class="form-label-group">
                                                        <input type="email" class="form-control" id="email-address"
                                                               name="user_email" value="" required>
                                                        <label for="user_email">Email address</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-6">
                                                    <fieldset class="form-label-group">
                                                        <input type="text" class="form-control" name="address" value="">
                                                        <label for="address">Address</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-6">
                                                    <fieldset class="form-label-group">
                                                        <input type="text" class="form-control" name="country" value="">
                                                        <label for="country">Country</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-6">
                                                    <fieldset class="form-label-group">
                                                        <input type="tel" class="form-control" name="tel" value="">
                                                        <label for="tel">Telephone</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-6">
                                                    <fieldset class="form-label-group">
                                                        <input type="tel" class="form-control"
                                                               name="fax" value="">
                                                        <label for="fax">Fax</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-6">
                                                    <fieldset class="form-label-group">
                                                        <input type="url" class="form-control"
                                                               name="web" value="">
                                                        <label for="website">Website</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-6">
                                                    <fieldset class="form-label-group">
                                                        <input type="password" class="form-control"
                                                               name="pwd" value="" minlength="10" required>
                                                        <label for="pwd">Password</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-6">
                                                    <fieldset class="form-label-group">
                                                        <input class="form-control" name="pwd2" value=""
                                                               type="password" minlength="10" equalto="#pwd" required>
                                                        <label for="pwd2">Retype password</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-6">
                                                    <fieldset class="form-label-group">
                                                        <input type="text" class="form-control" name="sq" value=""
                                                               required>
                                                        <label for="sq">Secret question</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-6">
                                                    <fieldset class="form-label-group">
                                                        <input type="text" class="form-control" name="sa" value=""
                                                               required>
                                                        <label for="sa">Secret answer</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12">
                                                    <fieldset class="form-label-group">
                                                        <input type="text" class="form-control" name="eth" value=""
                                                               required>
                                                        <label for="eth">Ethereum address</label>
                                                    </fieldset>
                                                </div>
                                                <right><input type="checkbox" name="agree" value="1" class="switchery"
                                                              data-size="sm">
                                                    I agree with <a href="rules.php">Terms and conditions</a>
                                                </right>
                                                <input type="hidden" class="form-control" name="doRegister"
                                                       value="Register">
                                                <div class="col-12 text-right">
                                                    <input class="btn-gradient-primary my-1" type="submit">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title text-center"> overview </h6>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="text-center row clearfix mb-2">
                                    <div class="col-12">
                                        <i class="icon-layers font-large-3 bg-warning bg-glow white rounded-circle p-3 d-inline-block"></i>
                                    </div>
                                </div>
                                <h3 class="text-center">Oct 26, 2018</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-de mb-0">
                                    <tbody>
                                    <tr>
                                        <td>Active accounts</td>
                                        <td> 4962</td>
                                    </tr>
                                    <tr>
                                        <td>Members online</td>
                                        <td>23</td>
                                    </tr>
                                    <tr>
                                        <td>Total withdraw</td>
                                        <td><i class="la la-dollar"></i><font size="4"> 56798.74</font></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer footer-static footer-transparent">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span
                class="float-md-left d-block d-md-inline-block">Copyright &copy; 2018 <a
                    class="text-bold-800 grey darken-2" href="index.php" target="_blank">Later Gain </a>, All rights reserved. </span><span
                class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Invest with peace of mind. <i
                    class="ft-heart pink"></i></span></p>
</footer>

<script src="app-assets/vendors/js/vendors.min.js" type="1bb72d6d4cac3e38847f6993-text/javascript"></script>


<script src="app-assets/vendors/js/forms/toggle/switchery.min.js"
        type="1bb72d6d4cac3e38847f6993-text/javascript"></script>


<script src="app-assets/js/core/app-menu.js" type="1bb72d6d4cac3e38847f6993-text/javascript"></script>
<script src="app-assets/js/core/app.js" type="1bb72d6d4cac3e38847f6993-text/javascript"></script>


<script src="app-assets/js/scripts/forms/account-profile.js" type="1bb72d6d4cac3e38847f6993-text/javascript"></script>

<script src="ajax.cloudflare.com/cdn-cgi/scripts/2448a7bd/cloudflare-static/rocket-loader.min.js"
        data-cf-nonce="1bb72d6d4cac3e38847f6993-" defer=""></script>

<!--Start of Tawk.to Script--><script type="text/javascript">    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();    (function () {        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];        s1.async = true;        s1.src = 'https://embed.tawk.to/5a6e2c99d7591465c70728a7/default';        s1.charset = 'UTF-8';        s1.setAttribute('crossorigin', '*');        s0.parentNode.insertBefore(s1, s0);    })();</script><!--End of Tawk.to Script--></body>

<!-- Mirrored from latergain.com/index.php?a=signup by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 26 Oct 2018 05:30:13 GMT -->
</html>