<?php
    include "conn.php";
    include "p_bord.php";
    session_start();
    $nama = $_SESSION["nama"];
    $pid = $_SESSION["id"];
    $query = "";

    if(isset($_POST["cari"])){
        $namabuku = $_POST["tajukbuku"];
        $kategori = $_POST["katerogi"];

        if($namabuku != NULL AND $kategori == NULL){
            $query = "AND nama_buku LIKE '%$namabuku%'";

        }elseif($namabuku == NULL AND $kategori != NULL){
            $query = "AND kategori = '$kategori'";

        }elseif($namabuku != NULL AND $kategori != NULL){
            $query = "AND nama_buku LIKE '%$namabuku%' AND 
                        kategori = '$kategori'";
        }

    }
?>
<div class="conten">

    <form action="p_senarai_buku.php" method="POST">    
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
    </form><br><br>

        <!-------------------------- BUKU ADA ----------------------------------------->
        <h2>senarai buku yang tersedia</h2>
        <table border="5px">
            <tr>
                <th>buku id</th>
                <th>nama buku</th>
                <th>gambar</th>
                <th>detail
                <th>pinjam sekarang</th>
            </tr>
            
            
            <?php $sql1 = "SELECT * FROM buku WHERE status = 'tersedia' AND buku_id NOT IN
                            (SELECT buku_id FROM pinjam WHERE (status = 'noti_me' OR status = 'lulus' ) AND pengguna_id = '$pid')
                            $query";
                    $result1 = mysqli_query($conn,$sql1);
                    while($row = mysqli_fetch_assoc($result1)) { ?>
                        <tr>
                            <th><?php echo $row["buku_id"] ?></th>
                            <th><?php echo $row["nama_buku"] ?></th>
                            <th><img width='100px' src="imej/<?=$row['gambar']?>"></th>
                            <th><a href="p_buku_detail.php?bukuid=<?=$row["buku_id"]?>">DETAIL</a></th>
                            <th><a href="p_pinjam_buku.php?bukuid=<?=$row["buku_id"]?>">PINJAM</a></th>
                        </tr>
                    <?php } ?>
        </table>
        <!-------------------------- BUKU ADA ----------------------------------------->

        <!-------------------------- BUKU tiada ----------------------------------------->
        <br><br><h2>buku yang tidak tersedia</h2>
            <table border="5px">
            <tr>
                <th>buku id</th>
                <th>nama buku</th>
                <th>noti me</th>
            </tr>
            <?php $sql = "SELECT * FROM buku WHERE status = 'tidak_tersedia'";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <th><?php echo $row["buku_id"] ?></th>
                            <th><?php echo $row["nama_buku"] ?></th>
                            <th><a href="p_noti_buku.php?bukuid=<?=$row["buku_id"]?>">noti me</a></th>
                        </tr>
                    <?php endwhile; ?>
    
            </table>
        <!-------------------------- BUKU tiada----------------------------------------->