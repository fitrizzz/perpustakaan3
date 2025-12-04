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
            <th>tarikh pinjam</th>
            <th>tarikh pulang</th>
            <th>PULANG BUKU</th>
        </tr>
        <?php 
        // $sql = "SELECT * FROM buku WHERE buku_id IN 
        //                 (SELECT buku_id FROM pinjam WHERE pengguna_id = $pid AND status = 'lulus')";
            $sql = "SELECT * FROM buku JOIN pinjam 
                    WHERE buku.buku_id = pinjam.buku_id AND pinjam.pengguna_id = $pid AND pinjam.status = 'lulus'";
                
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <th><?php echo $row["buku_id"] ?></th>
                        <th><?php echo $row["nama_buku"] ?></th>
                        <th><img width='100px' src="imej/<?= $row["gambar"] ?>"></th>
                        <th><?php echo $row["tarikh_pinjam"] ?></th>
                        <th><?php echo $row["tarikh_pulang"] ?></th>
                        <th><a href="p_pulang_buku.php?bukuid=<?=$row["buku_id"]?>&namabuku=<?=$row["nama_buku"]?>">PULANG</a></th>
                    </tr>
                <?php } ?>

        </table>
    <!-------------------------- BUKU pinjam----------------------------------------->

        </div>
    </body>
</html>