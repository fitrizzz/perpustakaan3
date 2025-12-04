<?php
include "conn.php";
include "p_bord.php";
session_start();
$pid = $_SESSION["id"];
$pnama = $_SESSION["nama"];
$pass = $_SESSION["pass"];
$email = $_SESSION["email"];

if (isset($_POST["hantar"])) {
    $nnama = $_POST["nama"];
    $ppass = $_POST["pass"];
    $eemail = $_POST["email"];

    // error_reporting(0);
    $sql = "SELECT nama_pengguna FROM pengguna WHERE nama_pengguna = '$nnama' AND pengguna_id != '$pid'";
    $result = mysqli_query($conn, $sql);

    error_reporting(0);
    $sql2 = "SELECT staff_nama FROM staff WHERE staff_nama = '$nnama' AND staff_id != '$pid'";
    $result2 = mysqli_query($conn, $sql2);

    error_reporting(0);
    $sql3 = "SELECT admin_nama FROM staff WHERE admin_nama = '$nnama' AND admin_id != '$pid'";
    $result3 = mysqli_query($conn, $sql3);

    if($row = mysqli_fetch_assoc($result) or $row2 = mysqli_fetch_assoc($result2) or
        $row3 = mysqli_fetch_assoc($result3)) {

        echo "<script>alert('Username telah ada sila guna yang lain')</script>";
    } else {

        if ($nnama == $pnama AND $pass == $ppass AND $email == $eemail) {
            echo "<script>alert('awak update ape ni')
            window.location.href = 'p_edit_acc.php';
            </script>";
        }else if($nnama == $pnama){
            $sql = "UPDATE pengguna SET password = '$ppass', email = '$eemail'
            WHERE pengguna_id = $pid";
            mysqli_query($conn, $sql);

            $_SESSION["pass"] = $ppass;
            $_SESSION["email"] = $eemail;

            echo "<script>alert('berjaya')
            window.location.href = 'p_edit_acc.php';
            </script>";
        }else{
            $sql = "UPDATE pengguna SET nama_pengguna = '$nnama', password = '$ppass', email = '$eemail'
                WHERE pengguna_id = $pid";
            mysqli_query($conn, $sql);

            $_SESSION["nama"] = $nnama;
            $_SESSION["pass"] = $ppass;
            $_SESSION["email"] = $eemail;

            echo "<script>alert('berjaya')
                window.location.href = 'p_edit_acc.php';
                </script>";
        }
    }
} else {
}
?>
<html>

<body>
    <div class="conten">
        <form action="p_edit_acc.php" method="POST">
            <label for="nama">nama : </label><input type="text" name="nama" value="<?= $pnama ?>" required><br>
            <label for="pass">password : </label><input type="text" name="pass" value="<?= $pass ?>" required><br>
            <label for="email">email : </label><input type="email" name="email" value="<?= $email ?>" required><br>
            <button type="submit" name="hantar">UPDATE</button>
        </form>
    </div>
</body>

</html>