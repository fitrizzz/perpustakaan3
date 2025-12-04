<?php
    session_start();
    include "conn.php";
    include "p_bord.php";
    $pid = $_SESSION["id"];
    
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
            mysqli_query($conn,$sql);
    
            $sql = "DELETE FROM pinjam WHERE pengguna_id = $pid AND buku_id = $bukuid AND status = 'noti_me'";
            mysqli_query($conn,$sql);
    
            $sql = "INSERT INTO pinjam VALUES('','$tpinjam','$tpulang',$pid,NULL,$bukuid,'lulus')";
            mysqli_query($conn,$sql);
    
            echo "<script>
                alert ('BERJAYA PINJAM');
                window.location.href = 'p_senarai_buku.php';
            </script>";
        }

    }

    $sql = "SELECT * FROM pinjam WHERE buku_id = $bukuid and status = 'lulus' AND pengguna_id != $pid";
    $result = mysqli_query($conn,$sql);
    
    if(($row = mysqli_fetch_assoc($result)) == true){
        echo "<script>alert('ADE ORANG BELUM PULANG BUKU TU SABO LA !!!!!!!!!');</script>";
    }else{

        echo " <div class='conten'>
                <form action='p_terima_dari_noti_buku.php' method='POST'>
                    <input type='text' name='pid' value='$pid' readonly><br>
                    <input type='text' name='bukuid' value='$bukuid' readonly><br>
                    <input type='date' name='tpinjam' required><br>
                    <input type='date' name='tpulang' required><br>
                    <button type='submit' name='hantar'>PINJAM</button>
                </form>
            </div>
        ";

    }

    // header("location: home_pengguna.php");
?>