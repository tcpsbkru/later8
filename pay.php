<?php
$url = $_SERVER ['REQUEST_URI'];
header("Refresh: 600; URL=$url");
include 'dbc.php';
page_protect();
if (isset ($_GET ['id'])) {
    $id = mysqli_real_escape_string($link, $_GET ['id']);
}

$address = null;
$expected_satoshis = null;

/* create a prepared statement http://php.net/manual/en/mysqli-stmt.prepare.php */
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, 'SELECT bitcoin, expected_satoshis FROM transactions WHERE id=?')) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $address, $expected_satoshis);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}
mysqli_close($link);

$expected_btc = satoshi_to_btc($expected_satoshis);
$qr = "bitcoin:" . $address . "?amount=" . $expected_btc;
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
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
    <!-- Histats.com  START  (aync)-->    <script type="text/javascript">var _Hasync = _Hasync || [];        _Hasync.push(['Histats.start', '1,4027956,4,0,0,0,00010000']);        _Hasync.push(['Histats.fasi', '1']);        _Hasync.push(['Histats.track_hits', '']);        (function () {            var hs = document.createElement('script');            hs.type = 'text/javascript';            hs.async = true;            hs.src = ('//s10.histats.com/js15_as.js');            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);        })();</script>    <noscript><a href="/" target="_blank"><img src="//sstatic1.histats.com/0.gif?4027956&101" alt="stats counter"                                               border="0"></a></noscript>    <!-- Histats.com  END  --></head>
<body class="vertical-layout vertical-compact-menu 1-column  bg-full-screen-image menu-expanded blank-page blank-page"
      data-open="click" data-menu="vertical-compact-menu" data-col="1-column">
<div class="pay">
    <p class="back-to"> <a href="account.php">back to account</a></p>
    <p>Scan this QR</p>
    <img src="qr/php/qr_img.php?d=<?= $qr ?>&s=6">
    <p><?= $address ?></p>
    <p><?= $expected_btc ?> BTC</p>
</div>
<!--Start of Tawk.to Script-->
<script type="text/javascript">    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/5a6e2c99d7591465c70728a7/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();</script>
<!--End of Tawk.to Script-->
</body>
</html>

