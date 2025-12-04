<?php
    session_start();
    include "conn.php";

    $pid = $_SESSION["id"];
    $bukuid = $_GET["bukuid"];

    // $sql = "DELETE FROM pinjam WHERE ";
    $sql = "UPDATE pinjam SET status = 'noti_buang' WHERE pengguna_id = $pid AND buku_id = $bukuid AND status = 'noti_me'";
    mysqli_query($conn,$sql);

    header("location: p_senarai_noti_buku.php");
?>