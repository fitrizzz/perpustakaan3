<?php
    include "conn.php";
    include "s_bord.php";
    session_start();
    $sid = $_SESSION["id"];
    $nama = $_SESSION["nama"];
    $email = $_SESSION["email"];
    $pass = $_SESSION["pass"];

    if(isset($_POST["update"])){
        $nnama = $_POST["nama"];
        $ppass = $_POST["pass"];
        $eemail = $_POST["email"];

        $sql1 = "SELECT nama_pengguna FROM pengguna WHERE nama_pengguna = '$nnama'";
        $result1 = mysqli_query($conn,$sql1);

        $sql2 = "SELECT staff_nama FROM staff WHERE staff_nama = '$nnama' AND staff_id != $sid";
        $result2 = mysqli_query($conn,$sql2);

        $sql3 = "SELECT admin_nama FROM staff WHERE admin_nama = '$nnama' AND staff_id != $sid";
        $result3 = mysqli_query($conn,$sql3);

        if( $row = mysqli_fetch_assoc($result1) OR
            $row2 = mysqli_fetch_assoc($result2) OR 
            $row3 = mysqli_fetch_assoc($result3)){

                echo "<script>alert('Username telah ada sila guna yang lain')</script>";
                
        }else{
            $sql = "UPDATE staff SET staff_nama = '$nnama',
                    password = '$ppass', email = '$eemail' WHERE staff_id = $sid";
            mysqli_query($conn,$sql);

            $_SESSION["nama"] = $nnama;
            $_SESSION["pass"] = $ppass;
            $_SESSION["email"] = $eemail;

            echo "<script>alert('berjaya')
            window.location.href = 's_edit_profil.php';
            </script>";
        }
    }
?>
<html>
    <body>
        <div class="conten">
            <form action="s_edit_profil.php" method="POST">
                <input type="text" name="nama" value="<?=$nama?>">
                <input type="text" name="pass"value="<?=$pass?>">
                <input type="text" name="email"value="<?=$email?>">
                <button type="submit" name="update">UPDATE</button>
            </form>
        </div>
    </body>
</html>