<?php
session_start();
include "conn.php";
include "s_bord.php";
$query = "";

if(isset($_POST["cari"])){
    $nama = $_POST["nama"];
    $email = $_POST["email"];

    if($nama != NULL AND $email == NULL){
        $query = "WHERE nama_pengguna LIKE '%$nama%'";

    }elseif($nama == NULL AND $email != NULL){
        $query = "WHERE email LIKE '%$email%'";

    }elseif($nama != NULL AND $email != NULL){
        $query = "WHERE nama_pengguna LIKE '%$nama%' AND
                    email LIKE '%$email%'";
    }
}
?>
<html>

<body>
    <div class="conten">
        <form action="s_senarai_pengguna.php" method="POST">
            <label for="nama">nama : </label><input type="text" name="nama">
            <label for="email">email : </label><input type="text" name="email">
            <button type="submit" name="cari">cari</button>
        </form>
        <br>
        <h2>JADUAL PENGGUNA</h2>
        <h3><a href="s_tambah_pengguna.php">TAMBAH</a></h3>
        <table border="5px">
            <tr>
                <th>id</th>
                <th>nama</th>
                <th>password</th>
                <th>email</th>
                <th>UPDATE</th>
                <th>PADAM</th>
            </tr>
            <?php
            $sql = "SELECT * FROM pengguna $query";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row["pengguna_id"];
                $nama = $row["nama_pengguna"];
                $pass = $row["password"];
                $email = $row["email"];
 
                // $_SESSION["aksi"] = "update_pengguna";            
                echo "<tr>
                            <th>$id</th>
                            <th>$nama</th> 
                            <th>$pass</th> 
                            <th>$email</th>
                            
                            <th><a href='s_update_pengguna.php?pid=$id'>update</a></th>
                            <th><a href='s_padam_pengguna.php?pid=$id'>padam</a></th>
                        </tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>