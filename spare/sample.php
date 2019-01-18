<?php
//insert a new record if not exists
$unconfirmed = "unconfirmed";
$stmt = mysqli_stmt_init($link);
if (mysqli_stmt_prepare($stmt, 'SELECT user_id FROM gvb WHERE user_id=?')) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $user_id_g);
    mysqli_stmt_fetch($stmt);
    //        $num = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);

    if ($user_id != $user_id_g) {
        $stmt = mysqli_stmt_init($link);
        $sql = "INSERT INTO gvb  (user_id)
	            VALUES(?)";
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

}