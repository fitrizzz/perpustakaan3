<?php
    include "conn.php";
    $role =  $_SESSION["role"];
    // session_start();
    
?>

<div class="sidebar">
                <header>STAFF</header>
                <ul>
                    <li><a href="s_home.php" >HOME</a></li>
                    <li><a href="s_pov.php">OVER VIEW</a></li>
                    <li><a href="s_senarai_pengguna.php" >urus pengguna</a></li>
                    <li><a href="s_senarai_buku.php">SENARAI BUcKU</a></li>
                    <!-- <li><a href="s_senarai_buku_dipinjam.php">REKOT YG PULAG PINJAM</a></li>
                    <li><a href="s_senarai_buku_dipulang.php">REKOT YG PULAG BUKU</a></li> -->
                    <?php if($role == "admin"){ ?>
                            <li><a href="#">hoREEEEEEE</a></li>
                        <?php } ?>
                    <li><a href="s_senarai_full_rekot.php">RECORD BUKU</a></li>
                    <li><a href="s_senarai_buku_lambat.php">lambat hantar</a></li>
            
                    <li><a href="s_edit_profil.php" >EDIT PROFIL</a></li>
                    <li><a href="logout.php" >LOGOUT</a></li>
                </ul>
</div>