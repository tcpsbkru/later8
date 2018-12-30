<?php
include 'dbc.php';
page_protect();
$user_id = $_SESSION ['user_id'];

$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, 'SELECT full_name, address, country, tel, fax, website, sq, sa, account_date FROM users WHERE id=?')) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $full_name, $address, $country, $tel, $fax, $website, $sq, $sa, $account_date);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}

if (filter_input(INPUT_POST, 'doSave') === 'Save') {
    foreach ($_POST as $key => $value) {
        $data [$key] = filter($link, $value);
    }

    $full_name = $data['name'];
    $address = $data['address'];
    $country = $data['country'];
    $tel = $data['tel'];
    $fax = $data['fax'];
    $website = $data['website'];
    $sq = $data['sq'];
    $sa = $data['sa'];
    $account_date = $data['account_date'];

    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'UPDATE users SET full_name=?, address=?, country=?, tel=?, fax=?, website=?, sq=?, sa=?  WHERE id=? ')) {
        mysqli_stmt_bind_param($stmt, "ssssssssi", $full_name, $address, $country, $tel, $fax, $website, $sq, $sa, $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    $msg = urlencode("Your profile saved");
    header("Location: settings.php?msg=$msg");
}

if (filter_input(INPUT_POST, 'doUpdate') === 'Update') {
    // Sanitizing
    foreach ($_POST as $key => $value) {
        $data [$key] = filter($link, $value);
    }

    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'SELECT pwd FROM users WHERE id=?')) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $old);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    // check for old password in md5 format
    if ($old == md5($data ['pwd_old'])) {
        $newmd5 = md5($data ['pwd_new']);

        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, 'UPDATE users SET pwd=? WHERE id=? ')) {
            mysqli_stmt_bind_param($stmt, "si", $newmd5, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        $msg = urlencode("Your password has been changed.");
        header("Location: settings.php?msg=$msg");
    } else {
        $err = urlencode("Your password is wrong");
        header("Location: settings.php?err=$err");
    }
}


?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Later Gain provides award-winning investment solutions for both amateur and senior investors.
We offer a wide variety of personal deposit products which you can find below. Since any investment involves risk, we do our best to eliminate risks and make online investing easier and saver. It is important to know that your initial deposit is insured and protected by Reserve Fund of our company.">
    <meta name="keywords"
          content="crypto, ico, cryptocurrency, bitcoin, HYIP, free bitcoin, Bitcoin investment, Make money, Payeer, PerfectMoney, Investment">
    <meta name="author" content="latergain">
    <title>LaterGain Dashboard - The best cryptocurrency investment platform</title>
    <script src="/cdn-cgi/apps/head/uisqnG4EIZK9iA9RPSaARecOaks.js"></script>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i|Comfortaa:300,400,500,700"
          rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/chartist.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/chartist-plugin-tooltip.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/toggle/switchery.min.css">


    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">


    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/cryptocoins/cryptocoins.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/timeline.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/dashboard-ico.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/account-profile.css">


    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Histats.com  START  (aync)-->    <script type="text/javascript">var _Hasync = _Hasync || [];        _Hasync.push(['Histats.start', '1,4027956,4,0,0,0,00010000']);        _Hasync.push(['Histats.fasi', '1']);        _Hasync.push(['Histats.track_hits', '']);        (function () {            var hs = document.createElement('script');            hs.type = 'text/javascript';            hs.async = true;            hs.src = ('//s10.histats.com/js15_as.js');            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);        })();</script>    <noscript><a href="/" target="_blank"><img src="//sstatic1.histats.com/0.gif?4027956&101" alt="stats counter"                                               border="0"></a></noscript>    <!-- Histats.com  END  --></head>
<body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar" data-open="click"
      data-menu="vertical-compact-menu" data-col="2-columns">
<?php
if (isset ($_GET ['err'])) {
    $err = mysqli_real_escape_string($link, $_GET ['err']);
    echo "<div class=\"alertku\">
  <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>$err</div>";
}

if (isset ($_GET ['msg'])) {
    $msg = mysqli_real_escape_string($link, $_GET ['msg']);
    echo "<div class=\"alertku-msg\">
  <span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>$msg</div>";
}
?>
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-bg-color">
    <div class="navbar-wrapper">
        <div class="navbar-header d-md-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item d-md-none"><a class="navbar-brand" href="index.php?a=account"><img
                                class="brand-logo d-none d-md-block" alt="Later Gain"
                                src="app-assets/images/logo/logo.png"><img class="brand-logo d-sm-block d-md-none"
                                                                           alt="LG"
                                                                           src="app-assets/images/logo/logo-sm.png"></a>
                </li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse"
                                                  data-target="#navbar-mobile"><i class="la la-ellipsis-v"> </i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                                                              href="#"><i class="ft-menu"> </i></a></li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label"
                                                                           href="index.php?a=withdraw"><i
                                    class="ficon icon-wallet"></i></a></li>
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                                                                   href="#" data-toggle="dropdown"> <span
                                    class="avatar avatar-online"><img src="images/Accounts_main.png"
                                                                      alt="avatar"></span><span class="mr-1">Hi<span
                                        class="user-name text-bold-700">findiklun</span></span></a>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="?a=account"><i
                                        class="ft-award"></i>Al</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="?a=edit_account"><i class="ft-user"></i> Profile</a><a
                                    class="dropdown-item" href="?a=withdraw"><i class="icon-wallet"></i> My Wallet</a><a
                                    class="dropdown-item" href="?a=earnings"><i class="ft-check-square"></i>
                                Transactions </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="?a=logout"><i class="ft-power"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="main-menu menu-fixed menu-dark menu-bg-default rounded menu-accordion menu-shadow">
    <div class="main-menu-content"><a class="navigation-brand d-none d-md-block d-lg-block d-xl-block"
                                      href="index.php?a=account"><img class="brand-logo" alt="LG logo"
                                                                      src="app-assets/images/logo/logo.png"/></a>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="active"><a href="index.php?a=account"><i class="icon-grid"></i><span class="menu-title"
                                                                                            data-i18n="">Dashboard</span></a>
            </li>
            <li class=" nav-item"><a href="index.php?a=deposit"><i class="icon-layers"></i><span class="menu-title"
                                                                                                 data-i18n="">Invest Now</span></a>
            </li>
            <li class=" nav-item"><a href="?a=withdraw"><i class="icon-wallet"></i><span class="menu-title"
                                                                                         data-i18n="">Wallet</span></a>
            </li>
            <li class=" nav-item"><a href="#"><i class="icon-shuffle"></i><span class="menu-title"
                                                                                data-i18n="">History</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="?a=withdraw_history">Withdrawals History</a></li>
                    <li><a class="menu-item" href="?a=deposit_history">Deposit history</a></li>
                    <li><a class="menu-item" href="?a=earnings">Recent Transactions</a></li>
                    <li><a class="menu-item" href="?a=deposit_list">Your deposits</a></li>
                </ul>
            </li>
            <li class=" nav-item"><a href="?a=edit_account"><i class="icon-user-following"></i><span class="menu-title"
                                                                                                     data-i18n="">Account</span></a>
            </li>
            <li><a class="menu-item" href="?a=referals"> <font color="#FDC202">Referrals</font> </a>
            </li>
            <li><a class="menu-item" href="?a=security"> <font color="#FF4D32">Security</font> </a>
            </li>
        </ul>
    </div>
</div>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>

        <section class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-10 col-12">
                                <h4>Account Profile</h4>
                                <hr/>

                                <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/2448a7bd/cloudflare-static/rocket-loader.min.js"
                                        data-cf-nonce="2556f9fe33dbb441683693a8-"></script>
                                <form class="form-horizontal form-user-profile row mt-2" action="settings.php"
                                      method=post>
                                    <div class="col-6">
                                        <fieldset class="form-label-group">
                                            Account Name: <?php echo $_SESSION ['user_name']; ?>
                                        </fieldset>
                                    </div>
                                    <div class="col-6">
                                        <fieldset class="form-label-group">
                                            Registration date:
                                            <?php
                                            $account_date = date_create($account_date);
                                            echo $account_date = date_format($account_date, 'd/m/Y');
                                            ?>
                                        </fieldset>
                                    </div>
                                    <div class="col-6">
                                        <fieldset class="form-label-group">
                                            <input class="form-control" name="name" type="text"
                                                   value="<?= $full_name ?>">
                                            <label for="full-name">Full Name</label>
                                        </fieldset>
                                    </div>
                                    <div class="col-6">
                                        <fieldset class="form-label-group">
                                            <input class="form-control" name="website" type="text"
                                                   value="<?= $website ?>">
                                            <label for="website">Website</label>
                                        </fieldset>
                                    </div>
                                    <div class="col-6">
                                        <fieldset class="form-label-group">
                                            <input class="form-control" name="address" type="text"
                                                   value="<?= $address ?>">
                                            <label for="Address">Address</label>
                                        </fieldset>
                                    </div>
                                    <div class="col-6">
                                        <fieldset class="form-label-group">
                                            <input class="form-control" name="country" type="text"
                                                   value="<?= $country ?>">
                                            <label for="country">Country</label>
                                        </fieldset>
                                    </div>
                                    <div class="col-6">
                                        <fieldset class="form-label-group">
                                            <input class="form-control" name="tel" type="text"
                                                   value="<?= $tel ?>">
                                            <label for="tel">Telephone</label>
                                        </fieldset>
                                    </div>
                                    <div class="col-6">
                                        <fieldset class="form-label-group">
                                            <input class="form-control" name="fax" type="text"
                                                   value="<?= $fax ?>">
                                            <label for="fax">Fax</label>
                                        </fieldset>
                                    </div>
                                    <div class="col-6">
                                        <fieldset class="form-label-group">
                                            <input class="form-control" name="sq" type="text"
                                                   value="<?= $sq ?>">
                                            <label for="sq">Secret question</label>
                                        </fieldset>
                                    </div>
                                    <div class="col-6">
                                        <fieldset class="form-label-group">
                                            <input class="form-control" name="sa" type="text"
                                                   value="<?= $sa ?>">
                                            <label for="sa">Secret answer</label>
                                        </fieldset>
                                    </div>

                                    <table>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <input type="hidden" class="" name="doSave" value="Save">
                                            <td><input type=submit value="change profile"
                                                       class=btn-gradient-primary my-1>
                                            </td>

                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-12">
                                <h4 style="padding-top: 2em">password</h4>
                                <hr/>

                                <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/2448a7bd/cloudflare-static/rocket-loader.min.js"
                                        data-cf-nonce="2556f9fe33dbb441683693a8-"></script>
                                <form class="form-horizontal form-user-profile row mt-2" name="pform" method="post"
                                      action="settings.php">

                                    <div class="col-6">
                                        <fieldset class="form-label-group">
                                            <input class="form-control" name="pwd_old" type="password">
                                            <label for="pwd_old">Old password</label>
                                        </fieldset>
                                    </div>
                                    <div class="col-6">
                                        <fieldset class="form-label-group">
                                            <input class="form-control" name="pwd_new" type="password">
                                            <label for="pwd_new">New password</label>
                                        </fieldset>
                                    </div>
                                    <table>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <input type="hidden" class="" name="doUpdate" value="Update">
                                            <td><input type="submit" value="change password"
                                                       class="btn-gradient-primary my-1">
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
</div>


<footer class="footer footer-static footer-transparent">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span
                class="float-md-left d-block d-md-inline-block">Copyright &copy; 2018 <a
                    class="text-bold-800 grey darken-2" href="https://latergain.com" target="_blank">Later Gain </a>, All rights reserved. </span><span
                class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Oct 31, 2018 </span></p>
</footer>

<script src="app-assets/vendors/js/vendors.min.js" type="2556f9fe33dbb441683693a8-text/javascript"></script>


<script src="app-assets/vendors/js/charts/chartist.min.js" type="2556f9fe33dbb441683693a8-text/javascript"></script>
<script src="app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js"
        type="2556f9fe33dbb441683693a8-text/javascript"></script>
<script src="app-assets/vendors/js/timeline/horizontal-timeline.js"
        type="2556f9fe33dbb441683693a8-text/javascript"></script>
<script src="app-assets/vendors/js/forms/toggle/switchery.min.js"
        type="2556f9fe33dbb441683693a8-text/javascript"></script>


<script src="app-assets/js/core/app-menu.js" type="2556f9fe33dbb441683693a8-text/javascript"></script>
<script src="app-assets/js/core/app.js" type="2556f9fe33dbb441683693a8-text/javascript"></script>


<script src="app-assets/js/scripts/forms/account-profile.js" type="2556f9fe33dbb441683693a8-text/javascript"></script>
<script src="app-assets/js/scripts/pages/dashboard-ico.js" type="2556f9fe33dbb441683693a8-text/javascript"></script>

<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/2448a7bd/cloudflare-static/rocket-loader.min.js"
        data-cf-nonce="2556f9fe33dbb441683693a8-" defer=""></script>
<!--Start of Tawk.to Script--><script type="text/javascript">    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();    (function () {        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];        s1.async = true;        s1.src = 'https://embed.tawk.to/5a6e2c99d7591465c70728a7/default';        s1.charset = 'UTF-8';        s1.setAttribute('crossorigin', '*');        s0.parentNode.insertBefore(s1, s0);    })();</script><!--End of Tawk.to Script--></body>
</html>
