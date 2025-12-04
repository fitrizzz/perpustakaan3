<?php
    include "conn.php";
    include "p_bord.php";
    session_start();
    $pid = $_SESSION["id"];
?>
<html>
    <body>
        <div class="conten">
                    <!-------------------------- NOTI ----------------------------------------->
                    <h2>NOTIFIVATION</h2>
            <table border="5px">
            <tr>
                <th>buku id</th>
                <th>nama buku</th>
                <th>terima</th>
                <th>buang noti</th>
            </tr>
            
            <?php $sql = "SELECT * FROM buku WHERE buku_id IN 
                            (SELECT buku_id FROM pinjam WHERE pengguna_id = $pid AND status = 'noti_me')";
                    $result = mysqli_query($conn,$sql);

                    while($row = mysqli_fetch_assoc($result)) { 
                        $bid = $row["buku_id"];
                            
                            $sqlp = "SELECT buku_id FROM buku WHERE buku_id = 
                            (SELECT buku_id FROM pinjam WHERE buku_id = $bid AND status = 'lulus')";
                            
                            $resultp = mysqli_query($conn,$sqlp); 
                            $resultp =  mysqli_fetch_assoc($resultp);
                            // var_dump($resultp);
                            // var_dump($bid);

                        if(($resultp AND $bid)){
                            echo "
                                <tr>
                                <th>$row[buku_id] </th>
                                <th>$row[nama_buku] </th>
                                <th></th>
                                <th><a href='p_buang_noti.php?bukuid=$row[buku_id]'>buang</a></th>
                            </tr>
                            ";
                        }else{
                            echo "
                                <tr>
                            <th>$row[buku_id] </th>
                            <th>$row[nama_buku] </th>
                                <th><a href=p_terima_dari_noti_buku.php?bukuid=$row[buku_id]>terima</a></th>
                            <th><a href='p_buang_noti.php?bukuid=$row[buku_id]'>buang</a></th>
                        </tr>
                            ";
                        }?>

                    <?php } ?>
    
            </table>
        <!-------------------------- NOTI ----------------------------------------->
        </div>
    </body>
</html>