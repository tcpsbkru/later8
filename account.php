<?php
$url = $_SERVER ['REQUEST_URI'];
header("Refresh: 600; URL=$url");
include 'dbc.php';
page_protect();
$user_id = $_SESSION ['user_id'];

// get exchange rate of USD to BTC. 1GVB = 1USD
//$url = "https://blockchain.info/tobtc?currency=USD&value=1";
//$usd_in_btc = file_get_contents($url, $headers = false);
//$usd_in_satoshi = $usd_in_btc * 100000000;
//
//this rate is more precise
//$url = "https://bitpay.com/api/rates/BTC/USD";
//$contents = file_get_contents($url, $headers = false);
//$arr_json = json_decode($contents, true);
//$btc_in_usd = $arr_json['rate'];
//$usd_in_btc = 1 / $btc_in_usd;
//$usd_in_satoshi = $usd_in_btc * 100000000;

if (filter_input(INPUT_POST, 'pay_name') === 'pay') {
    // Sanitizing
    foreach ($_POST as $key => $value) {
        $data [$key] = filter($link, $value);
    }

    $cus_address = $data ['cus_address'];
    $expected_gvb = $data ['quantity'];
    $expected_satoshis = $expected_gvb * usd_in_satoshi();

    $payment = "new";
    $limit = 1;
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'SELECT id FROM bits WHERE payment=? LIMIT ?')) {
        mysqli_stmt_bind_param($stmt, "si", $payment, $limit);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    $payment = "pending";
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'UPDATE bits SET user_id=?, expected_satoshis=?, expected_gvb=?, owed_gvb=?, payment=?, cus_address=?, paytime=now()  WHERE id=? ')) {
        mysqli_stmt_bind_param($stmt, "iiddssi", $user_id, $expected_satoshis, $expected_gvb, $expected_gvb, $payment, $cus_address, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    header("Location: pay.php?id=$id");
}

if (filter_input(INPUT_POST, 'pay_owed_name') === 'pay') {
// Sanitizing
    foreach ($_POST as $key => $value) {
        $data [$key] = filter($link, $value);
    }
    $id = $data ['id'];
    header("Location: pay.php?id=$id");
}

$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, 'SELECT id, expected_gvb, owed_gvb, payment, address, paytime FROM bits WHERE user_id=?')) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $expected_gvb, $owed_gvb, $payment, $address, $paytime);

    while (mysqli_stmt_fetch($stmt)) {
        $transactions[] = array($id, $expected_gvb, $owed_gvb, $payment, $address, $paytime);
    }

    $num_of_transactions = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);
}

$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, 'SELECT SUM(actual_gvb) FROM bits WHERE user_id=?')) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $total);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
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

            <li class=" nav-item"><a href="settings.php"><i class="icon-shuffle"></i><span class="menu-title"
                                                                                           data-i18n="">Settings</span></a>
            </li>
        </ul>
    </div>
</div>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-md-8 col-12">

                    <h2>Welcome <?php echo $_SESSION ['user_name']; ?></h2>

                    <div class="card-body">
                        To send BTC, you can use any private or exchange wallet.
                        This is your unique deposit address. Once funds are received in
                        this address your balance will be updated shortly.
                    </div>
                    <div class="card pull-up">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="col-12" style="padding-right: 30px; padding-left: 30px;">
                                    <div class="row">
                                        <div class="col-md-8 col-12">
                                            <p><strong>Your balance:</strong></p>
                                            <h1><?= $total ?> GVB</h1>
                                            <p class="mb-0">
                                            </p>
                                        </div>
                                    </div>
                                    <form class="" action="account.php" method="post"
                                          name="logForm" id="logForm">
                                        <input type=hidden name=follow_id value=''>
                                        <fieldset class="form-label-group">
                                            <input class=form-control name="cus_address" type="text">
                                            <label for="">Your Ethereum address</label>
                                        </fieldset>
                                        <fieldset class="form-label-group" style="padding-right: 60%;">
                                            <input class=form-control type="text" name="quantity">
                                            <label for="">GVB</label>
                                        </fieldset>
                                        <div>
                                            <input class="btn-gradient-secondary btn-sm" name="pay_name" type="submit"
                                                   id="pay" value="pay">
                                            <!--                                            <a class="btn-gradient-secondary btn-sm1 white" href="?a=deposit">Invest Now</a>-->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <h6 class="my-2">Account Overview</h6>
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <p><b>Last Access: Oct-31-2018 01:13:37 AM</b></p>
                                Registration Date: Oct-26-2018<br>
                                Total Deposit: $<b><?= $total ?> GVB</b><br>
                                Withdrew Total: $<b>0.00</b><br>
                                Active Deposit: $<b>0.00</b><br>
                                Earned Total: $<b>0.00</b>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>

</div>


<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <h3>Your deposits:</h3><br>
        <b>Total: <?= $total ?> GVB</b><br><br>
        <div class="table-responsive">
            <div class="card">
                <table cellspacing=1 cellpadding=2 border=0 width=100% class=table table-de mb-0>
                    <tr>
                        <td class=item>
                            <table cellspacing=1 cellpadding=2 border=0 width=100%>
                                <!--                                <tr>-->
                                <!--                                    <td colspan=3 align=center><b>5.5% Daily for 20 Business Days</b></td>-->
                                <!--                                </tr>-->
                                <tr>
                                    <td class=inheader><b>Date</b></td>
                                    <td class=inheader><b>GVB</b></td>
                                    <td class=inheader><b>Outstanding</b></td>
                                    <td class=inheader><b>Transaction</b></td>
                                    <!--                                    <td class=inheader><b>Address</b></td>-->
                                    <td class=inheader><b>Pay</b></td>
                                    <!--                                    <td class=inheader width=200>Amount Spent ($)</td>-->
                                    <!--                                    <td class=inheader width=100 nowrap>-->
                                    <!--                                        <nobr>Daily Profit (%)</nobr>-->
                                    <!--                                    </td>-->
                                </tr>
                                <?php
                                for ($i = 0;
                                     $i < $num_of_transactions;
                                     $i++) {
                                    // $id, $expected_gvb, $owed_gvb, $payment, $address, $paytime
                                    $date = date_create($transactions [$i] [5]);
                                    $date = date_format($date, 'd/m/Y');
                                    $expected_gvb = $transactions [$i] [1];
                                    $payment = $transactions [$i] [3];
                                    $owed_gvb = $transactions [$i] [2];
                                    $address = $transactions [$i] [4];
                                    $id = $transactions [$i] [0];
                                    ?>
                                    <tr>
                                        <td class=item><?= $date ?></td>
                                        <td class=item><?= $expected_gvb . " GVB " ?></td>
                                        <td class=item><?= $owed_gvb . " GVB " ?></td>
                                        <td class=item><?php if ($payment == "confirmed" OR $payment == "confirmed_wrong_amount") {
                                                echo "confirmed";
                                            } else {
                                                echo $payment;
                                            } ?></td>
                                        <!--                                    <td class=item>-->
                                        <? //= $address ?><!--</td>-->
                                        <td class=item>
                                            <form class="login" action="account.php" method="post">
                                                <input name="id" type="hidden" value="<?= $id ?>">
                                                <?php
                                                if ($payment == "confirmed_wrong_amount" || $payment == "pending") { ?>
                                                    <input class="btn-gradient-secondary btn-sm"
                                                           name="pay_owed_name" type="submit"
                                                           value="pay">
                                                <?php } ?>

                                            </form>
                                        </td>
                                        <!--                                    <td class=item align=right>$10.00 - $10000.00</td>-->
                                        <!--                                    <td class=item align=right>5.50</td>-->
                                    </tr>
                                    <?php
                                } ?>
                            </table>

                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
</div>


<footer class="footer footer-static footer-transparent">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span
                class="float-md-left d-block d-md-inline-block">Copyright &copy; 2018 <a
                    class="text-bold-800 grey darken-2" href="https://latergain.com" target="_blank">Later Gain </a>, All rights reserved. </span><span
                class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Oct 31, 2018 </span></p>
</footer>

<script src="app-assets/vendors/js/vendors.min.js" type="621608ae50b87e267d5440b0-text/javascript"></script>


<script src="app-assets/vendors/js/charts/chartist.min.js" type="621608ae50b87e267d5440b0-text/javascript"></script>
<script src="app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js"
        type="621608ae50b87e267d5440b0-text/javascript"></script>
<script src="app-assets/vendors/js/timeline/horizontal-timeline.js"
        type="621608ae50b87e267d5440b0-text/javascript"></script>
<script src="app-assets/vendors/js/forms/toggle/switchery.min.js"
        type="621608ae50b87e267d5440b0-text/javascript"></script>


<script src="app-assets/js/core/app-menu.js" type="621608ae50b87e267d5440b0-text/javascript"></script>
<script src="app-assets/js/core/app.js" type="621608ae50b87e267d5440b0-text/javascript"></script>


<script src="app-assets/js/scripts/forms/account-profile.js" type="621608ae50b87e267d5440b0-text/javascript"></script>
<script src="app-assets/js/scripts/pages/dashboard-ico.js" type="621608ae50b87e267d5440b0-text/javascript"></script>

<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/2448a7bd/cloudflare-static/rocket-loader.min.js"
        data-cf-nonce="621608ae50b87e267d5440b0-" defer=""></script>
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
</html>
