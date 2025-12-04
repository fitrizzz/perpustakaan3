<?php
    include "conn.php";
    session_start();

    $id = $_GET["bukuid"];
    $datang = $_SESSION["datang"];

    $sql = "DELETE FROM buku WHERE buku_id = $id";
    mysqli_query($conn,$sql);

    header("location: s_senarai_buku.php");
?>