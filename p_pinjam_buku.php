<?php
    include "conn.php";
    include "p_bord.php";

    session_start();
    $id = $_SESSION["id"];

    if(isset($_GET["bukuid"])){
        $bukuid = $_GET["bukuid"];
    }

    if(isset($_POST["hantar"])){
        $pid = $_POST["pid"];
        $bukuid = $_POST["bukuid"];
        $tpinjam = $_POST["tpinjam"];
        $tpulang = $_POST["tpulang"];

        if($tpulang < $tpinjam ){
            error_reporting(0);
            echo "<script>alert('BIAR BERTUL pinjam $t$tpinjam pulang $tpulang mana logik')</script>";
            $tpinjam = NULL;
            $tpulang = NULL;

        }else{
            $sql = "UPDATE buku SET status = 'tidak_tersedia' WHERE buku_id = $bukuid";
            $result = mysqli_query($conn,$sql);
        
            $sql = "INSERT INTO pinjam VALUES('','$tpinjam','$tpulang',$pid,NULL,$bukuid,'lulus')";
            $result = mysqli_query($conn,$sql);

            echo "<script>
                    alert ('BERJAYA PINJAM');
                    window.location.href = 'p_senarai_buku.php';
                </script>";
        }
    }
?>
<html>
    <body>
        <div class="conten">
            <form action="p_pinjam_buku.php" method="POST">
                <input type="text" name="pid" value="<?= $id ?>" readonly><br>
                <input type="text" name="bukuid" value="<?= $bukuid ?>" readonly><br>
                <input type="date" name="tpinjam" required><br>
                <input type="date" name="tpulang" required><br>
                <button type="submit" name="hantar">PINJAM</button>
            </form>
        </div>
    </body>
</html>