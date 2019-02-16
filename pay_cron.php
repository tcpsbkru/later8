<?php
include 'dbc.php';
echo "cron";
//$sa = satoshi_to_btc(100000000);
//
//
//$bt = btc_to_satoshi(1);
//
//
//$us = usd_to_satoshi(3831.46);
//
//
//$sat = satoshi_to_usd(100000000);
//
//
//$usdd = usd_to_btc(3831.46);
//
//
//$btt = btc_to_usd(1);
//$num = null;
//$bits[] = null;

$num = 0;
$pending = "pending";
$unconfirmed = "unconfirmed";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, 'SELECT id, users_id,  expected_satoshis, expected_usd,  bitcoin FROM transactions WHERE trans=? OR trans=?')) {
    mysqli_stmt_bind_param($stmt, "ss", $pending, $unconfirmed);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $users_id,  $expected_satoshis, $expected_usd,  $bitcoin);

    while (mysqli_stmt_fetch($stmt)) {
        $bits[] = array($id, $users_id, $expected_satoshis, $expected_usd,  $bitcoin);
    }

    $num = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);
}

for ($i = 0; $i < $num; $i++) {
    $id = $bits [$i] [0];
    $users_id = $bits [$i] [1];
    $expected_satoshis = $bits [$i] [2];
    $expected_usd = $bits [$i] [3];
    $bitcoin = $bits [$i] [4];

    $actual_usd = null;

    // $url = "https://insight.bitpay.com/api/addr/" . $bitcoin . "/balance";
    $url = "https://test-insight.bitpay.com/api/addr/" . $bitcoin . "/balance";
    $actual_satoshis = file_get_contents($url, $headers = false);
//    $actual_satoshis =  1000 ;
//    if (true) {
            if (confirmations($bitcoin)) {
        $actual_usd = $actual_satoshis / $expected_satoshis * $expected_usd;
        $trans = "confirmed";
        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, 'UPDATE transactions SET    trans=?, actual_usd=?  WHERE id=?')) {
            mysqli_stmt_bind_param($stmt, "sdi", $trans, $actual_usd, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, 'SELECT user_email FROM users WHERE id=?')) {
            mysqli_stmt_bind_param($stmt, "i", $users_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $user_email);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        }


        $subject = "payment confirmed";
        $message = "You will recieve " . $actual_usd . " GVB.";
        $host = $_SERVER ['HTTP_HOST'];
        mail($user_email, $subject, $message, "From: \"Bits\" <bits@$host>\r\n" . "X-Mailer: PHP/" . phpversion());
    }

    if (!confirmations($bitcoin) && satoshis($bitcoin)) {
        $trans = "unconfirmed";
        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, 'UPDATE transactions SET trans=? WHERE id=?')) {
            mysqli_stmt_bind_param($stmt, "si", $trans, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
}

$num1 = 0;
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, 'SELECT id FROM users')) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,  $users_id);

    while (mysqli_stmt_fetch($stmt)) {
        $bits[] = array( $users_id);
    }

    $num1 = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);
}

for ($i = 0; $i < $num1; $i++) {
    $users_id = $bits [$i] [0];

    $sent_total = null;
    $actual_usd_total = null;
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'SELECT SUM(actual_usd), SUM(sent) FROM transactions WHERE users_id=?')) {
        mysqli_stmt_bind_param($stmt, "i", $users_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $actual_usd_total, $sent_total);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    $send_total = $actual_usd_total - $sent_total;

    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'UPDATE users SET usd=?, send=? WHERE id=?')) {
        mysqli_stmt_bind_param($stmt, "ddi", $actual_usd_total, $send_total, $users_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}
