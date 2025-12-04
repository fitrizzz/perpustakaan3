<?php
include "conn.php";
include "s_bord.php";
session_start();
$datang = $_SESSION["datang"];

if(isset($_POST["hantar"])){
    $nama = $_POST["nama"];
    $pass = $_POST["pass"];
    $email = $_POST["email"];

    $sql = "SELECT nama_pengguna FROM pengguna WHERE nama_pengguna = '$nama'";
    $result = mysqli_query($conn,$sql);

    $sql2 = "SELECT staff_nama FROM staff WHERE staff_nama = '$nama'";
    $result2 = mysqli_query($conn,$sql2);

    $sql3 = "SELECT admin_nama FROM staff WHERE admin_nama = '$nama'";
    $result3 = mysqli_query($conn,$sql3);

    if( $row = mysqli_fetch_assoc($result) OR
        $row2 = mysqli_fetch_assoc($result2) OR 
        $row3 = mysqli_fetch_assoc($result3)){
    
        // echo "USER NAMA TELAH ADA SILA GUNA NAMA YANG LAIN";

    echo"<script>
            alert('USER NAMA TELAH ADA SILA GUNA NAMA YANG LAIN');
    </script>";

    }else{
        $sql = "INSERT INTO pengguna VALUES('','$pass','$nama','$email')";
        mysqli_query($conn,$sql);
        
    
    echo"<script>
        alert('TAMBAH PENGGUNA BERJAYA');
            window.location.href = 's_senarai_pengguna.php';
    </script>";
    }

}
?>
<html>
    <body>
        <div class="conten">
            <form action="s_tambah_pengguna.php" method="POST">
                <label for="nama">nama : </label>
                <input type="text" name="nama" placeholder="nama" id="">

                <label for="pass">password : </label>
                <input type="text" name="pass" placeholder="password" id="">

                <label for="email">email : </label>
                <input type="text" name="email" placeholder="email" id="">
                <button type="submit" name="hantar">TAMBAH</button>
            </form>
        </div>
    </body>
</html>