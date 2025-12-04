<?php
    include "conn.php";
    include "s_bord.php";
    session_start();

    if(isset($_GET["pid"])){
        $pid = $_GET["pid"];
        $sql = "SELECT * FROM pengguna WHERE pengguna_id = $pid";
        $result = mysqli_query($conn,$sql);
        $result = mysqli_fetch_assoc($result);
        $pass = $result["password"];
        $nama = $result["nama_pengguna"];
        $email = $result["email"];
    }
    if(isset($_POST["hantar"])){
        $pid = $_POST["pid"];
        $nama = $_POST["nama"];
        $pass = $_POST["pass"];
        $email = $_POST["email"];


        $sql1 = "SELECT nama_pengguna FROM pengguna WHERE nama_pengguna = '$nama'";
        $result1 = mysqli_query($conn,$sql1);
    
        $sql2 = "SELECT staff_nama FROM staff WHERE staff_nama = '$nama'";
        $result2 = mysqli_query($conn,$sql2);
    
        $sql3 = "SELECT admin_nama FROM staff WHERE admin_nama = '$nama'";
        $result3 = mysqli_query($conn,$sql3);

        if( $row = mysqli_fetch_assoc($result1) OR
            $row2 = mysqli_fetch_assoc($result2) OR 
            $row3 = mysqli_fetch_assoc($result3)){
            
        echo"<script>alert('USER NAMA TELAH ADA SILA GUNA NAMA YANG LAIN');</script>";

        }else{
            $sql = "UPDATE pengguna SET nama_pengguna = '$nama', password = '$pass', 
                    email = '$email' WHERE pengguna_id = $pid";
            mysqli_query($conn,$sql);

        echo"<script>alert('UPDATE BERJAYA');
                window.location.href = 's_senarai_pengguna.php';
        </script>";
        }


    }
?>
<html>
    <body>
        <div class="conten">
            <form action="s_update_pengguna.php" method="POST">
                <input type="text" name="pid" value=" <?=$pid?>" readonly>
                <input type="text" name="nama" value="<?=$nama?>">
                <input type="text" name="pass" value="<?=$pass?>">
                <input type="email" name="email" value="<?=$email?>">
                <button type="submit" name="hantar">UPDATE</button>
            </form>
        </div>
    </body>
</html>