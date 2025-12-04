<?php
    include "conn.php";    
    include "s_bord.php";
    session_start();
    $datang = $_SESSION["datang"];

    if(isset($_GET["bukuid"])){
        $buku_id = $_GET["bukuid"];
        
        $sql = "SELECT * FROM buku WHERE buku_id = $buku_id";
        $result = mysqli_query($conn,$sql);
        $result = mysqli_fetch_assoc($result);
        // var_dump($result);
        $nama_buku = $result["nama_buku"];
        $keterangan = $result["keterangan"];
        $harga = $result["harga"];
        $kategori = $result["kategori"];
        $gambar = $result["gambar"];
        $status = $result["status"];
        
    }

    if(isset($_POST["hantar"])){
        // echo "butang hantar ditekan";
        $buku_id = $_POST["buku_id"];
        $nama_buku = $_POST["nama_buku"];
        $keterangan = $_POST["keterangan"];
        $harga = $_POST["harga"];
        $kategori = $_POST["kategori"];
        $status = $_POST["status"];
        // $gambar = $_POST["gambar"];
        $namafail = $buku_id.".png";
        $sementara =  $_FILES["namafail"]["tmp_name"];
        move_uploaded_file($sementara, "imej/".basename($namafail));

        $sql = "UPDATE buku SET nama_buku = '$nama_buku',keterangan = '$keterangan',harga=$harga,
                kategori='$kategori',gambar='$namafail',status='$status' 
                WHERE buku_id = $buku_id";
        mysqli_query($conn, $sql);

        echo"<script>
        alert('update buku BERJAYA');
            window.location.href = 's_senarai_buku.php';
        </script>";
    }else{

    }

?>
<html>
    <body>
        <div class="conten">
        <form action="s_update_buku.php" method="POST" enctype="multipart/form-data">
        <label for="buku_id">BUKU ID</label>
                <input type="text" name="buku_id" value="<?=$buku_id ?>" readonly><br>

            <label for="nama_buku">NAMA BUKU</label>
                <textarea name="nama_buku" id="" rows="5"><?=$nama_buku ?></textarea><br>
    
            <label for="keterangan">KETERANGAN</label>
                <textarea name="keterangan" id="" rows="10"><?=$keterangan ?></textarea><br>
            
            <label for="harga">HARGA</label>
                <input type="text" name="harga" value="<?=$harga ?>"><br>
                
            <label for="kategori">KATEGORI</label>
                <select name="kategori" required>
                        <option value="<?= $kategori?>"><?php echo"$kategori"?></option>
                        <option value="database">database</option>
                        <option value="programing">programing</option>
                        <option value="multimedia">multimedia</option>
                        <option value="computer arceture">computer arceture</option>
                        <option value="matematic">matematic</option>
                        <option value="AI">AI</option>
                    </select><br>

    
            <label for="namafail">GAMBAR</label>
            <th><img  width="100" src="imej/<?= $buku_id ?>.png"></th>
                <input type="file" name="namafail" src=""><br>
    
            <label for="status">STATUS</label>
                <select name="status" required>
                        <option value="tersedia">tersedia</option>
                        <option value="tidak_tersedia">tidak_tersedia</option>

                    </select><br>
            <button type="submit" name="hantar">hantar</button>
        </form>
        </div>
        
        <?php 
            if($datang == "staff"){
                echo "<a href='home_staff.php'>Back</a>";
            }elseif($datang == "admin"){
                echo "<a href='home_admin.php'>Back</a>";
            }else{

            }
        ?>
    </body>
</html>