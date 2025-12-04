<?php
    include "conn.php";
    include "s_bord.php";
    session_start();
    $query = "";

    
    if(isset($_POST["cari"])){
        $namauser = $_POST["namauser"];
        $tajuk = $_POST["tajukbuku"];
        $status = $_POST["status"];

        if($namauser != NULL AND $tajuk == NULL AND $status == NULL){
            $query = "AND pengguna.nama_pengguna LIKE '%$namauser%'";

        }elseif($namauser == NULL AND $tajuk != NULL AND $status == NULL){
            $query = "AND buku.nama_buku LIKE '%$tajuk%'";

        }elseif($namauser == NULL AND $tajuk == NULL AND $status != NULL){
            $query = "AND pinjam.status = '$status'";

        }elseif($namauser != NULL AND $tajuk != NULL AND $status == NULL){
            $query = "AND pengguna.nama_pengguna LIKE '%$namauser%' AND
                        buku.nama_buku LIKE '%$tajuk%'";

        }elseif($namauser == NULL AND $tajuk != NULL AND $status != NULL){
            $query = "AND buku.nama_buku LIKE '%$tajuk%' AND 
                        pinjam.status = '$status'";

        }elseif($namauser != NULL AND $tajuk == NULL AND $status != NULL){
            $query = "AND pengguna.nama_pengguna LIKE '%$namauser%' AND 
                        buku.status = '$status'";
                
        }elseif($namauser != NULL AND $tajuk != NULL AND $status != NULL){
            $query = "AND pengguna.nama_pengguna LIKE '%$namauser%' AND 
                        buku.nama_buku LIKE '%$tajuk%' AND 
                        pinjam.status = '$status'";
            
        }else{

        }


    }else{
        $query = "";
    }
?>
<html>
    <body>
        <div class="conten">
            <br>
            <form action="s_senarai_full_rekot.php" method="POST">
                <label for="namauser">nama user : </label><input type="text" name="namauser">
                <label for="tajukbuku">tajuk buku : </label><input type="text" name="tajukbuku">
                <label for="status">status buku : </label><select name="status">
                    <option value=""></option>
                    <option value="lulus">lulus</option>
                    <option value="noti_me">noti me</option>
                    <option value="dipulangkan">dipulangkan</option>
                    <option value="noti_buang">noti dibuang</option>
                </select>

                    <button type="submit" name="cari">CARI</button>
                </form>
                
                <br><br><h1>SENARAI PINJAM</h1>
                <table border="1">
                    <tr>
                        <th>pinjam id</th>
                        <th>tarikh pinjam</th> 
                        <th>tarikh pulang</th> 
                        <th>nama pengguna</th>
                        <th>nama buku</th>
                        <th>ststus</th>
                    </tr>

                    <?php 

                        $sql = "SELECT* FROM pengguna JOIN pinjam JOIN buku
                                WHERE pengguna.pengguna_id = pinjam.pengguna_id AND pinjam.buku_id = buku.buku_id $query";
                        $result = mysqli_query($conn,$sql);

                        while($row = mysqli_fetch_array($result)) { 
                            
                            $pinjamid = $row["pinjam_id"];
                            $tpinjam = $row["tarikh_pinjam"];
                            $tpulang = $row["tarikh_pulang"];
                            $penggunaid = $row["pengguna_id"];
                            $bukuid = $row["buku_id"];
                            $tersedia = $row["10"]; 
                            $namapengguna = $row["nama_pengguna"];
                            $namabuku = $row["nama_buku"]; 

                            echo "<tr>
                                <th>$pinjamid</th>
                                <th>$tpinjam</th> 
                                <th>$tpulang</th> 
                                <th>$namapengguna</th>
                                <th>$namabuku</th>
                                <th>$tersedia</th>
                            </tr>";
                        } ?>
                </table>
        </div>
    </body>
</html>