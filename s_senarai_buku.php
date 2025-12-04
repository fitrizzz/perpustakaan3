<?php
    include "conn.php";
    include "s_bord.php";
    session_start();
    $query = "";

    if(isset($_POST["cari"])){
        $namabuku = $_POST["tajukbuku"];
        $kategori = $_POST["katerogi"];

        if($namabuku != NULL AND $kategori == NULL){
            $query = "WHERE nama_buku LIKE '%$namabuku%'";

        }elseif($namabuku == NULL AND $kategori != NULL){
            $query = "WHERE kategori = '$kategori'";

        }elseif($namabuku != NULL AND $kategori != NULL){
            $query = " WHERE nama_buku LIKE '%$namabuku%' AND 
                        kategori = '$kategori'";
        }

    }
?>
<html>
    <body>
        <div class="conten">
        
        <form action="s_senarai_buku.php" method="POST">
            <label for="tajukbuku">tajuk buku : </label><input type="text" name="tajukbuku">
                <label for="kategori">kategori : </label><select name="katerogi">
                        <option value=""></option>
                        <option value="database">database</option>
                        <option value="programing">programing</option>
                        <option value="multimedia">multimedia</option>
                        <option value="computer arceture">computer arceture</option>
                        <option value="matematic">matematic</option>
                        <option value="AI">AI</option>
                </select>

                    <button type="submit" name="cari">CARI</button>
                </form>
        
        
        <br><h2>JADUAL BUKU</h2>
        <h3><a href="s_tambah_buku.php">TAMBAH</a></h3>
        <table border="5px">
            <tr>
                <th>ISBN NUMBER</th>
                <th>nama buku</th> 
                <th>keterangan</th> 
                <th>harga</th>
                <th>kategori</th>
                <th>gambar</th>
                <th>tersedia</th>
                <th>UPDATE</th>
                <th>PADAM</th>

            </tr>
            <?php 
                $sql = "SELECT * FROM buku $query";
                $result = mysqli_query($conn,$sql);

                while($row = mysqli_fetch_assoc($result)){
                    $id = $row["buku_id"];
                    $nama = $row["nama_buku"];
                    $keterangan = $row["keterangan"];
                    $harga = $row["harga"];
                    $kategori = $row["kategori"];
                    $gambar = $row["gambar"];
                    $tersedia = $row["status"];
                                        
                    echo "<tr>
                            <th>$id</th>
                            <th>$nama</th> 
                            <th>$keterangan</th> 
                            <th>$harga</th>
                            <th>$kategori</th>
                            <th><img src='imej/$gambar' width='150px'></th>
                            <th>$tersedia</th>
                            <th><a href='s_update_buku.php?bukuid=$id'>update</a></th>
                            <th><a href='s_padam_buku.php?bukuid=$id'>padam</a></th>
                        </tr>";
                }
            ?>
        </table>
        </div>
        <h1>ssssss</h1>
    </body>
</html>