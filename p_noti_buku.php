<?php
    include "conn.php";
    session_start();

    $pid = $_SESSION["id"];
    $bukuid = $_GET["bukuid"];

    $sql = "SELECT * FROM pinjam WHERE pengguna_id = $pid AND buku_id = $bukuid AND status = 'lulus'";
    $result = mysqli_query($conn,$sql);
    
    if(($row = mysqli_fetch_assoc($result)) == true){
        echo "<script>alert('AWAK YANG PINJAM KENAPA NAK NOTI !!!!!!!!!');
            window.location.href = 'p_senarai_buku.php';
        </script>";
        // header("location: home_pengguna.php");
    }else{

        $sql = "SELECT * FROM pinjam WHERE pengguna_id = $pid AND buku_id = $bukuid AND status = 'noti_me'";
        $result = mysqli_query($conn,$sql);
        if(($row = mysqli_fetch_assoc($result)) == true){

        echo "<script>alert('AWAK DAH TEKAN NOTI KENAPE TEKAN LAGI :{');
                window.location.href = 'p_senarai_buku.php';
        </script>";
        
        }else{
        $sql = "INSERT INTO pinjam VALUES('',NULL,NULL,$pid,NULL,$bukuid,'noti_me')";
            mysqli_query($conn,$sql);
        
            echo"<script>
                alert('BERJAYA NOTI');
                window.location.href = 'p_senarai_buku.php';
            </script>";
        }

    }
    
?>