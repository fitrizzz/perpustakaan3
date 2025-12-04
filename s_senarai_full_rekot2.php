<?php
include "conn.php";
include "s_bord.php";
session_start();

$syaratuser = "";
$syaratbuku = "";

$sql = "SELECT * FROM pengguna JOIN pinjam JOIN buku
        WHERE pengguna.pengguna_id = pinjam.pengguna_id AND pinjam.buku_id = buku.buku_id ";

if(isset($_POST["cari"])){
    $syaratbuku = $_POST["namauser"];
    $syaratbuku = $_POST["tajukbuku"];
    var_dump($namabuku);
    var_dump($tajukbuku);
    echo "<script>alert('TAMBAH buku BERJAYA');</script>";

    
    if($syaratuser == NULL AND $syaratbuku != NULL){
        $sql = "SELECT * FROM pengguna JOIN pinjam JOIN buku
            WHERE pengguna.pengguna_id = pinjam.pengguna_id AND pinjam.buku_id = buku.buku_id
            AND nama_buku LIKE '%$syaratbuku%'";
            echo "aergfhudfgiohsdfgik";

    }elseif($syaratuser != NULL AND $syaratbuku == NULL){
        echo "<script>alert('TAMBAH buku BERJAYA');</script>";


    }elseif($syaratuser != NULL AND $syaratbuku != NULL){
        echo "<script>alert('TAMBAH buku BERJAYA');</script>";


    }
}else{
    // echo "<script>alert('hureeeeee');</script>";

}
?>
<html>
    <body>
        <div class="conten">
            <form action="s_senarai_full_rekot.php" method="POST">
                <label for="namauser">nama user : </label><input type="text" name="namauser">
                <label for="namauser">tajuk buku : </label><input type="text" name="tajukbuku">
                <button type="submit" nama="cari">CARI</button>
            </form>


            <br><h2>JADUAL BUKU</h2>
            <!-- <h3><a href="tambah_buku.php">TAMBAH</a></h3> -->
            <table border="5px">
                <tr>
                    <th>pinjam id</th>
                    <th>tarikh pinjam</th> 
                    <th>tarikh pulang</th> 
                    <th>nama pengguna</th>
                    <th>nama buku</th>
                    <th>ststus</th>

                </tr>
                <?php 


                    
                    $result = mysqli_query($conn,$sql);
                    
                    while($row = mysqli_fetch_assoc($result)){

                        $pinjamid = $row["pinjam_id"];
                        $tpinjam = $row["tarikh_pinjam"];
                        $tpulang = $row["tarikh_pulang"];
                        $penggunaid = $row["pengguna_id"];
                        $bukuid = $row["buku_id"];
                        $tersedia = $row["status"];

                        // $sql2 = "SELECT * FROM pengguna WHERE pengguna_id = $penggunaid";
                        // $result2 = mysqli_query($conn,$sql2);
                        // $result2 = mysqli_fetch_assoc($result2);
                        $namapengguna = $row["nama_pengguna"];

                        // var_dump($namapengguna);

                        // $sql2 = "SELECT * FROM buku WHERE buku_id = $bukuid";
                        // $result2 = mysqli_query($conn,$sql2);
                        // $result2 = mysqli_fetch_assoc($result2);
                        $namabuku = $row["nama_buku"];
                        
                        echo "<tr>
                                <th>$pinjamid</th>
                                <th>$tpinjam</th> 
                                <th>$tpulang</th> 
                                <th>$namapengguna</th>
                                <th>$namabuku</th>
                                <th>$tersedia</th>
                            </tr>";
                    }
                ?>
            </table>
        </div>
    </body>
</html>
