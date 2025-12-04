<?php
    include "conn.php";
    include "p_bord.php";
    session_start();
    $pid = $_SESSION["id"];
?>
<html>
    <body>
        <div class="conten">
                    <!-------------------------- BUKU pinjam ----------------------------------------->
        <h2>buku yang dipinjam</h2>
            <table border="5px">
            <tr>
                <th>buku id</th>
                <th>nama buku</th>
                <th>gambar</th>
                <th>PULANG BUKU</th>
            </tr>
            <?php $sql = "SELECT * FROM buku WHERE buku_id IN 
                            (SELECT buku_id FROM pinjam WHERE pengguna_id = $pid AND status = 'lulus')";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <th><?php echo $row["buku_id"] ?></th>
                            <th><?php echo $row["nama_buku"] ?></th>
                            <th><img src="imej/<?= $row["gambar"] ?>"></th>
                            <th><a href="p_pulang_buku.php?bukuid=<?=$row["buku_id"]?>&namabuku=<?=$row["nama_buku"]?>">PULANG</a></th>
                        </tr>
                    <?php endwhile; ?>
    
            </table>
        <!-------------------------- BUKU pinjam----------------------------------------->
        </div>
    </body>
</html>