<?php
    include "conn.php";
    session_start();

    $pid = $_GET["pid"];
    // $status = $_GET["status"];
    // $datang = $_GET["datang"];

    $sql = "DELETE FROM pengguna WHERE pengguna_id = $pid";
    mysqli_query($conn,$sql);
    header("location: s_senarai_pengguna.php");

?>