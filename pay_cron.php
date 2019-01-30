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
if (mysqli_stmt_prepare($stmt, 'SELECT id, users_id, expected_satoshis, expected_usd, owed_usd, bitcoin FROM transactions WHERE trans=? OR trans=?')) {
    mysqli_stmt_bind_param($stmt, "ss", $pending, $unconfirmed);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $users_id, $expected_satoshis, $expected_usd, $owed_usd, $bitcoin);

    while (mysqli_stmt_fetch($stmt)) {
        $bits[] = array($id, $users_id, $expected_satoshis, $expected_usd, $owed_usd, $bitcoin);
    }

    $num = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);
}

for ($i = 0; $i < $num; $i++) {
    $id = $bits [$i] [0];
    $users_id = $bits [$i] [1];
    $expected_satoshis = $bits [$i] [2];
    $expected_usd = $bits [$i] [3];
    $owed_usd = $bits [$i] [4];
    $bitcoin = $bits [$i] [5];

    $actual_usd = null;

    // $url = "https://insight.bitpay.com/api/addr/" . $bitcoin . "/balance";
    $url = "https://test-insight.bitpay.com/api/addr/" . $bitcoin . "/balance";
    $actual_satoshis = file_get_contents($url, $headers = false);


    if (confirmations($bitcoin)) {
        $actual_usd = $actual_satoshis / $expected_satoshis * $owed_usd;
        $trans = "confirmed";
        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, 'UPDATE transactions SET  actual_usd=?,  trans=? WHERE id=?')) {
            mysqli_stmt_bind_param($stmt, "dsi", $actual_usd, $trans, $id);
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

        if ($actual_satoshis >= $expected_satoshis) {
            $subject = "payment confirmed";
            $message = "You will recieve " . $actual_usd . " GVB.";
            $host = $_SERVER ['HTTP_HOST'];
            mail($user_email, $subject, $message, "From: \"Bits\" <bits@$host>\r\n" . "X-Mailer: PHP/" . phpversion());
        } else {
            $subject = "owe from cron";
            $owed = $owed_usd - $actual_usd;
            $message = "Payment pending for  " . $owed . " GVB.";
            $host = $_SERVER ['HTTP_HOST'];
            mail($user_email, $subject, $message, "From: \"Debt department cron\" <debt@$host>\r\n" . "X-Mailer: PHP/" . phpversion());
        }
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

    $expected_usd_total = null;
    $actual_usd_total = null;
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'SELECT SUM(expected_usd), SUM(actual_usd) FROM transactions WHERE users_id=?')) {
        mysqli_stmt_bind_param($stmt, "i", $users_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $expected_usd_total, $actual_usd_total);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    if ($actual_usd_total >= $expected_usd_total) {
        $pending = 0.00;
        $complete = "yes";
        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, 'UPDATE users SET usd=?, pending=?, complete=? WHERE id=?')) {
            mysqli_stmt_bind_param($stmt, "ddsi", $actual_usd, $pending, $complete, $users_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
}