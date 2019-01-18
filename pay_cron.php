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
$pending = "pending";
$unconfirmed = "unconfirmed";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, 'SELECT id, user_id, expected_satoshis,  expected_gvb, actual_gvb,  owed_gvb,  payment,address, paytime FROM bits WHERE payment=? OR payment=?')) {
    mysqli_stmt_bind_param($stmt, "ss", $pending, $unconfirmed);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $user_id, $expected_satoshis,  $expected_gvb, $actual_gvb, $owed_gvb, $payment,  $address, $paytime);

    while (mysqli_stmt_fetch($stmt)) {
        $bits[] = array($id, $user_id, $expected_satoshis,  $expected_gvb, $actual_gvb, $owed_gvb, $payment,  $address, $paytime);
    }

    $num = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);
}

for ($i = 0; $i < $num; $i++) {
    $id = $bits [$i] [0];
    $user_id = $bits [$i] [1];
    $expected_satoshis = $bits [$i] [2];
    $expected_gvb = $bits [$i] [3];
    $actual_gvb = $bits [$i] [4];
    $owed_gvb = $bits [$i] [5];
    $payment = $bits [$i] [6];
    $address = $bits [$i] [7];
    $paytime = $bits [$i] [8];

    // $url = "https://insight.bitpay.com/api/addr/" . $address . "/balance";
    $url = "https://test-insight.bitpay.com/api/addr/" . $address . "/balance";
    $actual_satoshis = file_get_contents($url, $headers = false);

    $expected_gvb_total = null;
    $actual_gvb_total = null;
    $stmt = mysqli_stmt_init($link);
    if (mysqli_stmt_prepare($stmt, 'SELECT SUM(expected_gvb), SUM(actual_gvb) FROM bits WHERE user_id=?')) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $expected_gvb_total, $actual_gvb_total);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }

    if (confirmations($address) && $owed_gvb == 0) {
        $actual_gvb = $actual_satoshis / $expected_satoshis * $expected_gvb;
        $payment = "confirmed";
        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, 'UPDATE bits SET  actual_gvb=?,  payment=? WHERE id=?')) {
            mysqli_stmt_bind_param($stmt, "dsi", $actual_gvb, $payment, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, 'SELECT user_email FROM users WHERE id=?')) {
            mysqli_stmt_bind_param($stmt, "i", $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $user_email);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        }

        if ($actual_satoshis / $expected_satoshis >= 1) {
            $subject = "payment confirmed";
            $message = "You will recieve " . $expected_gvb_total . " GVB.";
            $host = $_SERVER ['HTTP_HOST'];
            mail($user_email, $subject, $message, "From: \"Bits\" <bits@$host>\r\n" . "X-Mailer: PHP/" . phpversion());
        } else {
            $subject = "owe from cron";
            $owed = $expected_gvb - $actual_gvb;
            $message = "Payment pending for  " . $owed . " GVB.";
            $host = $_SERVER ['HTTP_HOST'];
            mail($user_email, $subject, $message, "From: \"Debt department cron\" <debt@$host>\r\n" . "X-Mailer: PHP/" . phpversion());
        }
    }

    if (confirmations($address) && $owed_gvb > 0) {
        $actual_gvb = $actual_satoshis / $expected_satoshis * $owed_gvb;

        $payment = "confirmed";
        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, 'UPDATE bits SET  actual_gvb=?,  payment=? WHERE id=?')) {
            mysqli_stmt_bind_param($stmt, "dsi", $actual_gvb, $payment, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, 'SELECT user_email FROM users WHERE id=?')) {
            mysqli_stmt_bind_param($stmt, "i", $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $user_email);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        }

        if ($actual_satoshis / $expected_satoshis >= 1) {
            $subject = "payment confirmed";
            $message = "You will recieve " . $expected_gvb_total . " GVB.";
            $host = $_SERVER ['HTTP_HOST'];
            mail($user_email, $subject, $message, "From: \"Bits\" <bits@$host>\r\n" . "X-Mailer: PHP/" . phpversion());
        } else {
            $subject = "owe from cron";
            $owed = $expected_gvb - $actual_gvb;
            $message = "Payment pending for  " . $owed . " GVB.";
            $host = $_SERVER ['HTTP_HOST'];
            mail($user_email, $subject, $message, "From: \"Debt department cron\" <debt@$host>\r\n" . "X-Mailer: PHP/" . phpversion());
        }
    }

    //    if ((time() - strtotime($paytime)) > 36 && !satoshis($address)) {
    //        $payment = "canceled";
    //        $stmt = mysqli_stmt_init($link);
    //        if (mysqli_stmt_prepare($stmt, 'UPDATE bits SET payment=? WHERE id=?')) {
    //            mysqli_stmt_bind_param($stmt, "si", $payment, $id);
    //            mysqli_stmt_execute($stmt);
    //            mysqli_stmt_close($stmt);
    //        }
    //    }
    //
    //    $stmt = mysqli_stmt_init($link);
    //    if (mysqli_stmt_prepare($stmt, 'UPDATE bits SET actual_satoshis=?, owed=? WHERE id=?')) {
    //        mysqli_stmt_bind_param($stmt, "iii", $actual_satoshis, $owed, $id);
    //        mysqli_stmt_execute($stmt);
    //        mysqli_stmt_close($stmt);
    //    }
    //
    //    if (!satoshis($address)) {
    //        $expected_satoshis = $expected_gvb * usd_in_satoshi();
    //        $stmt = mysqli_stmt_init($link);
    //        if (mysqli_stmt_prepare($stmt, 'UPDATE bits SET expected_satoshis=? WHERE id=?')) {
    //            mysqli_stmt_bind_param($stmt, "ii", $expected_satoshis, $id);
    //            mysqli_stmt_execute($stmt);
    //            mysqli_stmt_close($stmt);
    //        }
    //   }
    //    if (confirmations($address) && $actual_satoshis >= $expected_satoshis) {
    //        $actual_gvb = $actual_satoshis / $expected_satoshis * $expected_gvb;
    //        $payment = "confirmed";
    //        $stmt = mysqli_stmt_init($link);
    //        if (mysqli_stmt_prepare($stmt, 'UPDATE bits SET actual_satoshis=?, actual_gvb=?,  payment=? WHERE id=?')) {
    //            mysqli_stmt_bind_param($stmt, "idsi", $actual_satoshis, $actual_gvb, $payment, $id);
    //            mysqli_stmt_execute($stmt);
    //            mysqli_stmt_close($stmt);
    //        }
    //
    //        $stmt = mysqli_stmt_init($link);
    //        if (mysqli_stmt_prepare($stmt, 'SELECT user_email FROM users WHERE id=?')) {
    //            mysqli_stmt_bind_param($stmt, "i", $user_id);
    //            mysqli_stmt_execute($stmt);
    //            mysqli_stmt_bind_result($stmt, $user_email);
    //            mysqli_stmt_fetch($stmt);
    //            mysqli_stmt_close($stmt);
    //        }
    //
    //        $subject = "payment confirmed";
    //        $message = "You will recieve " . $expected_gvb . " GVB.";
    //        $host = $_SERVER ['HTTP_HOST'];
    //        mail($user_email, $subject, $message, "From: \"Bits\" <bits@$host>\r\n" . "X-Mailer: PHP/" . phpversion());
    //    }
    //
    //    if (confirmations($address) && $actual_satoshis < $expected_satoshis) {
    //        $actual_gvb = $actual_satoshis / $expected_satoshis * $expected_gvb;
    //
    //        $payment = "confirmed_wrong_amount";
    //        $stmt = mysqli_stmt_init($link);
    //        if (mysqli_stmt_prepare($stmt, 'UPDATE bits SET actual_satoshis=?, actual_gvb=?, owed_gvb=?, payment=? WHERE id=?')) {
    //            mysqli_stmt_bind_param($stmt, "iddsi", $actual_satoshis, $actual_gvb,  $owed_gvb, $payment, $id);
    //            mysqli_stmt_execute($stmt);
    //            mysqli_stmt_close($stmt);
    //        }
    //
    //        $stmt = mysqli_stmt_init($link);
    //        if (mysqli_stmt_prepare($stmt, 'SELECT user_email FROM users WHERE id=?')) {
    //            mysqli_stmt_bind_param($stmt, "i", $user_id);
    //            mysqli_stmt_execute($stmt);
    //            mysqli_stmt_bind_result($stmt, $user_email);
    //            mysqli_stmt_fetch($stmt);
    //            mysqli_stmt_close($stmt);
    //        }
    //
    //        $subject = "owe from cron";
    //        $message = "Payment pending for  " . $owed_gvb . " GVB.";
    //        $host = $_SERVER ['HTTP_HOST'];
    //        mail($user_email, $subject, $message, "From: \"Debt department cron\" <debt@$host>\r\n" . "X-Mailer: PHP/" . phpversion());
    //    }

    if (!confirmations($address) && satoshis($address)) {
        $payment = "unconfirmed";
        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, 'UPDATE bits SET payment=? WHERE id=?')) {
            mysqli_stmt_bind_param($stmt, "si", $payment, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }



    if ($expected_gvb_total >= $actual_gvb_total) {
        $complete = "yes";
        $stmt = mysqli_stmt_init($link);
        if (mysqli_stmt_prepare($stmt, 'UPDATE users SET complete=? WHERE id=?')) {
            mysqli_stmt_bind_param($stmt, "si", $complete, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            $complete = "no";
            $stmt = mysqli_stmt_init($link);
            if (mysqli_stmt_prepare($stmt, 'UPDATE users SET complete=? WHERE id=?')) {
                mysqli_stmt_bind_param($stmt, "si", $complete, $user_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }
    }
}