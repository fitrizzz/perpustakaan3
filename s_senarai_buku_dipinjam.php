<?php
include "conn.php";
include "s_bord.php";
session_start();

?>
<html>
    <body>
        <div class="conten">
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
                    $sql = "SELECT * FROM pinjam WHERE status = 'lulus'";
                    $result = mysqli_query($conn,$sql);

                    while($row = mysqli_fetch_assoc($result)){

                        $pinjamid = $row["pinjam_id"];
                        $tpinjam = $row["tarikh_pinjam"];
                        $tpulang = $row["tarikh_pulang"];
                        $penggunaid = $row["pengguna_id"];
                        $bukuid = $row["buku_id"];
                        $tersedia = $row["status"];

                        $sql2 = "SELECT * FROM pengguna WHERE pengguna_id = $penggunaid";
                        $result2 = mysqli_query($conn,$sql2);
                        $result2 = mysqli_fetch_assoc($result2);
                        $namapengguna = $result2["nama_pengguna"];

                        // var_dump($namapengguna);

                        $sql2 = "SELECT * FROM buku WHERE buku_id = $bukuid";
                        $result2 = mysqli_query($conn,$sql2);
                        $result2 = mysqli_fetch_assoc($result2);
                        $namabuku = $result2["nama_buku"];
                        
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